<?php
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


// grab variables from the classbutton that was clicked, and set them as session variables
$_SESSION['classID']=$_GET['classID'];
$_SESSION['classCode']=$_GET["classCode"];
$_SESSION['className']=$_GET["className"];
$classID=$_SESSION['classID'];
$studentID=$_SESSION['userID'];

$sql="SELECT adminID FROM classrooms where classID = '".$classID."'";
$result = mysqli_query($conn,$sql);

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
    header("Location:../class/studentPage.php");
    die();
}
?>