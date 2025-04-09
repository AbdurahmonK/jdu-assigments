```javascript
// 1. Berilgan yilda nechta kun bor?
function checkLeapYear(year) {
    let isLeap = (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
    let days = isLeap ? 366 : 365;
    return `${year}-yilda ${days} kun bor.`;
}

// 2. Son tub yoki yo‘qligini tekshirish
function checkPrime(num) {
    if (num < 2) {
        return `${num} - tub emas.`;
    }
    for (let i = 2; i * i <= num; i++) {
        if (num % i === 0) {
            return `${num} - tub emas.`;
        }
    }
    return `${num} - tub son.`;
}

// 3. Start dan stop gacha step bilan yig‘indini topish
function generateSum(start, stop, step) {
    let sum = 0;
            
    for (let i = start; i <= stop; i += step) {
        sum += i;
    }

    return sum;
}

// 4. Fibonacci sonini topish
function findFibonacci(a, b, n) {
    if (n === 1) return`Natija: ${a}`;
    if (n === 2) return `Natija: ${b}`;

    let fib1 = a, fib2 = b, fibN;
    for (let i = 3; i <= n; i++) {
        fibN = fib1 + fib2;
        fib1 = fib2;
        fib2 = fibN;
    }

    return `Natija: ${fibN}`;
}

// 5. Yig‘indi: 1^k + 2^k + ... + N^k
function calculateSum(n, k) {
    let sum = 0;

    for (let i = 1; i <= n; i++) {
        sum += Math.pow(i, k);
    }

    return sum;
}
```