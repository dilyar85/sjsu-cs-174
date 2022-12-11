<?php
require_once "login.php";
$con = new mysqli($hn, $un, $pw);
if ($con->connect_error) die($con->connect_error);

$query = "CREATE DATABASE IF NOT EXISTS $db";
$result = $con->query($query);
if (!$result) die($con->error);
$con->close();

$con = new mysqli($hn, $un, $pw, $db);

$query = "DROP TABLE IF EXISTS AdminTable";
$result = $con->query($query);

$createAdminTable = "CREATE TABLE AdminTable(username VARCHAR(20) NOT NULL UNIQUE, password VARCHAR(128) NOT NULL)";
$result = $con->query($createAdminTable);
if (!$result) die($con->error);


$query = "DROP TABLE IF EXISTS MalwareTable";
$result = $con->query($query);

$createMalwareTable = "CREATE TABLE MalwareTable(name VARCHAR(20) NOT NULL UNIQUE, content VARCHAR(65494) NOT NULL)";
$result = $con->query($createMalwareTable);
if (!$result) die($con->error);


//Add Admin's info
$salt1 = "ew&*d";
$salt2 = "ds+#a";

//Admin's info
$username = "saifuding";
$password = "8031Davi#";

$token = hash("ripemd128", "$salt1$password$salt2");

$queryString = "SELECT * FROM AdminTable WHERE username = '$username'";
$result = $con->query($queryString);
if (!$result) die($con->error);
if ($result->num_rows == 0) addUser($con, $username, $token);


$con->close();

//Add user to database
function addUser($con, $username, $token)
{
    $insertString = "INSERT INTO AdminTable Values('$username', '$token')";
    $res = $con->query($insertString);
    if (!$res) die($con->error);
}