<?php
session_start();
if(isset($_SESSION['userID']) && isset($_SESSION['userName']) && isset($_SESSION['userEmail'])){
  $loggedIn = true;
}else{
  $loggedIn=false;
}
?>
<!DOCTYPE HTML>
<html lang="en" dir="ltr">
<head>
    <meta charset = "utf-8">
    <title>Progress Check Website</title>
    <link rel ="icon" href="../img/logo.png"/>
    <link rel ="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="ht../tps://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
</head>
<div class="nav-bar" style="font-size: 30px">
    <div class = "nav-container">
            
            <img src="../img/logo.png" 
              width = "40"
              height = "40"
              alt = "logo"
              id="logo"
              style="border: 1px solid black">
              
              <div class ="stuff">
                 <!-- nav bar, hyper links to other pages. color and text decoration removes the default blue underline for hlinks  -->
                  <a href="../index.php"style="color: black; text-decoration:none">Home</a>
                  <?php if($loggedIn) : ?>
                  <a href="../class/dashboard.php"style="color: black; text-decoration:none">Dashboard</a><?php endif;?>
                  <?php if($loggedIn==false):?>
                  <a href="../login/createAccount.php"style="color: black; text-decoration:none">Create Account</a>
                  <a href="../login/loginPage.php"style="color: black; text-decoration:none">Sign In</a><?php endif;?>
                  <a href="../login/logoutPage.php"style="color: black; text-decoration:none">Log Out</a>
              </div>
                  </div>
           </div>

<div class = "content">
<div class = "title" style = "font-size: 60px">
<strong>Logged In Successfuly</strong>
</div>
</html>