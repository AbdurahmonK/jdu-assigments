### 1.
```html
<!DOCTYPE html>
<html>
<head>
<title>Tartiblangan Jadval</title>
</head>
<body>

<h1>Tartiblangan jadval sarlavhasi h1da yozilgan</h1>

<h3>./ul> va ./ol> teglari bilan ishlash (h3)</h3>

<ol>
  <li>
    <strong>I. Teatr</strong>
    <ol start="20">
      <li>kino</li>
      <li>film</li>
      <li>serial</li>
      <li>video</li>
      <li>klip</li>
    </ol>
  </li>
  <li>
    <strong>II. Maktab</strong>
    <ol type="a">
      <li>kitob</li>
      <li>dars</li>
      <li>o'quvchi</li>
      <li>sinf</li>
    </ol>
  </li>
  <li>
    <strong>III. Kutubxona</strong>
    <ol start="13">
      <li>kutubxonachi</li>
      <li>
        o'quvchilar
        <ul>
          <li>boshlang'ich sinf</li>
          <li>yuqori sinf</li>
          <li>bitiruvchilar</li>
        </ul>
      </li>
      <li>
        kitoblar
        <ul>
          <li>badiiy kitoblar</li>
          <li>ilmiy kitoblar</li>
        </ul>
      </li>
    </ol>
  </li>
</ol>

<h3>./dh> bilan ishlash (h3)</h3>

<dl>
  <dt>O'zbekiston</dt>
  <dd>Toshkent</dd>
  <dd>Buxoro</dd>
  <dd>Samarqand</dd>
  <dd>Qashqadaryo</dd>
</dl>

</body>
</html>
```

---

### 2.
```html
<!DOCTYPE html>
<html>
<head>
<title>Ro'yxatlar</title>
</head>
<body>

<p>Hello User!....</p>
<p>The following list uses the Square mark in front of list items.</p>

<ul>
  <li>Cars:
    <ul>
      <li>BMW
        <ul>
          <li>BMW X5</li>
          <li>BMW X7</li>
          <li>BMW Z4</li>
          <li>BMW M2</li>
        </ul>
      </li>
      <li>Audi
        <ul>
          <li>Audi Q8</li>
          <li>Audi Q7 2020</li>
          <li>Audi Q3</li>
          <li>Audi A7</li>
        </ul>
      </li>
      <li>Mercedes</li>
      <li>Jaguar
        <ul>
          <li>Jaguar XF</li>
          <li>Jaguar XE</li>
          <li>Jaguar E Pace</li>
          <li>Jaguar I Pace</li>
        </ul>
      </li>
      <li>Lamborghini</li>
    </ul>
  </li>
  <li>bikes:
    <ul>
      <li>Apache</li>
      <li>KTM</li>
      <li>R15</li>
      <li>Ducati</li>
      <li>Harley - Davidson</li>
    </ul>
  </li>
  <li>Aeroplanes
    <ul>
      <li>Air India</li>
      <li>Indigo</li>
      <li>Vistara</li>
      <li>GoAir</li>
      <li>SpiceJet</li>
    </ul>
  </li>
  <li>Trains</li>
  <li>Ships</li>
</ul>

</body>
</html>
```

---

### 3.
```html
<!DOCTYPE html>
<html>
<head>
<title>Ichma-ich Tartiblangan Ro'yxatlar</title>
</head>
<body>

<h1>Nested Ordered Lists</h1>

<ol>
  <li>Headidinhs</li>
  <li>Basic Text sections</li>
  <li>Lists
    <ol type="A">
      <li>Ordered
        <ol>
          <li>The OL tag
            <ol type="a">
              <li>TYPE</li>
              <li>START</li>
              <li>COMPACT</li>
            </ol>
          </li>
          <li>The LI tag</li>
        </ol>
      </li>
      <li>Unordered
        <ol>
          <li>The UL tag</li>
          <li>The LI tag</li>
        </ol>
      </li>
      <li>Definition
        <ol>
          <li>The DL tag</li>
          <li>The DT tag</li>
          <li>The DD tag</li>
        </ol>
      </li>
    </ol>
  </li>
  <li>Miscellaneous</li>
</ol>

</body>
</html>
```

---

### 4.
```html
<!DOCTYPE html>
<html>
<head>
<title>Futbol Ro'yxati</title>
</head>
<body>

<ul>
  <li>Futbol jamolari
    <ul>
      <li><a href="https://www.fcbarcelona.com/">Barcelona</a></li>
      <li><a href="https://www.realmadrid.com/">Real Madrid</a></li>
      <li><a href="https://en.psg.fr/">Psj</a></li>
    </ul>
  </li>
  <li>Futbolchilar
    <ul>
      <li><a href="https://en.wikipedia.org/wiki/Lionel_Messi">Leonel Messi</a></li>
      <li><a href="https://en.wikipedia.org/wiki/Cristiano_Ronaldo">Cristiano Ranaldo</a></li>
      <li><a href="https://en.wikipedia.org/wiki/Kylian_Mbapp%C3%A9">Killian Mbappe</a></li>
      <li><a href="https://en.wikipedia.org/wiki/Neymar">Neymar Junior</a></li>
    </ul>
  </li>
</ul>

</body>
</html>
```

---

### 5.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Test</title>
</head>
<body>

    <h2>Quiz Test 🤓</h2>

    <p>Malumotlaringizni kiriting: 🤩</p>

    <form>
        <label for="firstName">First Name:</label><br>
        <input type="text" id="firstName" name="firstName" value=""><br><br>

        <label for="lastName">Last Name:</label><br>
        <input type="text" id="lastName" name="lastName" value=""><br><br>

        <label for="age">Age:</label><br>
        <input type="number" id="age" name="age" value=""><br><br>

        <button type="submit">Start</button>
    </form>

    <hr>

    <h3>Questions 🧐</h3>

    <ol>
        <li>
            <p>Rasmda futbolchi kim?</p>
            <img src="your_image_url_here.jpg" alt="Futbolchi rasmi" width="200"><br>
            <input type="radio" id="cristiano" name="footballer" value="cristiano">
            <label for="cristiano">Cristiano Ranaldo</label><br>
            <input type="radio" id="leonel" name="footballer" value="leonel">
            <label for="leonel">Leonel Messi</label>
        </li>
        <li>
            <p>Alisher Navoiy qachan tug'ilgan?</p>
            <input type="date" id="birthday" name="birthday">
        </li>
        <li>
            <p>HTML da tag chiziq qaysi teglar yordamida qoyiladi</p>
            <select name="tag_chiziq">
                <option value="ins">ins</option>
                <option value="del">del</option>
                <option value="s">s</option>
                <option value="u">u</option>
            </select>
        </li>
    </ol>

    <hr>

    <h3>Comment</h3>
    <textarea rows="4" cols="50" placeholder="Savollar haqida fikr bildiring..."></textarea><br><br>

    <button type="submit">Finish</button>

</body>
</html>
```