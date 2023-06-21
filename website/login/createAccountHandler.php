<!-- connect to databse, all default + no password-->

<?php
$servername = "127.0.0.1";
$username= "root";
$password = "";
$dbname = "loginDB";

// connect databse through mysql

$conn = new mysqli($servername,$username,$password,$dbname);

// insert values from createaccount form into the database

$txtname = $_POST['personname'];
$txtemail  =$_POST['email'];
$txtpass = $_POST['passcode'];
$txtpass2 = $_POST['passcode2'];

if($txtpass != $txtpass2){
    $conn->close();
    header("Location: ../login/createAccountWrongPass.php");
    die();
}



$sql = "INSERT INTO loginInfo (personname,email,passcode) VALUES ('$txtname','$txtemail','$txtpass')";

// insert
$result = mysqli_query($conn, $sql);



if(mysqli_affected_rows($conn)==0){
    $conn->close();
    header("Location: ../login/createNotSuccessful.php");
    die();
}
else{
    $conn->close();
    header("Location: ../login/createSuccessful.php");
    die();
}
// disconnect



?>