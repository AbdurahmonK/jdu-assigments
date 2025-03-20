```javascript
// 1. Xazinani topish
function checkTreasure(input) {
    let arr = input.split(',').map(Number);
    let allEven = arr.every(num => num % 2 === 0);
    return allEven ? "Xazinani topdingiz!" : "Xazinani topa olmadiz!";
}

// 2. Guess a number o‘yini
function guessNumber() {
    let target = Math.floor(Math.random() * 100) + 1;
    let guess;
    let attempts = 0;

    while (guess !== target) {
        guess = parseInt(prompt("1 dan 100 gacha son kiriting:"));
        if (isNaN(guess)) break;
        attempts++;

        if (guess > target) {
            alert("O‘ylangan sondan kichik");
        } else if (guess < target) {
            alert("O‘ylangan sondan katta");
        } else {
            alert(`Tabriklayman! Siz ${attempts} urinishda topdingiz!`);
            return `Son ${target} edi, ${attempts} urinishda topildi!`;
        }
    }
}

// 3. Takrorlangan sonlarni olib tashlash
function removeDuplicates(input) {
    let arr = input.split(',').map(Number);
    let unique = arr.filter(num => arr.indexOf(num) === arr.lastIndexOf(num));
    return unique.join(', ') || "Takrorlanmagan son yo‘q!";
}

// 4. So‘zning oxirgi 2 ta belgisini almashtirish
function swapLastTwo(str) {
    if (str.length < 2) return "So‘z kamida 2 ta harfdan iborat bo‘lishi kerak!";
    let swapped = str.slice(0, -2) + str.slice(-1) + str.slice(-2, -1);
    return swapped;
}

// 5. Matnning boshidagi 2 ta belgini olib tashlash (istisno bilan)
function removeFirstTwo(str) {
    if (str.length < 2) return "Matn kamida 2 ta harfdan iborat bo‘lishi kerak!";
    let newStr = (str.startsWith("ab")) ? str : str.slice(2);
    return newStr;
}
```