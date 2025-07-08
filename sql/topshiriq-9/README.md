-----

MySQL'da bir nechta jadvallarni bog'lash orqali murakkab ma'lumotlarni olish juda muhim. Quyidagi topshiriqlarni bajarish uchun avvalo kerakli ma'lumotlar bazasini yaratib, jadvallarni to'ldirib olamiz.

-----

## Ma'lumotlar bazasini yaratish va jadvallarni to'ldirish

Sizning topshiriqlaringiz uchun `dars9_db` nomli yangi ma'lumotlar bazasi yaratamiz. Keyin har bir topshiriqda aytib o'tilgan jadvallarni yaratib, ularga namunaviy ma'lumotlarni kiritamiz.

```sql
-- Ma'lumotlar bazasini yaratish
CREATE DATABASE IF NOT EXISTS dars9_db;
USE dars9_db;

-- 1. Students, Enrollments, Courses jadvallari
CREATE TABLE Students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    student_name VARCHAR(100) NOT NULL
);

CREATE TABLE Courses (
    course_id INT PRIMARY KEY AUTO_INCREMENT,
    course_name VARCHAR(100) NOT NULL,
    instructor_name VARCHAR(100)
);

CREATE TABLE Enrollments (
    enrollment_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    course_id INT,
    FOREIGN KEY (student_id) REFERENCES Students(student_id),
    FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);

INSERT INTO Students (student_name) VALUES
('Alijon Valiev'),
('Madina Karimova'),
('Jasur Mahmudov'),
('Nilufar Shodiyeva');

INSERT INTO Courses (course_name, instructor_name) VALUES
('Matematika-101', 'Professor Saidov'),
('Fizika-201', 'Dotsent Karimova'),
('Dasturlash Asoslari', 'Assistent Nurmatov'),
('Ingliz Tili B2', 'O\'qituvchi Rahimova');

INSERT INTO Enrollments (student_id, course_id) VALUES
(1, 1), -- Alijon Matematika-101 ga yozilgan
(1, 3), -- Alijon Dasturlash Asoslari ga yozilgan
(2, 2), -- Madina Fizika-201 ga yozilgan
(3, 1), -- Jasur Matematika-101 ga yozilgan
(4, NULL); -- Nilufar hali kursga yozilmagan

-- 2. Orders, Customers, Products jadvallari
CREATE TABLE Customers (
    customer_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_name VARCHAR(100) NOT NULL
);

CREATE TABLE Products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2)
);

CREATE TABLE Orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT,
    product_id INT,
    order_date DATE,
    FOREIGN KEY (customer_id) REFERENCES Customers(customer_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);

INSERT INTO Customers (customer_name) VALUES
('Zafarbek Ahmedov'),
('Sevara Boboyeva'),
('Rustam Saidov');

INSERT INTO Products (product_name, price) VALUES
('Smartfon X', 800.00),
('Noutbuk Pro', 1200.00),
('Simsiz quloqchin', 150.00),
('Veb-kamera', 50.00);

INSERT INTO Orders (customer_id, product_id, order_date) VALUES
(1, 1, '2025-07-01'), -- Zafarbek Smartfon X sotib oldi
(1, 3, '2025-07-01'), -- Zafarbek Simsiz quloqchin sotib oldi
(2, 2, '2025-07-02'), -- Sevara Noutbuk Pro sotib oldi
(3, NULL, '2025-07-03'), -- Rustam hech qanday mahsulot sotib olmagan (yoki buyurtmasi hali aniq emas)
(NULL, 4, '2025-07-04'); -- Noma'lum mijoz veb-kamera sotib olgan
```

-----

## 1\. `INNER JOIN` yordamida talabalar, kurs nomlari va o'qituvchilarini ko'rsatish

Ushbu topshiriqda `Students`, `Enrollments` va `Courses` jadvallarini **`INNER JOIN`** orqali bog'lab, faqat barcha uch jadvalda ham mos keluvchi ma'lumotlarni olamiz. Bu degani, faqat kursga yozilgan va ushbu kurs haqida ma'lumotlar mavjud bo'lgan talabalar ro'yxati chiqadi.

```sql
USE dars9_db;

SELECT
    s.student_name,
    c.course_name,
    c.instructor_name
FROM
    Students AS s
INNER JOIN
    Enrollments AS e ON s.student_id = e.student_id
INNER JOIN
    Courses AS c ON e.course_id = c.course_id;
```

**Izoh:**

  * `Students AS s`, `Enrollments AS e`, `Courses AS c` jadvallar uchun taxallus (alias) nomlar. Bu so'rovni o'qishni va yozishni osonlashtiradi.
  * Birinchi `INNER JOIN` **`Students`** va **`Enrollments`** jadvallarini `student_id` orqali bog'laydi.
  * Ikkinchi `INNER JOIN` hosil bo'lgan natijani **`Courses`** jadvali bilan `course_id` orqali bog'laydi.
  * Natijada, faqat **talaba kursga yozilgan** va **kurs haqida ma'lumot mavjud** bo'lgan qatorlar ko'rsatiladi. Agar talaba kursga yozilmagan bo'lsa (masalan, Nilufar Shodiyeva) yoki `Enrollments` jadvalida kurs `ID`si mavjud bo'lmasa, ular natijada ko'rinmaydi.

-----

## 2\. `LEFT JOIN` yordamida buyurtmalar, mijozlar va mahsulot nomlarini ko'rsatish

Bu topshiriqda `Orders`, `Customers` va `Products` jadvallarini **`LEFT JOIN`** orqali bog'lab, barcha buyurtmalar ro'yxatini olamiz. `LEFT JOIN` buyrug'i birinchi (chapdagi) jadvaldagi barcha ma'lumotlarni saqlab qoladi, mos keladigan ma'lumotlarni esa keyingi jadvallardan oladi. Agar mos keladigan ma'lumot topilmasa, `NULL` qiymatlar qaytaradi.

```sql
USE dars9_db;

SELECT
    o.order_id,
    o.order_date,
    c.customer_name,
    p.product_name
FROM
    Orders AS o
LEFT JOIN
    Customers AS c ON o.customer_id = c.customer_id
LEFT JOIN
    Products AS p ON o.product_id = p.product_id;
```

**Izoh:**

  * `Orders AS o` jadvali asosiy (chapdagi) jadval hisoblanadi, shuning uchun undagi barcha buyurtmalar har doim natijada ko'rinadi.
  * Birinchi `LEFT JOIN` **`Orders`** va **`Customers`** jadvallarini `customer_id` orqali bog'laydi. Agar buyurtma biror mijozga tegishli bo'lmasa (`customer_id` NULL bo'lsa), `customer_name` ustuni `NULL` bo'lib qoladi.
  * Ikkinchi `LEFT JOIN` hosil bo'lgan natijani **`Products`** jadvali bilan `product_id` orqali bog'laydi. Agar buyurtmada mahsulot `ID`si mavjud bo'lmasa (`product_id` NULL bo'lsa), `product_name` ustuni `NULL` bo'lib qoladi.
  * Natijada, barcha buyurtmalar (hatto mijoz yoki mahsulot ma'lumotlari to'liq bo'lmasa ham) ro'yxati chiqadi.