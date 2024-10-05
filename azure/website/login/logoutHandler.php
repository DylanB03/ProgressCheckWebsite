<!-- destroy session -->

<?php

session_start();


// unset variables
unset($_SESSION['personID']['personname']['email']['passcode']['classID']['classCode']['taskID']);


// destroy session
session_destroy();

header("Location: ../home.php");

exit;

?>