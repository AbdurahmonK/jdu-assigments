## 1\. Amazon ma'lumotlar bazasi ichida `mahsulotlar` nomli jadvalga 5 ta har xil mahsulot qo'shish

Avvalambor, `amazon` ma'lumotlar bazasini faol holatga keltiramiz. Keyin `INSERT INTO` buyrug'idan foydalanib `mahsulotlar` jadvaliga 5 ta yangi mahsulot kiritamiz:

```sql
USE amazon;

INSERT INTO mahsulotlar (nomi, narxi, kategoriya) VALUES
('Smartfon Samsung Galaxy S24', 1200.00, 'Elektronika'),
('Noutbuk HP Pavilion 15', 950.50, 'Kompyuterlar'),
('Sport poyabzali Nike Air Max', 150.75, 'Kiyimlar'),
('Oshxona kombayni Bosch MCM3501M', 250.00, 'Maishiy texnika'),
('Kitob "Alkimyogar" P.Koelo', 15.20, 'Kitoblar');
```

**Izoh:**

  * `USE amazon;` — `amazon` ma'lumotlar bazasini tanlaydi.
  * `INSERT INTO mahsulotlar (nomi, narxi, kategoriya)` — `mahsulotlar` jadvaliga, `nomi`, `narxi` va `kategoriya` ustunlariga ma'lumot kiritishni boshlaydi. `ID` ustunini ko'rsatmadik, chunki u `AUTO_INCREMENT` bo'lganligi sababli avtomatik ravishda to'ldiriladi.
  * `VALUES (...)` — kiritiladigan qiymatlarni belgilaydi. Har bir qator alohida qavs ichida va vergul bilan ajratilgan.

-----

## 2\. `mijozlar` nomli jadvalga 5 ta har xil mijoz qo'shish

Endi `mijozlar` jadvaliga 5 ta yangi mijoz ma'lumotlarini kiritamiz:

```sql
USE amazon;

INSERT INTO mijozlar (ismi, address, telefon_raqami) VALUES
('Alijon Valiev', 'Toshkent sh., Chilonzor tum., 12-uy', '+998901234567'),
('Madina Karimova', 'Samarqand sh., Mirzo Ulugbek ko\'ch., 5-uy', '+998917654321'),
('Jasur Mahmudov', 'Buxoro sh., Bahouddin Naqshband ko\'ch., 8-uy', '+998939876543'),
('Nilufar Shodiyeva', 'Farg\'ona sh., Mustaqillik ko\'ch., 2-uy', '+998941238765'),
('Dilshod Rustamov', 'Andijon sh., Bobur shohko\'chasi, 15-uy', '+998976543210');
```

Bu yerda ham `ID` ustuni avtomatik ravishda to'ldiriladi.

-----

## 3\. `kategoriyalar` nomli jadvalga 5 ta har xil kategoriya qo'shish

Nihoyat, `kategoriyalar` jadvaliga 5 ta yangi kategoriya qo'shamiz:

```sql
USE amazon;

INSERT INTO kategoriyalar (kategoriya_nomi) VALUES
('Elektronika'),
('Kompyuterlar'),
('Kiyimlar'),
('Maishiy texnika'),
('Kitoblar');
```

**Eslatma:** `kategoriya_nomi` ustunida `UNIQUE` cheklovi borligini unutmang. Bu shuni anglatadiki, siz bir xil nomdagi ikkita kategoriyani qo'sha olmaysiz. Agar qo'shishga harakat qilsangiz, xatolik yuz beradi.