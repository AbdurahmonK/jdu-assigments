```html
<!DOCTYPE html>
<html>
<head>
    <title>Momentum Clone</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="container">
        <div class="time" id="time"></div>
        <div class="greeting" id="greeting"></div>
        <input type="text" id="name" placeholder="Ismingizni kiriting...">
        <div class="weather" id="weather"></div>
        <div class="player">
            <audio id="audio"></audio>
            <div class="controls">
                <button id="prev"><i class="fa fa-backward"></i></button>
                <button id="play"><i class="fa fa-play"></i></button>
                <button id="next"><i class="fa fa-forward"></i></button>
            </div>
            <ul id="playlist"></ul>
        </div>
        <div class="quote" id="quote"></div>
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
    background-size: cover;
    background-position: center;
    color: white;
    text-align: center;
    height: 100vh;
}

.container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.time {
    font-size: 5em;
    margin-bottom: 20px;
}

.greeting {
    font-size: 2em;
    margin-bottom: 10px;
}

input {
    background-color: transparent;
    border: none;
    border-bottom: 2px solid white;
    color: white;
    font-size: 1.5em;
    padding: 5px;
    text-align: center;
    margin-bottom: 20px;
}

.weather {
    font-size: 1.2em;
    margin-bottom: 20px;
}

.player {
    margin-bottom: 20px;
}

.controls button {
    background-color: transparent;
    border: none;
    color: white;
    font-size: 1.5em;
    margin: 0 10px;
    cursor: pointer;
}

.playlist {
    list-style: none;
    padding: 0;
    margin-top: 10px;
}

.playlist li {
    padding: 5px 10px;
    cursor: pointer;
}

.quote {
    font-size: 1.1em;
    font-style: italic;
}
```

```javascript
const timeDisplay = document.getElementById('time');
const greetingDisplay = document.getElementById('greeting');
const nameInput = document.getElementById('name');
const weatherDisplay = document.getElementById('weather');
const audio = document.getElementById('audio');
const playBtn = document.getElementById('play');
const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');
const playlist = document.getElementById('playlist');
const quoteDisplay = document.getElementById('quote');

const songs = [
    {
        title: 'Lovely',
        artist: 'Billie Eilish, Khalid',
        file: 'lovely.mp3'
    },
    {
        title: 'Жди меня там',
        artist: 'Sevak',
        file: 'sevak.mp3'
    },
    {
        title: 'Runaway',
        artist: 'AURORA',
        file: 'runaway.mp3'
    },
    {
        title: 'Наверно ты меня не помнишь',
        artist: 'Jony, HammAli',
        file: 'jony.mp3'
    }
];

let currentSongIndex = 0;

function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString();
    timeDisplay.textContent = timeString;

    const hour = now.getHours();
    if (hour < 12) {
        greetingDisplay.textContent = 'Xayrli tong!';
    } else if (hour < 18) {
        greetingDisplay.textContent = 'Xayrli kun!';
    } else {
        greetingDisplay.textContent = 'Xayrli kech!';
    }
}

function loadSong(song) {
    audio.src = song.file;
}

function playSong() {
    audio.play();
    playBtn.innerHTML = '<i class="fa fa-pause"></i>';
}

function pauseSong() {
    audio.pause();
    playBtn.innerHTML = '<i class="fa fa-play"></i>';
}

function prevSong() {
    currentSongIndex--;
    if (currentSongIndex < 0) {
        currentSongIndex = songs.length - 1;
    }
    loadSong(songs[currentSongIndex]);
    playSong();
}

function nextSong() {
    currentSongIndex++;
    if (currentSongIndex > songs.length - 1) {
        currentSongIndex = 0;
    }
    loadSong(songs[currentSongIndex]);
    playSong();
}

function fetchWeather() {
    // API kalitingizni kiriting
    const apiKey = 'YOUR_WEATHER_API_KEY';
    const city = 'Tashkent'; // Shahar nomini o'zgartiring

    fetch(`https://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${city}`)
        .then(response => response.json())
        .then(data => {
            const { temp_c, condition: { text } } = data.current;
            weatherDisplay.textContent = `${city}: ${temp_c}°C, ${text}`;
        })
        .catch(error => {
            console.error('Ob-havo ma\'lumotlarini olishda xatolik:', error);
            weatherDisplay.textContent = 'Ob-havo ma\'lumotlari mavjud emas.';
        });
}

function fetchQuote() {
    fetch('https://api.quotable.io/random')
        .then(response => response.json())
        .then(data => {
            quoteDisplay.textContent = `"${data.content}" - ${data.author}`;
        })
        .catch(error => {
            console.error('Iqtibosni olishda xatolik:', error);
            quoteDisplay.textContent = 'Iqtibos mavjud emas.';
        });
}

function setBackground() {
    // API kalitingizni kiriting
    const apiKey = 'YOUR_UNSPLASH_API_KEY';

    fetch(`https://api.unsplash.com/photos/random?client_id=${apiKey}&query=nature`)
        .then(response => response.json())
        .then(data => {
            document.body.style.backgroundImage = `url(${data.urls.regular})`;
        })
        .catch(error => {
            console.error('Fon rasmini olishda xatolik:', error);
        });
}

loadSong(songs[currentSongIndex]);
updateTime();
fetchWeather();
fetchQuote();
setBackground();

setInterval(updateTime, 1000);

playBtn.addEventListener('click', () => {
    if (audio.paused) {
        playSong();
    } else {
        pauseSong();
    }
});

prevBtn.addEventListener('click', prevSong);
nextBtn.addEventListener('click', nextSong);

nameInput.addEventListener('change', (event) => {
    localStorage.setItem('name', event.target.value);
});

const savedName = localStorage.getItem('name');
if (savedName) {
    nameInput.value = savedName;
}

songs.map(song => {
    const li = document.createElement('li');
    li.textContent = song.title;
    li.addEventListener('click', () => {
        loadSong(song);
        playSong();
    });
    playlist.appendChild(li);
});
```