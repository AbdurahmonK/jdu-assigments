-----

Sizning 13-dars bo'yicha topshiriqlaringizda ma'lumotlarni guruhlash (`GROUP BY`) va saralash (`ORDER BY`) funksiyalaridan foydalanish talab qilinadi. Keling, har bir topshiriqni bosqichma-bosqich bajaramiz.

-----

## 1\. Universitet ma'lumotlar bazasini va `talabalar` jadvalini yaratish

Avval **`universitet`** nomli ma'lumotlar bazasini yaratamiz. So'ngra uning ichida **`talabalar`** nomli jadvalni tuzamiz, u `id`, `ismi`, `familiyasi`, `viloyati` va `yonalishi` ustunlariga ega bo'ladi. Keyin bu jadvalni 20 ta namunaviy talaba ma'lumotlari bilan to'ldiramiz.

```sql
-- Ma'lumotlar bazasini yaratish
CREATE DATABASE IF NOT EXISTS universitet;
USE universitet;

-- `talabalar` jadvalini yaratish
CREATE TABLE talabalar (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ismi VARCHAR(50) NOT NULL,
    familiyasi VARCHAR(50) NOT NULL,
    viloyati VARCHAR(50),
    yonalishi VARCHAR(100)
);

-- Jadvalni 20 ta talaba bilan to'ldirish
INSERT INTO talabalar (ismi, familiyasi, viloyati, yonalishi) VALUES
('Ali', 'Valiev', 'Toshkent', 'Kompyuter injiniringi'),
('Botir', 'Karimov', 'Samarqand', 'Dasturiy injiniring'),
('Dilorom', 'Ahmedova', 'Jizzax', 'Kompyuter injiniringi'),
('Eshmat', 'G\'aniyev', 'Andijon', 'Axborot xavfsizligi'),
('Fotima', 'Holmatova', 'Farg\'ona', 'Dasturiy injiniring'),
('G\'ani', 'Komilov', 'Jizzax', 'Axborot tizimlari'),
('Hulkar', 'Rustamova', 'Navoiy', 'Kompyuter injiniringi'),
('Ibrohim', 'Sulaymonov', 'Buxoro', 'Dasturiy injiniring'),
('Jasmina', 'Abdullayeva', 'Toshkent', 'Axborot xavfsizligi'),
('Kamron', 'Zokirov', 'Qashqadaryo', 'Axborot tizimlari'),
('Lola', 'Mirzaeva', 'Samarqand', 'Kompyuter injiniringi'),
('Murod', 'Fayziev', 'Namangan', 'Dasturiy injiniring'),
('Nigora', 'Saidova', 'Qashqadaryo', 'Axborot xavfsizligi'),
('Otabek', 'Toshmatov', 'Buxoro', 'Axborot tizimlari'),
('Parizoda', 'Asqarova', 'Xorazm', 'Kompyuter injiniringi'),
('Qodir', 'Umarov', 'Sirdaryo', 'Dasturiy injiniring'),
('Rayhon', 'Olimova', 'Toshkent', 'Axborot xavfsizligi'),
('Sarvar', 'Jo\'raev', 'Surxondaryo', 'Axborot tizimlari'),
('Tohir', 'G\'ulomov', 'Andijon', 'Kompyuter injiniringi'),
('Umid', 'Sobirov', 'Farg\'ona', 'Dasturiy injiniring');
```

-----

## 2\. Talabalar jadvalidan qaysi yo'nalishda nechta talaba o'qishini guruhlab chiqaruvchi so'rov

Har bir yo'nalishdagi talabalar sonini aniqlash uchun **`COUNT()`** funksiyasi va **`GROUP BY`** buyrug'idan foydalanamiz.

```sql
USE universitet;

SELECT
    yonalishi,
    COUNT(id) AS talabalar_soni
FROM
    talabalar
GROUP BY
    yonalishi;
```

**Izoh:**

  * `SELECT yonalishi, COUNT(id) AS talabalar_soni`: Natijada `yonalishi` ustunini va har bir yo'nalish bo'yicha talabalar sonini (`talabalar_soni` nomi ostida) ko'rsatishni bildiradi.
  * `FROM talabalar`: Ma'lumotlar `talabalar` jadvalidan olinadi.
  * `GROUP BY yonalishi`: Natijalarni `yonalishi` ustuni bo'yicha guruhlaydi, ya'ni bir xil yo'nalishdagi talabalar bir guruhga jamlanadi va `COUNT(id)` har bir guruh uchun alohida hisoblanadi.

-----

## 3\. Talabalar jadvalidan har bir viloyatda nechta talaba o'qishini kamayish tartibida guruhlab chiqaruvchi so'rov

Har bir viloyatdagi talabalar sonini aniqlash va ularni kamayish tartibida saralash uchun **`COUNT()`**, **`GROUP BY`** va **`ORDER BY ... DESC`** buyruqlaridan foydalanamiz.

```sql
USE universitet;

SELECT
    viloyati,
    COUNT(id) AS talabalar_soni
FROM
    talabalar
GROUP BY
    viloyati
ORDER BY
    talabalar_soni DESC; -- DESC kamayish tartibida (eng ko'pdan eng kamga) saralaydi
```

**Izoh:**

  * `SELECT viloyati, COUNT(id) AS talabalar_soni`: `viloyati` ustunini va har bir viloyat bo'yicha talabalar sonini (`talabalar_soni` nomi ostida) tanlaydi.
  * `FROM talabalar`: Ma'lumotlar `talabalar` jadvalidan olinadi.
  * `GROUP BY viloyati`: Natijalarni `viloyati` ustuni bo'yicha guruhlaydi.
  * `ORDER BY talabalar_soni DESC`: Hosil bo'lgan natijani `talabalar_soni` ustuni bo'yicha **kamayish tartibida** (ya'ni, talabalar soni eng ko'p bo'lgan viloyatdan eng kam bo'lgan viloyatga qarab) saralaydi.