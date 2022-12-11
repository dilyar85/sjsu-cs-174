<?php

//Ending the session
function destroySessionAndData()
{
    $_SESSION = array();
    setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();
}


destroySessionAndData();
echo "Logout Successfully!<br>";
echo "<a href='index.php'>Click here to go to home page.";