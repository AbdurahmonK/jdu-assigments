### **1. Ob’ekt, xususiyati va metodlarni tushuntirib bering**
- **Ob'ekt (Object)**: Ob'ekt dasturdagi ma'lum bir narsaning modelidir. Ob'ektda ma'lumotlar (xususiyatlar) va ular bilan bog'liq funksiyalar (metodlar) bo'ladi. Ob'ekt biror sinfning nusxasidir.
- **Xususiyat (Property)**: Ob'ektning holatini tavsiflovchi ma'lumotlar. Xususiyatlar odatda o'zgaruvchilar sifatida ob'ektda saqlanadi. Masalan, `firstName`, `age` kabi xususiyatlar.

- **Metod (Method)**: Ob'ekt bilan ishlash uchun ishlatiladigan funksiyalar. Metodlar ob'ektning xususiyatlari bilan ishlaydi va ob'ektning maqsadlariga erishish uchun ishlatiladi. Masalan, `getFullName()` yoki `updateAge()` metodlari.

---

### **2. Ob'ektga yo'naltirilgan dasturlashning beshta tamoyillarini sanab bering**
- **Encapsulation (Kapsulatsiya)**: Ma'lumotlarni va funksiyalarni bir joyga to'plash va ma'lumotlarning bevosita kirishiga cheklovlar qo'yish. Bu, ob'ektlarning tashqi dunyo bilan qanday aloqada bo'lishini boshqaradi.

- **Abstraction (Abstraktsiya)**: Murakkab tizimlarni soddalashtirish va foydalanuvchiga faqat kerakli ma'lumotlarni taqdim etish. Keraksiz detal va tashqi nuqtalarni yashirish.

- **Inheritance (Meros olish)**: Bir sinfning xususiyatlarini va metodlarini boshqa sinfga meros qilib olish imkoniyati. Bu, kodni qayta ishlatish va umumiylikni oshiradi.

- **Polymorphism (Polimorfizm)**: Bir xil nomli metodlar yoki operatorlar turli xil sinflarda turli xil xatti-harakatlarni amalga oshirishi. Bu, metodlarning turli versiyalarini yaratishga imkon beradi.

- **Composition (Kompozitsiya)**: Ob'ektlar bir-biriga kirib, yangi ob'ektlar yaratadi. Bu orqali sinflar bir-biridan foydalanadi, lekin ularning ichki tuzilmalari alohida bo'ladi.

---

### **3. Sinf va ob’ekt tushunchalari farqini tushuntirib bering**
- **Sinf (Class)**: Sinf - bu ob'ektlarning shabloni yoki blueprinti. Sinf ob'ektlarning qanday tuzilishi va ular qanday metodlarni bajarishi haqida aniq ko'rsatmalar beradi. Sinf faqatgina ob'ekt yaratish uchun ishlatiladi.
  
- **Ob'ekt (Object)**: Sinfdan yaratilgan konkret nusxa bo'lib, ob'ekt sinfning atributlari va metodlariga ega. Har bir ob'ekt o'zining holatiga ega bo'ladi.

**Farq**: Sinf - bu tasvir, ob'ekt esa shu tasvir asosida yaratilgan aniq ob'ekt.

---

### **4. Person nomli sinf yaratish**
```javascript
class Person {
  constructor(firstName, lastName, age, phoneNumber) {
    this.firstName = firstName;
    this.lastName = lastName;
    this.age = age;
    this.phoneNumber = phoneNumber;
  }

  // public method
  description() {
    return `${this.firstName} ${this.lastName} is ${this.age} years old.`;
  }

  // private method
  #getPhoneNumber() {
    return this.phoneNumber;
  }

  getPhoneNumber() {
    return "Phone number is private.";
  }
}

const person = new Person("John", "Doe", 30, "123-456-789");
console.log(person.description());  // John Doe is 30 years old.
console.log(person.getPhoneNumber());  // Phone number is private.
```

**Izoh**: `description` metodi ommaviy (public), `getPhoneNumber` esa maxfiy (private) metod sifatida ishlatiladi. JavaScriptda maxfiy metodlar `#` belgisi bilan e'lon qilinadi.

---

### **5. Student sinfini Person sinfidan voris olib sinf yaratish**
```javascript
class Student extends Person {
  constructor(firstName, lastName, age, phoneNumber, studentId, studentAverageGrade) {
    super(firstName, lastName, age, phoneNumber);
    this.studentId = studentId;
    this.studentAverageGrade = studentAverageGrade;
  }

  // public method
  getAvvarageGrade() {
    return this.studentAverageGrade;
  }

  // private method
  #getStudentCourse() {
    return "Course details are private.";
  }

  getStudentCourse() {
    return "Course information is not available.";
  }
}

const student = new Student("Alice", "Smith", 20, "987-654-321", "S12345", 89);
console.log(student.description());  // Alice Smith is 20 years old.
console.log(student.getAvvarageGrade());  // 89
console.log(student.getStudentCourse());  // Course information is not available.
```

**Izoh**: `Student` sinfi `Person` sinfidan voris olib, o'zining yangi atributlari (masalan, `studentId`, `studentAverageGrade`) va metodlarini qo'shgan. `super()` metodi orqali `Person` sinfining konstruktorini chaqirish mumkin.