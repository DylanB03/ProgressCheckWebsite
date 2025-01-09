<?php
// connect and set variables
session_start();
// if appropriate session variables arent set, send the user back to the home page
if(!isset($_SESSION['userID']) || !isset($_SESSION['classID']) || !isset($_SESSION['className']) || !isset($_SESSION['classCode'])){
  header("Location:../index.php");
  die();
}
$servername = "165.227.46.101";
$username= "user1";
$password = "access";
$dbname = "loginDB";
//$conn = new mysqli($servername,$username,$password,$dbname);
try{
  $conn = new PDO("mysql:host=localhost;dbname=$dbname",$username,$password);
  } catch (PDOException $e){
      die("Failed to connect to database: ". $e->getMessage());
  }

unset($_SESSION['taskID']);

$studentID=$_SESSION['userID'];
$classID=$_SESSION['classID'];
$className=$_SESSION['className'];
$classCode=$_SESSION['classCode'];

$taskName=$_GET['taskName'];
$taskID=$_GET['taskID'];
$desc=$_GET['description'];
$_SESSION['taskID']=$taskID;

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- default make stuff -->
    <meta charset = "utf-8">
    <title>Progress Check Website</title>
    <link rel ="icon" href="../img/logo.png"/>
    <link rel ="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="ht../tps://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
    <script src = "../js/script.js"></script>
</head> 

<body>

    <div class="nav-bar" style="font-size: 30px">
            
      <img src="../img/logo.png" 
        width = "100"
        height = "100"
        alt = "logo"  
        id="logo"
        style="border-right: 3px solid black">
        
        <div class ="stuff">
           <!-- nav bar, hyper links to other pages. color and text decoration removes the default blue underline for hlinks  -->
            <a href="../index.php"style="color: black; text-decoration:none">Home</a>
            <a href="../class/dashboard.php"style="color: black; text-decoration:none" id="dash">Dashboard</a>
            <a href="../login/logoutPage.php"style="color: black; text-decoration:none"id="lO">Log Out</a>
        </div>
     </div>
    
<!-- big text -->
<div class = "myDashboard">
  <b><?php echo $className."   - ".$taskName." Assignment"?></b>
</div>

<!-- home button -->
<div class = "homeButton">
  <button onclick="location.href='../class/classPageRedirect.php';" style ="border:0;background:transparent;float:right;margin-top:5px">
  <img src ="../img/home.png" style="height:50px;width:50px;border-radius:25px;overflow:hidden"></button>
</div>

<div class = "taskDescription">
<b><?php echo $desc?></b>
</div>

<!-- form with comments and color -->
<div class = "enterInfoLogin">
<!-- collect user input, create form class to connect to the login handler -->
<form class = "loginInput" action="submit.php" method ="post">

<!-- Multiple chocie -->
  <div class = "colorSelect">
<label>
  <input type = "radio" class = "text-field"id="color" name="color" value ="red" required>
  <img src = "../img/red.png" style="height:100px;width:100px;border-radius:50px;margin-left:40%;"></label>
<label><input type = "radio" class = "text-field" id="color"name="color" value ="yellow">
<img src="../img/yellow.png"style="height:100px;width:100px;border-radius:50px"></label>
<label><input type = "radio" class = "text-field"id="color" name="color" value ="green">
<img src="../img/green.png"style="height:100px;width:100px;border-radius:50px"></label>
  </div>
    <input class = "text-field" type="text" id="comment" name = "comment" placeholder="Additional Comments for Your Teacher" style="padding-bottom:50px;margin-top:30px">
    <input class = "w3-cyan w3-hover-light-green w3-border-0 text-field" type="submit" value="Submit">
</div>
</div>