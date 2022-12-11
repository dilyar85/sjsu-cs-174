<?php
$db_host        = 'localhost';
$db_user        = 'root';
$db_pass        = '';
$db_database    = 'hw2_database'; 

$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);

$query = $db->query("SELECT * FROM table1");

while ($row = $query->fetch())
{

    $firstName = $row['first_name'];
    $lastName = $row['last_name'];

    echo <<<_TAG
        Last Name: $lastName , First Name: $firstName. <br/>
_TAG;

}
?>