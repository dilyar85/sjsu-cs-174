<?php
$hn = 'localhost';
$un = 'username';
$pw = 'password';
$db = 'publications';

$con = new mysqli($hn, $un, $pw, $db);

if ($con->connect_error) die($con->connect_error);

$query = "SELECT * FROM tableName";
$result = $con->query($query);
if (!$result) die($con->error);

$num_of_rows = $result->num_of_rows;

