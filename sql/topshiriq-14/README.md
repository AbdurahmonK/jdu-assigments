Tranzaksiya — bu bitta mantiqiy ish birligi sifatida bajariladigan SQL buyruqlarining ketma-ketligidir. Uning asosiy xususiyatlari **ACID** (Atomicity, Consistency, Isolation, Durability) tamoyillaridir. Ayniqsa, Atomicity (Atomlik) muhim, ya'ni tranzaksiya to'liq bajariladi yoki hech qachon bajarilmaydi (ya'ni, xatolik yuz bersa, barcha o'zgarishlar bekor qilinadi).

-----

## 1\. Yangi `bank` ma'lumotlar bazasini yaratish va `accounts` jadvalini tuzish

Avvalo, `bank` nomli yangi ma'lumotlar bazasini yaratamiz. Keyin uning ichida `accounts` nomli jadvalni tuzamiz, u quyidagi ustunlarga ega bo'ladi: `account_id`, `Ismi` va `Balans`.

```sql
-- Ma'lumotlar bazasini yaratish
CREATE DATABASE IF NOT EXISTS bank;
USE bank;

-- `accounts` jadvalini yaratish
CREATE TABLE accounts (
    account_id INT PRIMARY KEY AUTO_INCREMENT,
    Ismi VARCHAR(100) NOT NULL,
    Balans DECIMAL(10, 2) NOT NULL
);
```

**Izoh:**

  * `account_id INT PRIMARY KEY AUTO_INCREMENT`: Har bir hisob uchun noyob identifikator, avtomatik ortib boradi.
  * `Ismi VARCHAR(100) NOT NULL`: Foydalanuvchining ismi, bo'sh bo'lmasligi shart.
  * `Balans DECIMAL(10, 2) NOT NULL`: Hisobdagi pul miqdori, maksimal 10 ta raqam va verguldan keyin 2 ta raqam (pul birliklari uchun ideal). Bo'sh bo'lmasligi shart.

-----

## 2\. Jadvalni 20 ta foydalanuvchi bilan to'ldirish

Endi `accounts` jadvalini 20 ta namunaviy foydalanuvchi bilan to'ldiramiz.

```sql
USE bank;

INSERT INTO accounts (Ismi, Balans) VALUES
('Alijon Valiev', 1500.50),
('Madina Karimova', 2300.00),
('Jasur Mahmudov', 800.75),
('Nilufar Shodiyeva', 5000.00),
('Dilshod Rustamov', 1200.25),
('Gulsara Azimova', 300.00),
('Farhod Sobirov', 750.50),
('Laylo Komilova', 4000.00),
('Umidjon Ergashev', 1800.00),
('Zarina Saidova', 2900.50),
('Behruz Nurmatov', 600.00),
('Diyora Olimova', 3500.00),
('Eshmat Haydarov', 900.00),
('Fotima Umarova', 2100.75),
('G`ayrat Boboev', 100.00),
('Hulkar Abdullayeva', 1700.00),
('Ibrohim Rashidov', 2400.00),
('Jasmina Bekova', 450.00),
('Komiljon Hamidov', 3200.00),
('Luiza G`afurova', 950.00);
```

-----

## 3\. Pul o'tkazish operatsiyasini 5 marta tranzaksiya orqali amalga oshirish va `ROLLBACK`

Pul o'tkazish operatsiyasi quyidagi bosqichlarni o'z ichiga oladi:

1.  Yuboruvchi hisobidan pul ayirish.
2.  Qabul qiluvchi hisobiga pul qo'shish.

Bu ikkala amal birgalikda bajarilishi kerak. Agar birinchi amal bajarilib, ikkinchisi xato bo'lsa, pul "yo'qolishi" mumkin. Shuning uchun biz buni **tranzaksiya** ichida qilamiz.
`START TRANSACTION;` bilan tranzaksiya boshlanadi, `COMMIT;` bilan tasdiqlanadi yoki `ROLLBACK;` bilan bekor qilinadi.

Keling, 5 ta pul o'tkazish operatsiyasini alohida tranzaksiyalarda ko'rsatamiz. Har bir operatsiyadan keyin `COMMIT` yoki `ROLLBACK`ni namoyish etamiz.

```sql
USE bank;

-- -----------------------------------------------------
-- 1-Tranzaksiya: Alijon Valievdan Madina Karimovaga 100.00 o'tkazish
-- -----------------------------------------------------
START TRANSACTION;

UPDATE accounts
SET Balans = Balans - 100.00
WHERE account_id = 1; -- Alijon Valiev

UPDATE accounts
SET Balans = Balans + 100.00
WHERE account_id = 2; -- Madina Karimova

-- Barcha o'zgarishlarni ko'rish
SELECT * FROM accounts WHERE account_id IN (1, 2);

-- Agar hamma narsa to'g'ri bo'lsa, o'zgarishlarni saqlash
COMMIT;
-- Yoki, agar xato bo'lsa, o'zgarishlarni bekor qilish
-- ROLLBACK;


-- -----------------------------------------------------
-- 2-Tranzaksiya: Jasur Mahmudovdan Nilufar Shodiyevaga 50.75 o'tkazish
-- -----------------------------------------------------
START TRANSACTION;

UPDATE accounts
SET Balans = Balans - 50.75
WHERE account_id = 3; -- Jasur Mahmudov

UPDATE accounts
SET Balans = Balans + 50.75
WHERE account_id = 4; -- Nilufar Shodiyeva

SELECT * FROM accounts WHERE account_id IN (3, 4);
COMMIT;


-- -----------------------------------------------------
-- 3-Tranzaksiya: Gulsara Azimovadan Farhod Sobirovga 20.00 o'tkazish
-- (Bu tranzaksiyani ROLLBACK qilamiz)
-- -----------------------------------------------------
START TRANSACTION;

UPDATE accounts
SET Balans = Balans - 20.00
WHERE account_id = 6; -- Gulsara Azimova

UPDATE accounts
SET Balans = Balans + 20.00
WHERE account_id = 7; -- Farhod Sobirov

SELECT * FROM accounts WHERE account_id IN (6, 7);

-- Bu yerda qandaydir xato yuz berdi deb faraz qilamiz, shuning uchun ROLLBACK
ROLLBACK;

-- ROLLBACK dan keyin balans holatini tekshirish. Ular avvalgi holatda qolishi kerak.
SELECT * FROM accounts WHERE account_id IN (6, 7);


-- -----------------------------------------------------
-- 4-Tranzaksiya: Umidjon Ergashevdan Zarina Saidovaga 150.00 o'tkazish
-- -----------------------------------------------------
START TRANSACTION;

UPDATE accounts
SET Balans = Balans - 150.00
WHERE account_id = 9; -- Umidjon Ergashev

UPDATE accounts
SET Balans = Balans + 150.00
WHERE account_id = 10; -- Zarina Saidova

SELECT * FROM accounts WHERE account_id IN (9, 10);
COMMIT;


-- -----------------------------------------------------
-- 5-Tranzaksiya: Behruz Nurmatovdan Diyora Olimovaga 75.00 o'tkazish
-- (Bu tranzaksiyani ham ROLLBACK qilamiz, masalan, yetarli balans yo'q edi)
-- -----------------------------------------------------
START TRANSACTION;

-- Tasavvur qiling, Behruz Nurmatovning balansi yetarli emas
-- UPDATE accounts
-- SET Balans = Balans - 75.00
-- WHERE account_id = 11; -- Behruz Nurmatov

-- UPDATE accounts
-- SET Balans = Balans + 75.00
-- WHERE account_id = 12; -- Diyora Olimova

-- Hozirgi holatni ko'rish (tranzaksiya davomida)
SELECT * FROM accounts WHERE account_id IN (11, 12);

-- Xatolik yuz berdi yoki foydalanuvchi bekor qildi
ROLLBACK;

-- ROLLBACK dan keyin balans holatini tekshirish.
SELECT * FROM accounts WHERE account_id IN (11, 12);

-- Barcha hisoblarning yakuniy holatini tekshirish
SELECT * FROM accounts;
```

**Ishlatilish tartibi:**

1.  Har bir `START TRANSACTION;` dan keyingi `UPDATE` buyruqlarini bajaring.
2.  Keyin, `SELECT * FROM accounts WHERE account_id IN (...)` buyrug'ini bajarib, o'zgarishlarni ko'ring. E'tibor bering, bu o'zgarishlar faqat joriy sessiyangiz uchun ko'rinadi va tasdiqlanmaguncha boshqa sessiyalarda ko'rinmaydi.
3.  Agar hamma narsa joyida bo'lsa, `COMMIT;` ni bajaring. Bu o'zgarishlarni doimiy saqlaydi.
4.  Agar qandaydir muammo yuzaga kelsa (masalan, 3- va 5- tranzaksiyalar misolida), `ROLLBACK;` ni bajaring. Bu tranzaksiya boshlangan paytdagi holatga qaytaradi. `SELECT` buyrug'i orqali qayta tekshirganingizda, balanslar avvalgi holatiga qaytganini ko'rasiz.