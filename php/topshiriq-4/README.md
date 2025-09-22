## 1\. PHP da yangi "4-topshiriq" nomli proekt yaratish

Har bir dars uchun alohida loyiha papkasi yaratish yaxshi amaliyotdir.

1.  **Papka yaratish:** Kompyuteringizda **`4-topshiriq`** nomli yangi papka yarating.

      * **Windows:** O'ng tugmani bosing -\> "New" -\> "Folder" -\> `4-topshiriq` deb nomlang.
      * **macOS/Linux:** Terminalda: `mkdir 4-topshiriq`

2.  **`index.php` faylini yaratish:** `4-topshiriq` papkasi ichiga **`index.php`** nomli yangi fayl yarating. Keyingi topshiriqlar uchun barcha kodlar shu faylda yoziladi.

      * **Windows:** `4-topshiriq` papkasini oching, o'ng tugmani bosing -\> "New" -\> "Text Document" -\> `index.php` deb nomlang. (Fayl kengaytmasi `.php` ekanligiga ishonch hosil qiling.)
      * **macOS/Linux:** Terminalda `cd 4-topshiriq` buyrug'i bilan papkaga o'ting, so'ng `touch index.php` buyrug'ini bering.

3.  **PHP built-in serverini ishga tushirish:**
    Terminalni oching va `cd` buyrug'i yordamida `4-topshiriq` papkasiga o'ting. So'ngra quyidagi buyruqni ishga tushiring:

    ```bash
    php -S localhost:8000
    ```

    Bu serverni `http://localhost:8000` manzilida ishga tushiradi. Brauzeringizda ushbu manzilga kirib, natijalarni ko'rishingiz mumkin.

-----

## 2\. `fruits` nomli array bilan ishlash

`fruits` massivi yaratib, unga 5 ta element qo'shasiz, keyin 2 ta yangi meva qo'shasiz, 2 tasini o'zgartirasiz va natijani HTMLda tartiblangan ro'yxat (`<ol>` va `<li>`) yordamida chiqarasiz.

`index.php` faylingizga quyidagi kodni qo'shing:

```php
<?php

    echo "<h2>`fruits` massivi bilan ishlash</h2>";

    // 1. fruits nomli massiv yaratish va 5 ta element qo'shish
    $fruits = ["Olma", "Nok", "Uzum", "Shaftoli", "Anor"];
    echo "<h4>Boshlang'ich ro'yxat:</h4>";
    echo "<pre>";
    print_r($fruits);
    echo "</pre>";

    // 2. 2 ta yangi meva qo'shish
    $fruits[] = "Gilos"; // Massiv oxiriga element qo'shish
    array_push($fruits, "Kivi"); // Yana bir usul
    echo "<h4>2 ta yangi meva qo'shilgandan keyin:</h4>";
    echo "<pre>";
    print_r($fruits);
    echo "</pre>";

    // 3. 2 ta mevani boshqa mevalarga o'zgartirish
    $fruits[1] = "O'rik"; // 'Nok' ni 'O'rik' ga o'zgartirish (indeks 1)
    $fruits[3] = "Mandarin"; // 'Shaftoli' ni 'Mandarin' ga o'zgartirish (indeks 3)
    echo "<h4>2 ta meva o'zgartirilgandan keyin:</h4>";
    echo "<pre>";
    print_r($fruits);
    echo "</pre>";

    // 4. Oxirida HTMLda tartiblangan ro'yxat yordamida chiqarish
    echo "<h4>Yakuniy mevalar ro'yxati:</h4>";
    echo "<ol>"; // Tartiblangan ro'yxatni ochish
    foreach ($fruits as $fruit) {
        echo "<li>" . $fruit . "</li>";
    }
    echo "</ol>"; // Tartiblangan ro'yxatni yopish

    echo "<hr>";

?>
```

  * **`$fruits[] = "Gilos";`**: Bu usul massiv oxiriga yangi element qo'shishning eng sodda usuli.
  * **`array_push($fruits, "Kivi");`**: Bu funksiya ham massiv oxiriga bir yoki bir nechta element qo'shish uchun ishlatiladi.
  * **`$fruits[1] = "O'rik";`**: Massiv elementini indeks orqali o'zgartirish. Massiv indekslari 0 dan boshlanadi.
  * **`<pre>` va `print_r()`**: `print_r()` funksiyasi massivning tarkibini tushunarli formatda chiqaradi. `<pre>` tegi esa chiqarilgan matnni o'z formatida (bo'sh joylar va yangi qatorlar saqlangan holda) ko'rsatish uchun ishlatiladi.
  * **`<ol>` va `<li>`**: HTMLda tartiblangan ro'yxatlar (ordered list) yaratish uchun ishlatiladi.

-----

## 3\. `months` nomli arrayni yaratish va tartiblangan ro'yxatdan chiqarish

`months` massiviga 12 ta oy nomini kiritib, uni tartiblangan ro'yxat (`<ol>` va `<li>`) yordamida ekranga chiqarasiz.

```php
<?php

    echo "<h2>`months` massivi va oylarni chiqarish</h2>";

    // months nomli massiv yaratish va 12 ta oy nomini kiritish
    $months = [
        "Yanvar", "Fevral", "Mart", "Aprel", "May", "Iyun",
        "Iyul", "Avgust", "Sentabr", "Oktabr", "Noyabr", "Dekabr"
    ];

    echo "<h4>Oylar ro'yxati:</h4>";
    echo "<ol>"; // Tartiblangan ro'yxatni ochish
    foreach ($months as $month) {
        echo "<li>" . $month . "</li>";
    }
    echo "</ol>"; // Tartiblangan ro'yxatni yopish

    echo "<hr>";

?>
```

Bu yerda ham oldingi topshiriqdagi kabi `foreach` sikli va `<ol>`, `<li>` HTML teglari yordamida ro'yxat chiqariladi.

-----

## 4\. Talabalar nomli assosiativ array yaratish va ma'lumotlarni qo'shish

Assosiativ massivda elementlarga butun sonlar o'rniga nomli (string) kalitlar orqali murojaat qilinadi.

```php
<?php

    echo "<h2>Talabalar assosiativ massivi</h2>";

    // Talabalar nomli assosiativ massiv yaratish va 5 ta talaba ma'lumotini qo'shish
    $talabalar = [
        [
            "id" => 1,
            "ismi" => "Ali",
            "yoshi" => 20
        ],
        [
            "id" => 2,
            "ismi" => "Vali",
            "yoshi" => 21
        ],
        [
            "id" => 3,
            "ismi" => "G'ani",
            "yoshi" => 19
        ],
        [
            "id" => 4,
            "ismi" => "Dilorom",
            "yoshi" => 22
        ],
        [
            "id" => 5,
            "ismi" => "Salima",
            "yoshi" => 20
        ]
    ];

    echo "<h4>Talabalar ma'lumotlari:</h4>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<thead><tr><th>ID</th><th>Ismi</th><th>Yoshi</th></tr></thead>";
    echo "<tbody>";

    foreach ($talabalar as $talaba) {
        echo "<tr>";
        echo "<td>" . $talaba['id'] . "</td>";
        echo "<td>" . $talaba['ismi'] . "</td>";
        echo "<td>" . $talaba['yoshi'] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

    echo "<hr>";

?>
```

  * **Assosiativ massiv ichida massivlar:** Har bir talaba alohida assosiativ massiv sifatida saqlangan bo'lib, ular asosiy `$talabalar` massivi ichida joylashgan.
  * **`"id" => 1`**: Bu "id" kaliti (key) va uning qiymati (value) 1 ekanligini bildiradi.
  * **`$talaba['id']`**: Har bir ichki assosiativ massiv elementlariga kalit nomi orqali murojaat qilinadi.
  * **`<table>`, `<thead>`, `<th>`, `<tbody>`, `<tr>`, `<td>`**: HTMLda jadval yaratish uchun ishlatiladigan teglardir. `border='1'` jadvalga chegara qo'yadi, `cellpadding` va `cellspacing` esa katakchalar orasidagi bo'shliqlarni boshqaradi.

-----

## 5\. `yangiliklar` nomli assosiativ array yaratish

`yangiliklar` nomli assosiativ massiv yaratasiz, unga 5 ta yangilik elementini `sarlavha` va `batafsil` kalitlari (keys) bilan qo'shasiz.

```php
<?php

    echo "<h2>yangiliklar` assosiativ massivi</h2>";

    // Yangiliklar nomli assosiativ massiv yaratish va 5 ta element qo'shish
    $yangiliklar = [
        [
            "sarlavha" => "Yangi ta'lim dasturi ishga tushirildi",
            "batafsil" => "Maktablarda raqamli texnologiyalar bo'yicha yangi o'quv dasturi joriy etildi. Bu dastur yoshlarni IT sohasida malakali kadrlar bo'lib yetishishlariga yordam beradi."
        ],
        [
            "sarlavha" => "Shaharda yangi avtobus yo'nalishi ochildi",
            "batafsil" => "Jamoat transporti xizmatlarini yaxshilash maqsadida shaharning shimoliy qismida yangi avtobus yo'nalishi ishga tushirildi. Bu yo'nalish aholiga katta qulaylik yaratadi."
        ],
        [
            "sarlavha" => "Dehqonchilikda yangi texnologiyalar qo'llanilmoqda",
            "batafsil" => "Qishloq xo'jaligida hosildorlikni oshirish va resurslardan samarali foydalanish maqsadida zamonaviy texnologiyalar, xususan, tomchilatib sug'orish tizimlari keng qo'llanilmoqda."
        ],
        [
            "sarlavha" => "Sportda yangi yutuqlar",
            "batafsil" => "Mahalliy sportchimiz xalqaro musobaqada oltin medalni qo'lga kiritdi. Bu yutuq mamlakatimiz sporti rivojiga katta hissa qo'shadi."
        ],
        [
            "sarlavha" => "Madaniy tadbirlar haftaligi boshlandi",
            "batafsil" => "Shaharda madaniy tadbirlar haftaligi start oldi. Haftalik davomida turli ko'rgazmalar, konsertlar va teatr sahnalari namoyish etiladi."
        ]
    ];

    echo "<h4>So'nggi Yangiliklar:</h4>";

    foreach ($yangiliklar as $yangilik) {
        echo "<div>";
        echo "<h3>" . $yangilik['sarlavha'] . "</h3>"; // Sarlavhani chiqarish
        echo "<p>" . $yangilik['batafsil'] . "</p>";   // Batafsil ma'lumotni chiqarish
        echo "</div>";
        echo "<br>"; // Har bir yangilikdan keyin bo'sh joy qoldirish
    }

    echo "<hr>";

?>
```

  * Bu topshiriq ham 4-topshiriqqa o'xshash bo'lib, assosiativ massiv ichida yana assosiativ massivlar joylashtirilgan.
  * Har bir yangilik elementi `"sarlavha"` va `"batafsil"` kalitlariga ega.
  * **`<h3>` va `<p>`**: HTMLda sarlavha va paragraf (matn bloki) yaratish uchun ishlatiladi.