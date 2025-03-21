### 1.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Responsive Tartib</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <div class="container">
        <div class="item mobile">Mobile</div>
        <div class="item tablet">Tablet</div>
        <div class="item desktop">Desktop</div>
    </div>

</body>
</html>
```

```css
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.item {
    padding: 20px;
    border: 1px solid #ccc;
    text-align: center;
    margin: 10px;
}

/* Mobil qurilmalar uchun stil */
@media (max-width: 600px) {
    .tablet, .desktop {
        display: none;
    }
    .mobile {
        background-color: #f0f8ff;
    }
}

/* Planshet qurilmalar uchun stil */
@media (min-width: 601px) and (max-width: 1024px) {
    .mobile, .desktop {
        display: none;
    }
    .tablet {
        background-color: #e0f8f0;
    }
}

/* Desktop qurilmalar uchun stil */
@media (min-width: 1025px) {
    .mobile, .tablet {
        display: none;
    }
    .desktop {
        background-color: #f8f8ff;
    }
}
```

---

### 2.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Responsive Tartib</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <div class="container">
        <div class="header"></div>
        <div class="sidebar"></div>
        <div class="content">
            <div class="content-top"></div>
            <div class="content-middle"></div>
            <div class="content-bottom"></div>
        </div>
        <div class="footer"></div>
    </div>

</body>
</html>
```

```css
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    display: grid;
    grid-template-columns: 1fr 3fr;
    grid-template-rows: auto auto auto;
    gap: 10px;
    width: 90%;
    margin: 20px auto;
}

.header {
    grid-column: 1 / 3;
    background-color: #4caf50; /* Yashil */
    padding: 20px;
}

.sidebar {
    grid-column: 1 / 2;
    background-color: #f44336; /* Qizil */
    padding: 20px;
}

.content-top {
    background-color: #ff9800; /* Apelsin */
    padding: 20px;
}

.content-middle {
    background-color: #9c27b0; /* Binafsha */
    padding: 20px;
}

.content-bottom {
    background-color: #3f51b5; /* Ko'k */
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 5px;
    padding: 20px;
}

.footer {
    grid-column: 1 / 3;
    background-color: #4caf50; /* Yashil */
    padding: 20px;
}

/* Mobil qurilmalar uchun stil */
@media (max-width: 600px) {
    .container {
        grid-template-columns: 1fr;
        grid-template-rows: auto auto auto auto;
    }
    .sidebar {
        grid-column: 1 / 2;
        grid-row: 2 / 3;
    }
    .content {
        grid-column: 1 / 2;
        grid-row: 3 / 4;
    }
    .footer {
        grid-column: 1 / 2;
        grid-row: 4 / 5;
    }
    .content-bottom {
        grid-template-columns: 1fr;
    }
}

/* Planshet qurilmalar uchun stil */
@media (min-width: 601px) and (max-width: 1024px) {
    .container {
        grid-template-columns: 1fr 2fr;
    }
    .content-bottom {
        grid-template-columns: repeat(3, 1fr);
    }
}
```

---

### 3.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Responsive Tartib</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <div class="container">
        <div class="header"></div>
        <div class="content">
            <div class="content-top"></div>
            <div class="content-middle"></div>
            <div class="content-bottom"></div>
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
}

.container {
    display: grid;
    gap: 5px;
    width: 90%;
    margin: 20px auto;
}

.header {
    background-color: #ff9800; /* Apelsin */
    padding: 10px;
}

.content-top {
    background-color: #cddc39; /* Lime */
    padding: 10px;
}

.content-middle {
    background-color: #3f51b5; /* Ko'k */
    padding: 10px;
}

.content-bottom {
    display: grid;
    gap: 5px;
    padding: 10px;
}

/* Mobil qurilmalar uchun stil (320px) */
@media (max-width: 320px) {
    .container {
        grid-template-columns: 1fr;
        grid-template-rows: auto auto auto auto;
    }
    .content-bottom {
        grid-template-columns: 1fr;
    }
}

/* Planshet qurilmalar uchun stil (768px) */
@media (min-width: 321px) and (max-width: 768px) {
    .container {
        grid-template-columns: 1fr;
        grid-template-rows: auto auto auto auto;
    }
    .content-bottom {
        grid-template-columns: 1fr;
    }
}

/* Desktop qurilmalar uchun stil (1024px) */
@media (min-width: 769px) {
    .container {
        grid-template-columns: 1fr;
        grid-template-rows: auto auto auto;
    }
    .content-bottom {
        grid-template-columns: repeat(2, 1fr);
    }
}
```