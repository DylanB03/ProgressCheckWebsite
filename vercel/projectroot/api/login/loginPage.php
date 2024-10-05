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
    <link rel ="stylesheet" href="../css/styles.css">
</head>
<div class="nav-bar" style="font-size: 30px">
            
            <img src="../img/logo.png" 
              width = "100"
              height = "100"
              alt = "logo"
              id="logo"
              style="border-right: 3px solid black">
              
              <div class ="stuff">
                 <!-- nav bar, hyper links to other pages. color and text decoration removes the default blue underline for hlinks  -->
                  <a href="../home.php"style="color: black; text-decoration:none">Home</a>
                  <?php if($loggedIn) : ?>
                  <a href="../class/dashboard.php"style="color: black; text-decoration:none">Dashboard</a><?php endif;?>
                  <a href="../login/createAccount.php"style="color: black; text-decoration:none">Create Account</a>
                  <a href="../login/loginPage.php"style="color: black; text-decoration:none">Sign In</a>
                  <a href="../login/logoutPage.php"style="color: black; text-decoration:none">Log Out</a>
              </div>
           </div>
      
<div class = "header">
<b>Please Enter Your Information</b>
</div>


<div class = "enterInfoLogin">
<!-- collect user input, create form class to connect to the login handler -->
<form class = "loginInput" action="loginHandler.php" method ="post">

    <input class = "text-field" type="text" id = "email" name="email" placeholder="Email"required>
    <input class = "text-field" type="password" id="passcode" name = "passcode" placeholder="Password"required>
    <input class = "w3-cyan w3-hover-light-green w3-border-0 text-field" type="submit" value="Sign in">
</div>
</div>

<?php
 if(isset($_SESSION["error"])){
    $error = $_SESSION["error"];

}
?>
</form>
</html>
