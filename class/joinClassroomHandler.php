<?php
session_start();
// if appropriate session variables arent set, send the user back to the home page
if(!isset($_SESSION['userID'])){
    header("Location:../index.php");
    die();
  }

// connect to server
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

$code = $_POST['classroomCode'];
$studentID = $_SESSION['userID'];

// get classid and name where the code matches
$sql= "SELECT classID,className FROM classrooms WHERE classCode = '".$code."'";

//$result = mysqli_query($conn,$sql);
$result=$conn->query($sql);

// does the code exist in the table or not
//if(mysqli_num_rows($result)>0){
if($result->rowCount()>0){
    //$row = mysqli_fetch_assoc($result);
    $row=$result->fetch(PDO::FETCH_ASSOC);
    $tmp = $row['classID'];
    $sql2 = "INSERT INTO enrolled (classID, studentID) VALUES ('$tmp','$studentID')";
    //$result2 = mysqli_query($conn,$sql2);
    $result2=$conn->query($sql2);

    $_SESSION['classID']=$tmp;
    $_SESSION['className'] = $row['className'];
    $_SESSION['classCode']=$code;
   // $conn->close();
   $conn=null;
    header("Location: ../class/classPageRedirect.php");
    die();
}else{
    //$conn->close();
    $conn=null;
    header("Location: ../class/dashboardCodeNoExist.php");
    die();
}