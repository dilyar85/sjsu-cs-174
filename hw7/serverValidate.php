<?php

if (isset($_POST['username'])) $username = fix_string($_POST['username']);
if (isset($_POST['email'])) $email = fix_string($_POST['email']);
if (isset($_POST['password'])) $password = fix_string($_POST['password']);
$fail = validateUsername($username);
$fail .= validatePassword($password);
$fail .= validateEmail($email);

if ($fail == "") echo "Validate Successfully!<br>Username: $username<br>Email: $email<br>Password: $password";
else echo $fail;


function validateUsername($field)
{
    if ($field == "") return "Username is empty.<br>";
    if (preg_match("/[^a-zA-Z0-9_-]/", $field))
        return "The username can contain English letters (capitalized or not), digits, and the characters '_' (underscore) and '-' (dash). Nothing else.<br>";
    return "";
}

function validateEmail($field)
{
    if ($field == "") return "Email is empty.<br>";
    if (!((strpos($field, ".") > 0) && (strpos($field, "@") > 0) || preg_match("/[^a-zA-Z0-9.@_-]/", $field)))
        return "The email must be well formatted<br>";
    return "";
}

function validatePassword($field)
{
    if ($field == "") return "Password is empty.<br>";
    if (strlen($field) < 6) return "Passwords must be at lease 6 characters<br>";
    if (!preg_match("/[a-z]/", $field) ||
        !preg_match("/[a-z]/", $field) ||
        !preg_match("/[0-9]/", $field))
        return "Password must have lower case, upper case, and digits together<br>";
    return "";
}

function fix_string($string)
{
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return htmlentities($string);
}