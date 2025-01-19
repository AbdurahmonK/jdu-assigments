### **1. Baxo o‘zgaruvchisi asosida talabaning fanni o‘tgan yoki yiqilganligini tekshirish dasturi**

##### **Blok-sxema ko‘rinishi:**
![Example Flowchart](./topshiriq-3.1.svg)

##### **Psevdocod:**
```plaintext
START
  DECLARE baxo AS INTEGER
  INPUT baxo
  IF baxo < 56 THEN
    OUTPUT "Siz fandan yiqildingiz"
  ELSE
    OUTPUT "Siz fandan o‘tdingiz"
  ENDIF
END
```

---

### **2. Darsga qatnash foizini tekshirish bilan umumlashtirilgan dastur**

##### **Blok-sxema ko‘rinishi:**
![Example Flowchart](./topshiriq-3.2.svg)

##### **Psevdocod:**
```plaintext
START
  DECLARE baxo, foiz AS INTEGER
  INPUT baxo, foiz
  IF baxo >= 56 AND foiz >= 56 THEN
    OUTPUT "Siz fandan o‘tdingiz"
  ELSE
    OUTPUT "Siz fandan yiqildingiz"
  ENDIF
END
```

---

### **3. 10 dan 100 gacha bo‘lgan juft sonlar yig‘indisi dasturi**

##### **Blok-sxema ko‘rinishi:**
![Example Flowchart](./topshiriq-3.3.svg)

##### **Psevdocod:**
```plaintext
START
  DECLARE sum AS INTEGER
  SET sum = 0
  FOR i FROM 10 TO 100 DO
    IF i % 2 == 0 THEN
      sum = sum + i
    ENDIF
  ENDFOR
  OUTPUT sum
END
```