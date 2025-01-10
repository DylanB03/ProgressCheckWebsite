<?php
// connect set vars
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

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- default make stuff -->
    <meta charset = "utf-8">
    <title>Progress Check Website</title>
    <link rel ="icon" href="../img/logo.png"/>
    <link rel ="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="ht../tps://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
    <script src = "../js/script.js"></script>
</head> 

<body>

   
<div class="nav-bar" style="font-size: 30px">
      <div class = "nav-container">
            
      <img src="../img/logo.png" 
        width = "40"
        height = "40"
        alt = "logo"  
        id="logo"
        style="border: 1px solid black">
        
        <div class ="stuff">
           <!-- nav bar, hyper links to other pages. color and text decoration removes the default blue underline for hlinks  -->
            <a href="../index.php"style="color: black; text-decoration:none">Home</a>
            <a href="../class/dashboard.php"style="color: black; text-decoration:none" id="dash">Dashboard</a>
            <a href="../login/logoutPage.php"style="color: black; text-decoration:none"id="lO">Log Out</a>
        </div>
</div>
     </div>
     <!--  big text -->

<div class = "myDashboard">
  <b><?php echo $className."   - Current Assignments"?></b>
</div>


<?php
// get tasks from the class, and get their data

$u= "SELECT taskID FROM tasks WHERE classID = '".$classID."'";
//$result = mysqli_query($conn,$u);
$result=$conn->query($u);
//$result = mysqli_fetch_all($result);
$result=$result->fetchAll(PDO::FETCH_ASSOC);
$result2=[];

foreach($result as $row){
  $taskID=$row['taskID'];
    $a = "SELECT taskName, taskDescription, taskID FROM tasks WHERE taskID = '".$taskID."'";
   // $tmp=mysqli_fetch_assoc(mysqli_query($conn,$a));
   $step=$conn->query($a);
   $tmp=$step->fetch(PDO::FETCH_ASSOC);
    array_push($result2,$tmp);
}?>

<!-- create a new box displaying the task name for each task that exists -->
<div class = "container-box" id= "classList">
    <?php
    foreach($result2 as $task){
        $name=$task['taskName'];
        $desc =$task['taskDescription'];
        $taskID=$task['taskID'];
    
    ?>

    <button onclick="location.href='../class/assignmentPage.php?taskName=<?php echo $name?>&description=<?php echo $desc?>&taskID=<?php echo $taskID?>';"
    id=classListButton"
    class="item-list block"><?php echo $name?></button>
    <?php } ?>
    </div>