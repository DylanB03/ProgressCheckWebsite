<?php
// connect
session_start();
// if appropriate session variables arent set, send the user back to the home page
if(!isset($_SESSION['userID']) || !isset($_SESSION['classID'])){
    header("Location:../home.php");
    die();
  }
$servername = "127.0.0.1";
$username= "root";
$password = "";
$dbname = "loginDB";
$conn = new mysqli($servername,$username,$password,$dbname);


// check if student is admin of current classroom
$studentID = $_SESSION['userID'];
$classID = $_SESSION['classID'];
$sql="SELECT adminID FROM classrooms WHERE classID = '".$classID."'";
$result=mysqli_query($conn,$sql);

$row=mysqli_fetch_assoc($result);
$adminID=$row['adminID'];

// true = admin, false = student
if($adminID==$studentID){
    $conn->close();
    header("Location: ../class/adminPage.php");
    die();
}
else{
    $conn->close();
    header("Location: ../class/studentPage.php");
    die();
}
?>
