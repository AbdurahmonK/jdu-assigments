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