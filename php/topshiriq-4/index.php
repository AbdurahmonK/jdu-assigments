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