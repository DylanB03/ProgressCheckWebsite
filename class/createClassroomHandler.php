<?php
// connect, set vars, and increase temp memory limit so the code generator can run
session_start();
ini_set("memory_limit","16M");
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

// generate code using the $x possible characters, length 5
function generateCode($length=5){
 return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',ceil($length/strlen($x)) )),1,$length);
}

// get the classroomname from the create classroom form, create an autogenerated code, and insert it into the database, the current userID is the admin
$className = $_POST['classroomName'];
$code  = "".generateCode()."";
$tmp = $_SESSION['userID'];

$sql="INSERT INTO classrooms (classCode, adminID, className) VALUES ('$code','$tmp','$className')";


// if the code generated already exists, it will keep making new ones until its not new
$result=mysqli_query($conn,$sql);
while(!$result){
    $code=generateCode();
    $tmp = $_SESSION['userID'];
    $sql="INSERT INTO classrooms (classCode, adminID, className) VALUES ('$code','$tmp','$className')";
}

$classID_query = "SELECT classID FROM classrooms
WHERE classCode='".$code."'";
$classID = mysqli_fetch_assoc(mysqli_query($conn,$classID_query));

// make the creator of the class enrolled
$tmp2 = $classID["classID"];
$enroll = "INSERT INTO enrolled (classID, studentID) VALUES ('$tmp2','$tmp')";

$result2=mysqli_query($conn,$enroll);


$conn->close();
header("Location:../class/dashboard.php");
die();

?>
