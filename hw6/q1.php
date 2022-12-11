<?php

function getSquareRoot($num)
{
    if (!is_numeric($num)) return 0;
    if ($num < 0) return 0;
    $res = $num;
    //Using Newton's Method to get result
    while ($res * $res != $num) {
        $res = ($res + $num / $res) / 2;
    }
    return $res;
}

function testGetSquareRoot()
{
    //Test for correct behavior
    $input = 9;
    $expected = 3;
    $result = getSquareRoot($input);
    if ($result == $expected) echo "Test passed for input: $input<br>";
    else echo "Test failed! Input: $input Expected: $expected Result: $result <br>";

    $input = 6.25;
    $expected = 2.5;
    $result = getSquareRoot($input);
    if ($result == $expected) echo "Test passed for input: $input<br>";
    else echo "Test failed! Input: $input Expected: $expected Result: $result <br>";

    $input = 0;
    $expected = 0;
    $result = getSquareRoot($input);
    if ($result == $expected) echo "Test passed for input: $input<br>";
    else echo "Test failed! Input: $input Expected: $expected Result: $result <br>";


    //Test for misbehavior
    $input = -1;
    $expected = 0;
    $result = getSquareRoot($input);
    if ($result == $expected) echo "Test passed for input: $input<br>";
    else echo "Test failed! Input: $input Expected: $expected Result: $result <br>";

    $input = "asd";
    $expected = 0;
    $result = getSquareRoot($input);
    if ($result == $expected) echo "Test passed for input: $input<br>";
    else echo "Test failed! Input: $input Expected: $expected Result: $result <br>";

    $input = "";
    $expected = 0;
    $result = getSquareRoot($input);
    if ($result == $expected) echo "Test passed for input: $input<br>";
    else echo "Test failed! Input: $input Expected: $expected Result: $result <br>";
}

testGetSquareRoot();