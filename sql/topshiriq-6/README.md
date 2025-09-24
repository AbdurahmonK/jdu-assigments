## 1\. `ums` nomli ma'lumotlar bazasini yaratish

`ums` (universitet ma'lumotlar tizimi) nomli ma'lumotlar bazasini yaratamiz. MySQL Workbench'da yangi so'rov oynasini oching va quyidagi buyruqni kiriting:

```sql
CREATE DATABASE ums;
```

Buyruqni bajargach, "SCHEMAS" bo'limini yangilab, `ums` ma'lumotlar bazasi paydo bo'lganini tasdiqlashingiz mumkin.

-----

## 2\. `talabalar` jadvali yaratish va 10 ta talabani qo'shish

Endi `ums` ma'lumotlar bazasi ichida `talabalar` nomli jadvalni yaratamiz. Bu jadvalda talabalarning IDsi, ismi, familiyasi, viloyati, guruhi va bahosi uchun ustunlar bo'ladi. Keyin ushbu jadvalga 10 ta talaba ma'lumotini qo'shamiz.

Avvalo, `ums` ma'lumotlar bazasini faol (current) holatga keltiramiz:

```sql
USE ums;

CREATE TABLE talabalar (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ismi VARCHAR(50) NOT NULL,
    familiyasi VARCHAR(50) NOT NULL,
    viloyati VARCHAR(50),
    guruhi VARCHAR(20),
    bahosi DECIMAL(3, 1)
);

INSERT INTO talabalar (ismi, familiyasi, viloyati, guruhi, bahosi) VALUES
('Ali', 'Valiyev', 'Toshkent', 'A-101', 4.5),
('Botir', 'Karimov', 'Samarqand', 'B-202', 3.8),
('Dilorom', 'Ahmedova', 'Jizzax', 'A-101', 5.0),
('Eshmat', 'G'aniyev', 'Andijon', 'C-303', 4.2),
('Fotima', 'Holmatova', 'Farg\'ona', 'B-202', 4.9),
('G'ani', 'Komilov', 'Jizzax', 'C-303', 3.5),
('Hulkar', 'Rustamova', 'Navoiy', 'A-101', 4.7),
('Ibrohim', 'Sulaymonov', 'Buxoro', 'B-202', 4.0),
('Jasmina', 'Abdullayeva', 'Toshkent', 'C-303', 5.0),
('Kamron', 'Zokirov', 'Qashqadaryo', 'A-101', 3.9);
```

**Izoh:**

  * `id INT PRIMARY KEY AUTO_INCREMENT`: Har bir talaba uchun noyob identifikator.
  * `ismi VARCHAR(50) NOT NULL`: Talabaning ismi, bo'sh bo'lmasligi shart.
  * `familiyasi VARCHAR(50) NOT NULL`: Talabaning familiyasi, bo'sh bo'lmasligi shart.
  * `viloyati VARCHAR(50)`: Talabaning yashash viloyati.
  * `guruhi VARCHAR(20)`: Talabaning guruhi.
  * `bahosi DECIMAL(3, 1)`: Talabaning bahosi (masalan, 5.0, 4.5).

-----

## 3\. `talabalar` jadvalidan Jizzaxlik talabalarni chiqarib beruvchi so'rov

Faqat Jizzax viloyatidan bo'lgan talabalarni tanlash uchun `SELECT` va `WHERE` buyruqlaridan foydalanamiz:

```sql
USE ums;

SELECT *
FROM talabalar
WHERE viloyati = 'Jizzax';
```

**Izoh:**

  * `SELECT *`: Jadvaldagi barcha ustunlarni tanlaydi.
  * `FROM talabalar`: `talabalar` jadvalidan ma'lumotlarni oladi.
  * `WHERE viloyati = 'Jizzax'`: Faqat `viloyati` ustunining qiymati 'Jizzax' ga teng bo'lgan qatorlarni filtrlaydi.

-----

## 4\. `talabalar` jadvalidagi barcha talabalarni familiyasi bo'yicha (A-Z) saralab chiqarib berish

Talabalarni familiyasi bo'yicha alifbo tartibida (A-Z) saralash uchun `ORDER BY` buyrug'idan foydalanamiz:

```sql
USE ums;

SELECT *
FROM talabalar
ORDER BY familiyasi ASC; -- ASC alifbo tartibida (A-Z) saralashni anglatadi
```

**Izoh:**

  * `ORDER BY familiyasi ASC`: Natijalarni `familiyasi` ustuni bo'yicha o'suvchi (ASCending) tartibda saralaydi.

-----

## 5\. `talabalar` jadvalidan 5 baho olgan va ismi 'A' harfi bilan boshlanadigan talabalarni chiqarib beruvchi so'rov

Bir nechta shartlarni birlashtirish uchun `AND` operatoridan foydalanamiz. Ismi 'A' harfi bilan boshlanadigan talabalarni topish uchun `LIKE` operatori va `'A%'` shablonidan foydalanamiz:

```sql
USE ums;

SELECT *
FROM talabalar
WHERE bahosi = 5.0 AND ismi LIKE 'A%';
```

**Izoh:**

  * `WHERE bahosi = 5.0`: Faqat bahosi 5.0 bo'lgan talabalarni tanlaydi.
  * `AND`: Ikki shartni birlashtiradi, ya'ni ikkala shart ham to'g'ri bo'lishi kerak.
  * `ismi LIKE 'A%'`: Ismi 'A' harfi bilan boshlanadigan har qanday talabani topadi (`%` har qanday belgilar ketma-ketligini bildiradi).