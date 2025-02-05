### **1. 1 dan 100 gacha bo’lgan butun sonlar yig’indisini chiqaruvchi dastur bloksxemasini chizish.**

##### **Blok-sxema ko‘rinishi:**
![Example Flowchart](./topshiriq-5.1.svg)

---

### **2. 1 dan 100 gacha 3 ga ham 5 ga ham karrali bo’lgan butun sonlar yig’indisini chiqaruvchi dastur blok-sxemasini chizish.**

##### **Blok-sxema ko‘rinishi:**
![Example Flowchart](./topshiriq-5.2.svg)

---

### **3. Sonning juft toqligini tekshirish daturi blok-sxemasini chizish.(while sikl dan foydalanib 0 ni kiritsa tugatilsin).**

##### **Blok-sxema ko‘rinishi:**
![Example Flowchart](./topshiriq-5.3.svg)

---

### **4. Ko’paytirish jadvalini chiqaradigan dastur blok-sxemasini chizish.**

##### **Blok-sxema ko‘rinishi:**
![Example Flowchart](./topshiriq-5.4.svg)

---

### **5. Piramida ko’rinishidagi shaklni chiqaradigan dastur blok sxemasi chizish (kiruvchi ma’lumot qatorlar soni).**

##### **Blok-sxema ko‘rinishi:**
![Example Flowchart](./topshiriq-5.5.svg)

##### **JS code:**
```javascript
function paintATree(num) {
let point = ""
for(let i = 1; i <= num; i++) {
    let space = ""
    for (let j = 1; j <= num - i; j++) {
        space = space + " "
    }
    point = point + (point === "" ? "*" : "**")
    console.log(space + point)
  }
}
paintATree(5)
```
##### **Result:**
```plaintext
    *
   ***
  *****
 *******
*********
```