<?php
// connect to server and set variables
session_start();
// if appropriate session variables arent set, send the user back to the home page
if(!isset($_SESSION['userID']) || !isset($_SESSION['classID']) || !isset($_SESSION['className']) || !isset($_SESSION['classCode'])){
  header("Location:../home.php");
  die();
}
$servername = "127.0.0.1";
$username= "root";
$password = "";
$dbname = "loginDB";
$conn = new mysqli($servername,$username,$password,$dbname);

// make the session variables easier to use
$studentID=$_SESSION['userID'];
$classID=$_SESSION['classID'];
$className=$_SESSION['className'];
$classCode=$_SESSION['classCode'];

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- default make stuff -->
    <meta charset = "utf-8">
    <title>Progress Check Website</title>
    <link rel ="stylesheet" href="../css/styles.css">
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
            <a href="../home.php"style="color: black; text-decoration:none">Home</a>
            <a href="../class/dashboard.php"style="color: black; text-decoration:none" id="dash">Dashboard</a>
            <a href="../login/logoutPage.php"style="color: black; text-decoration:none"id="lO">Log Out</a>
        </div>
     </div>
    

     <!-- big text -->
<div class = "myDashboard">
  <b><?php echo $className?></b>
</div>

<!-- quad box/functions for the teacher to use -->

<div class ="adminBox">
    <button class="adminButton block2">Class Code:  <?php echo $classCode?></button>
    <button onclick="location.href='studentList.php';" class="adminButton block2">Student List</button>
    <button onclick = "location.href='viewAssignments.php';"class="adminButton block2">View Assignments</button>
    <button onclick = "location.href='createAssignments.php';"class="adminButton block2">Create Assignment</button>
</div>
