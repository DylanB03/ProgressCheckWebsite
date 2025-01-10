<?php

session_start();

// check if logged in to change nav bar
if(isset($_SESSION['userID']) && isset($_SESSION['userName']) && isset($_SESSION['userEmail'])){
  $loggedIn = true;
}else{
  $loggedIn=false;
}

// $servername = "progresschecker-server.mysql.database.azure.com";
// $username= "ywitupqynh";
// $password = "accessProgress123!";
// $dbname = "logindb";
// $conn=mysqli_init();
// if(!$conn) {
//     die("mysqli_init failure");
// }
// mysqli_ssl_set($conn,NULL,NULL,"C:\Users\dylan\Downloads\DigiCertGlobalRootG2.crt.pem",NULL,NULL);
// mysqli_real_connect($conn,$servername,$username,$password,$dbname,3306,MYSQLI_CLIENT_SSL);
// if(mysqli_connect_errno()){
//     $conn->close();
//     die('Failed to connect to MySQL: '.mysqli_connect_error());
// }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- default make stuff -->
    <meta charset = "utf-8">
    <title>Progress Check Website</title>
    <link rel ="icon" href="img/logo.png"/>
    <link rel ="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
</head> 

<body>


    <div class="nav-bar" style="font-size: 30px">
            
      <img src="img/logo.png" 
        width = "100"
        height = "100"
        alt = "logo"  
        id="logo"
        style="border-right: 3px solid black">
        
        <div class ="stuff">
           <!-- nav bar, hyper links to other pages. color and text decoration removes the default blue underline for hlinks  -->
            <a href="index.php"style="color: black; text-decoration:none">Home</a>
            <?php if($loggedIn) : ?>
            <a href="class/dashboard.php"style="color: black; text-decoration:none"id="dash">Dashboard</a> <?php endif;?>
            <?php if($loggedIn==false):?>
            <a href="login/createAccount.php"style="color: black; text-decoration:none">Create Account</a>
            <a href="login/loginPage.php"style="color: black; text-decoration:none"id="lP">Sign In</a><?php endif;?>
            <a href="login/logoutPage.php"style="color: black; text-decoration:none"id="lO">Log Out</a>
        </div>
     </div>

    <div class="title" style  = "font-size: 80px">

      <strong>Progress Check</strong>

    </div>

</body>
</html>