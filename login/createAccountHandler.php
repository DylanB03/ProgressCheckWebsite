<!-- connect to databse, all default + no password-->

<?php
echo "setting variables";
$servername = "165.227.46.101";
$username= "user1";
$password = "access";
$dbname = "loginDB";
echo "variables set";

//code for microsoft azure
// echo "connect";
// $conn=mysqli_init();
// echo "line 1";
// if(!$conn) {
//     die("mysqli_init failure");
// }
// echo "line 2";
// mysqli_ssl_set($conn,NULL,NULL,"../var/DigiCertGlobalRootCA.crt.pem",NULL,NULL);
// echo "line 3";
// mysqli_real_connect($conn,$servername,$username,$password,$dbname,3306, MYSQLI_CLIENT_SSL);
// if(mysqli_connect_errno()){
//     $conn->close();
//     die('Failed to connect to MySQL: '.mysqli_connect_error());
// }
// echo "line 5";

// connect databse through mysql

//$conn = new mysqli($servername,$username,$password,$dbname); 

//digital ocean pdo object format

try{
$conn = new PDO("mysql:host=localhost;dbname=$dbname",$username,$password);
} catch (PDOException $e){
    die("Failed to connect to database: ". $e->getMessage());
}
echo "connected";

// get variables from the createAccount form

$txtname = $_POST['personname'];
$txtemail  =$_POST['email'];
$txtpass = $_POST['passcode'];
$txtpass2 = $_POST['passcode2'];


// error_log("Password 1 = ", $txtpass);
// error_log("Password 2 = ", $txtpass2);

echo "before";

// check if passcode1 == passcode2
if($txtpass != $txtpass2){
    echo "here";
    //mysqli_close($conn);
    $conn = null;
    echo "2";
   header("Location: ../login/createAccountWrongPass.php");
  // header("Location: ../index.php");
    die();
}

echo "checked if passwords matched";


$sql = "INSERT INTO loginInfo (personname,email,passcode) VALUES ('$txtname','$txtemail','$txtpass')";

echo "inserted";

// if email already exists, send back to create account handler, else, create account
$sql2= "SELECT email FROM loginInfo 
WHERE email='".$_POST['email']."'";
//$result2=mysqli_query($conn,$sql2);
$result2 = $conn->query($sql2);

echo "selected";
error_log("number 2");

//if(mysqli_num_rows($result2)==0){
if($result2->rowCount()==0){
//$result=mysqli_query($conn,$sql);
$conn->exec($sql);
echo "queried";
//mysqli_close($conn);
$conn=null;
header("Location:../login/createSuccessful.php");
die();
}else{
    echo "second else";
   // mysqli_close($conn);
   $conn=null;
    header("Location: ../login/createAccountWrongPass.php");
    die();  
}


?>