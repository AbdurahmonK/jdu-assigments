```html
<!DOCTYPE html>
<html>
<head>
    <title>Avstraliya Slayderi</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .slider-container {
            width: 80%;
            margin: 20px auto;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
            position: relative;
        }

        .slide img {
            width: 100%;
            display: block;
        }

        .slide-content {
            position: absolute;
            top: 50%;
            left: 5%;
            transform: translateY(-50%);
            color: white;
        }

        .slide-content h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .slide-content p {
            font-size: 1.1em;
            margin-bottom: 20px;
        }

        .slide-content a {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .thumbnail-container {
            position: absolute;
            top: 50%;
            right: 5%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
        }

        .thumbnail {
            width: 100px;
            height: 150px;
            margin-bottom: 10px;
            overflow: hidden;
            border-radius: 8px;
            cursor: pointer;
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .controls {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
        }

        .controls button {
            background-color: white;
            border: none;
            padding: 8px 15px;
            margin: 0 5px;
            border-radius: 5px;
            cursor: pointer;
        }
        .slide-content {
            opacity: 0;
            transform: translateY(-50%) translateX(-20px);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        }

        .slide.active .slide-content {
            opacity: 1;
            transform: translateY(-50%) translateX(0);
        }
    </style>
</head>
<body>

    <div class="slider-container">
        <div class="slider">
            <div class="slide active">
                <img src="australia1.jpg" alt="Avstraliya 1">
                <div class="slide-content">
                    <h2>AUSTRALIA</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, quisquam.</p>
                    <a href="#">See more</a>
                </div>
            </div>
            <div class="slide">
                <img src="australia2.jpg" alt="Avstraliya 2">
                <div class="slide-content">
                    <h2>AUSTRALIA</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, quisquam.</p>
                    <a href="#">See more</a>
                </div>
            </div>
            <div class="slide">
                <img src="australia3.jpg" alt="Avstraliya 3">
                <div class="slide-content">
                    <h2>AUSTRALIA</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, quisquam.</p>
                    <a href="#">See more</a>
                </div>
            </div>
        </div>
        <div class="thumbnail-container">
            <div class="thumbnail">
                <img src="australia1-thumb.jpg" alt="Avstraliya 1 kichik rasm">
            </div>
            <div class="thumbnail">
                <img src="australia2-thumb.jpg" alt="Avstraliya 2 kichik rasm">
            </div>
            <div class="thumbnail">
                <img src="australia3-thumb.jpg" alt="Avstraliya 3 kichik rasm">
            </div>
        </div>
        <div class="controls">
            <button id="prevBtn">←</button>
            <button id="nextBtn">→</button>
        </div>
    </div>

    <script>
        const slider = document.querySelector('.slider');
        const slides = document.querySelectorAll('.slide');
        const thumbnails = document.querySelectorAll('.thumbnail');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        let currentIndex = 0;

        function updateSlider() {
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
            slides.forEach((slide, index) => {
                if (index === currentIndex) {
                    slide.classList.add('active');
                } else {
                    slide.classList.remove('active');
                }
            });
        }

        function goToSlide(index) {
            if (index < 0) {
                currentIndex = slides.length - 1;
            } else if (index >= slides.length) {
                currentIndex = 0;
            } else {
                currentIndex = index;
            }
            updateSlider();
        }

        prevBtn.addEventListener('click', () => {
            goToSlide(currentIndex - 1);
        });

        nextBtn.addEventListener('click', () => {
            goToSlide(currentIndex + 1);
        });

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', () => {
                goToSlide(parseInt(thumbnail.dataset.index));
            });
        });
    </script>
</body>
</html>
```