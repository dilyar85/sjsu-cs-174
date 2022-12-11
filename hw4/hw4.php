<?php
//Main Function
function indexContainsDigits($n)
{
    if (!is_numeric($n)) {
        echo "Invalid input. Enter a number.";
        return;
    }
    if ($n < 1) {
        echo "Enter a positive number.";
        return;
    }

    $index = 1;
    while (true) {
        $num = getFibonacci($index);
        $numLength = strlen((string)$num);
        if ($numLength >= $n) return $index;
        $index++;
    }
    return $index;
}

//Helper function to get Fibonacci number of given index
function getFibonacci($index)
{
    return $index > 2 ? getFibonacci($index - 1) + getFibonacci($index - 2) : 1;
}

//Testing functions

//Wrong inputs
indexContainsDigits("sda");
echo "\n";
indexContainsDigits(-2);
echo "\n";

//For n = 2, it would return 7
echo indexContainsDigits(2);
echo "\n";
//For n = 3, it would return 12
echo indexContainsDigits(3);
echo "\n";
?>