<?php
// connect and set variables
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

// create variables
$studentID=$_SESSION['userID'];
$classID=$_SESSION['classID'];
$className=$_SESSION['className'];
$classCode=$_SESSION['classCode'];

// take information from the create assignment form
$taskName=$_POST['taskName'];
$description=$_POST['description'];

// insert var into database
$sql="INSERT INTO tasks (classID, taskName, taskDescription) VALUES ('$classID','$taskName','$description')";
$result=mysqli_query($conn,$sql);

$conn->close();
header("Location: ../class/adminPage.php");
die();

?>