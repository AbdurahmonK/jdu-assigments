### **1. Kiritilgan son musbat yoki manfiyligini tekshirish**

##### **Blok-sxema ko‘rinishi:**
![Example Flowchart](./topshiriq-4.1.svg)

##### **Psevdocod:**
```plaintext
START
  INPUT son
  IF son >= 0 THEN
    IF son % 2 == 0 THEN
      OUTPUT "Musbat juft son"
    ELSE
      OUTPUT "Musbat toq son"
    ENDIF
  ELSE
    OUTPUT "Manfiy son kvadrati: " + son * son
  ENDIF
END
```

---

### **2. Sonning nechta xonali ekanligini aniqlash**

##### **Blok-sxema ko‘rinishi:**
![Example Flowchart](./topshiriq-4.2.svg)

##### **Psevdocod:**
```plaintext
START
  INPUT son
  IF ABS(son) <= 9 THEN
    OUTPUT "Bir xonali son"
  ELSE IF ABS(son) <= 99 THEN
    OUTPUT "Ikki xonali son"
  ELSE IF ABS(son) <= 999 THEN
    OUTPUT "Uch xonali son"
  ELSE
    OUTPUT "Ko‘p xonali son"
  ENDIF
END
```

---

### **3. 3 ga va 5 ga karralik yoki manfiy sonlarni tekshirish**

##### **Blok-sxema ko‘rinishi:**
![Example Flowchart](./topshiriq-4.3.svg)

##### **Psevdocod:**
```plaintext
START
  INPUT son
  IF (son % 3 == 0 AND son % 5 == 0) OR son < 0 THEN
    OUTPUT "Kvadrat: " + son * son
  ELSE
    OUTPUT "Kub: " + son * son * son
  ENDIF
END
```

---

### **4. Hafta kunini aniqlash va ish kuni/dam olish kunini ko‘rsatish**

##### **Blok-sxema ko‘rinishi:**
![Example Flowchart](./topshiriq-4.4.svg)

##### **Psevdocod:**
```plaintext
START
  INPUT kun
  SWITCH (kun)
    CASE 1:
      OUTPUT "Du - Ish kuni"
      BREAK
    CASE 2:
      OUTPUT "Se - Ish kuni"
      BREAK
    CASE 3:
      OUTPUT "Chor - Ish kuni"
      BREAK
    CASE 4:
      OUTPUT "Pay - Ish kuni"
      BREAK
    CASE 5:
      OUTPUT "Juma - Ish kuni"
      BREAK
    CASE 6:
      OUTPUT "Shan - Dam olish kuni"
      BREAK
    CASE 7:
      OUTPUT "Yak - Dam olish kuni"
      BREAK
    DEFAULT:
      OUTPUT "Noto‘g‘ri kun kiritildi"
  ENDSWITCH
END
```