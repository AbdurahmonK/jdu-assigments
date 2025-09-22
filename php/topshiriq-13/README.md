## 1\. Kvadrat ildiz funksiyasi va manfiy son istisnosi

### `index.php` fayliga quyidagi kodni qoʻshing:

```php
<?php
    echo "<h2>Kvadrat ildiz funksiyasi (istisno bilan)</h2>";

    /**
     * Berilgan sonning kvadrat ildizini hisoblaydi.
     * Agar son manfiy bo'lsa, Exception tashlaydi.
     *
     * @param float $son Kvadrat ildizi hisoblanadigan son.
     * @return float Sonning kvadrat ildizi.
     * @throws Exception Agar son manfiy bo'lsa.
     */
    function ildiz($son) {
        if ($son < 0) {
            // Manfiy son kiritilganda istisno tashlash
            throw new Exception("Manfiy sondan kvadrat ildiz olish mumkin emas!");
        }
        return sqrt($son); // sqrt() PHPning kvadrat ildizni hisoblovchi funksiyasi
    }

    // Funksiyani turli qiymatlar bilan sinab ko'rish
    $numbers_to_test = [25, 9, 0, -4, 16.5];

    foreach ($numbers_to_test as $num) {
        echo "Son: " . $num . "<br>";
        try {
            $result = ildiz($num);
            echo "Kvadrat ildiz: " . $result . "<br><br>";
        } catch (Exception $e) {
            // Istisno tutilganda xabar chiqarish
            echo "<p style='color: red;'>Xatolik: " . $e->getMessage() . "</p><br>";
        }
    }
?>
<hr>
```

**Tushuntirish:**

  * **`function ildiz($son)`**: `ildiz` nomli funksiya yaratildi, u bitta `$son` parametrini qabul qiladi.
  * **`if ($son < 0) { throw new Exception(...) }`**: Agar `$son` manfiy boʻlsa, `Exception` obyekti tashlanadi (`throw new Exception()`). Bu istisno keyinchalik `try-catch` blokida tutiladi.
  * **`sqrt($son)`**: PHPning oʻrnatilgan funksiyasi boʻlib, sonning kvadrat ildizini hisoblaydi.
  * **`try { ... } catch (Exception $e) { ... }`**:
      * **`try` bloki**: Istisno yuzaga kelishi mumkin boʻlgan kod shu blok ichiga yoziladi.
      * **`catch (Exception $e)` bloki**: Agar `try` blokida `Exception` turidagi istisno tashlansa, shu blok ishga tushadi. `$e` oʻzgaruvchisi istisno obyektini oʻz ichiga oladi.
      * **`$e->getMessage()`**: Istisno obyektidan istisno xabarini olish uchun ishlatiladi.

-----

## 2\. Koʻpaytirish funksiyasi va parametrlar istisnosi

### `index.php` fayliga quyidagi kodni qoʻshing:

```php
<?php
    echo "<h2>Ko'paytirish funksiyasi (parametr tekshiruvi bilan)</h2>";

    /**
     * Ikki sonni ko'paytiradi.
     * Agar parametrlar son bo'lmasa, TypeError Exception tashlaydi.
     *
     * @param mixed $son1 Birinchi ko'paytuvchi.
     * @param mixed $son2 Ikkinchi ko'paytuvchi.
     * @return float Ikki sonning ko'paytmasi.
     * @throws TypeError Agar parametrlar son emas bo'lsa.
     */
    function kopaytirish($son1, $son2) {
        // is_numeric() sonlarni (integer, float, va son ko'rinishidagi stringlar) tekshiradi.
        // Agar qat'iyroq tip tekshiruvi kerak bo'lsa, is_int() yoki is_float() ishlatish mumkin.
        if (!is_numeric($son1) || !is_numeric($son2)) {
            // Agar parametrlar son emas bo'lsa, TypeError istisno tashlash
            // PHP 7+ da type hinting (int $son1) ishlatsak, avtomatik TypeError tashlaydi.
            // Lekin bu yerda is_numeric() bilan qo'lda tekshiramiz.
            throw new TypeError("Ikkala parametr ham son bo'lishi kerak!");
        }
        return $son1 * $son2;
    }

    // Funksiyani turli qiymatlar bilan sinab ko'rish
    $test_cases = [
        [10, 5],
        [7.5, 2],
        [10, "abc"], // Noto'g'ri parametr
        ["20", 3],   // Son ko'rinishidagi string
        ["xyz", 8],  // Noto'g'ri parametr
        [0, 100],
        ["", 5]      // Noto'g'ri parametr
    ];

    foreach ($test_cases as $case) {
        echo "Parametrlar: " . var_export($case[0], true) . " va " . var_export($case[1], true) . "<br>";
        try {
            $result = kopaytirish($case[0], $case[1]);
            echo "Ko'paytma: " . $result . "<br><br>";
        } catch (TypeError $e) {
            // TypeError istisno tutilganda xabar chiqarish
            echo "<p style='color: red;'>Xatolik: " . $e->getMessage() . "</p><br>";
        } catch (Exception $e) {
            // Boshqa turdagi istisno tutilganda (agar bo'lsa)
            echo "<p style='color: red;'>Kutilmagan xatolik: " . $e->getMessage() . "</p><br>";
        }
    }
?>
<hr>
```

**Tushuntirish:**

  * **`function kopaytirish($son1, $son2)`**: `kopaytirish` nomli funksiya yaratildi.
  * **`is_numeric($son1)`**: Bu funksiya oʻzgaruvchining son qiymatini ifodalashini tekshiradi (butun son, oʻnlik son yoki son koʻrinishidagi satr boʻlishi mumkin, masalan, `"123"`).
  * **`throw new TypeError(...)`**: Agar parametrlar son emasligini aniqlansa, `TypeError` istisnosi tashlanadi. `TypeError` PHP 7+ da notoʻgʻri turdagi argument funksiyaga oʻtkazilganda avtomatik ravishda tashlanadigan istisno sinfidir. Biz buni qoʻlda ham tashlashimiz mumkin.
  * **`try { ... } catch (TypeError $e) { ... } catch (Exception $e) { ... }`**:
      * Bu yerda bir nechta `catch` blokidan foydalanilgan. Avval `TypeError`ni tutishga harakat qiladi, agar u tutilmasa, keyinroq umumiy `Exception`ni tutadi. Bu har xil turdagi istisnolarni alohida-alohida qayta ishlashga imkon beradi.