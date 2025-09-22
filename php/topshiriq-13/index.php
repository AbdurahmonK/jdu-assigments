<?php
    echo "<h2>Kvadrat ildiz funksiyasi (istisno bilan)</h2>";

    function ildiz($son) {
        if ($son < 0) {
            throw new Exception("Manfiy sondan kvadrat ildiz olish mumkin emas!");
        }
        return sqrt($son);
    }

    $numbers_to_test = [25, 9, 0, -4, 16.5];

    foreach ($numbers_to_test as $num) {
        echo "Son: " . $num . "<br>";
        try {
            $result = ildiz($num);
            echo "Kvadrat ildiz: " . $result . "<br><br>";
        } catch (Exception $e) {
            echo "<p style='color: red;'>Xatolik: " . $e->getMessage() . "</p><br>";
        }
    }
?>

<hr />

<?php
    echo "<h2>Ko'paytirish funksiyasi (parametr tekshiruvi bilan)</h2>";

    function kopaytirish($son1, $son2) {
        if (!is_numeric($son1) || !is_numeric($son2)) {
            throw new TypeError("Ikkala parametr ham son bo'lishi kerak!");
        }
        return $son1 * $son2;
    }

    $test_cases = [
        [10, 5],
        [7.5, 2],
        [10, "abc"],
        ["20", 3],
        ["xyz", 8],
        [0, 100],
        ["", 5]
    ];

    foreach ($test_cases as $case) {
        echo "Parametrlar: " . var_export($case[0], true) . " va " . var_export($case[1], true) . "<br>";
        try {
            $result = kopaytirish($case[0], $case[1]);
            echo "Ko'paytma: " . $result . "<br><br>";
        } catch (TypeError $e) {
            echo "<p style='color: red;'>Xatolik: " . $e->getMessage() . "</p><br>";
        } catch (Exception $e) {
            echo "<p style='color: red;'>Kutilmagan xatolik: " . $e->getMessage() . "</p><br>";
        }
    }
?>

<hr />