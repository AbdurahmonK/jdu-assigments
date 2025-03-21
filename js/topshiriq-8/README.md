### 1.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Seriallar Ro'yxati</title>
    <style>
        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 10px;
            width: 80%;
            margin: 20px auto;
        }
        .item {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .item img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="item">
            <img src="your_image_lucifer.jpg" alt="Lucifer">
            <p>LUTSIFER LUSIFER LYUTSIFER UZBEK O'ZBEK</p>
        </div>
        <div class="item">
            <img src="your_image_umid.jpg" alt="Umid">
            <p>UMID KOREYS SERIAL BARCHA QISMLARI</p>
        </div>
        <div class="item">
            <img src="your_image_dilozorim.jpg" alt="Dilozorim">
            <p>DILOZORIM KOREYS SERIAL BARCHA QISMLARI</p>
        </div>
        <div class="item">
            <img src="your_image_ketma.jpg" alt="Ketma">
            <p>KETMA KOREYS SERIAL BARCHA QISMLARI</p>
        </div>
        <div class="item">
            <img src="your_image_rings.jpg" alt="The Lord of the Rings">
            <p>UZUKLAR HUKUMDORI QUDRAT UZUKLARI</p>
        </div>
        <div class="item">
            <img src="your_image_nonisi.jpg" alt="Non Isi">
            <p>NON ISI KOREYA SERIALI BARCHA</p>
        </div>
        <div class="item">
            <img src="your_image_quyosh.jpg" alt="Quyosh Avlodlari">
            <p>QUYOSH AVLODLARI KOREYS SERIAL BARCHA QISMLARI</p>
        </div>
        <div class="item">
            <img src="your_image_xongildon.jpg" alt="Xon Gil Don">
            <p>XON GIL DON AFONASI HAQIDA AFSONA KOREYS</p>
        </div>
    </div>

</body>
</html>
```

---

### 2.
```html
<!DOCTYPE html>
<html>
<head>
    <title>CSS Card Hover Effects</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="container">
        <h1>CSS CARD HOVER EFFECTTS</h1>

        <div class="cards">
            <div class="card">01</div>
            <div class="card">02</div>
            <div class="card">03</div>
        </div>

        <p>HTML CSS TUTORIAL</p>
    </div>

</body>
</html>
```

```css
body {
    background-image: url('your_background_image.jpg'); /* Fon rasmi */
    background-size: cover;
    font-family: sans-serif;
    color: white;
    text-align: center;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 50px auto;
}

.cards {
    display: flex;
    justify-content: center;
    margin: 50px 0;
}

.card {
    width: 150px;
    height: 200px;
    margin: 0 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 3em;
    font-weight: bold;
    color: white;
    transition: transform 0.3s ease;
}

.card:nth-child(1) {
    background: linear-gradient(to bottom, #6a5acd, #9370db);
}

.card:nth-child(2) {
    background: linear-gradient(to bottom, #3cb371, #90ee90);
}

.card:nth-child(3) {
    background: linear-gradient(to bottom, #ffa500, #ffc72c);
}

.card:hover {
    transform: scale(1.1);
}

p {
    font-size: 1.2em;
}
```

---

### 3.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Navigatsiya Panellari</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="navbar">
        <div class="logo">LOGOBAKERY</div>
        <div class="nav-links">
            <a href="#">Services</a>
            <a href="#">Projects</a>
            <a href="#">About</a>
            <a href="#" class="contact-btn">Contact</a>
        </div>
    </div>

    <div class="navbar">
        <div class="nav-links left">
            <a href="#">Services</a>
            <a href="#">Projects</a>
            <a href="#">About</a>
            <a href="#" class="contact-btn">Contact</a>
        </div>
        <div class="logo right">LOGOBAKERY</div>
    </div>

    <div class="navbar">
        <div class="logo">LOGOBAKERY</div>
        <div class="nav-links right">
            <a href="#">Services</a>
            <a href="#">Projects</a>
            <a href="#">About</a>
            <a href="#" class="contact-btn">Contact</a>
        </div>
    </div>

</body>
</html>
```

```css
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}

.navbar {
    background-color: #282828;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    margin-bottom: 10px;
}

.logo {
    font-size: 1.5em;
    font-weight: bold;
}

.nav-links {
    display: flex;
    align-items: center;
}

.nav-links.left {
    margin-right: auto;
}

.nav-links.right {
    margin-left: auto;
}

.nav-links a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
}

.contact-btn {
    background-color: #008CBA;
    padding: 8px 15px;
    border-radius: 5px;
}
```

---

### 4.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Karta Tartibi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="container">
        <div class="card">
            <img src="your_image1.jpg" alt="Rasm 1">
            <div class="card-content">
                <h2>Write title Here</h2>
                <p>You can Add Description Here...</p>
                <a href="#" class="read-more">Read More</a>
            </div>
        </div>
        <div class="card">
            <img src="your_image2.jpg" alt="Rasm 2">
            <div class="card-content">
                <h2>Write title Here</h2>
                <p>You can Add Description Here...</p>
                <a href="#" class="read-more">Read More</a>
            </div>
        </div>
        <div class="card">
            <img src="your_image3.jpg" alt="Rasm 3">
            <div class="card-content">
                <h2>Write title Here</h2>
                <p>You can Add Description Here...</p>
                <a href="#" class="read-more">Read More</a>
            </div>
        </div>
        <div class="card">
            <img src="your_image4.jpg" alt="Rasm 4">
            <div class="card-content">
                <h2>Write title Here</h2>
                <p>You can Add Description Here...</p>
                <a href="#" class="read-more">Read More</a>
            </div>
        </div>
    </div>

</body>
</html>
```

```css
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}

.container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    padding: 20px;
}

.card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 10px;
    width: 250px;
    overflow: hidden;
}

.card img {
    width: 100%;
    height: auto;
    display: block;
}

.card-content {
    padding: 20px;
}

.card-content h2 {
    margin-top: 0;
    font-size: 1.2em;
}

.card-content p {
    color: #555;
    font-size: 0.9em;
}

.read-more {
    display: inline-block;
    background-color: #e0e0e0;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    color: #333;
    margin-top: 10px;
}
```

---

### 5.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Tartib</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="container">
        <div class="item item1">1</div>
        <div class="item item2">2</div>
        <div class="item item3">3</div>
        <div class="item item4">4</div>
        <div class="item item8">8</div>
        <div class="item item7">7</div>
        <div class="item item5">5</div>
        <div class="item item9">9</div>
        <div class="item item10">10</div>
        <div class="item item6">6</div>
    </div>

</body>
</html>
```

```css
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to right, #e0f2f7, #fce4ec); /* Gradient fon */
}

.container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: repeat(4, 1fr);
    gap: 10px;
    width: 80%;
    margin: 20px auto;
}

.item {
    background-color: white;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.5em;
    font-weight: bold;
    color: #333;
}

.item1 {
    grid-column: 1 / 3;
    grid-row: 1 / 2;
}

.item2 {
    grid-column: 3 / 4;
    grid-row: 1 / 3;
}

.item3 {
    grid-column: 4 / 5;
    grid-row: 1 / 2;
}

.item4 {
    grid-column: 1 / 2;
    grid-row: 2 / 3;
}

.item8 {
    grid-column: 2 / 3;
    grid-row: 2 / 3;
}

.item7 {
    grid-column: 4 / 5;
    grid-row: 2 / 3;
}

.item5 {
    grid-column: 1 / 3;
    grid-row: 3 / 4;
}

.item9 {
    grid-column: 3 / 4;
    grid-row: 3 / 4;
}

.item10 {
    grid-column: 4 / 5;
    grid-row: 3 / 5;
}

.item6 {
    grid-column: 1 / 4;
    grid-row: 4 / 5;
}
```