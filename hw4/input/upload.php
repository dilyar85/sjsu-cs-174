<?php

//Create a HTML document having upload form
echo <<< _TAG
<html>
<head>
<title>PHP Form Upload</title>
</head>
<body>
<form method="post" action="upload.php" enctype="multipart/form-data">
Select File: 
<input type="file" name="uploaded_file" size ="10"> </input>
<input type="submit" value="Upload" </input>
</form>
_TAG;

//Check the uploaded file and print out all numbers it contains
if ($_FILES) {

    $name = $_FILES['uploaded_file']['name'];

    //Only allow uploading TXT file (with ".txt" extension)
    if ($_FILES['uploaded_file']['type'] == 'text/plain' && preg_match('/^.*\.(txt)$/i ', $name)) {

        move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $name);

        $words = explode(" ", file_get_contents($name));
        $numbers = array();

        //Get each word from uploaded file and store only numbers into the array
        foreach ($words as $word) {
            if (is_numeric($word)) $numbers[] = $word;
        }

        //Print out numbers contained in uploaded file
        foreach ($numbers as $num) {
            echo "$num ";
        }

    } else {
        //User uploaded a file without ".txt" extension
        echo "Please upload a plain text file!";
    }

} else {
    echo "No text file has been uploaded";
}

echo "</body></html>";


/*
Test in browser

- Upload a file with no ".txt" as extension
OUTPUT in browser:
Please upload a plain text file!

- Upload a file with ".txt" as extension and content is "Hello,I told you 8 times how to close the 4 doors. You still left 1 open!"
OUTPUT in browser:
8 4 1

- Upload a file with ".txt" as extension and content is "Hamsik17 115 Maradona10"
OUTPUT in browser:
115

 */

