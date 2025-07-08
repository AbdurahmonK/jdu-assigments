-----

## 1\. `mahsulotlar` jadvalidagi 3 ta mahsulotning sonini (narxini) 0 ga o'zgartirish

Berilgan topshiriqda "sonini 0 ga o'zgartirish" deyilgan, biroq avvalgi topshiriqlarda `mahsulotlar` jadvalida mahsulot soni (`quantity` yoki `stock`) ustuni yaratilmagan, balki `narxi` ustuni mavjud. Shu sababli, men **mahsulotlarning narxini 0 ga o'zgartirish** deb tushundim. Agar sizning jadvallingizda `soni` degan ustun bo'lsa, o'zgartirishingiz mumkin.

Quyidagi SQL buyruqlari yordamida biz 3 ta mahsulotning narxini 0 ga o'zgartiramiz:

```sql
USE amazon;

UPDATE mahsulotlar
SET narxi = 0.00
WHERE ID IN (1, 2, 3);
```

**Izoh:**

  * `USE amazon;` — `amazon` ma'lumotlar bazasini tanlaydi.
  * `UPDATE mahsulotlar` — `mahsulotlar` jadvalidagi ma'lumotlarni yangilashni boshlaydi.
  * `SET narxi = 0.00` — `narxi` ustunining qiymatini 0.00 ga o'rnatadi.
  * `WHERE ID IN (1, 2, 3)` — Faqat IDsi 1, 2 yoki 3 bo'lgan mahsulotlarga ta'sir qilishini belgilaydi. Bu yerda siz o'zingiz xohlagan boshqa ID raqamlarini kiritishingiz mumkin.

-----

## 2\. `mahsulotlar` jadvalidagi narxi 0 ga teng bo'lgan 3 ta mahsulotni o'chirish

Narxi 0 ga teng bo'lgan (yoki sizning holatingizda soni 0 ga teng bo'lgan) mahsulotlarni jadvaldan o'chirish uchun `DELETE` buyrug'idan foydalanamiz:

```sql
USE amazon;

DELETE FROM mahsulotlar
WHERE narxi = 0.00
LIMIT 3;
```

**Izoh:**

  * `DELETE FROM mahsulotlar` — `mahsulotlar` jadvalidan ma'lumotlarni o'chirishni boshlaydi.
  * `WHERE narxi = 0.00` — Faqat `narxi` 0.00 bo'lgan qatorlarni o'chirishni belgilaydi.
  * `LIMIT 3` — Bu qator ixtiyoriy. Agar bir nechta mahsulotning narxi 0 bo'lsa va siz faqat bir nechtasini o'chirmoqchi bo'lsangiz, `LIMIT` dan foydalanishingiz mumkin. Aks holda, `LIMIT 3` ni olib tashlashingiz mumkin, bu barcha narxi 0 bo'lgan mahsulotlarni o'chiradi.

-----

## 3\. `mijozlar` jadvalidagi 5 ta mijozning telefon raqamlarini o'zgartirish

Mijozlarning telefon raqamlarini yangilash uchun `UPDATE` buyrug'idan foydalanamiz. Har bir mijoz uchun alohida `UPDATE` buyrug'i berishimiz mumkin:

```sql
USE amazon;

UPDATE mijozlar
SET telefon_raqami = '+998991112233'
WHERE ID = 1;

UPDATE mijozlar
SET telefon_raqami = '+998984445566'
WHERE ID = 2;

UPDATE mijozlar
SET telefon_raqami = '+998977778899'
WHERE ID = 3;

UPDATE mijozlar
SET telefon_raqami = '+998950001122'
WHERE ID = 4;

UPDATE mijozlar
SET telefon_raqami = '+998913334455'
WHERE ID = 5;
```

**Izoh:** Har bir `UPDATE` buyrug'i faqat ma'lum bir `ID` ga ega mijozning `telefon_raqami` ni yangilaydi. ID raqamlarini o'zingizning mijozlaringiz IDlariga moslab o'zgartirishingiz mumkin.

-----

## 4\. `mijozlar` jadvalidagi `telefon_raqam` ustunini `UNIQUE` qilish

`telefon_raqami` ustuniga `UNIQUE` cheklovini qo'shish uchun `ALTER TABLE` buyrug'idan foydalanamiz. Bu har bir mijozning telefon raqami noyob bo'lishini ta'minlaydi:

```sql
USE amazon;

ALTER TABLE mijozlar
ADD CONSTRAINT UQ_telefon_raqami UNIQUE (telefon_raqami);
```

**Izoh:**

  * `ALTER TABLE mijozlar` — `mijozlar` jadvalining tuzilishini o'zgartirishni boshlaydi.
  * `ADD CONSTRAINT UQ_telefon_raqami UNIQUE (telefon_raqami)` — `telefon_raqami` ustuniga `UQ_telefon_raqami` nomli noyob cheklovni qo'shadi. Bu buyruq, agar jadvalda bir xil telefon raqamlari mavjud bo'lsa, xatolik berishi mumkin. Agar shunday bo'lsa, avval takrorlanuvchi raqamlarni tuzatishingiz kerak bo'ladi.

-----

## 5\. `kategoriyalar` jadvalidagi 5 ta kategoriyadan 2 tasini o'chirish va qolgan 3 tasining nomini o'zgartirish

Avval 2 ta kategoriyani o'chiramiz, so'ngra qolgan 3 tasining nomini o'zgartiramiz.

**2 ta kategoriyani o'chirish:**

```sql
USE amazon;

DELETE FROM kategoriyalar
WHERE ID IN (1, 2); -- Bu yerda o'chirmoqchi bo'lgan kategoriyalarning ID'larini kiriting
```

**Izoh:** `ID IN (1, 2)` bu yerda IDsi 1 va 2 bo'lgan kategoriyalar o'chiriladi. Siz o'chirmoqchi bo'lgan kategoriyalarning ID'larini bilishingiz kerak.

**Qolgan 3 ta kategoriyaning nomini o'zgartirish:**

Misol uchun, oldingi "Elektronika", "Kompyuterlar", "Kiyimlar", "Maishiy texnika", "Kitoblar" kategoriyalaridan ikkitasi o'chirildi deb hisoblasak (masalan, "Elektronika" va "Kompyuterlar"), qolgan 3 tasi "Kiyimlar", "Maishiy texnika", "Kitoblar" bo'ladi. Ularning nomlarini o'zgartiramiz:

```sql
USE amazon;

UPDATE kategoriyalar
SET kategoriya_nomi = 'Liboslar'
WHERE kategoriya_nomi = 'Kiyimlar'; -- Eski nomni ko'rsating

UPDATE kategoriyalar
SET kategoriya_nomi = 'Uy Ro\'zg\'or Buyumlari'
WHERE kategoriya_nomi = 'Maishiy texnika';

UPDATE kategoriyalar
SET kategoriya_nomi = 'Adabiyotlar'
WHERE kategoriya_nomi = 'Kitoblar';
```

**Izoh:** `WHERE kategoriya_nomi = 'Eski Nom'` qismida siz o'zgartirmoqchi bo'lgan kategoriyaning hozirgi nomini kiritishingiz shart. `SET kategoriya_nomi = 'Yangi Nom'` qismida esa yangi nomni kiritasiz.

Ushbu amallar bajarilgandan so'ng, sizning ma'lumotlar bazangizdagi jadvallar kerakli tarzda yangilanadi. Yana qanday savollaringiz bor?