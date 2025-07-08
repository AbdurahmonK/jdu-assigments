-----

Siz bergan topshiriqlarni bajarish uchun avval ma'lumotlar bazasini yaratib, kerakli jadvallarni to'ldirib olamiz. Keyin har bir topshiriq uchun tegishli SQL so'rovlarini yozamiz.

-----

## Ma'lumotlar bazasini yaratish va jadvallarni to'ldirish

Avvalo, `dars8_db` nomli ma'lumotlar bazasini yaratamiz va topshiriqlarda aytilganidek `Students`, `Enrollments`, `Authors`, `Books`, `Departments`, `Employees` jadvallarini yaratib, ularni namunaviy ma'lumotlar bilan to'ldiramiz.

```sql
-- Ma'lumotlar bazasini yaratish
CREATE DATABASE IF NOT EXISTS dars8_db;
USE dars8_db;

-- 1. Students va Enrollments jadvallari
CREATE TABLE Students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    student_name VARCHAR(100) NOT NULL
);

CREATE TABLE Enrollments (
    enrollment_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    course_name VARCHAR(100) NOT NULL,
    FOREIGN KEY (student_id) REFERENCES Students(student_id)
);

INSERT INTO Students (student_name) VALUES
('Alijon Valiev'),
('Madina Karimova'),
('Jasur Mahmudov'),
('Nilufar Shodiyeva');

INSERT INTO Enrollments (student_id, course_name) VALUES
(1, 'Matematika'),
(1, 'Fizika'),
(2, 'Kimyo'),
(3, 'Adabiyot'),
(NULL, 'Biologiya'); -- student_id NULL bo'lishi mumkinligini ko'rsatish uchun

-- 2. Authors va Books jadvallari
CREATE TABLE Authors (
    author_id INT PRIMARY KEY AUTO_INCREMENT,
    author_name VARCHAR(100) NOT NULL
);

CREATE TABLE Books (
    book_id INT PRIMARY KEY AUTO_INCREMENT,
    book_title VARCHAR(255) NOT NULL,
    author_id INT,
    FOREIGN KEY (author_id) REFERENCES Authors(author_id)
);

INSERT INTO Authors (author_name) VALUES
('O\'tkir Hoshimov'),
('Abdulla Qodiriy'),
('Tohir Malik'),
('Cho\'lpon');

INSERT INTO Books (book_title, author_id) VALUES
('Dunyoning Ishlari', 1),
('O\'tkan Kunlar', 2),
('Shaytanat', 3),
('Kecha va Kunduz', 4),
('Yulduzli Tunlar', NULL); -- Ba'zi kitoblarni muallifsiz ko'rsatish uchun

-- 3. Departments va Employees jadvallari
CREATE TABLE Departments (
    department_id INT PRIMARY KEY AUTO_INCREMENT,
    department_name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE Employees (
    employee_id INT PRIMARY KEY AUTO_INCREMENT,
    employee_name VARCHAR(100) NOT NULL,
    department_id INT,
    FOREIGN KEY (department_id) REFERENCES Departments(department_id)
);

INSERT INTO Departments (department_name) VALUES
('Marketing'),
('IT'),
('Buxgalteriya'),
('Inson resurslari');

INSERT INTO Employees (employee_name, department_id) VALUES
('Azizjon Ergashev', 1),
('Lola Solieva', 2),
('Diyorbek Sobirov', 1),
('Gulnora Mirzayeva', NULL); -- Ba'zi xodimlarni bo'limsiz ko'rsatish uchun
```

-----

## 1\. `INNER JOIN` yordamida talabalar va kurs nomlarini ko'rsatish

`INNER JOIN` ikkala jadvalda ham mos keluvchi yozuvlarni qaytaradi. Bu holatda, talabalarning `student_id` si `Enrollments` jadvalidagi `student_id` ga mos kelgan barcha yozuvlar chiqariladi. Ya'ni, faqat kursga yozilgan talabalar ko'rinadi.

```sql
USE dars8_db;

SELECT
    s.student_name,
    e.course_name
FROM
    Students AS s
INNER JOIN
    Enrollments AS e ON s.student_id = e.student_id;
```

**Natija:** Faqat kursga yozilgan talabalarning ismlari va ular yozilgan kurs nomlari chiqariladi. "Nilufar Shodiyeva" (kursga yozilmagan) va `Enrollments` jadvalidagi `student_id` NULL bo'lgan "Biologiya" kursi natijada ko'rinmaydi.

-----

## 2\. `LEFT JOIN` yordamida mualliflar va kitob nomlarini ko'rsatish

`LEFT JOIN` (yoki `LEFT OUTER JOIN`) chapdagi jadvaldagi barcha yozuvlarni va o'ngdagi jadvaldan mos keluvchi yozuvlarni qaytaradi. Agar o'ng jadvalda moslik bo'lmasa, o'ng jadval ustunlari uchun `NULL` qiymatlari ko'rsatiladi. Bu holatda, barcha mualliflar ko'rinadi, ular yozgan kitoblar esa (agar mavjud bo'lsa) yonida ko'rsatiladi. Agar muallif kitob yozmagan bo'lsa, kitob nomi `NULL` bo'lib qoladi.

```sql
USE dars8_db;

SELECT
    a.author_name,
    b.book_title
FROM
    Authors AS a
LEFT JOIN
    Books AS b ON a.author_id = b.author_id;
```

**Natija:** Barcha mualliflar (hatto kitob yozmagan bo'lsa ham) va ularning kitoblari ko'rsatiladi. Agar muallifning kitobi bo'lmasa, `book_title` ustuni `NULL` bo'ladi. `Books` jadvalidagi muallifsiz "Yulduzli Tunlar" kitobi bu so'rovda ko'rinmaydi.

-----

## 3\. `RIGHT JOIN` yordamida xodimlar va bo'lim nomlarini ko'rsatish

`RIGHT JOIN` (yoki `RIGHT OUTER JOIN`) o'ngdagi jadvaldagi barcha yozuvlarni va chapdagi jadvaldan mos keluvchi yozuvlarni qaytaradi. Agar chap jadvalda moslik bo'lmasa, chap jadval ustunlari uchun `NULL` qiymatlari ko'rsatiladi. Bu holatda, barcha xodimlar ko'rinadi, ular ishlaydigan bo'limlar esa (agar mavjud bo'lsa) yonida ko'rsatiladi. Agar xodim bo'limga biriktirilmagan bo'lsa, bo'lim nomi `NULL` bo'lib qoladi.

```sql
USE dars8_db;

SELECT
    e.employee_name,
    d.department_name
FROM
    Departments AS d
RIGHT JOIN
    Employees AS e ON d.department_id = e.department_id;
```

**Natija:** Barcha xodimlar (hatto bo'limga biriktirilmagan bo'lsa ham) va ularning bo'lim nomlari ko'rsatiladi. Agar xodimning bo'limi bo'lmasa, `department_name` ustuni `NULL` bo'ladi. "IT", "Buxgalteriya", "Inson resurslari" bo'limlarida xodim bo'lmagani uchun ular bu so'rovda ko'rinmaydi, faqat xodimlari bor bo'limlar yoki bo'limsiz xodimlar ko'rinadi.