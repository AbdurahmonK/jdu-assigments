### 2.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Kartalar</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="container">
        <div id="cards"></div>
    </div>

    <script src="script.js"></script>
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
    align-items: center;
    height: 100vh;
}

.card {
    width: 200px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 10px;
    padding: 20px;
    text-align: center;
}

.card img {
    width: 60px;
    height: 60px;
    margin-bottom: 10px;
}

.card h3 {
    margin-top: 0;
    font-size: 1.2em;
}
```

```javascript
const cardsDiv = document.getElementById('cards');

const cardData = [
    { title: 'Education', image: 'education.png', color: '#ffeb3b' },
    { title: 'Credentialing', image: 'credentialing.png', color: '#4caf50' },
    { title: 'Wallet', image: 'wallet.png', color: '#9c27b0' },
    { title: 'Human Resources', image: 'human-resources.png', color: '#2196f3' }
];

cardData.forEach(data => {
    const card = document.createElement('div');
    card.classList.add('card');
    card.style.backgroundColor = data.color;

    const image = document.createElement('img');
    image.src = data.image;
    card.appendChild(image);

    const title = document.createElement('h3');
    title.textContent = data.title;
    card.appendChild(title);

    cardsDiv.appendChild(card);
});
```