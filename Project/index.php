<?php
require_once "login.php";
require_once "initDatabase.php";
?>

    <!DOCTYPE html>
    <head>
        <title>CS174 Final Project Anti-virus Application</title>

        <script>


        </script>
    </head>

    <body>

    <div>
        <b><a href="admin.php">Click here to login as Admin</a></b>
    </div>

    <div>
        <form action="index.php" method="post" enctype="multipart/form-data">
            Select a file to test if it is infected<br>
            <input type="file" name="testFile">
            <input type="submit" name="submit" value="Test">
        </form>
    </div>
    </body>


<?php
if (isset($_POST["submit"]) != "") {

    //Check if user selects a file
    if ($_FILES['testFile']['size'] === 0) {
        echo "Please select a file to check.";
        return;
    }

    $name = $_FILES["testFile"]["name"];
    $path = $_FILES["testFile"]["tmp_name"];

    echo "Checking virus on file $name...<br>";

    $content = file_get_contents($path);
    $len = filesize($path);
    $binaryContent = "";
    for ($i = 0; $i < $len; $i++) $binaryContent .= sprintf("%08b", ord($content[$i]));

    $con = new mysqli($hn, $un, $pw, $db);
    if ($con->connect_error) die($con->connect_error);
    $result = $con->query("SELECT * FROM MalwareTable");
    if (!$result) die($con->error);

    $found = false;
    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_row();
        //Must use !== to check if it returns false
        if (strpos($binaryContent, $row[1]) !== false) {
            echo "Found a virus on this file. Virus name: $row[0] <br>";
            $found = true;
            break;
        }
    }
    if ($found) echo "This file is infected!";
    else echo "This file is NOT infected.";

    $result->close();
    $con->close();
}

