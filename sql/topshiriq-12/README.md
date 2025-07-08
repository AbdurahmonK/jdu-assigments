-----

Sizning topshiriqlaringiz **Trigger**larga oid bo'lib, ular ma'lum bir hodisa (masalan, ma'lumot qo'shish yoki o'zgartirish) sodir bo'lganda avtomatik ravishda ishga tushadigan maxsus saqlangan protseduralardir. Quyidagi qadamlarda siz so'ragan ma'lumotlar bazasi va triggerlarni yaratamiz.

-----

## 1\. `barcelona` nomli ma'lumotlar bazasini yaratish va `futbolchilar` jadvalini tuzish

Avvalo, `barcelona` nomli yangi ma'lumotlar bazasini yaratamiz. Keyin ushbu baza ichida `futbolchilar` nomli jadvalni yaratamiz, uning ustunlari: `futbolchi_ismi`, `oylik_maoshi` va `yillik_maoshi` bo'ladi.

```sql
-- Ma'lumotlar bazasini yaratish
CREATE DATABASE IF NOT EXISTS barcelona;
USE barcelona;

-- `futbolchilar` jadvalini yaratish
CREATE TABLE futbolchilar (
    id INT PRIMARY KEY AUTO_INCREMENT,
    futbolchi_ismi VARCHAR(100) NOT NULL,
    oylik_maoshi DECIMAL(10, 2) NOT NULL,
    yillik_maoshi DECIMAL(12, 2) -- Yillik maoshni saqlash uchun kattaroq tur
);
```

**Izoh:**

  * `id INT PRIMARY KEY AUTO_INCREMENT`: Har bir futbolchi uchun noyob identifikator.
  * `futbolchi_ismi VARCHAR(100) NOT NULL`: Futbolchining ismi, bo'sh bo'lmasligi shart.
  * `oylik_maoshi DECIMAL(10, 2) NOT NULL`: Oylik maosh, maksimal 10 ta raqam va verguldan keyin 2 ta raqam. Bo'sh bo'lmasligi shart.
  * `yillik_maoshi DECIMAL(12, 2)`: Yillik maosh, maksimal 12 ta raqam va verguldan keyin 2 ta raqam. Bu ustunni triggerlar yordamida hisoblaymiz.

-----

## 2\. `after_insert_player` nomli trigger yaratish

Bu trigger `futbolchilar` jadvaliga yangi qator (futbolchi) qo'shilgandan so'ng (AFTER INSERT) ishga tushadi. Uning vazifasi yangi qo'shilgan futbolchining `oylik_maoshi` asosida `yillik_maoshi`ni hisoblash va uni jadvalga kiritishdir (oylik\_maoshi \* 12).

```sql
USE barcelona;

DELIMITER //

CREATE TRIGGER after_insert_player
AFTER INSERT ON futbolchilar
FOR EACH ROW
BEGIN
    UPDATE futbolchilar
    SET yillik_maoshi = NEW.oylik_maoshi * 12
    WHERE id = NEW.id;
END //

DELIMITER ;
```

**Izoh:**

  * `DELIMITER // ... DELIMITER ;`: Bu qatorlar trigger yaratishda ishlatiladi, chunki trigger tanasi ichida ham `;` belgisi ishlatiladi. `DELIMITER` so'rov yakunini bildiradi.
  * `CREATE TRIGGER after_insert_player`: `after_insert_player` nomli trigger yaratadi.
  * `AFTER INSERT ON futbolchilar`: Bu trigger `futbolchilar` jadvaliga ma'lumot qo'shilgandan **keyin** ishga tushishini bildiradi.
  * `FOR EACH ROW`: Har bir qo'shilgan qator uchun triggerning ishga tushishini ta'minlaydi.
  * `BEGIN ... END`: Trigger tanasini belgilaydi.
  * `UPDATE futbolchilar SET yillik_maoshi = NEW.oylik_maoshi * 12 WHERE id = NEW.id;`: Bu yerda `NEW` kalit so'zi yangi kiritilayotgan qatorning ma'lumotlariga murojaat qilish imkonini beradi. Trigger yangi futbolchining `oylik_maoshi`ni oladi, uni 12 ga ko'paytiradi va xuddi shu futbolchining `yillik_maoshi` ustuniga yozadi.

**Triggerning ishlashini tekshirish:**

```sql
USE barcelona;

INSERT INTO futbolchilar (futbolchi_ismi, oylik_maoshi) VALUES
('Lionel Messi', 1000000.00);

INSERT INTO futbolchilar (futbolchi_ismi, oylik_maoshi) VALUES
('Robert Lewandowski', 750000.00);

SELECT * FROM futbolchilar;
```

Yuqoridagi `INSERT` buyruqlarini bajarganingizda, `yillik_maoshi` ustuni avtomatik ravishda hisoblanib, to'ldirilganini ko'rishingiz kerak.

-----

## 3\. `after_update_player` nomli trigger yaratish

Bu trigger `futbolchilar` jadvalidagi mavjud qator (futbolchi) o'zgartirilgandan so'ng (AFTER UPDATE) ishga tushadi. Uning vazifasi, agar futbolchining `oylik_maoshi` o'zgargan bo'lsa, `yillik_maoshi`ni qayta hisoblash va yangilashdir.

```sql
USE barcelona;

DELIMITER //

CREATE TRIGGER after_update_player
AFTER UPDATE ON futbolchilar
FOR EACH ROW
BEGIN
    IF OLD.oylik_maoshi <> NEW.oylik_maoshi THEN
        UPDATE futbolchilar
        SET yillik_maoshi = NEW.oylik_maoshi * 12
        WHERE id = NEW.id;
    END IF;
END //

DELIMITER ;
```

**Izoh:**

  * `AFTER UPDATE ON futbolchilar`: Bu trigger `futbolchilar` jadvalidagi ma'lumotlar yangilangandan **keyin** ishga tushishini bildiradi.
  * `OLD` va `NEW` kalit so'zlari: `NEW` yangilangan qatorning yangi qiymatlariga, `OLD` esa yangilanishdan oldingi qiymatlariga murojaat qilish imkonini beradi.
  * `IF OLD.oylik_maoshi <> NEW.oylik_maoshi THEN ... END IF;`: Bu shart tekshiruvi. Agar futbolchining eski `oylik_maoshi` yangi `oylik_maoshi`ga teng bo'lmasa (ya'ni, maosh o'zgargan bo'lsa), faqatgina shu holda `yillik_maoshi` qayta hisoblanadi. Bu keraksiz yangilanishlarning oldini oladi.

**Triggerning ishlashini tekshirish:**

```sql
USE barcelona;

-- Lionel Messining oylik maoshini o'zgartirish
UPDATE futbolchilar
SET oylik_maoshi = 1200000.00
WHERE futbolchi_ismi = 'Lionel Messi';

-- Robert Lewandowskining ismini o'zgartirish (maosh o'zgarmaydi, shuning uchun trigger yillik_maoshini yangilamaydi)
UPDATE futbolchilar
SET futbolchi_ismi = 'Robert Lewandowski Jr.'
WHERE futbolchi_ismi = 'Robert Lewandowski';

SELECT * FROM futbolchilar;
```

Yuqoridagi `UPDATE` buyruqlarini bajarganingizda, Lionel Messining `oylik_maoshi` o'zgarganda `yillik_maoshi` ham avtomatik ravishda yangilanganini ko'rishingiz kerak. Ikkinchi `UPDATE`da faqat futbolchi nomi o'zgargani uchun `yillik_maoshi` o'zgarmaydi.