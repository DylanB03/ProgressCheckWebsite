<?php
session_start();
// if appropriate session variables arent set, send the user back to the home page
if(!isset($_SESSION['userID']) || !isset($_SESSION['classID'])){
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


// grab variables from the classbutton that was clicked, and set them as session variables
$_SESSION['classID']=$_GET['classID'];
$_SESSION['classCode']=$_GET["classCode"];
$_SESSION['className']=$_GET["className"];
$classID=$_SESSION['classID'];
$studentID=$_SESSION['userID'];

$sql="SELECT adminID FROM classrooms where classID = '".$classID."'";
//$result = mysqli_query($conn,$sql);
$result=$conn->query($sql);

//$row=mysqli_fetch_assoc($result);
$row=$result->fetch(PDO::FETCH_ASSOC);
$adminID=$row['adminID'];

// true = admin, false = student
if($adminID==$studentID){
   // $conn->close();
   $conn=null;
    header("Location: ../class/adminPage.php");
    die();
}
else{
    //$conn->close();
    $conn=null;
    header("Location:../class/studentPage.php");
    die();
}
?>