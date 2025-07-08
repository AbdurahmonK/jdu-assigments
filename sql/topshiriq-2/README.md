-----

## 1\. MySQL Server va MySQL Workbench dasturiy muhitini o'rnatish va sozlash

MySQL Server va MySQL Workbenchni o'rnatish uchun quyidagi bosqichlarni bajarishingiz kerak:

1.  **MySQL veb-saytiga tashrif buyuring:** Brauzeringizda [https://dev.mysql.com/downloads/](https://dev.mysql.com/downloads/) sahifasiga o'ting.
2.  **MySQL Installer'ni yuklab oling:** "MySQL Community (GPL) Downloads" bo'limiga o'ting va "MySQL Installer for Windows" (agar Windows ishlatayotgan bo'lsangiz) yoki operatsion tizimingizga mos keladigan boshqa versiyani tanlang. `.msi` (Windows uchun) faylini yuklab oling.
3.  **Installer'ni ishga tushiring:** Yuklab olingan faylni ikki marta bosing. O'rnatish ustasi ishga tushadi.
4.  **O'rnatish turini tanlang:**
      * **"Developer Default"** ni tanlash tavsiya etiladi, chunki u MySQL Server, Workbench, Shell va boshqa kerakli vositalarni o'z ichiga oladi.
      * Agar faqat ma'lum komponentlar kerak bo'lsa, **"Custom"** ni tanlashingiz mumkin.
5.  **Mahsulotlarni tanlang:** Agar "Custom" ni tanlagan bo'lsangiz, "MySQL Servers", "Applications" ostidan "MySQL Workbench" va "MySQL Shell" ni tanlang va o'ngga o'tkazing.
6.  **Konfiguratsiya:**
      * **"Type and Networking"** qismida, ko'pchilik holatlar uchun standart sozlamalar (masalan, port raqami 3306) mos keladi.
      * **"Authentication Method"** da "Use Strong Password Encryption for Authentication (RECOMMENDED)" ni tanlash tavsiya etiladi.
      * **"Accounts and Roles"** qismida **root foydalanuvchisi uchun kuchli parol o'rnating**. Bu parolni eslab qoling, chunki u sizga MySQL serveriga kirish uchun kerak bo'ladi.
      * **"Windows Service"** da "Configure MySQL Server as a Windows Service" belgilanganligiga ishonch hosil qiling va "Start MySQL Server at System Startup" ni belgilashingiz mumkin, bu serverni kompyuter yoqilganda avtomatik ishga tushiradi.
7.  **O'rnatishni yakunlang:** Barcha bosqichlarni bajarib, o'rnatishni yakunlang.

O'rnatish tugagandan so'ng, **MySQL Workbench** ni ishga tushiring. Siz "Local Instance MySQL" yoki shunga o'xshash nom bilan ulanishni ko'rishingiz kerak. Unga ulanish uchun root foydalanuvchisi parolini kiriting.

-----

## 2\. MySQL Workbench'da 10 ta ma'lumotlar bazasini yaratish

MySQL Workbench'da 10 ta ma'lumotlar bazasini yaratish uchun quyidagi amallarni bajaring:

1.  **MySQL Workbench'ni oching** va root foydalanuvchisi parolingiz bilan mahalliy MySQL misoliga (Local Instance MySQL) ulaning.

2.  **So'rov oynasini oching:** Chap tomondagi "SCHEMAS" bo'limida bo'sh joyga o'ng tugmani bosing va "Create Schema..." ni tanlang, yoki yuqori menyudan "File" -\> "New Query Tab" ni tanlab yangi so'rov oynasini oching.

3.  **Ma'lumotlar bazalarini yaratish uchun SQL buyruqlarini kiriting:** Quyidagi SQL buyruqlarini so'rov oynasiga kiriting va har bir buyruqni alohida-alohida bajarish uchun tanlab (yoki hammasini birga tanlab) "Execute (boshqotirma chaqmoqchasi)" tugmasini bosing:

    ```sql
    CREATE DATABASE database_1;
    CREATE DATABASE database_2;
    CREATE DATABASE database_3;
    CREATE DATABASE database_4;
    CREATE DATABASE database_5;
    CREATE DATABASE database_6;
    CREATE DATABASE database_7;
    CREATE DATABASE database_8;
    CREATE DATABASE database_9;
    CREATE DATABASE database_10;
    ```

4.  **Yangilash:** SCHEMAS bo'limini yangilash uchun o'ng tugmani bosib "Refresh All" ni tanlang. Endi siz yaratgan 10 ta ma'lumotlar bazasini ko'rishingiz kerak.

-----

## 3\. Yaratilgan ma'lumotlar bazalarining 4 tasini o'chirish

Yaratilgan 10 ta ma'lumotlar bazasidan 4 tasini o'chirish uchun quyidagi amallarni bajaring:

1.  **MySQL Workbench'dagi so'rov oynasiga qayting** (yoki yangisini oching).

2.  **Ma'lumotlar bazalarini o'chirish uchun SQL buyruqlarini kiriting:** Quyidagi SQL buyruqlarini so'rov oynasiga kiriting va har bir buyruqni alohida-alohida bajarish uchun tanlab (yoki hammasini birga tanlab) "Execute" tugmasini bosing:

    ```sql
    DROP DATABASE database_1;
    DROP DATABASE database_2;
    DROP DATABASE database_3;
    DROP DATABASE database_4;
    ```

    **Eslatma:** `DROP DATABASE` buyrug'i ma'lumotlar bazasini va uning ichidagi barcha jadvallar, ma'lumotlar va boshqa ob'ektlarni butunlay o'chirib tashlaydi. Bu qaytarib bo'lmaydigan amaldir, shuning uchun uni ehtiyotkorlik bilan bajaring\!

3.  **Yangilash:** SCHEMAS bo'limini yangilash uchun o'ng tugmani bosib "Refresh All" ni tanlang. Endi siz o'chirilgan 4 ta ma'lumotlar bazasi yo'qligini ko'rishingiz mumkin.

Bu amallar MySQL Server va Workbench bilan ishlashning asosiy bosqichlarini qamrab oladi. Keyingi topshiriqlarda ma'lumotlar bazalari ichida jadvallar yaratish va ma'lumotlar bilan ishlashni o'rganishingiz mumkin. Savollaringiz bormi?