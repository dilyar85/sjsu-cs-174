<?php

$hn = 'localhost';
$un = 'username';
$pw = 'password';
$db = 'publications';

$con = new mysqli($hn, $un, $pw, $db);
if ($con->connect_error) die($con->connect_error);
