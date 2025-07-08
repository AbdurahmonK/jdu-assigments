-----

## 1\. Amazon nomli ma'lumotlar bazasini yaratish

Avvalambor, bizning barcha ma'lumotlarimizni saqlash uchun `amazon` nomli yangi ma'lumotlar bazasini yaratamiz. MySQL Workbench'da yangi so'rov oynasini oching va quyidagi buyruqni kiriting:

```sql
CREATE DATABASE amazon;
```

Bu buyruqni bajarib bo'lgach, MySQL Workbench'ning "SCHEMAS" bo'limini yangilab, `amazon` ma'lumotlar bazasining paydo bo'lganligini tasdiqlashingiz mumkin.

-----

## 2\. Amazon ma'lumotlar bazasi ichida mahsulotlar nomli jadval yaratish

Endi biz `amazon` ma'lumotlar bazasi ichida **`mahsulotlar`** nomli jadvalni yaratamiz. Bu jadvalda mahsulotlarning identifikatori, nomi, narxi va kategoriyasi uchun ustunlar bo'ladi.

Ishni boshlashdan oldin, `amazon` ma'lumotlar bazasini faol (current) ma'lumotlar bazasi sifatida tanlashimiz kerak. Buning uchun `USE` buyrug'idan foydalanamiz:

```sql
USE amazon;

CREATE TABLE mahsulotlar (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nomi VARCHAR(255) NOT NULL,
    narxi DECIMAL(10, 2) NOT NULL,
    kategoriya VARCHAR(100)
);
```

Yuqoridagi buyruqlar quyidagilarni anglatadi:

  * `USE amazon;`: Keyingi barcha operatsiyalar `amazon` ma'lumotlar bazasida bajarilishini bildiradi.
  * `CREATE TABLE mahsulotlar`: `mahsulotlar` nomli yangi jadval yaratishni boshlaydi.
  * `ID INT PRIMARY KEY AUTO_INCREMENT`: `ID` ustunini butun son (INTEGER) sifatida belgilaydi. **`PRIMARY KEY`** bu ustunni jadvaldagi har bir qator uchun noyob identifikator qiladi. **`AUTO_INCREMENT`** esa har yangi qator qo'shilganda `ID` avtomatik ravishda bittaga oshishini ta'minlaydi.
  * `nomi VARCHAR(255) NOT NULL`: `nomi` ustunini maksimal 255 ta belgidan iborat matn qatori (VARCHAR) sifatida belgilaydi. **`NOT NULL`** esa bu ustunning bo'sh qoldirilmasligini ta'minlaydi.
  * `narxi DECIMAL(10, 2) NOT NULL`: `narxi` ustunini o'nli son (DECIMAL) sifatida belgilaydi. Bu 10 ta umumiy raqamni va verguldan keyin 2 ta raqamni (ya'ni, valyuta qiymatlari uchun ideal) qabul qiladi. Bu ham bo'sh qoldirilmasligi kerak.
  * `kategoriya VARCHAR(100)`: `kategoriya` ustunini maksimal 100 ta belgidan iborat matn qatori sifatida belgilaydi. Bu ustun bo'sh qoldirilishi mumkin.

-----

## 3\. Mijozlar nomli jadval yaratish

Endi esa `amazon` ma'lumotlar bazasi ichida **`mijozlar`** nomli jadvalni yaratamiz. Bu jadvalda mijozning identifikatori, ismi, manzili va telefon raqami uchun ustunlar bo'ladi.

```sql
USE amazon;

CREATE TABLE mijozlar (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    ismi VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    telefon_raqami VARCHAR(50)
);
```

Bu yerda:

  * `ID INT PRIMARY KEY AUTO_INCREMENT`: `mijozlar` jadvali uchun noyob mijoz identifikatorini belgilaydi.
  * `ismi VARCHAR(255) NOT NULL`: Mijoz ismini saqlaydi va bo'sh bo'lishiga yo'l qo'ymaydi.
  * `address VARCHAR(255)`: Mijoz manzilini saqlaydi.
  * `telefon_raqami VARCHAR(50)`: Mijoz telefon raqamini saqlaydi.

-----

## 4\. Kategoriyalar nomli jadval yaratish

Oxirgi qadamda, biz **`kategoriyalar`** nomli jadvalni yaratamiz. Bu jadval mahsulotlar kategoriyalarini alohida saqlash uchun mo'ljallangan bo'lib, keyinchalik `mahsulotlar` jadvali bilan bog'lanishi mumkin (normallashtirish uchun).

```sql
USE amazon;

CREATE TABLE kategoriyalar (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    kategoriya_nomi VARCHAR(100) NOT NULL UNIQUE
);
```

Bu jadvalda:

  * `ID INT PRIMARY KEY AUTO_INCREMENT`: Kategoriya uchun noyob identifikator.
  * `kategoriya_nomi VARCHAR(100) NOT NULL UNIQUE`: Kategoriya nomini saqlaydi. **`UNIQUE`** cheklovi har bir kategoriya nomining noyob bo'lishini ta'minlaydi, ya'ni bir xil nomli ikkita kategoriya bo'lishiga yo'l qo'ymaydi. **`NOT NULL`** esa bo'sh qoldirilmasligini ta'minlaydi.

Bu buyruqlarni bajarib bo'lgach, `amazon` ma'lumotlar bazasida uchta yangi jadval: `mahsulotlar`, `mijozlar` va `kategoriyalar` paydo bo'ladi. Endi siz ushbu jadvallarga ma'lumotlar kiritishni boshlashingiz mumkin.