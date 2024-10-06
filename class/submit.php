<?php
// connect set vars
session_start();
// if appropriate session variables arent set, send the user back to the home page
if(!isset($_SESSION['userID']) || !isset($_SESSION['classID']) || !isset($_SESSION['className']) || !isset($_SESSION['classCode']) || !isset($_SESSION['taskID'])){
    header("Location:../index.php");
    die();
  }
  $servername = "progresschecker-server.mysql.database.azure.com";
  $username= "ywitupqynh";
  $password = "accessProgress123!";
  $dbname = "loginDB";
$conn = new mysqli($servername,$username,$password,$dbname);

$studentID=$_SESSION['userID'];
$classID=$_SESSION['classID'];
$className=$_SESSION['className'];
$classCode=$_SESSION['classCode'];
$taskID=$_SESSION['taskID'];

// grab the color and comment from the form submission
$color=$_POST['color'];
$comment=$_POST['comment'];

// first see if the submission already exists, to either replace it or create a new one

$conn=new mysqli($servername,$username,$password,$dbname);

$sql ="SELECT submitID FROM submitted WHERE taskID='".$taskID."' AND studentID='".$studentID."'";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    $tmp=$row['submitID'];
    $sql2="UPDATE submitted SET studentID='".$studentID."', taskID='".$taskID."',color='".$color."',comment='".$comment."'
    WHERE submitID='".$tmp."'";
    $result2=mysqli_query($conn,$sql2);
     $conn->close();
     header("Location: ../class/studentPage.php");
     die();
} else{

$sql2="INSERT INTO submitted(studentID,taskID,color,comment)
VALUES ('$studentID','$taskID','$color','$comment')";
$result2=mysqli_query($conn,$sql2);
$conn->close();
header("Location:../class/studentPage.php");
die();
    
}