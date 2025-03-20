```javascript
// 1. Katta va kichik sonni chiqarish
function compareNumbers(a, b) {
    let result = a > b ? `${a}, ${b}, ${b}, ${a}` : `${b}, ${a}, ${a}, ${b}`;
    return "Natija: " + result;
}

// 2. Uch xonali sonning raqamlari takrorlanganmi?
function checkUniqueDigits(num) {
    let digits = num.toString().split("");
    let uniqueDigits = new Set(digits);
    let result = uniqueDigits.size === digits.length ? "Takror yo‘q" : "Takror bor";
    return "Natija: " + result;
}

// 3. Sonni kvadrat yoki kub qilish
function calculateSquareOrCube(num) {
    let result = (num % 3 === 0 && num % 5 === 0) || num < 0 ? num ** 2 : num ** 3;
    return "Natija: " + result;
}

// 4. Uchta sondan eng kattasini topish
function findLargest(a, b, c) {
    let max = Math.max(a, b, c);
    return "Eng katta son: " + max;
}

// 5. Oyni va faslni aniqlash
function getSeason(month) {
    const months = [
        "Yanvar", "Fevral", "Mart", "Aprel", "May", "Iyun",
        "Iyul", "Avgust", "Sentabr", "Oktabr", "Noyabr", "Dekabr"
    ];
    const seasons = ["Qish", "Bahor", "Yoz", "Kuz"];

    if (month < 1 || month > 12) {
        return "1 dan 12 gacha son kiriting!";
    }

    let season =
        (month === 12 || month <= 2) ? seasons[0] :
        (month >= 3 && month <= 5) ? seasons[1] :
        (month >= 6 && month <= 8) ? seasons[2] : seasons[3];

    return `${months[month - 1]} — ${season}`;
}
```