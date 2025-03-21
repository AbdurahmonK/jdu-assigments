### 1.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Seminar Jadvali</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            border: 1px solid black;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th rowspan="2">Day</th>
                <th colspan="2">Schedule</th>
                <th rowspan="2">Topic</th>
            </tr>
            <tr>
                <th>Begin</th>
                <th>End</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Monday</td>
                <td>8:00 a.m.</td>
                <td>5:00 p.m.</td>
                <td>Introduction to XML <br> Validity: DTD and Relax NG</td>
            </tr>
            <tr>
                <td rowspan="3">Tuesday</td>
                <td>8:00 a.m.</td>
                <td>11:00 a.m.</td>
                <td>XPath</td>
            </tr>
            <tr>
                <td>11:00 a.m.</td>
                <td>2:00 p.m.</td>
                <td rowspan="2">XSL Transformations</td>
            </tr>
            <tr>
                <td>2:00 p.m.</td>
                <td>5:00 p.m.</td>
            </tr>
            <tr>
                <td>Wednesday</td>
                <td>8:00 a.m.</td>
                <td>12:00 p.m.</td>
                <td>XSL Formatting Objects</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
```

---

### 2.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Basic HTML Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            border: 1px solid black;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Basic HTML Table</h2>

    <table>
        <thead>
            <tr>
                <th>Level1</th>
                <th>Level2</th>
                <th>Level3</th>
                <th>Info</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="6">System</td>
                <td rowspan="2">System Apps</td>
                <td>SystemEnv</td>
                <td>App Test</td>
                <td>foo</td>
            </tr>
            <tr>
                <td>SystemEnv</td>
                <td>App Memory</td>
                <td>foo</td>
            </tr>
            <tr>
                <td rowspan="4">System Memory</td>
                <td>SystemEnv2</td>
                <td>App Test</td>
                <td>bar</td>
            </tr>
            <tr>
                <td>SystemEnv2</td>
                <td>App Test</td>
                <td>bar</td>
            </tr>
            <tr>
                <td>Memeory Test</td>
                <td>Memory Func</td>
                <td>foo</td>
            </tr>
            <tr>
                <td>Memeory Test</td>
                <td>Apes Test</td>
                <td>foo</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
```

---

### 3.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Jadval Tartibi</title>
    <style>
        table {
            width: 600px; /* Jadval kengligi */
            margin: 20px auto; /* Markazga joylashish */
            border-collapse: collapse; /* Chegaralarni birlashtirish */
        }
        td {
            border: 1px solid black; /* Katak chegarasi */
            text-align: center; /* Matnni markazga joylashish */
            padding: 10px; /* Ichki bo'shliq */
        }
    </style>
</head>
<body>

    <table>
        <tr>
            <td colspan="6">1</td>
        </tr>
        <tr>
            <td rowspan="2" colspan="2">2</td>
            <td rowspan="2" colspan="2">3</td>
            <td colspan="2">4</td>
        </tr>
        <tr>
            <td>5</td>
            <td>6</td>
        </tr>
        <tr>
            <td colspan="6">7</td>
        </tr>
    </table>

</body>
</html>
```

---

### 4.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Jadval Tartibi</title>
    <style>
        table {
            width: 600px; /* Jadval kengligi */
            margin: 20px auto; /* Markazga joylashish */
            border-collapse: collapse; /* Chegaralarni birlashtirish */
        }
        td {
            border: 1px solid black; /* Katak chegarasi */
            text-align: center; /* Matnni markazga joylashish */
            padding: 10px; /* Ichki bo'shliq */
        }
    </style>
</head>
<body>

    <table>
        <tr>
            <td colspan="2" rowspan="2"></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td rowspan="2" colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="3"></td>
        </tr>
    </table>

</body>
</html>
```

---

### 5.
```html
<!DOCTYPE html>
<html>
<head>
    <title>Jadval Tartibi</title>
    <style>
        table {
            width: 600px;
            height: 600px;
            margin: 20px auto;
            border-collapse: collapse;
        }
        td {
            border: 1px solid black;
        }
    </style>
</head>
<body>

    <table>
        <tr>
            <td colspan="11"></td>
        </tr>
        <tr>
            <td rowspan="9"></td>
            <td colspan="9"></td>
            <td rowspan="9"></td>
        </tr>
        <tr>
            <td rowspan="7"></td>
            <td colspan="7"></td>
            <td rowspan="7"></td>
        </tr>
        <tr>
            <td rowspan="5"></td>
            <td colspan="5"></td>
            <td rowspan="5"></td>
        </tr>
        <tr>
            <td rowspan="3"></td>
            <td colspan="3"></td>
            <td rowspan="3"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td colspan="9"></td>
        </tr>
        <tr>
            <td colspan="11"></td>
        </tr>
    </table>

</body>
</html>
```