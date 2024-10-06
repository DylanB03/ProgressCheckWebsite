<!-- connect to databse, all default + no password-->

<?php
$servername = "progresschecker-server.mysql.database.azure.com";
$username= "ywitupqynh";
$password = "accessProgress123!";
$dbname = "loginDB";

/*
$conn=mysqli_init();
if(!$conn) {
    die("mysqli_init failure");
}
mysqli_ssl_set($conn,NULL,NULL,"C:\Users\dylan\Downloads\DigiCertGlobalRootG2.crt.pem",NULL,NULL);
mysqli_real_connect($conn,$servername,$username,$password,$dbname,3306,MYSQLI_CLIENT_SSL);
if(mysqli_connect_errno()){
    $conn->close();
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}*/
// connect databse through mysql

$conn = new mysqli($servername,$username,$password,$dbname);

// get variables from the createAccount form

$txtname = $_POST['personname'];
$txtemail  =$_POST['email'];
$txtpass = $_POST['passcode'];
$txtpass2 = $_POST['passcode2'];

// check if passcode1 == passcode2
if($txtpass != $txtpass2){
    $conn->close();
    header("Location: ../login/createAccountWrongPass.php");
    die();
}



$sql = "INSERT INTO loginInfo (personname,email,passcode) VALUES ('$txtname','$txtemail','$txtpass')";

// if email already exists, send back to create account handler, else, create account
$sql2= "SELECT email FROM loginInfo 
WHERE email='".$_POST['email']."'";
$result2=mysqli_query($conn,$sql2);

if(mysqli_num_rows($result2)==0){
$result=mysqli_query($conn,$sql);
$conn->close();
header("Location:../login/createSuccessful.php");
die();
}
else{
    $conn->close();
    header("Location: ../login/createAccountWrongPass.php");
    die();  
}


?>