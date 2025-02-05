### **1. Kompyuter fayli nima va u qanday tashkil etilgan?**
**Kompyuter fayli** — bu ma’lumotlarni saqlash uchun ishlatiladigan asosiy tuzilma. U:  
- **Tashqi xotirada (disk)** saqlanadi.  
- **Strukturasi:**  
  - Fayl nomi (`file_name.extension`)  
  - Fayl turi (matnli, binar, media, va hokazo)  
  - Fayl mazmuni (ma’lumotlar yoki kodlar)  
- **Jadvalli yoki oddiy matn ko‘rinishida tashkil etilgan bo‘lishi mumkin.**

---

### **2. Dasturlashda fayllarni qanday e'lon qilish, ochish, o'qish, yozish va yopish mumkin?**
#### Dasturlash tillarida fayllarni ishlatish bo‘yicha umumiy amallar:  
```javascript
const fs = require("fs");

// Faylga yozish
fs.writeFileSync("example.txt", "Salom, dunyo!");

// Faylni o‘qish
const data = fs.readFileSync("example.txt", "utf8");
console.log(data);
```  

---

### **3. studentData faylidan studentId va name ma’lumotlarini o’qib olib newStudentData fayliga yozish dasturi blok-sxemasi**
### **Node.js Kod Misoli**
```javascript
const fs = require("fs");

// Faylni o‘qish
fs.readFile("studentData.txt", "utf8", (err, data) => {
    if (err) {
        console.error("Faylni o‘qishda xatolik:", err);
        return;
    }

    // Yangi faylga yozish
    fs.writeFile("newStudentData.txt", data, (err) => {
        if (err) {
            console.error("Yangi faylga yozishda xatolik:", err);
            return;
        }
        console.log("Ma'lumotlar muvaffaqiyatli ko‘chirildi!");
    });
});
```