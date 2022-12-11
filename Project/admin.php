<?php
require_once "login.php";

$con = new mysqli($hn, $un, $pw, $db);
if ($con->connect_error) die($con->connect_error);

$errorMessage = "You must login to continue!";
$success = false;

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {

//if (isset($_SESSION['username']) && $_SESSION['password']) {
    $username = mysql_entities_fix_string($con, $_SERVER['PHP_AUTH_USER']);
    $password = mysql_entities_fix_string($con, $_SERVER['PHP_AUTH_PW']);

    //access admin's info from database
    $queryString = "SELECT * FROM AdminTable WHERE username='$username'";
    $result = $con->query($queryString);
    if (!$result) die($con->error);

    //Check if username exists
    if ($result->num_rows != 0) {
        $row = $result->fetch_row();

        $salt1 = "ew&*d";
        $salt2 = "ds+#a";
        $token = hash("ripemd128", "$salt1$password$salt2");
        //check password
        if ($token == $row[1]) {

            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $success = true;
        }
        //Wrong password
        else $errorMessage = "Failed to login as Admin";

    } //there is no admin row found in database
    else $errorMessage = "Failed to login as Admin!";

}
//PHP_AUTH_USER or PHP_AUTH_PW not set
else {
    header('WWW-Authenticate: Basic realm="Restricted Section"');
    header('HTTP/1.0 401 Unauthorized');
}


if (!$success) {
    echo "$errorMessage <br>";
    echo "<b><a href=\"admin.php\">Click here to login again</a></b>";
    $con->close();
    return;
}


//Store Malware into Database
if (isset($_POST["submit"])) {
    $malwareName = fix_string($_POST["malwareName"]);

    $name = $_FILES["malwareFile"]["name"];
    $path = $_FILES["adminFile"]["tmp_name"];
    echo "Uploading Malware File  $name... <br>";
    // first check if this malicious content exist in the database already.
    $result = $con->query("SELECT * FROM infected_info WHERE name='$malwareName'");
    if (!$result) die($con->error);
    // if the select query has length 0, which means that this malicious content doesn't exist in the database
    if ($result->num_rows !== 0) {
        echo "This Malware Name already exists in the database.<br>";
        echo "Please change the name and try again!<br>";
    } else {
        $content = file_get_contents($path); // get all content of the file
        $len = filesize($path); // get the length of all content
        $binaryContent = "";
        // if the length of all content is less that 20, we select all content. Otherwise we will select
        // the first 20 words in the file
        for ($i = 0; $i < ($len < 20 ? $len : 20); $i++) {
            // convert each word into binary format
            $binaryContent .= sprintf("%08b", ord($content[$i]));
        }
        // insert the malicious content into database (name, content)
        storeMalware($con, $malwareName, $binaryContent);
        echo "Upload Malware Successfully!";
    }
    $result->close();
}
$con->close();


//Store the Malware File and Malware Name into Database
function storeMalware($con, $malwareName, $binaryContent)
{
    $query = "INSERT INTO MalwareTable VALUES($malwareName, $binaryContent)";
    $result = $con->query($query);
    if (!$result) die($con->error);
}

function mysql_fix_string($con, $string)
{
    if (get_magic_quotes_gpc()) $string = stripcslashes($string);
    return $con->real_escape_string($string);
}

function mysql_entities_fix_string($con, $string)
{
    return htmlentities(mysql_fix_string($con, $string));
}

// helper function for reading variable from html input
function fix_string($string)
{
    if (get_magic_quotes_gpc())
        $string = stripslashes($string);
    return htmlentities($string);
}



?>

<!DOCTYPE html>
<head>
    <title>Admin Upload Malware Page</title>

    <script>
        function validateMalwareName(form){
            var malwareName = form.malwareName.value
            if (malwareName == "") {
                alert("Malware Name cannot be empty!")
                return false
            }
            if(/[^a-zA-Z0-9]/.test(malwareName)){
                alert("Malware mame must only contain letters and digits")
                return false
            }
            return true
        }


    </script>
</head>
<p>Hello Admin!<br></p>
<form action="admin.php" method="post" enctype="multipart/form-data" onsubmit="return validateMalwareName(this)">
    Enter Malware Name:
    <input type="text" name="malwareName">
    <input type="file" name="malwareFile">
    <input type="submit" name="submit" value="Upload">
</form>
<a href="adminLogout.php">Log out</a>


