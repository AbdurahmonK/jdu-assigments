## 1\. `guruhlar` nomli jadval yaratish

`ums` ma'lumotlar bazasida **`guruhlar`** nomli jadvalni yaratamiz. Bu jadvalda guruhlarning identifikatori (`id`) va nomi (`name`) bo'ladi. `id` ustuniga **PRIMARY KEY** cheklovini o'rnatamiz, bu uni jadvaldagi har bir qator uchun noyob qiladi.

```sql
USE ums;

CREATE TABLE guruhlar (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE
);
```

**Izoh:**

  * `id INT PRIMARY KEY AUTO_INCREMENT`: `id` ustuni butun son bo'lib, birlamchi kalit hisoblanadi va har yangi qator qo'shilganda avtomatik ravishda 1 taga oshadi.
  * `name VARCHAR(50) NOT NULL UNIQUE`: `name` ustuni maksimal 50 ta belgidan iborat matn qatori bo'lib, bo'sh bo'lmasligi va takrorlanmasligi shart.

-----

## 2\. `students` nomli jadval yaratish

Endi **`students`** nomli jadvalni yaratamiz. Bu jadvalda talabalarning identifikatori (`student_id`), ismi, familiyasi va qaysi guruhga tegishli ekanligini ko'rsatuvchi `group_id` ustuni bo'ladi. `student_id` ustuni **PRIMARY KEY** bo'lib, avtomatik ortib boradi. Eng muhimi, `group_id` ustuniga **FOREIGN KEY** cheklovini o'rnatamiz, bu uni `guruhlar` jadvalidagi `id` ustuni bilan bog'laydi.

```sql
USE ums;

CREATE TABLE students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    ismi VARCHAR(50) NOT NULL,
    familiyasi VARCHAR(50) NOT NULL,
    group_id INT,
    FOREIGN KEY (group_id) REFERENCES guruhlar(id)
);
```

**Izoh:**

  * `student_id INT PRIMARY KEY AUTO_INCREMENT`: Talaba identifikatori, birlamchi kalit va avtomatik ravishda oshib boradi.
  * `ismi VARCHAR(50) NOT NULL`, `familiyasi VARCHAR(50) NOT NULL`: Talabaning ismi va familiyasi, bo'sh bo'lmasligi shart.
  * `group_id INT`: Talaba tegishli bo'lgan guruhning identifikatori.
  * `FOREIGN KEY (group_id) REFERENCES guruhlar(id)`: Bu cheklov `students` jadvalidagi `group_id` ustunini `guruhlar` jadvalidagi `id` ustuni bilan bog'laydi. Bu shuni anglatadiki, `students` jadvaliga faqat `guruhlar` jadvalida mavjud bo'lgan `id` qiymatlari kiritilishi mumkin. Bu ma'lumotlar yaxlitligini ta'minlaydi.

-----

## 3\. `guruhlar` jadvalini JDUdagi barcha guruhlar bilan to'ldirish

Jizzax Davlat Universiteti (JDU) dagi bir nechta guruh nomlarini `groups` jadvaliga kiritamiz. Siz o'zingizning universitet va fakultetingiz guruhlarini kiritishingiz mumkin.

```sql
USE ums;

INSERT INTO guruhlar (name) VALUES
('BIT-2101'),
('BIT-2102'),
('MIT-2203'),
('DIT-2001'),
('QMT-2304');
```

-----

## 4\. `students` jadvaliga 10 o'z guruhingizdagi talabalar bilan to'ldirish

Endi `students` jadvaliga 10 ta talabani kiritamiz. Ularni yuqorida yaratilgan guruhlardan biriga biriktiramiz. Kiritishdan oldin, **guruhlarning ID raqamlarini bilishingiz kerak**. Agar siz yuqoridagi kabi ma'lumotlarni kiritgan bo'lsangiz, `BIT-2101` ning `group_id` 1 bo'lishi ehtimoli bor. Sizning guruhingizga mos IDni topish uchun `SELECT * FROM guruhlar;` buyrug'ini ishlatib ko'ring.

Misol uchun, barcha talabalar `BIT-2101` (ID=1) guruhiga tegishli deb hisoblaymiz:

```sql
USE ums;

INSERT INTO students (ismi, familiyasi, group_id) VALUES
('Umar', 'Usmonov', 1),
('Saida', 'Saidova', 1),
('Dilmurod', 'Ismoilov', 1),
('Aziza', 'Tursunova', 1),
('Shukhrat', 'G\'ulomov', 1),
('Laylo', 'Karimova', 1),
('Bekzod', 'Aminov', 1),
('Madina', 'Raximova', 1),
('Zafar', 'Nosirov', 1),
('Feruza', 'Ergasheva', 1);
```

**Izoh:** `group_id` ustuniga kiritilgan raqamlar `guruhlar` jadvalidagi mavjud `id` larga mos kelishi shart. Aks holda, xatolik yuz beradi.

-----

## 5\. `COUNT` funksiyasi orqali har bir guruhda nechta talaba borligini aniqlovchi so'rov yozish

Har bir guruhdagi talabalar sonini topish uchun biz `COUNT()` jamlovchi funksiyasidan va `GROUP BY` buyrug'idan foydalanamiz. Natijalarni tushunarli qilish uchun `guruhlar` jadvali bilan `students` jadvalini **`JOIN`** qilamiz.

```sql
USE ums;

SELECT
    g.name,
    COUNT(s.student_id) AS total_students
FROM
    guruhlar AS g
LEFT JOIN
    students AS s ON g.id = s.group_id
GROUP BY
    g.name
ORDER BY
    g.name;
```

**Izoh:**

  * `SELECT g.name, COUNT(s.student_id) AS total_students`: `name` ustunini va har bir guruhdagi talabalar sonini (`total_students` nomi ostida) tanlaydi.
  * `FROM guruhlar AS g`: `guruhlar` jadvalini `g` taxallusi bilan tanlaydi.
  * `LEFT JOIN students AS s ON g.id = s.group_id`: `guruhlar` jadvalini `students` jadvali (`s` taxallusi bilan) bilan `group_id` ustuni orqali bog'laydi. `LEFT JOIN` barcha guruhlarni (hatto talabasi bo'lmasa ham) ro'yxatga kiritishni ta'minlaydi.
  * `GROUP BY g.gname`: Natijalarni `name` bo'yicha guruhlaydi, bu `COUNT()` funksiyasiga har bir guruh uchun alohida hisoblash imkonini beradi.
  * `ORDER BY g.name`: Natijalarni guruh nomi bo'yicha alifbo tartibida saralaydi.