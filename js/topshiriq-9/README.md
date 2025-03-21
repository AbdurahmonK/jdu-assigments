### 1.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Grid Tartibi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="container">
        <div class="item item1">1</div>
        <div class="item item2">2</div>
        <div class="item item3">3</div>
        <div class="item item4">4</div>
        <div class="item item5">5</div>
        <div class="item item6">6</div>
        <div class="item item7">7</div>
        <div class="item item8">8</div>
        <div class="item item9">9</div>
        <div class="item item10">10</div>
        <div class="item item11">11</div>
        <div class="item item12">12</div>
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
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: repeat(4, 1fr);
    gap: 10px;
    width: 80%;
    margin: 20px auto;
}

.item {
    background-color: #ddd;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.5em;
    font-weight: bold;
    color: #333;
}

.item1 {
    grid-column: 1 / 2;
    grid-row: 1 / 2;
    background-color: #e57373;
}

.item2 {
    grid-column: 2 / 3;
    grid-row: 1 / 3;
    background-color: #ba68c8;
}

.item3 {
    grid-column: 3 / 5;
    grid-row: 1 / 2;
    background-color: #ffb74d;
}

.item4 {
    grid-column: 1 / 2;
    grid-row: 2 / 3;
    background-color: #81c784;
}

.item5 {
    grid-column: 1 / 2;
    grid-row: 3 / 4;
    background-color: #aed581;
}

.item6 {
    grid-column: 3 / 4;
    grid-row: 2 / 4;
    background-color: #64b5f6;
}

.item7 {
    grid-column: 1 / 2;
    grid-row: 4 / 5;
    background-color: #9ccc65;
}

.item8 {
    grid-column: 2 / 3;
    grid-row: 3 / 4;
    background-color: #4db6ac;
}

.item9 {
    grid-column: 2 / 3;
    grid-row: 4 / 5;
    background-color: #4dd0e1;
}

.item10 {
    grid-column: 4 / 5;
    grid-row: 3 / 4;
    background-color: #80cbc4;
}

.item11 {
    grid-column: 3 / 4;
    grid-row: 4 / 5;
    background-color: #7986cb;
}

.item12 {
    grid-column: 4 / 5;
    grid-row: 4 / 5;
    background-color: #ef5350;
}
```

---

### 2.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Grid Tartibi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="container">
        <div class="item item1"></div>
        <div class="item item2"></div>
        <div class="item item3"></div>
        <div class="item item4"></div>
        <div class="item item5"></div>
        <div class="item item6"></div>
        <div class="item item7"></div>
    </div>

</body>
</html>
```

```css
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    background-color: #282c34; /* Qora fon */
}

.container {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 2fr;
    grid-template-rows: 2fr 1fr 2fr;
    gap: 10px;
    width: 80%;
    margin: 20px auto;
}

.item {
    border-radius: 8px;
}

.item1 {
    grid-column: 1 / 2;
    grid-row: 1 / 4;
    background-color: #8bc34a; /* Yashil */
}

.item2 {
    grid-column: 2 / 3;
    grid-row: 1 / 2;
    background-color: #ff5722; /* Qizil */
}

.item3 {
    grid-column: 3 / 5;
    grid-row: 1 / 2;
    background-color: #ff5722; /* Qizil */
}

.item4 {
    grid-column: 2 / 3;
    grid-row: 2 / 3;
    background-color: #ff9800; /* Apelsin */
}

.item5 {
    grid-column: 3 / 4;
    grid-row: 2 / 3;
    background-color: #ff5722; /* Qizil */
}

.item6 {
    grid-column: 4 / 5;
    grid-row: 2 / 4;
    background-color: #8bc34a; /* Yashil */
}

.item7 {
    grid-column: 2 / 4;
    grid-row: 3 / 4;
    background-color: #ff9800; /* Apelsin */
}
```

---

### 3.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Grid Tartibi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="container">
        <div class="item item1"></div>
        <div class="item item2"></div>
        <div class="item item3"></div>
        <div class="item item4"></div>
        <div class="item item5"></div>
        <div class="item item6"></div>
        <div class="item item7"></div>
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
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: repeat(3, 1fr);
    gap: 10px;
    width: 80%;
    margin: 20px auto;
}

.item {
    border-radius: 8px;
}

.item1 {
    grid-column: 1 / 5;
    grid-row: 1 / 2;
    background-color: #f8bbd0; /* Pushti */
}

.item2 {
    grid-column: 1 / 2;
    grid-row: 2 / 3;
    background-color: #e91e63; /* To'q pushti */
}

.item3 {
    grid-column: 2 / 3;
    grid-row: 2 / 3;
    background-color: #e91e63; /* To'q pushti */
}

.item4 {
    grid-column: 3 / 5;
    grid-row: 2 / 3;
    background-color: #e91e63; /* To'q pushti */
}

.item5 {
    grid-column: 1 / 3;
    grid-row: 3 / 4;
    background-color: #81d4fa; /* Moviy */
}

.item6 {
    grid-column: 3 / 5;
    grid-row: 3 / 4;
    background-color: #81d4fa; /* Moviy */
}

.item7 {
    grid-column: 1 / 4;
    grid-row: 4 / 5;
    background-color: #aed581; /* Yashil */
}

.item8 {
    grid-column: 4 / 5;
    grid-row: 4 / 5;
    background-color: #ff9800; /* Apelsin */
}
```

---

### 4.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Grid Tartibi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="container">
        <div class="item item1"></div>
        <div class="item item2"></div>
        <div class="item item3"></div>
        <div class="item item4"></div>
        <div class="item item5"></div>
        <div class="item item6"></div>
        <div class="item item7"></div>
        <div class="item item8"></div>
        <div class="item item9"></div>
    </div>

</body>
</html>
```

```css
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    background-color: #282c34; /* Qora fon */
}

.container {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    grid-template-rows: 1fr 1fr 1fr 1fr;
    gap: 10px;
    width: 80%;
    margin: 20px auto;
}

.item {
    border-radius: 8px;
}

.item1 {
    grid-column: 1 / 4;
    grid-row: 1 / 2;
    background-color: #4caf50; /* Yashil */
}

.item2 {
    grid-column: 1 / 2;
    grid-row: 2 / 3;
    background-color: #ffeb3b; /* Sariq */
}

.item3 {
    grid-column: 2 / 3;
    grid-row: 2 / 4;
    background-color: #9c27b0; /* Binafsha */
}

.item4 {
    grid-column: 3 / 4;
    grid-row: 2 / 3;
    background-color: #03a9f4; /* Moviy */
}

.item5 {
    grid-column: 4 / 5;
    grid-row: 2 / 3;
    background-color: #607d8b; /* Kulrang */
}

.item6 {
    grid-column: 4 / 5;
    grid-row: 3 / 4;
    background-color: #3f51b5; /* To'q moviy */
}

.item7 {
    grid-column: 4 / 5;
    grid-row: 4 / 5;
    background-color: #ff9800; /* Apelsin */
}

.item8 {
    grid-column: 3 / 4;
    grid-row: 4 / 5;
    background-color: #9e9e9e; /* Och kulrang */
}

.item9 {
    grid-column: 4 / 5;
    grid-row: 4 / 5;
    background-color: #f44336; /* Qizil */
}
```

---

### 5.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Grid Tartibi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="container">
        <div class="item item1">13</div>
        <div class="item item2">9</div>
        <div class="item item3">18</div>
        <div class="item item4">1</div>
        <div class="item item5">20</div>
        <div class="item item6">15</div>
        <div class="item item7">22</div>
        <div class="item item8">5</div>
        <div class="item item9">6</div>
        <div class="item item10">8</div>
        <div class="item item11">11</div>
        <div class="item item12">3</div>
        <div class="item item13">7</div>
        <div class="item item14">16</div>
        <div class="item item15">19</div>
        <div class="item item16">14</div>
        <div class="item item17">21</div>
        <div class="item item18">24</div>
        <div class="item item19">17</div>
        <div class="item item20">2</div>
        <div class="item item21">4</div>
        <div class="item item22">23</div>
        <div class="item item23">10</div>
        <div class="item item24">12</div>
    </div>

</body>
</html>
```

```css
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0; /* Och kulrang fon */
}

.container {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
    grid-template-rows: 1fr 1fr 1fr 1fr 1fr;
    gap: 5px;
    width: 80%;
    margin: 20px auto;
}

.item {
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.5em;
    font-weight: bold;
    color: #333;
    border: 1px dotted #ccc; /* Nuqtali chegara */
}

.item1 {
    grid-column: 1 / 3;
    grid-row: 1 / 2;
    background-color: #c8e6c9; /* Och yashil */
}

.item2 {
    grid-column: 3 / 4;
    grid-row: 1 / 2;
    background-color: #ffcdd2; /* Och qizil */
}

.item3 {
    grid-column: 4 / 5;
    grid-row: 1 / 2;
    background-color: #fff9c4; /* Och sariq */
}

.item4 {
    grid-column: 5 / 6;
    grid-row: 1 / 2;
    background-color: #bbdefb; /* Och moviy */
}

.item5 {
    grid-column: 6 / 7;
    grid-row: 1 / 2;
    background-color: #fff9c4; /* Och sariq */
}

.item6 {
    grid-column: 1 / 2;
    grid-row: 2 / 3;
    background-color: #fff9c4; /* Och sariq */
}

.item7 {
    grid-column: 2 / 4;
    grid-row: 2 / 3;
    background-color: #ffcdd2; /* Och qizil */
}

.item8 {
    grid-column: 4 / 6;
    grid-row: 2 / 3;
    background-color: #fff9c4; /* Och sariq */
}

.item9 {
    grid-column: 6 / 7;
    grid-row: 2 / 3;
    background-color: #bbdefb; /* Och moviy */
}

.item10 {
    grid-column: 1 / 2;
    grid-row: 3 / 4;
    background-color: #fff9c4; /* Och sariq */
}

.item11 {
    grid-column: 2 / 3;
    grid-row: 3 / 4;
    background-color: #bbdefb; /* Och moviy */
}

.item12 {
    grid-column: 3 / 4;
    grid-row: 3 / 4;
    background-color: #ffcdd2; /* Och qizil */
}

.item13 {
    grid-column: 4 / 5;
    grid-row: 3 / 4;
    background-color: #fff9c4; /* Och sariq */
}

.item14 {
    grid-column: 5 / 6;
    grid-row: 3 / 4;
    background-color: #ffcdd2; /* Och qizil */
}

.item15 {
    grid-column: 6 / 7;
    grid-row: 3 / 4;
    background-color: #c8e6c9; /* Och yashil */
}

.item16 {
    grid-column: 1 / 2;
    grid-row: 4 / 5;
    background-color: #bbdefb; /* Och moviy */
}

.item17 {
    grid-column: 2 / 3;
    grid-row: 4 / 5;
    background-color: #fff9c4; /* Och sariq */
}

.item18 {
    grid-column: 3 / 4;
    grid-row: 4 / 5;
    background-color: #c8e6c9; /* Och yashil */
}

.item19 {
    grid-column: 4 / 5;
    grid-row: 4 / 5;
    background-color: #ffcdd2; /* Och qizil */
}

.item20 {
    grid-column: 5 / 6;
    grid-row: 4 / 5;
    background-color: #bbdefb; /* Och moviy */
}

.item21 {
    grid-column: 6 / 7;
    grid-row: 4 / 5;
    background-color: #fff9c4; /* Och sariq */
}

.item22 {
    grid-column: 4 / 5;
    grid-row: 5 / 6;
    background-color: #fff9c4; /* Och sariq */
}

.item23 {
    grid-column: 6 / 7;
    grid-row: 5 / 6;
    background-color: #fff9c4; /* Och sariq */
}

.item24 {
    grid-column: 3 / 4;
    grid-row: 5 / 6;
    background-color: #c8e6c9; /* Och yashil */
}
```