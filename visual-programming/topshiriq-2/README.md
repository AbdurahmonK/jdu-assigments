
# **Nazariy qism**

### Dasturlashda o‘zgaruvchi va o‘zgarmaslikni aniqlash:

- **O‘zgaruvchi (Variable):**
  - Ma’lumotlarni vaqtinchalik saqlash uchun ishlatiladi.
  - U dastur ishlash jarayonida qiymatini o‘zgartirishi mumkin.
    ```python
    x = 10  # O‘zgaruvchi e’lon qilindi
    x = x + 5  # Qiymati o‘zgartirildi
    ```

- **O‘zgarmaslik (Constant):**
  - Qiymati dastur ishlash jarayonida o‘zgarmaydi.
    ```python
    PI = 3.14  # O‘zgarmas qiymat
    ```

---

### Dasturlash tilida arifmetik operatsiyalarning tartibi:
Arifmetik operatsiyalar quyidagi ustuvorlik tartibida bajariladi:

1. **Qavslar**: `( )`
2. **Eksponenta**: `**`
3. **Ko‘paytirish, bo‘lish, va qoldiq**: `*`, `/`, `//`, `%`
4. **Qo‘shish va ayirish**: `+`, `-`

```python
result = 2 + 3 * (5 - 2)  # Natija: 11
```

---

### Modularizatsiya qanday afzalliklarga ega?
**Modularizatsiya** — dasturiy ta’minotni kichik, mustaqil qismlarga (modullarga) ajratish usuli.  
Afzalliklari:
- **Qayta foydalanish**: Modullar boshqa dasturlarda ishlatilishi mumkin.
- **Tuzilma**: Katta loyihalarni boshqarishni osonlashtiradi.
- **Texnik xizmat**: Xatolarni topish va tuzatishni tezlashtiradi.

---

# **Amaliy qism**

### Yosh kiritish va unga birni qo‘shib chiqaradigan dastur

##### **Blok-sxema ko‘rinishi:**
![Example Flowchart](./topshiriq-2.1.svg)

##### **Psevdocod:**
```plaintext
START
  DECLARE age AS INTEGER
  INPUT age
  age = age + 1
  OUTPUT age
END
```

---

### `c = a + b` amalini bajarish uchun modul asosida blok-sxema va psevdocod

##### **Blok-sxema ko‘rinishi:**

![Example Flowchart](./topshiriq-2.2.svg)

##### **Psevdocod:**
```plaintext
START
  DECLARE a, b, c AS INTEGER
  INPUT a, b
  c = ADD(a, b)
  OUTPUT c
END

FUNCTION ADD(a, b)
  RETURN a + b
END
```