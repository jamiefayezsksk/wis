<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $a = 42;
    $b = 20;

    echo "Operator Types<br/><br/>";

    $c = $a + $b;
    echo "Addition Operation Result: $c <br/><br/>";
    $c = $a - $b;
    echo "Subtraction Operation Result: $c <br/><br/>";
    $c = $a * $b;
    echo "Multiplication Operation Result: $c <br/><br/>";
    $c = $a / $b;
    echo "Division Operation Result: $c <br/><br/>";
    $c = $a % $b;
    echo "Modulus Operation Result: $c <br/><br/>";
    $c = $a++;
    echo "Increment Operation Result: $c <br/><br/>";
    $c = $a--;
    echo "Decrement Operation Result: $c <br/><br/>";
    ?>
</body>

</html>