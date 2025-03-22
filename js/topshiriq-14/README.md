```html
<!DOCTYPE html>
<html>
<head>
    <title>Creative Music Player</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="player">
        <div class="header">
            <div class="time" id="time"></div>
            <div class="user">
                <div class="avatar"></div>
                <div class="username">#mister_sher10<br>Shermuhammad</div>
            </div>
        </div>
        <div class="content">
            <div class="song-info">
                <div class="song-cover"></div>
                <div class="song-details">
                    <div class="song-title" id="song-title"></div>
                    <div class="song-album" id="song-album"></div>
                    <div class="song-lyrics" id="song-lyrics"></div>
                </div>
            </div>
            <div class="playlist">
                <ul id="playlist"></ul>
            </div>
        </div>
        <div class="controls">
            <audio id="audio"></audio>
            <div class="progress-container">
                <div class="progress" id="progress"></div>
            </div>
            <div class="buttons">
                <button id="prev"><i class="fa fa-backward"></i></button>
                <button id="play"><i class="fa fa-play"></i></button>
                <button id="next"><i class="fa fa-forward"></i></button>
            </div>
        </div>
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
    background-color: #282828;
    color: white;
}

.player {
    width: 80%;
    margin: 20px auto;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
}

.time {
    font-size: 1.2em;
}

.user {
    display: flex;
    align-items: center;
}

.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #f0f0f0;
    margin-right: 10px;
}

.content {
    display: flex;
    justify-content: space-between;
}

.song-info {
    width: 60%;
}

.song-cover {
    width: 100%;
    height: 300px;
    background-color: #f0f0f0;
}

.song-details {
    padding: 20px;
}

.playlist {
    width: 35%;
    overflow-y: auto;
}

.playlist ul {
    list-style: none;
    padding: 0;
}

.playlist li {
    padding: 10px;
    cursor: pointer;
}

.controls {
    margin-top: 20px;
    text-align: center;
}

.progress-container {
    width: 100%;
    height: 5px;
    background-color: #f0f0f0;
    margin-bottom: 10px;
}

.progress {
    width: 0%;
    height: 100%;
    background-color: #007bff;
}

.buttons button {
    background-color: transparent;
    border: none;
    color: white;
    font-size: 1.5em;
    margin: 0 10px;
    cursor: pointer;
}
```

```javascript
const timeDisplay = document.getElementById('time');
const songTitleDisplay = document.getElementById('song-title');
const songAlbumDisplay = document.getElementById('song-album');
const songLyricsDisplay = document.getElementById('song-lyrics');
const audio = document.getElementById('audio');
const progress = document.getElementById('progress');
const playBtn = document.getElementById('play');
const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');
const playlist = document.getElementById('playlist');

const songs = [
    {
        title: 'Ты и Я',
        artist: 'Xcho',
        album: 'none',
        time: '#time',
        image: 'xcho.jpg',
        file: 'xcho.mp3', // Qo'shiq fayli nomi
        lyrics: 'Qo\'shiq matni 1' // Qo'shiq matni
    },
    {
        title: 'Комета',
        artist: 'Jony',
        album: 'Комета',
        time: '#time',
        image: 'jony.jpg',
        file: 'jony.mp3', // Qo'shiq fayli nomi
        lyrics: 'Qo\'shiq matni 2' // Qo'shiq matni
    },
    {
        title: 'Қураған гүл',
        artist: 'Qarakesek',
        album: '2022',
        time: '#time',
        image: 'qarakesek.jpg',
        file: 'qarakesek.mp3', // Qo'shiq fayli nomi
        lyrics: 'Qo\'shiq matni 3' // Qo'shiq matni
    },
    {
        title: 'Пьяное солнце',
        artist: 'Alekseev',
        album: '2016',
        time: '#time',
        image: 'alekseev.jpg',
        file: 'alekseev.mp3', // Qo'shiq fayli nomi
        lyrics: 'Qo\'shiq matni 4' // Qo'shiq matni
    },
    {
        title: 'Davae',
        artist: 'Ad Aka Dilovar',
        album: '2021',
        time: '#time',
        image: 'dilovar.jpg',
        file: 'dilovar.mp3', // Qo'shiq fayli nomi
        lyrics: 'Qo\'shiq matni 5' // Qo'shiq matni
    },
    {
        title: 'Calm Down',
        artist: 'Rema',
        album: '2022',
        time: '#time',
        image: 'rema.jpg',
        file: 'rema.mp3', // Qo'shiq fayli nomi
        lyrics: 'Qo\'shiq matni 6' // Qo'shiq matni
    },
    {
        title: 'Вредина',
        artist: 'Bakr',
        album: '2022',
        time: '#time',
        image: 'bakr.jpg',
        file: 'bakr.mp3', // Qo'shiq fayli nomi
        lyrics: 'Qo\'shiq matni 7' // Qo'shiq matni
    },
    {
        title: 'Доча',
        artist: 'Jah Khalib',
        album: '2022',
        time: '#time',
        image: 'jahkhalib.jpg',
        file: 'jahkhalib.mp3', // Qo'shiq fayli nomi
        lyrics: 'Qo\'shiq matni 8' // Qo'shiq matni
    },
    {
        title: 'Samurai',
        artist: 'Miyagi',
        album: '2020',
        time: '#time',
        image: 'miyagi.jpg',
        file: 'miyagi.mp3', // Qo'shiq fayli nomi
        lyrics: 'Qo\'shiq matni 9' // Qo'shiq matni
    },
    {
        title: 'Hope',
        artist: 'XXXXTENTACION',
        album: '2012',
        time: '#time',
        image: 'xxxtentacion.jpg',
        file: 'xxxtentacion.mp3', // Qo'shiq fayli nomi
        lyrics: 'Qo\'shiq matni 10' // Qo'shiq matni
    }
];

let currentSongIndex = 0;

function loadSong(song) {
    songTitleDisplay.textContent = song.title;
    songAlbumDisplay.textContent = song.album;
    songLyricsDisplay.textContent = song.lyrics;
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

function updateProgress(e) {
    const { duration, currentTime } = e.srcElement;
    const progressPercent = (currentTime / duration) * 100;
    progress.style.width = `${progressPercent}%`;
}

function setProgress(e) {
    const width = this.clientWidth;
    const clickX = e.offsetX;
    const duration = audio.duration;
    audio.currentTime = (clickX / width) * duration;
}

function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString();
    timeDisplay.textContent = timeString;
}

loadSong(songs[currentSongIndex]);

playBtn.addEventListener('click', () => {
    if (audio.paused) {
        playSong();
    } else {
        pauseSong();
    }
});

prevBtn.addEventListener('click', prevSong);
nextBtn.addEventListener('click', nextSong);

audio.addEventListener('timeupdate', updateProgress);
progressContainer.addEventListener('click', setProgress);

setInterval(updateTime, 1000);

songs.map((song, index) => {
    const li = document.createElement('li');
    li.textContent = song.title;
    li.addEventListener('click', () => {
        currentSongIndex = index;
        loadSong(song);
        playSong();
    });
    playlist.appendChild(li);
});
```