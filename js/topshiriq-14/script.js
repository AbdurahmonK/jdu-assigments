const songs = [
    {
        title: 'Ты и Я',
        artist: 'Xcho',
        album: 'none',
        time: '#time',
        image: 'images/xcho.png',
        file: 'https://cdn4.drivemusic.club/dl/online/3YboDZH4Om4z90p4Ns_CNA/1745258551/download_music/2022/03/xcho-ty-i-ja.mp3',
        lyrics: 'Music 1'
    },
    {
        title: 'Комета',
        artist: 'Jony',
        album: 'Комета',
        time: '#time',
        image: 'images/jony.jpeg',
        file: 'https://cdn7.sefon.pro/prev/NolTXb2fP8RGc-i2DNi8Yw/1745257451/141/Jony%20-%20%D0%9A%D0%BE%D0%BC%D0%B5%D1%82%D0%B0%20%28192kbps%29.mp3',
        lyrics: 'Music 2'
    },
    {
        title: 'Қураған гүл',
        artist: 'Qarakesek',
        album: '2022',
        time: '#time',
        image: 'images/qarakesek.jpeg',
        file: 'https://cdn7.sefon.pro/prev/-G3jWr0oI5l4I7tjij4oQA/1745257567/702/QARAKESEK%20-%20%D2%9A%D1%83%D1%80%D0%B0%D2%93%D0%B0%D0%BD%20%D0%B3%D2%AF%D0%BB%20%28192kbps%29.mp3',
        lyrics: 'Music 3'
    },
    {
        title: 'Пьяное солнце',
        artist: 'Alekseev',
        album: '2016',
        time: '#time',
        image: 'images/alekseev.jpg',
        file: 'https://dl1.mp3path.com/mp3/a81cc5aa9a2cb39db41a72d1a3a3048b.mp3',
        lyrics: 'Music 4'
    },
    {
        title: 'Davae',
        artist: 'Ad Aka Dilovar',
        album: '2021',
        time: '#time',
        image: 'images/dilovar.jpg',
        file: 'https://muzzona.kz/link_file.php?u=2021-11/ad-aka-dilovar-je-davae-dafshae_(muzzonas.ru).mp3',
        lyrics: 'Music 5'
    },
    {
        title: 'Calm Down',
        artist: 'Rema',
        album: '2022',
        time: '#time',
        image: 'images/rema.jpg',
        file: 'https://cdn3.sefon.pro/prev/N0Ooe1CP0V27qE4A8upRuw/1745257722/305/Rema%20feat.%20Selena%20Gomez%20-%20Calm%20Down%20%28192kbps%29.mp3',
        lyrics: 'Music 6'
    },
    {
        title: 'Вредина',
        artist: 'Bakr',
        album: '2022',
        time: '#time',
        image: 'images/bakr.jpeg',
        file: 'https://cdn6.sefon.pro/prev/L1RB-9yytDtWiIbxaP3Vnw/1745257759/302/Bakr%20-%20%D0%92%D1%80%D0%B5%D0%B4%D0%B8%D0%BD%D0%B0%20%28192kbps%29.mp3',
        lyrics: 'Music 7'
    },
    {
        title: 'Доча',
        artist: 'Jah Khalib',
        album: '2022',
        time: '#time',
        image: 'images/jahkhalib.jpeg',
        file: 'https://cdn7.sefon.pro/prev/KB_Wo5We5s3jKweJx29FQQ/1745257776/340/Jah%20Khalib%20-%20%D0%94%D0%BE%D1%87%D0%B0%20%28192kbps%29.mp3',
        lyrics: 'Music 8'
    },
    {
        title: 'Samurai',
        artist: 'Miyagi',
        album: '2020',
        time: '#time',
        image: 'images/miyagi.jpg',
        file: 'https://cdn8.sefon.pro/prev/NCCx6dnS7WZ_YeFTQqVLMQ/1745257815/128/MiyaGi%20-%20%D0%A1%D0%B0%D0%BC%D1%83%D1%80%D0%B0%D0%B9%20%28192kbps%29.mp3',
        lyrics: 'Music 9'
    },
    {
        title: 'Hope',
        artist: 'XXXXTENTACION',
        album: '2012',
        time: '#time',
        image: 'images/xxxtentacion.jpg',
        file: 'https://cdn8.sefon.pro/prev/cpFG9ZnQwAYsZ4GYyS3pHg/1745257855/313/XXXTentacion%20-%20Hope%20%28192kbps%29.mp3',
        lyrics: 'Music 10',
    }
];

const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

const songList = document.querySelector('.song-list');
const time = document.querySelector('.time');
const day = document.querySelector('.day');

const songTitleDisplay = document.querySelector('.author-name');
const songAlbumDisplay = document.querySelector('.album-name');
const songLyricsDisplay = document.querySelector('.song-text');
const songAlbumImage = document.querySelector('.album-image');
const bgImage = document.querySelector('.player');
const playBtn = document.getElementById('play');
const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');
const audio = document.getElementById('audio');
const progressContainer = document.querySelector('.progress-container');
const progress = document.getElementById('progress');

let currentSongIndex = 0;

function loadSong(song) {
    songTitleDisplay.textContent = `${song.artist} - ${song.title}`;
    songAlbumDisplay.textContent = `ALbum: ${song.album}`;
    songLyricsDisplay.textContent = song.lyrics;
    songAlbumImage.src = song.image
    bgImage.style.backgroundImage = `url(${song.image})`;
    audio.src = song.file;
}

songs.map((song, index) => {
    const musicCard = document.createElement('div');
    musicCard.classList.add("card");

    const cardHeader = document.createElement('div');
    cardHeader.classList.add('card-header');

    const songImage = document.createElement('img');
    songImage.src = song.image;
    cardHeader.appendChild(songImage);

    const cardBody = document.createElement('div');
    cardBody.classList.add('card-body');

    const songInfo = document.createElement('div');

    const artist = document.createElement('p');
    artist.classList.add('artist');
    artist.textContent = song.artist;

    const title = document.createElement('h2');
    title.classList.add('title');
    title.textContent = song.title;

    const album = document.createElement('p');
    album.classList.add('album');
    album.textContent = `Album:${song.album}, #time`;

    songInfo.appendChild(artist);
    songInfo.appendChild(title);
    songInfo.appendChild(album);

    const playButton = document.createElement('button');
    playButton.classList.add('play-button');
    playButton.addEventListener('click', () => {
        currentSongIndex = index;
        loadSong(song);
        playSong();
    });

    cardBody.appendChild(songInfo);
    cardBody.appendChild(playButton);

    musicCard.appendChild(cardHeader);
    musicCard.appendChild(cardBody);
    songList.appendChild(musicCard);
});

function updateTime() {
    const now = new Date();
  
    let hours = now.getHours();
    const minutes = String(now.getMinutes()).padStart(2, '0');
  
    hours = hours % 12;
    hours = hours === 0 ? 12 : hours;
  
    const dayName = days[now.getDay()];
    const monthName = months[now.getMonth()];
    const dayOfMonth = now.getDate();
  
    time.textContent = `${hours}:${minutes}`
    day.textContent = `${dayName}, ${monthName} ${dayOfMonth}`
}

// setInterval(updateTime, 1000);

loadSong(songs[currentSongIndex]);

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

function setProgress(e) {
    const width = this.clientWidth;
    const clickX = e.offsetX;
    const duration = audio.duration;
    audio.currentTime = (clickX / width) * duration;
}

function updateProgress(e) {
    const { duration, currentTime } = e.srcElement;
    const progressPercent = (currentTime / duration) * 100;
    progress.style.width = `${progressPercent}%`;
}

playBtn.addEventListener('click', () => {
    if (audio.paused) {
        playSong();
    } else {
        pauseSong();
    }
});

progressContainer.addEventListener('click', setProgress);
audio.addEventListener('timeupdate', updateProgress);

prevBtn.addEventListener('click', prevSong);
nextBtn.addEventListener('click', nextSong);