### **1. Konstruktorlar qanday yaratiladi?**
Konstruktorlar — ob'ektni yaratishda avtomatik tarzda chaqiriladigan metodlardir. Ular ob'ektning boshlang'ich holatini o'rnatish uchun ishlatiladi. JavaScriptda konstruktorlar quyidagicha yaratiladi:

```javascript
class Car {
  constructor(make, model, year) {
    this.make = make;
    this.model = model;
    this.year = year;
  }
}

const myCar = new Car("Toyota", "Camry", 2020);
console.log(myCar);
```
Bu yerda `constructor` metodini yaratish orqali, `Car` sinfidan yangi ob'ekt yaratishda avtomatik ravishda ushbu metod chaqiriladi.

---

### **2. Destruktorlar qanday yaratiladi?**
JavaScriptda destruktorlar (yoki `finalize` metodlari) mavjud emas, chunki JavaScript avtomatik xotira boshqaruvini amalga oshiradi (garbage collection). Boshqa dasturlash tillarida destruktorlar obyektni yo'q qilinishidan oldin chaqiriladi, ammo JavaScriptda bu ehtiyoj avtomatik tarzda hal qilinadi.

Biroq, agar resurslarni tozalash kerak bo'lsa, `finally` blokidan yoki `cleanup` metodlaridan foydalanish mumkin.

```javascript
class Car {
  constructor(make, model, year) {
    this.make = make;
    this.model = model;
    this.year = year;
  }

  cleanup() {
    console.log("Resurslar tozalanmoqda...");
  }
}

const myCar = new Car("Toyota", "Camry", 2020);
myCar.cleanup();
```
---

### **3. Kompozitsiyani tushuntirib bering**
Kompozitsiya — bu ob'ektga yo'naltirilgan dasturlashda boshqa ob'ektlarni bir ob'ektda qo'llashdir. Bu, ob'ektlarning yirik tizimga birlashishiga imkon beradi. Kompozitsiya orqali bir ob'ektni boshqa ob'ekt sifatida kiritish mumkin.

Misol:

```javascript
class Engine {
  start() {
    console.log("Engine starting...");
  }
}

class Car {
  constructor(engine) {
    this.engine = engine;
  }

  drive() {
    this.engine.start();
    console.log("Car is moving...");
  }
}

const engine = new Engine();
const myCar = new Car(engine);
myCar.drive();
```

Bu yerda `Car` sinfi `Engine` sinfini o'z ichiga oladi, va bu kompozitsiya hisoblanadi.

---

### **4. Protected metodi bilan o’zgaruvchi e’lon qiling va vazifasini tushuntirib bering**
JavaScriptda to'g'ridan-to'g'ri `protected` so'z mavjud emas. Biroq, metodlarni yoki o'zgaruvchilarni himoya qilish uchun o'zgaruvchilarni private qilish yoki maxfiy qilish usullari mavjud (es6 va keyingi versiyalarda):

```javascript
class Car {
  #make;  // private o'zgaruvchi
  
  constructor(make) {
    this.#make = make;
  }

  getMake() {
    return this.#make;
  }
}

const myCar = new Car("Toyota");
console.log(myCar.getMake());  // "Toyota"
```

Bu yerda `#make` private o'zgaruvchi bo'lib, uni faqat metodlar orqali o'qish mumkin. `protected` o'zgaruvchilarni sinflar o'rtasida faqat "meros" olish orqali o'qish mumkin.

---

### **5. Ob’ektga yo’naltirilgan dasturlashda istisnolar qanday ishlatiladi va vazifani tushuntirib bering**
Istisnolar (Exceptions) — dastur bajarilayotganda yuzaga keladigan xatoliklar yoki noxush holatlar. JavaScriptda istisnolar `try`, `catch` bloklari yordamida ishlatiladi. Bu xatoliklarni ushlab turish va qayta ishlash imkonini beradi.

```javascript
try {
  let result = riskyOperation();
} catch (error) {
  console.error("Xatolik yuz berdi: " + error.message);
} finally {
  console.log("Ish tugadi.");
}

function riskyOperation() {
  throw new Error("Qayta ishlashda xatolik!");
}
```

Bu yerda, agar `riskyOperation()` funksiyasida xatolik yuzaga kelsa, bu `catch` blokida ushlanadi va mos xabar chiqariladi.