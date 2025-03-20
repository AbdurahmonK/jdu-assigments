```javascript
// 1. Hayvonlar oyoqlarini hisoblash funksiyasi
function calculateLegs(sheeps, chickens) {
    const legs = (sheeps * 4) + (chickens * 2);
    return "Jami oyoqlar: " + legs;
}

// 2. Quruvchiga g‘isht hisoblash funksiyasi
function calculateBricks(wallLength, wallHeight) {
    const bricksPerMeter = 12;
    const brickHeight = 0.05; // 5 sm = 0.05 m
    const totalBricks = Math.ceil(wallLength * (wallHeight / brickHeight) * bricksPerMeter);
    return "Kerakli g‘ishtlar soni: " + totalBricks;
}

// 3. 3 xonali sonni teskari qilish funksiyasi
function reverseNumber(num) {
    const reversed = num.toString().split("").reverse().join("");
    return "Teskarisi: " + reversed;
}

// 4. 3 xonali sonni o‘nlar va birlikni almashtirish funksiyasi
function swapDigits(num) {
    if (num.length !== 3) {
        return "3 xonali son kiriting!";
    }
    let arr = num.toString().split("");
    [arr[1], arr[2]] = [arr[2], arr[1]]; // O‘nlar va birlik xonalarini almashtirish
    let swappedNum = arr.join("");
    return "Almashtirilgan son: " + swappedNum;
}

// 5. 4 xonali son raqamlari yig‘indisini hisoblash funksiyasi
function sumDigits(num) {
    if (num.length !== 4) {
        return "4 xonali son kiriting!";
    }
    let sum = num.toString().split("").reduce((acc, digit) => acc + parseInt(digit), 0);
    return "Raqamlar yig‘indisi: " + sum;
}
```