<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variable Types</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Variable Types</h1>

    <div class="container">
        <h4>Integers</h4>
        <?php
        print "Integers <br>";
        $int_var = 12345;
        print $int_var . "<br>";
        $another_int = -12345 + 12345;
        print $another_int . "<br><br>";
        ?>
    </div>

    <div class="container">
        <h4>Doubles</h4>
        <?php
        $many = 2.2888800;
        $many_2 = 2.2111200;
        $few = $many + $many_2;
        print($many + $many_2 . " = $few<br>");
        ?>
    </div>

    <div class="container">
        <h4>Boolean</h4>
        <?php
        if (TRUE)
            print("This will always print<br>");
        else
            print("This will never print<br>");
        ?>
    </div>

    <div class="container">
        <h4>Other Types of Boolean</h4>
        <?php
        $true_num = 3 + 0.14159;
        $true_str = "Tried and true";
        $true_array[49] = "An array element";
        $false_array = array();
        $false_null = NULL;
        $false_num = 999 - 999;

        print "true_num: " . $true_num . "<br>";
        print "true_str: " . $true_str . "<br>";
        print "true_array[49]: " . $true_array[49] . "<br>";
        print "false_array: " . var_export($false_array, true) . "<br>";
        print "false_null: " . var_export($false_null, true) . "<br>";
        print "false_num: " . $false_num . "<br>";
        ?>
    </div>

    <div class="container">
        <h4>Null</h4>
        <?php
        $my_var = null;
        ?>
    </div>

    <div class="container">
        <h4>Strings</h4>
        <?php
        $string_1 = "This is a string in double quotes";
        $string_2 = "This is a somewhat longer, singly quoted string";
        $string_39 = "This string has thirty-nine characters";
        $string_0 = ""; // a string with zero characters
        
        $variable = "name";
        $literally = 'My $variable will not print!<br>';
        echo $literally;
        $literally = "My $variable will print!<br>";
        echo $literally;
        ?>
    </div>

    <div class="container">
        <h4>Here Document</h4>
        <?php
        $channel = <<<_XML_
        <channel>
        <title>What's For Dinner</title>
        <link>http://menu.example.com/</link>
        <description>Choose what to eat tonight.</description>
        </channel>
        _XML_;
        
        echo <<<END
        This uses the "here document" syntax to output
        multiple lines with variable interpolation. Note
        that the here document terminator must appear on a
        line with just a semicolon. no extra whitespace!
        <br />
        END;
        print $channel . "<br>";
        ?>
    </div>

    <div class="container">
        <h4>PHP Local Variables</h4>
        <?php
        $x = 4;

        function assignx()
        {
            global $x; // Use the globalkeyword to access the global variable $x
            $x = 0;
            print "\$x inside function is $x. ";
        }

        assignx();
        print "\$x outside of function is $x. <br>";
        ?>
    </div>

    <div class="container">
        <h4>PHP Function Parameters</h4>
        <?php
        // multiply a value by 10 and return it to the caller
        function multiply($value)
        {
            $value = $value * 10;
            return $value;
        }
        $retval = multiply(10);
        print "Return value is $retval <br>";
        ?>
    </div>

    <div class="container">
        <h4>PHP Global Variables</h4>
        <?php
        $somevar = 15;
        function addit()
        {
            global $somevar;
            $somevar++;
            print "Somevar is $somevar";
        }
        addit();
        print "<br>";
        ?>
    </div>

    <div class="container">
        <h4>PHP Static Variables</h4>
        <?php
        function keep_track()
        {
            static $count = 0;
            $count++;
            print $count;
            print "<br>";
        }

        keep_track();
        keep_track();
        keep_track();
        ?>
    </div>
</body>

</html>