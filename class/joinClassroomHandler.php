<?php
session_start();
// if appropriate session variables arent set, send the user back to the home page
if(!isset($_SESSION['userID'])){
    header("Location:../index.php");
    die();
  }

// connect to server
$servername = "progresschecker-server.mysql.database.azure.com";
$username= "ywitupqynh";
$password = "accessProgress123!";
$dbname = "loginDB";

$conn = new mysqli($servername,$username,$password,$dbname);

$code = $_POST['classroomCode'];
$studentID = $_SESSION['userID'];

// get classid and name where the code matches
$sql= "SELECT classID,className FROM classrooms WHERE classCode = '".$code."'";

$result = mysqli_query($conn,$sql);

// does the code exist in the table or not
if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    $tmp = $row['classID'];
    $sql2 = "INSERT INTO enrolled (classID, studentID) VALUES ('$tmp','$studentID')";
    $result2 = mysqli_query($conn,$sql2);

    $_SESSION['classID']=$tmp;
    $_SESSION['className'] = $row['className'];
    $_SESSION['classCode']=$code;
    $conn->close();
    header("Location: ../class/classPageRedirect.php");
    die();
}else{
    $conn->close();
    header("Location: ../class/dashboardCodeNoExist.php");
    die();
}