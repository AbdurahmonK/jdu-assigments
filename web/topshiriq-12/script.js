let playerScore = 0;
let computerScore = 0;

const playerScoreDisplay = document.getElementById('playerScore');
const computerScoreDisplay = document.getElementById('computerScore');
const result = document.getElementById('result');

const playerImage = document.getElementById('playerImg');
const computerImage = document.getElementById('computerImg');

const rockButton = document.getElementById('rock');
const scissorsButton = document.getElementById('scissors');
const paperButton = document.getElementById('paper');

function getComputerChoice() {
    const choices = ['rock', 'scissors', 'paper'];
    const randomIndex = Math.floor(Math.random() * 3);
    return choices[randomIndex];
}

function playRound(playerSelection, computerSelection) {
    if (playerSelection === computerSelection) {
        result.textContent = "Draw!";
    } else if (
        (playerSelection === 'rock' && computerSelection === 'scissors') ||
        (playerSelection === 'scissors' && computerSelection === 'paper') ||
        (playerSelection === 'paper' && computerSelection === 'rock')
    ) {
        playerScore++;
        playerScoreDisplay.textContent = playerScore;
        result.textContent = "You win!";
    } else {
        computerScore++;
        computerScoreDisplay.textContent = computerScore;
        result.textContent = "Computer win!";
    }
}

function drawImage(playerSelection, computerSelection) {
    playerImage.src = getImageLink(playerSelection);
    computerImage.src = getImageLink(computerSelection);
}

function getImageLink(type) {
    const imageMap = {
      "paper": "images/paper.png",
      "rock": "images/rock.png",
      "scissors": "images/scissors.png"
    };
    return imageMap[type] || "scissors.png";
}

rockButton.addEventListener('click', () => {
    const compChoice = getComputerChoice();
    playRound('rock', compChoice);
    drawImage('rock', compChoice);
});

scissorsButton.addEventListener('click', () => {
    const compChoice = getComputerChoice();
    playRound('scissors', compChoice);
    drawImage('scissors', compChoice);
});

paperButton.addEventListener('click', () => {
    const compChoice = getComputerChoice();
    playRound('paper', compChoice);
    drawImage('paper', compChoice);
});