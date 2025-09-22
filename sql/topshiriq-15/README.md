**(Privileges) ruxsatlar** bu ma'lumotlar bazasi xavfsizligining muhim qismi bo'lib, kim qanday ma'lumotlarga kira olishini va qanday amallarni bajarishini nazorat qilish imkonini beradi.

-----

## 1\. 14-darsda yaratilgan `bank` ma'lumotlar bazasidan foydalanish

Biz 14-darsda `bank` ma'lumotlar bazasini va uning ichida `accounts` jadvalini yaratib, to'ldirgan edik. Ushbu topshiriqlarda aynan shu bazadan foydalanamiz.

-----

## 2\. Serverda 3 ta yangi foydalanuvchi yaratish (`user1`, `user2`, `user3`)

MySQL serverida yangi foydalanuvchilarni yaratish uchun `CREATE USER` buyrug'idan foydalanamiz. Har bir foydalanuvchi uchun kuchli parol belgilash muhim. Bu misolda men sodda parollardan foydalanaman, ammo haqiqiy muhitda murakkab parollarni tanlash tavsiya etiladi.

```sql
-- Foydalanuvchi yaratish (Localhost dan ulanish uchun)
CREATE USER 'user1'@'localhost' IDENTIFIED BY 'User1_password!';
CREATE USER 'user2'@'localhost' IDENTIFIED BY 'User2_password!';
CREATE USER 'user3'@'localhost' IDENTIFIED BY 'User3_password!';

-- Agar serverga har qanday hostdan ulanishni xohlasangiz (xavfsizroq muhitda tavsiya etilmaydi):
-- CREATE USER 'user1'@'%' IDENTIFIED BY 'User1_password!';
-- CREATE USER 'user2'@'%' IDENTIFIED BY 'User2_password!';
-- CREATE USER 'user3'@'%' IDENTIFIED BY 'User3_password!';
```

**Izoh:**

  * `CREATE USER 'username'@'host' IDENTIFIED BY 'password'`: Yangi foydalanuvchi yaratish sintaksisi.
  * `'username'`: Foydalanuvchi nomi.
  * `'host'`: Foydalanuvchi qayerdan ulanishi mumkinligini belgilaydi.
      * `'localhost'` faqat shu serverdan ulanishga ruxsat beradi.
      * `'%'` har qanday hostdan ulanishga ruxsat beradi (xavfsizlik nuqtai nazaridan ehtiyot bo'lish kerak).
  * `'password'`: Foydalanuvchining paroli.

-----

## 3\. Yaratilgan foydalanuvchilarga `bank` ma'lumotlar bazasidagi `accounts` jadvalidagi ma'lumotlarni ko'rish ruxsatini berish

Foydalanuvchilarga ma'lumotlarni o'qish (ko'rish) huquqini berish uchun `SELECT` ruxsatidan foydalanamiz. Bu ruxsatni barcha uchala foydalanuvchiga beramiz.

```sql
-- user1 ga `bank.accounts` jadvalidan SELECT ruxsati berish
GRANT SELECT ON bank.accounts TO 'user1'@'localhost';

-- user2 ga `bank.accounts` jadvalidan SELECT ruxsati berish
GRANT SELECT ON bank.accounts TO 'user2'@'localhost';

-- user3 ga `bank.accounts` jadvalidan SELECT ruxsati berish
GRANT SELECT ON bank.accounts TO 'user3'@'localhost';

-- Ruxsatlarni yangilash (o'zgarishlar darhol kuchga kirishi uchun)
FLUSH PRIVILEGES;
```

**Izoh:**

  * `GRANT SELECT ON database_name.table_name TO 'username'@'host'`: Ma'lum bir jadvalga (yoki `*.*` orqali barcha jadvallarga) `SELECT` (o'qish) ruxsatini beradi.
  * `FLUSH PRIVILEGES`: MySQL serveriga ruxsatlar jadvalini qayta yuklashni buyuradi, bu esa yangi berilgan ruxsatlarning darhol kuchga kirishini ta'minlaydi.

-----

## 4\. `user1` ga `INSERT`, `user2` ga `DELETE`, va `user3` ga `UPDATE` qilish huquqlarini `GRANT` orqali berish

Endi har bir foydalanuvchiga ularning vazifasiga qarab alohida huquqlarni beramiz:

  * `user1`ga ma'lumot qo'shish (`INSERT`).
  * `user2`ga ma'lumot o'chirish (`DELETE`).
  * `user3`ga ma'lumot o'zgartirish (`UPDATE`).

<!-- end list -->

```sql
-- user1 ga `bank.accounts` jadvaliga INSERT huquqi berish
GRANT INSERT ON bank.accounts TO 'user1'@'localhost';

-- user2 ga `bank.accounts` jadvalidan DELETE huquqi berish
GRANT DELETE ON bank.accounts TO 'user2'@'localhost';

-- user3 ga `bank.accounts` jadvalidagi ma'lumotlarni UPDATE qilish huquqi berish
GRANT UPDATE ON bank.accounts TO 'user3'@'localhost';

-- Ruxsatlarni yangilash
FLUSH PRIVILEGES;
```

**Izoh:**

  * Har bir `GRANT` buyrug'i ma'lum bir amalni (INSERT, DELETE, UPDATE) faqat `bank.accounts` jadvaliga nisbatan bajarishga ruxsat beradi.

**Tekshirish uchun:**
Siz MySQL Workbench'dan foydalanib, har bir foydalanuvchi (`user1`, `user2`, `user3`) sifatida alohida ulanib, ularga berilgan ruxsatlarni tekshirib ko'rishingiz mumkin:

  * `user1` bilan ulanib, `accounts` jadvaliga `INSERT` buyrug'ini bajarib ko'ring. Boshqa buyruqlar (UPDATE, DELETE) xatolik berishi kerak.
  * `user2` bilan ulanib, `accounts` jadvalidan `DELETE` buyrug'ini bajarib ko'ring.
  * `user3` bilan ulanib, `accounts` jadvalidagi ma'lumotlarni `UPDATE` qilib ko'ring.