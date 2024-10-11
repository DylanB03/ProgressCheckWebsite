<!-- connect to databse, all default + no password-->

<?php
echo "setting variables";
$servername = "progresschecker-server.mysql.database.azure.com";
$username= "ywitupqynh";
$password = "accessProgress123!";
$dbname = "loginDB";
echo "variables set";


echo "connect";
$conn=mysqli_init();
echo "line 1";
if(!$conn) {
    die("mysqli_init failure");
}
echo "line 2";
mysqli_ssl_set($conn,NULL,NULL,"C:\Users\dylan\Downloads\DigiCertGlobalRootG2.crt.pem",NULL,NULL);
echo "line 3";
mysqli_real_connect($conn,$servername,$username,$password,$dbname,3306,MYSQLI_CLIENT_SSL);
echo "line 4";
if(mysqli_connect_errno()){
    $conn->close();
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}
echo "line 5";
// connect databse through mysql

//$conn = new mysqli($servername,$username,$password,$dbname);    

// get variables from the createAccount form

$txtname = $_POST['personname'];
$txtemail  =$_POST['email'];
$txtpass = $_POST['passcode'];
$txtpass2 = $_POST['passcode2'];

// check if passcode1 == passcode2
if($txtpass != $txtpass2){
    mysqli_close($conn);
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
mysqli_close($conn);
header("Location:../login/createSuccessful.php");
die();
}
else{
    mysqli_close($conn);
    header("Location: ../login/createAccountWrongPass.php");
    die();  
}


?>