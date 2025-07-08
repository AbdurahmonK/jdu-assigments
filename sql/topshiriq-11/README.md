-----

## 1\. SQLda View'lar nima va bizga nima uchun kerak bo'ladi?

**View (ko'rinish)** SQL ma'lumotlar bazasida saqlanadigan virtual jadvaldir. Uning jismoniy jadvallardan farqi shundaki, View ma'lumotlarni o'zida saqlamaydi, balki bir yoki bir nechta jadvallardan ma'lumotlarni **dinamik ravishda** olish uchun ishlatiladigan oldindan belgilangan SQL so'rovidir. Boshqacha qilib aytganda, View sizning so'rovingizga asoslangan jadval "oynasi" bo'lib, har safar unga murojaat qilganingizda, ostida yotgan SQL so'rovi qayta bajariladi va natijalar ko'rsatiladi.

**Nima uchun bizga View'lar kerak?**

View'lar ma'lumotlar bazasi boshqaruvida va dasturiy ta'minotni ishlab chiqishda bir qancha muhim afzalliklarga ega:

  * **Murakkab so'rovlarni soddalashtirish:** Ko'pincha, kerakli ma'lumotlarni olish uchun bir nechta jadvallarni `JOIN` qilish va murakkab `WHERE` shartlarini qo'llashga to'g'ri keladi. Bu so'rovlar uzoq va tushunarsiz bo'lishi mumkin. View yordamida bu murakkab so'rovni bir marta yaratib, unga oddiy jadval sifatida murojaat qilish mumkin.
  * **Xavfsizlikni oshirish:** View'lar orqali foydalanuvchilarga ma'lumotlarning faqat ma'lum bir qismini ko'rsatish mumkin. Masalan, moliyaviy ma'lumotlar bazasida xodimlarga faqat o'zlarining ish haqi ma'lumotlarini ko'rishga ruxsat berib, boshqa xodimlarning ma'lumotlarini yashirish mumkin. Bu jismoniy jadvallarga to'g'ridan-to'g'ri kirishni cheklash orqali amalga oshiriladi.
  * **Ma'lumotlar mustaqilligini ta'minlash:** Agar jismoniy jadvallarning tuzilishi o'zgarsa (masalan, ustun nomi o'zgarsa yoki yangi ustun qo'shilsa), View'lar ularni o'zgartirishga ehtiyoj sezmasdan mavjudligini davom ettira oladi (agar View ta'rifidagi ustunlar o'zgarmagan bo'lsa). Bu dastur kodida kamroq o'zgarishlarga olib keladi.
  * **Izchillik va qayta ishlatish:** Bir marta yaratilgan View bir nechta foydalanuvchilar yoki dasturlar tomonidan qayta-qayta ishlatilishi mumkin, bu ma'lumotlarga murojaat qilishda izchillikni ta'minlaydi.

-----

## 2\. `employees` jadvalidan `employee_id`, `first_name`, `last_name` va `department_id` ustunlarini o'z ichiga olgan `employee_view` nomli view yaratish

Avvalo, misol uchun `hr_db` nomli ma'lumotlar bazasini yaratib, ichida `employees` jadvalini tuzamiz va unga namunaviy ma'lumotlar qo'shamiz.

```sql
-- Ma'lumotlar bazasini yaratish
CREATE DATABASE IF NOT EXISTS hr_db;
USE hr_db;

-- `employees` jadvalini yaratish
CREATE TABLE employees (
    employee_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone_number VARCHAR(20),
    hire_date DATE,
    job_id VARCHAR(20),
    salary DECIMAL(10, 2),
    department_id INT
);

-- Namuna ma'lumotlar qo'shish
INSERT INTO employees (first_name, last_name, email, department_id) VALUES
('Ali', 'Valiev', 'ali.v@example.com', 10),
('Madina', 'Karimova', 'madina.k@example.com', 20),
('Jasur', 'Mahmudov', 'jasur.m@example.com', 10),
('Nilufar', 'Shodiyeva', 'nilufar.sh@example.com', 30),
('Dilshod', 'Rustamov', 'dilshod.r@example.com', 20),
('Gulsara', 'Azimova', 'gulsara.a@example.com', 5), -- department_id 5 bo'lgan xodim
('Farhod', 'Sobirov', 'farhod.s@example.com', 10),
('Laylo', 'Komilova', 'laylo.k@example.com', 5); -- department_id 5 bo'lgan xodim

-- `employee_view` nomli View yaratish
CREATE VIEW employee_view AS
SELECT
    employee_id,
    first_name,
    last_name,
    department_id
FROM
    employees;
```

**Izoh:**

  * `CREATE VIEW employee_view AS`: `employee_view` nomli yangi View yaratishni boshlaydi.
  * `SELECT employee_id, first_name, last_name, department_id FROM employees;`: Bu View'ning asosini tashkil etuvchi SQL so'rovi. View chaqirilganda, u `employees` jadvalidan faqat ko'rsatilgan ustunlarni tanlab oladi.

-----

## 3\. `employee_view` viewdan `department_id` 5 ga teng bo'lgan barcha xodimlarni olish

Endi biz yaratgan `employee_view` dan oddiy jadvalga murojaat qilgandek ma'lumot olamiz. Bu so'rovda `department_id` 5 ga teng bo'lgan xodimlarni filtrlaymiz.

```sql
USE hr_db;

SELECT
    *
FROM
    employee_view
WHERE
    department_id = 5;
```

**Izoh:**

  * `SELECT * FROM employee_view`: `employee_view` dan barcha ustunlarni tanlaydi.
  * `WHERE department_id = 5`: Natijalarni `department_id` ustuni qiymati 5 ga teng bo'lgan qatorlar bilan cheklaydi.

Bu so'rovni bajarganingizda, siz faqat `department_id` 5 ga teng bo'lgan xodimlarning `employee_id`, `first_name`, `last_name` va `department_id` ma'lumotlarini ko'rasiz. Aslida, ma'lumotlar `employees` jadvalidan olinadi, lekin biz ularni View orqali soddalashtirilgan shaklda ko'ramiz.