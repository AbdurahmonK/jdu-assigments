## 1\. Web ilovalarning ishlash sxemasi

Web ilovalar (veb-ilovalar) internet orqali ishlaydigan dasturlar boʻlib, foydalanuvchi bilan oʻzaro aloqani taʼminlaydi. Ular odatda uchta asosiy komponentdan iborat: **mijoz (client)**, **server** va **maʼlumotlar bazasi (database)**. Quyida ularning ishlash sxemasi va tushuntirishi keltirilgan:

```
+------------+       +-------------+       +-----------------+
|   Mijoz    | ----> |   Server    | ----> | Ma'lumotlar B.  |
| (Brauzer)  | <---- | (Backend)   | <---- | (Database)      |
+------------+       +-------------+       +-----------------+
      ^                    ^
      |                    |
      | (HTML, CSS, JS)    | (PHP, Python, Node.js)
      v                    v
```

**Ishlash sxemasini tushuntirish:**

1.  **Mijoz (Client):** Bu foydalanuvchi bevosita oʻzaro aloqada boʻladigan qism. Odatda bu sizning kompyuteringizdagi veb-brauzer (Chrome, Firefox, Safari va h.k.) hisoblanadi. Foydalanuvchi biror saytga kirish uchun manzilni (URL) brauzerga kiritadi yoki havolani bosadi. Brauzer bu soʻrovni serverga yuboradi. Mijoz tomonda koʻrsatiladigan narsalar **HTML**, **CSS** va **JavaScript** yordamida yaratiladi.

2.  **Server:** Mijozdan kelgan soʻrovlarni qabul qiluvchi va ularni qayta ishlaydigan kompyuter yoki dastur. Serverda veb-ilovaning mantiqiy qismi (backend) joylashgan boʻladi. Misol uchun, sizning soʻrovingiz asosida server maʼlumotlar bazasidan maʼlumotlarni olib kelishi, ularni qayta ishlashi yoki yangi maʼlumotlarni saqlashi mumkin. Server soʻrovni qayta ishlagandan soʻng, natijani (odatda HTML, CSS va JavaScript shaklida) mijozga qaytaradi. Serverlar odatda **PHP**, Python, Node.js, Ruby kabi dasturlash tillarida yozilgan dasturlarni ishga tushiradi.

3.  **Maʼlumotlar bazasi (Database):** Bu veb-ilovaning barcha maʼlumotlari saqlanadigan joy. Masalan, foydalanuvchi roʻyxati, mahsulotlar, blog postlari va hokazo. Server maʼlumotlar bazasi bilan aloqa qilib, kerakli maʼlumotlarni oladi yoki yangi maʼlumotlarni yozadi. MySQL, PostgreSQL, MongoDB kabi maʼlumotlar bazasi tizimlari ishlatiladi.

**Qisqacha jarayon:**

1.  Foydalanuvchi brauzer orqali biror sahifani soʻraydi (masalan, `example.com`).
2.  Brauzer bu soʻrovni `example.com` domeniga bogʻlangan serverga yuboradi.
3.  Server soʻrovni qabul qiladi, kerak boʻlsa maʼlumotlar bazasidan maʼlumot oladi.
4.  Server HTML, CSS va JavaScript kodini shakllantiradi va uni brauzerga qaytaradi.
5.  Brauzer bu kodni tahlil qilib, foydalanuvchiga veb-sahifani koʻrsatadi.

-----

## 2\. Frontend va Backend tushunchalari

Veb-ishlab chiqish ikki asosiy qismga boʻlinadi: **Frontend** va **Backend**.

### Frontend (Mijoz tomoni)

**Frontend** — bu foydalanuvchi bevosita koʻradigan va oʻzaro aloqada boʻladigan veb-ilovaning qismi. Boshqacha qilib aytganda, bu veb-saytning "yuzi" hisoblanadi. Frontend dasturchilar veb-saytning dizayni, tartibi, interaktivligi va umumiy foydalanuvchi tajribasini yaratishga eʼtibor berishadi.

**Asosiy texnologiyalar:**

  * **HTML (HyperText Markup Language):** Veb-sahifaning tarkibini (matn, rasmlar, havolalar va h.k.) belgilash uchun ishlatiladi. Bu veb-sahifaning "skeleti"dir.
  * **CSS (Cascading Style Sheets):** Veb-sahifalarga stil berish, ularni chiroyli qilish uchun ishlatiladi. Ranglar, shriftlar, joylashuv va h.k.ni boshqaradi. Bu veb-sahifaning "kiyimi"dir.
  * **JavaScript:** Veb-sahifalarga interaktivlik qoʻshish, dinamik xatti-harakatlarni amalga oshirish uchun ishlatiladi. Misol uchun, tugmachani bosganda biror narsa sodir boʻlishi, shakllarni tekshirish, animatsiyalar yaratish. Bu veb-sahifaning "miya"sidir.

### Backend (Server tomoni)

**Backend** — bu veb-ilovaning "orqa miyasi" boʻlib, foydalanuvchi bevosita koʻrmaydigan, ammo veb-ilovaning asosiy mantigʻini va maʼlumotlar bilan ishlashini taʼminlaydigan qism. Backend dasturchilar server, maʼlumotlar bazasi va dastur mantiqini ishlab chiqishga eʼtibor berishadi.

**Asosiy texnologiyalar:**

  * **Dasturlash tillari:** **PHP**, Python, Node.js (JavaScript), Ruby, Java, Go, C\# va boshqalar.
  * **Ramkalar (Frameworks):** Laravel (PHP), Django (Python), Express.js (Node.js), Ruby on Rails (Ruby) va boshqalar. Bu ramkalar dasturlash jarayonini tezlashtiradi va soddalashtiradi.
  * **Maʼlumotlar bazalari:** MySQL, PostgreSQL, MongoDB, SQLite va boshqalar.
  * **Serverlar:** Apache, Nginx, IIS.

**Frontend va Backend oʻzaro aloqasi:**

Frontend foydalanuvchidan maʼlumotlarni oladi va ularni backendga soʻrov (request) sifatida yuboradi. Backend bu soʻrovni qayta ishlaydi, kerak boʻlsa maʼlumotlar bazasi bilan aloqa qiladi, soʻngra natijani (response) frontendga qaytaradi. Frontend esa bu natijani foydalanuvchiga tushunarli va chiroyli shaklda koʻrsatadi.

-----

## 3\. PHP built-in serverini oʻrnatish va sozlash

PHP ning oʻrnatilgan serveri (built-in web server) veb-ilovalarini tez va oson ishga tushirish uchun juda qulay vositadir. Bu server ishlab chiqish jarayonida Apache yoki Nginx kabi professional serverlarni oʻrnatishga hojat qoldirmaydi.

**Oʻrnatish (aslida sozlash):**

PHP built-in serverini alohida oʻrnatish shart emas, chunki u PHP ning oʻzi bilan birga keladi. Siz faqatgina **PHP ni kompyuteringizga oʻrnatgan boʻlishingiz kerak**.

**PHP ni oʻrnatish (agar oʻrnatilmagan boʻlsa):**

1.  **Windows uchun:**

      * **XAMPP, WAMP, Laragon** kabi kompleks paketlardan birini yuklab oling va oʻrnating. Bu paketlar PHP, Apache/Nginx va MySQL ni birga oʻrnatadi. Ular PHP ni PATH oʻzgaruvchisiga avtomatik qoʻshadi.
      * Yoki PHP ning rasmiy saytidan (windows.php.net) "Non-thread safe" versiyasini yuklab oling, biror papkaga (masalan, `C:\php`) oching va bu papkaning yoʻlini tizimning **PATH** muhit oʻzgaruvchilariga qoʻshing.

2.  **macOS uchun:** macOS da PHP odatda oldindan oʻrnatilgan boʻladi. Agar yangiroq versiya kerak boʻlsa, **Homebrew** orqali oʻrnatishingiz mumkin:

    ```bash
    brew install php
    ```

3.  **Linux uchun:** Deyarli barcha Linux tarqatishlarida PHP ni paket menejeri orqali oʻrnatish mumkin:

    ```bash
    sudo apt update
    sudo apt install php  # Debian/Ubuntu uchun
    # yoki
    sudo dnf install php  # Fedora uchun
    ```

**PHP oʻrnatilganligini tekshirish:**

Terminal yoki buyruq satrida quyidagi buyruqni ishga tushiring:

```bash
php -v
```

Agar PHP ning versiyasi koʻrinsa, demak u toʻgʻri oʻrnatilgan.

**PHP built-in serverini ishga tushirish va sozlash:**

PHP built-in serverini ishga tushirish uchun siz terminal yoki buyruq satrida serverni ishga tushirmoqchi boʻlgan **loyihaning asosiy katalogida** boʻlishingiz kerak.

**Oddiy misol:**

1.  Ishchi stolda `jdu` nomli papka yarating.
2.  `jdu` papkasi ichiga `index.php` faylini yarating.
3.  Terminalni oching va `cd` buyrugʻi bilan `jdu` papkasiga oʻting:
    ```bash
    cd /path/to/your/jdu/folder  # Masalan, cd C:\Users\YourUser\Desktop\jdu
    ```
4.  Quyidagi buyruqni ishga tushiring:
    ```bash
    php -S localhost:8000
    ```
      * `-S`: serverni ishga tushirishni bildiradi.
      * `localhost`: server ishlaydigan IP manzil (oʻzingizning kompyuteringiz).
      * `8000`: server ishlaydigan port raqami. Siz boshqa portni ham tanlashingiz mumkin (masalan, 3000, 5000, 8080).

Server ishga tushgach, siz brauzeringizda `http://localhost:8000` manziliga kirib, loyihangizni koʻrishingiz mumkin. Server ishlayotgan terminal oynasini yopmang, aks holda server ham toʻxtaydi. Serverni toʻxtatish uchun terminalda `Ctrl + C` tugmalarini bosing.

**Eslatma:** PHP built-in serveri faqat ishlab chiqish uchun moʻljallangan. Haqiqiy (production) loyihalar uchun Apache, Nginx kabi serverlardan foydalanish tavsiya etiladi.

-----

## 4\. "jdu" nomli proekt yaratish va "Hello World\!" ni chiqarish

Yuqoridagi maʼlumotlarga asoslanib, "jdu" nomli loyihani yaratamiz va "Hello World\!" yozuvini chiqaramiz.

1.  **"jdu" nomli papka yaratish:**
    Kompyuteringizda istalgan joyda, masalan, ish stolida (Desktop) yoki `Documents` papkasida **`jdu`** nomli yangi papka yarating.

      * **Windows:** Oʻng tugmani bosing -\> "New" -\> "Folder" -\> `jdu` deb nomlang.
      * **macOS/Linux:** Terminalda: `mkdir jdu`

2.  **`index.php` faylini yaratish:**
    `jdu` papkasi ichiga **`index.php`** nomli yangi fayl yarating. Bu fayl sizning loyihangizning asosiy kirish nuqtasi boʻladi.

      * **Windows:** `jdu` papkasini oching, oʻng tugmani bosing -\> "New" -\> "Text Document" -\> `index.php` deb nomlang. (Fayl kengaytmasi `.txt` emas, `.php` ekanligiga ishonch hosil qiling. Agar koʻrinmasa, "View" -\> "File name extensions" ni yoqing.)
      * **macOS/Linux:** Terminalda `cd jdu` buyrugʻi bilan `jdu` papkasiga oʻting, soʻng `touch index.php` buyrugʻini bering.

3.  **`index.php` fayliga kod yozish:**
    `index.php` faylini oʻzingizning sevimli matn muharriringizda (VS Code, Sublime Text, Notepad++, Atom va h.k.) oching va quyidagi kodni yozing:

    ```php
    <!-- PHP kodining boshlanishi va tugashini bildiradi. PHP skripti shu teglar orasida joylashadi. -->
    <?php
      // PHP dagi buyruq boʻlib, u brauzerga matnni chiqarish uchun ishlatiladi.
      echo "Hello World!";

    ?>
    ```

4.  **PHP built-in serverini ishga tushirish:**
      * Terminalni (yoki buyruq satrini) oching.
      * `cd` buyrugʻi bilan `jdu` papkasiga oʻting:
        ```bash
        cd /path/to/your/jdu  # Masalan, cd C:\Users\YourUser\Desktop\jdu
        ```
      * PHP built-in serverini ishga tushiring:
        ```bash
        php -S localhost:8000
        ```
        Agar hamma narsa toʻgʻri boʻlsa, siz terminalda "Development Server (http://localhost:8000) started" kabi xabarni koʻrasiz.

5.  **Brauzerda natijani koʻrish:**
    Endi brauzeringizni oching va manzil satriga quyidagini yozing:

    ```
    http://localhost:8000
    ```

    Brauzer oynasida **"Hello World\!"** yozuvi paydo boʻladi.