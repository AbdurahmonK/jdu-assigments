```html
<!DOCTYPE html>
<html>
<head>
    <title>Tosh Qaychi Qog'oz</title>
    <style>
        body {
            background-color: yellow;
            font-family: sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .scores {
            display: flex;
            justify-content: space-around;
            width: 80%;
            margin-bottom: 20px;
        }

        .score {
            font-size: 1.5em;
        }

        .choices {
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 1em;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="scores">
        <div class="score">Siz <span id="playerScore">0</span></div>
        <div class="score">Kompyuter <span id="computerScore">0</span></div>
    </div>

    <div>
        <p>Tanlang  D</p>
    </div>

    <div class="choices">
        <button id="rock">Tosh</button>
        <button id="scissors">Qaychi</button>
        <button id="paper">Qog'oz</button>
    </div>

    <script>
        let playerScore = 0;
        let computerScore = 0;

        const playerScoreDisplay = document.getElementById('playerScore');
        const computerScoreDisplay = document.getElementById('computerScore');
        const rockButton = document.getElementById('rock');
        const scissorsButton = document.getElementById('scissors');
        const paperButton = document.getElementById('paper');

        function getComputerChoice() {
            const choices = ['Tosh', 'Qaychi', 'Qog\'oz'];
            const randomIndex = Math.floor(Math.random() * 3);
            return choices[randomIndex];
        }

        function playRound(playerSelection, computerSelection) {
            if (playerSelection === computerSelection) {
                return "Durang!";
            } else if (
                (playerSelection === 'Tosh' && computerSelection === 'Qaychi') ||
                (playerSelection === 'Qaychi' && computerSelection === 'Qog\'oz') ||
                (playerSelection === 'Qog\'oz' && computerSelection === 'Tosh')
            ) {
                playerScore++;
                playerScoreDisplay.textContent = playerScore;
                return "Siz yutdingiz!";
            } else {
                computerScore++;
                computerScoreDisplay.textContent = computerScore;
                return "Kompyuter yutdi!";
            }
        }

        rockButton.addEventListener('click', () => {
            alert(playRound('Tosh', getComputerChoice()));
        });

        scissorsButton.addEventListener('click', () => {
            alert(playRound('Qaychi', getComputerChoice()));
        });

        paperButton.addEventListener('click', () => {
            alert(playRound('Qog\'oz', getComputerChoice()));
        });
    </script>
</body>
</html>
```