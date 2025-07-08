---
## 1. Ma'lumotlar bazasi deganda nimani tushunasiz?

**Ma'lumotlar bazasi** (inglizcha: **Database**) — bu ma'lumotlarni tashkil etish, saqlash va boshqarish uchun mo'ljallangan tizimli to'plam. Oddiy qilib aytganda, u juda ko'p ma'lumotlarni tartibli joylashtirib, ularni osongina topish, o'zgartirish yoki o'chirish imkonini beruvchi joydir. Ma'lumotlar bazalari kompaniyalarda mijozlar ma'lumotlaridan tortib, veb-saytlardagi mahsulotlar ro'yxatigacha bo'lgan har qanday turdagi ma'lumotlarni saqlash uchun ishlatiladi.

---
## 2. Relyatsion ma'lumotlar bazasini tushuntirib bering.

**Relyatsion ma'lumotlar bazasi** (inglizcha: **Relational Database**) — ma'lumotlar bazalarining eng keng tarqalgan turidir. Unda ma'lumotlar **jadvallar** (inglizcha: **tables**) ko'rinishida saqlanadi. Har bir jadvalda ustunlar (inglizcha: **columns**) va qatorlar (inglizcha: **rows**) mavjud. Ustunlar ma'lumotning turini (masalan, ism, yosh, manzil) belgilasa, qatorlar esa har bir alohida yozuvni ifodalaydi.

Relyatsion ma'lumotlar bazasining asosiy xususiyati shundaki, jadvallar orasida **aloqalar** (inglizcha: **relationships**) o'rnatish mumkin. Bu aloqalar umumiy ustunlar (kalitlar) orqali amalga oshiriladi va ma'lumotlarni takrorlashdan saqlashga hamda ular orasidagi mantiqiy bog'liqliklarni ta'minlashga yordam beradi. Masalan, "Mijozlar" jadvali bilan "Buyurtmalar" jadvalini mijoz ID'si orqali bog'lash mumkin, bu esa kim qanday buyurtma berganini osongina aniqlash imkonini beradi.

---
## 3. SQL - bu …

**SQL** (inglizcha: **Structured Query Language** — Strukturalangan So'rov Tili) — relyatsion ma'lumotlar bazalaridagi ma'lumotlarni boshqarish va manipulyatsiya qilish uchun mo'ljallangan standart dasturlash tilidir. SQL yordamida siz:

* Ma'lumotlar bazasidan ma'lumotlarni tanlashingiz (SELECT)
* Yangi ma'lumotlarni qo'shishingiz (INSERT)
* Mavjud ma'lumotlarni o'zgartirishingiz (UPDATE)
* Ma'lumotlarni o'chirishingiz (DELETE)
* Ma'lumotlar bazasi tuzilmasini yaratishingiz yoki o'zgartirishingiz (CREATE, ALTER, DROP)

mumkin. SQL juda kuchli va keng qo'llaniladigan til bo'lib, deyarli barcha relyatsion ma'lumotlar bazasi tizimlari (masalan, MySQL, PostgreSQL, Oracle, SQL Server) uni qo'llab-quvvatlaydi.