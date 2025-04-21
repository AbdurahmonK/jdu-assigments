const songs = [
    {
        title: 'Lovely',
        artist: 'Billie Eilish, Khalid',
        file: 'https://s3.eu-central-1.wasabisys.com/audio.com.audio/transcoding/85/46/1825945395734685-1825945395781623-1825945405003462.mp3?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=W7IA3NSYSOQIKLY9DEVC%2F20250420%2Feu-central-1%2Fs3%2Faws4_request&X-Amz-Date=20250420T105813Z&X-Amz-SignedHeaders=host&X-Amz-Expires=518400&X-Amz-Signature=d293f82addfcdb9ccd51ce631024d824d8b15b9270593c8f5092e220112f80c4'
    },
    {
        title: 'Жди меня там',
        artist: 'Sevak',
        file: 'https://cdn8.sefon.pro/prev/kzTm8tvWikQxrti8uiNrfw/1745300630/177/%D0%A1%D0%B5%D0%B2%D0%B0%D0%BA%20%D0%A5%D0%B0%D0%BD%D0%B0%D0%B3%D1%8F%D0%BD%20-%20%D0%96%D0%B4%D0%B8%20%D0%9C%D0%B5%D0%BD%D1%8F%20%D0%A2%D0%B0%D0%BC%20%28192kbps%29.mp3'
    },
    {
        title: 'Runaway',
        artist: 'AURORA',
        file: 'https://cdn3.sefon.pro/prev/hka7Dijyy46ZQyJEkBrKWg/1745300684/235/Aurora%20-%20Runaway%20%28192kbps%29.mp3'
    },
    {
        title: 'Наверно ты меня не помнишь',
        artist: 'Jony, HammAli',
        file: 'https://cdn9.sefon.pro/prev/g79lSfJ3uARRRvG3qGiZLA/1745300691/304/JONY%20%26%20HammAli%20-%20%D0%9D%D0%B0%D0%B2%D0%B5%D1%80%D0%BD%D0%BE%2C%20%D0%A2%D1%8B%20%D0%9C%D0%B5%D0%BD%D1%8F%20%D0%9D%D0%B5%20%D0%9F%D0%BE%D0%BC%D0%BD%D0%B8%D1%88%D1%8C%20%28192kbps%29.mp3'
    }
];

const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

const day = document.querySelector('.day');
const time = document.querySelector('.time');
const audio = document.getElementById('audio');
const playBtn = document.getElementById('play');
const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');
const playlist = document.getElementById('playlist');
const quoteDisplay = document.querySelector('.quote');
const nameInput = document.getElementById('name-input');
const weatherInfo = document.getElementById('weather-info');
const weatherInput = document.getElementById('weather-input');
const greetingText = document.querySelector('.greeting-text');
const updateQuoteBtn = document.getElementById('update_quote');
const nextWallperBtn = document.querySelector('.next-wallper');
const prevWallperBtn = document.querySelector('.prev-wallper');

// API kalitingizni kiriting
const unsplashApiKey = 'JmVah2dgHRt_txvo83bmij2UCddppqwcSuz5fKCuohA';
const weatherApiKey = '4009a51d1fbb4f47ad0175035252104';

let currentSongIndex = 0;

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

function fetchWeather(city) {
    fetch(`https://api.weatherapi.com/v1/current.json?key=${weatherApiKey}&q=${city}`)
        .then(response => response.json())
        .then(data => {
            const { temp_c, condition: { text }, humidity, wind_kph } = data.current;
            weatherInfo.innerHTML = `<p>${temp_c}°C, ${text}<br/>
            Wind: ${wind_kph}km/h<br/>
            Humidity: ${humidity}%</p>`;
        })
        .catch(error => {
            console.error('Ob-havo ma\'lumotlarini olishda xatolik:', error);
            weatherInfo.textContent = 'Ob-havo ma\'lumotlari mavjud emas.';
        });
}

songs.map(song => {
    const li = document.createElement('li');
    li.textContent = `${song.artist} - ${song.title}`;
    li.addEventListener('click', () => {
        loadSong(song);
        playSong();
    });
    playlist.appendChild(li);
});

function setBackground() {
    const now = new Date();
    const hour = now.getHours();
    let query;

    if (hour >= 6 && hour < 12) {
        query = 'morning landscape';
    } else if (hour >= 12 && hour < 18) {
        query = 'afternoon landscape';
    } else {
        query = 'night landscape';
    }

    fetch(`https://api.unsplash.com/photos/random?client_id=${unsplashApiKey}&query=${query}`)
        .then(response => response.json())
        .then(data => {
            document.body.style.backgroundImage = `url(${data.urls.regular})`;
        })
        .catch(error => {
            console.error('Fon rasmini olishda xatolik:', error);
        });
}

function fetchQuote() {
    fetch('https://recite-production.up.railway.app/api/v1/random')
        .then(response => response.json())
        .then(data => {
            quoteDisplay.textContent = `"${data.quote}" - ${data.author}. (${data.book})`;
        })
        .catch(error => {
            console.error('Iqtibosni olishda xatolik:', error);
            quoteDisplay.textContent = 'Iqtibos mavjud emas.';
        });
}

function updateTime() {
    const now = new Date();
    let hours = now.getHours();
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
  
    const dayName = days[now.getDay()];
    const monthName = months[now.getMonth()];
    const dayOfMonth = now.getDate();
  
    time.textContent = `${hours}:${minutes}:${seconds}`
    day.textContent = `${dayName}, ${monthName} ${dayOfMonth}`
}

function updateGreeting() {
    const now = new Date();
    const hour = now.getHours();

    if (hour >= 6 && hour < 12) {
        greetingText.textContent = "Good Morning, ";
    } else if (hour >= 12 && hour < 18) {
        greetingText.textContent = "Good Afternoon, ";
    } else {
        greetingText.textContent = "Good Evening, ";
    }
}

updateGreeting();
setInterval(updateGreeting, 60 * 60 * 1000);

const savedName = localStorage.getItem('name');
if (savedName) {
    nameInput.value = savedName;
}

const cityName = localStorage.getItem('city');
if (cityName) {
    weatherInput.value = cityName;
    fetchWeather(cityName);
}

setBackground();
fetchQuote();
updateTime();

setInterval(updateTime, 1000);

loadSong(songs[currentSongIndex]);

prevBtn.addEventListener('click', prevSong);
nextBtn.addEventListener('click', nextSong);
playBtn.addEventListener('click', () => {
    if (audio.paused) {
        playSong();
    } else {
        pauseSong();
    }
});
audio.addEventListener('ended', nextSong);
nextWallperBtn.addEventListener('click', setBackground);
prevWallperBtn.addEventListener('click', setBackground);
updateQuoteBtn.addEventListener('click', fetchQuote);
nameInput.addEventListener('change', (event) => {
    localStorage.setItem('name', event.target.value);
});

weatherInput.addEventListener('change', (event) => {
    if(event.target.value.length > 3) {
        fetchWeather(event.target.value);
    }
    localStorage.setItem('city', event.target.value);
});