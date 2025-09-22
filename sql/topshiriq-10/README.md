## 1\. SQLda INDEX nima va ularning qanday afzalliklari bor?

**INDEX (indeks)** bu ma'lumotlar bazasida jadvaldagi ma'lumotlarni tezroq topish uchun ishlatiladigan maxsus ma'lumotlar strukturasi. Uni kitobning mundarijasiga (indeksiga) o'xshatish mumkin: kitob mundarijasidan kerakli mavzuni tez topganingiz kabi, indeks ham ma'lumotlar bazasida kerakli qatorlarni juda tez topishga yordam beradi. Indekslar ma'lum bir ustun yoki ustunlar kombinatsiyasidagi qiymatlarni tartiblab, ularga tezkor kirishni ta'minlaydi.

**Afzalliklari:**

  * **So'rovlarni tezlashtirish:** Indekslarning asosiy afzalligi bu `SELECT` so'rovlarining, ayniqsa `WHERE`, `JOIN`, `ORDER BY` va `GROUP BY` bandlarida ishlatiladigan so'rovlarning bajarilish vaqtini sezilarli darajada qisqartirishdir.
  * **Ma'lumotlar yaxlitligi:** `UNIQUE` indekslar yordamida ustundagi ma'lumotlarning takrorlanmasligini ta'minlash mumkin (masalan, foydalanuvchi elektron pochtasi). `PRIMARY KEY` avtomatik tarzda `UNIQUE` indeks hosil qiladi.
  * **Ma'lumotlarni saralashni tezlashtirish:** `ORDER BY` bandi bilan ma'lumotlarni saralashda indekslar mavjud bo'lsa, ma'lumotlar bazasi butun jadvalni saralashga hojat qolmaydi, bu esa samaradorlikni oshiradi.
  * **Kattaroq jadvallar bilan samarali ishlash:** Ayniqsa, katta hajmdagi jadvallarda indekslar bo'lmasa, ma'lumotlarni qidirish juda ko'p vaqt talab qiladi (to'liq jadvalni skanerlash). Indekslar bu muammoni hal qiladi.

**Kamchiliklari (e'tiborga olish kerak bo'lgan jihatlar):**

  * **Disk maydoni:** Indekslar o'zlari ham diskda joy egallaydi.
  * **Ma'lumotlarni yozish (INSERT, UPDATE, DELETE) sekinlashadi:** Ma'lumotlarni jadvalga qo'shish, o'zgartirish yoki o'chirishda indekslar ham yangilanishi kerak, bu esa bu operatsiyalarni sekinlashtirishi mumkin. Shuning uchun indekslarni faqat haqiqatdan ham zarur bo'lgan ustunlarga qo'yish muhimdir.

-----

## 2\. `users` jadvalida `email` ustuniga unikal indeks qo'shing

Avvalo, `dars10_db` nomli ma'lumotlar bazasini yaratib olamiz va `users` jadvalini tuzamiz.

```sql
CREATE DATABASE IF NOT EXISTS dars10_db;
USE dars10_db;

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL
);

-- `email` ustuniga UNIKAL indeks qo'shish
ALTER TABLE users
ADD UNIQUE INDEX idx_unique_email (email);
```

**Izoh:**

  * `ALTER TABLE users`: `users` jadvalini o'zgartirishni boshlaydi.
  * `ADD UNIQUE INDEX idx_unique_email (email)`: `email` ustuniga `idx_unique_email` nomli **unikal indeks** qo'shadi. Bu shuni anglatadiki, `email` ustunida bir xil qiymat ikki marta takrorlanishiga yo'l qo'yilmaydi.

-----

## 3\. `orders` jadvalida `customer_id` va `order_date` ustunlariga birgalikda indeks qo'shing

`orders` jadvalini yaratamiz va unga `customer_id` hamda `order_date` ustunlari bo'yicha **kompozit (birgalikdagi) indeks** qo'shamiz.

```sql
USE dars10_db;

CREATE TABLE orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT NOT NULL,
    product_id INT,
    order_date DATE NOT NULL,
    order_status VARCHAR(50),
    FOREIGN KEY (customer_id) REFERENCES users(user_id) -- users jadvali bilan bog'laymiz
);

-- `customer_id` va `order_date` ustunlariga kompozit indeks qo'shish
CREATE INDEX idx_customer_order_date ON orders (customer_id, order_date);
```

**Izoh:**

  * `CREATE INDEX idx_customer_order_date ON orders (customer_id, order_date)`: `orders` jadvalida `idx_customer_order_date` nomli indeks yaratadi. Bu indeks `customer_id` va `order_date` ustunlari birgalikda ishlatilganda, so'rovlarni tezlashtirish uchun optimallashtirilgan. Masalan, "Ma'lum bir mijozning ma'lum bir sanadagi barcha buyurtmalarini topish" kabi so'rovlarda foydali.

-----

## 4\. `students` jadvalidagi `ismi` ustuni bo'yicha qidiruvni tezlashtirish uchun indeks qo'shing va so'rovni yozing

`students` jadvalini yaratamiz va `ismi` ustuniga indeks qo'shamiz.

```sql
USE dars10_db;

CREATE TABLE students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    ismi VARCHAR(100) NOT NULL,
    familiyasi VARCHAR(100) NOT NULL,
    birth_date DATE
);

-- `ismi` ustuniga indeks qo'shish
CREATE INDEX idx_student_ismi ON students (ismi);

-- Namuna ma'lumotlar
INSERT INTO students (ismi, familiyasi, birth_date) VALUES
('Ali', 'Valiev', '2000-01-15'),
('Dilnoza', 'Karimova', '2001-03-22'),
('Aziz', 'Ahmedov', '1999-07-01'),
('Zarina', 'Usmonova', '2002-09-10'),
('Alisher', 'G'aniyev', '2000-11-25');

-- `ismi` ustuni bo'yicha qidiruvni tezlashtirish uchun so'rov
SELECT *
FROM students
WHERE ismi = 'Ali';

-- Yoki `LIKE` operatori bilan ham indeksdan foydalanishi mumkin (agar qidiruv shablonning boshidan boshlansa)
SELECT *
FROM students
WHERE ismi LIKE 'A%';
```

**Izoh:**

  * `CREATE INDEX idx_student_ismi ON students (ismi)`: `students` jadvalidagi `ismi` ustuniga `idx_student_ismi` nomli indeks qo'shadi. Bu `ismi` ustuni bo'yicha amalga oshiriladigan qidiruvlarni sezilarli darajada tezlashtiradi.
  * Yuqoridagi `SELECT` so'rovlari `ismi` ustunida indeks mavjud bo'lganligi sababli tezroq bajariladi.

-----

## 5\. `orders` jadvalida `product_id` va `order_status` ustunlariga kompozit indeks qo'shing va ushbu indeksdan foydalangan holda so'rov yozing

Avvalgi `orders` jadvalini ishlatamiz. Agar jadvalda hali ma'lumotlar yo'q bo'lsa, qo'shamiz.

```sql
USE dars10_db;

-- `product_id` va `order_status` ustunlariga kompozit indeks qo'shish
CREATE INDEX idx_product_status ON orders (product_id, order_status);

-- Namuna ma'lumotlar (agar hali bo'lmasa)
INSERT INTO orders (customer_id, product_id, order_date, order_status) VALUES
(1, 1, '2025-07-01', 'yetkazilgan'),
(1, 2, '2025-07-01', 'jarayonda'),
(2, 1, '2025-07-02', 'jarayonda'),
(3, 3, '2025-07-03', 'bekor qilingan'),
(1, 1, '2025-07-04', 'jarayonda');

-- Ushbu indeksdan foydalangan holda so'rov
SELECT
    order_id,
    customer_id,
    order_date
FROM
    orders
WHERE
    product_id = 1 AND order_status = 'jarayonda';
```

**Izoh:**

  * `CREATE INDEX idx_product_status ON orders (product_id, order_status)`: `orders` jadvalida `product_id` va `order_status` ustunlari bo'yicha kompozit indeks yaratadi.
  * `SELECT` so'rovi "product\_id = 1 bo'lgan va buyurtma holati 'jarayonda' bo'lgan barcha buyurtmalarni topish" uchun yozilgan. Bu so'rov berilgan kompozit indeksdan samarali foydalanadi, chunki `WHERE` bandida indeksga kiritilgan ikkala ustun ham ishlatilgan.