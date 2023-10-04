<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?

    define("MINSIZE", 50);
    echo MINSIZE;
    echo constant("MINSIZE"); // same thing as the previous line

    // Valid constant names
    define("ONE", "first thing");
    define("TWO2", "second thing");
    define("THREE_3", "third thing")

    // Invalid constant names
    define("2TWO", "second thing");
    define("__THREE__", "third value"); 

    // Display the constants
    echo "Valid Constants:<br>";
    echo "ONE: " . ONE . "<br>";
    echo "TWO2: " . TWO2 . "<br>";
    echo "THREE_3: " . THREE_3 . "<br><br>";

    echo "Invalid Constants:<br>";
    echo "TWO2_INVALID: " . TWO2_INVALID . "<br>";
    echo "THREE_INVALID: " . THREE_INVALID . "<br>";
    ?>
</body>
</html>