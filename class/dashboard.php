<?php
session_start();
// if appropriate session variables arent set, send the user back to the home page
if(!isset($_SESSION['userID'])){
  header("Location:../index.php");
  die();
}
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
            <a href="../index.php"style="color: black; text-decoration:none">Home</a>
            <a href="../class/dashboard.php"style="color: black; text-decoration:none" id="dash">Dashboard</a>
            <a href="../login/logoutPage.php"style="color: black; text-decoration:none"id="lO">Log Out</a>
        </div>
     </div>

<div class = "myDashboard">
  <b>My Dashboard</b>

</div>

<!-- two buttons -->

<div class = "joinClassroom">
<button class="open-button" onclick="openForm()"style="font-family:Courier-New;font-size:15px;border-radius:4px">Join Classroom</button>
</div>
<div class = "createClassroom">
<button class ="open-button2" onclick="openForm2()"style="font-family:Courier-New;font-size:15px;border-radius:4px;">Create Classroom</button>
</div>  


<!-- popup windows -->
<div class = "classroomCreatePage" id="myForm2">
<h1 style="font-size:40px; padding-left:0px; text-align:center; margin-top:-50px;">Enter Class Name</h1>
<button onclick="closeForm2()" style="width:50px;height:50px;border-radius:25px;background:transparent;border:0px;margin-right:-80px;float:right;margin-top:-110px;vertical-align:top"><img src ="../img/xButton.png"  style="width:50px;height:50px;border-radius:25px;overflow:hidden;"></button>
<form class = "createClassroomInput" action="createClassroomHandler.php"method="post">
<input class = "text-field" type="text" id="clasroomName"name="classroomName"placeholder="Classroom Name" style="border:1px solid black;border-radius:2px;"required>
<input class = "w3-cyan w3-hover-light-green w3-border-0 text-field" style="border:1px solid black;border-radius:2px"type = "submit" value="Create Classroom">
</div>
</form>

<div class = "classroomJoinPage" id="myForm">
<h1 style="font-size:40px; padding-left:0px; text-align:center; margin-top:-50px;">Enter Class Code</h1>
<button onclick="closeForm()"style="width:50px;height:50px;border-radius:25px;background:transparent;border:0px;margin-right:-80px;float:right;margin-top:-110px;vertical-align:top"><img src ="../img/xButton.png" style="width:50px;height:50px;border-radius:25px;overflow:hidden"></button>
<form class = "createClassroomInput" action="joinClassroomHandler.php"method="post">
<input class = "text-field" type="text" id="clasroomCode"name="classroomCode"placeholder="Classroom Code" style="border:1px solid black;border-radius:2px"required>
<input class = "w3-cyan w3-hover-light-green w3-border-0 text-field" type = "submit" style="border:1px solid black;border-radius:2px"value="Join Classroom">
</div>
</form>


<?php


// connect to database
$servername = "165.227.46.101";
$username= "user1";
$password = "access";
$dbname = "loginDB";

unset($_SESSION['classID']);
unset($_SESSION['className']);
unset($_SESSION['classCode']);

//$conn = new mysqli($servername,$username,$password,$dbname);
try{
  $conn = new PDO("mysql:host=localhost;dbname=$dbname",$username,$password);
  } catch (PDOException $e){
      die("Failed to connect to database: ". $e->getMessage());
  }

// select classrooms where the user is enrolled
$u = "SELECT classID FROM enrolled
WHERE studentID='".$_SESSION['userID']."'";

//$result = mysqli_query($conn,$u);
$result = $conn->query($u);
//$result = mysqli_fetch_all($result);
$result=$result->fetchAll(PDO::FETCH_ASSOC);
$result2 = [];

// get the className, ID, and code from each classID where enrolled
foreach ($result as $classID){
  $a = "SELECT className,classID,classCode FROM classrooms
  WHERE classID='".$classID[0]."'";
 // $tmp = mysqli_fetch_assoc(mysqli_query($conn,$a));
$sql2=$conn->query($a);
$tmp=$sql2->fetch(PDO::FETCH_ASSOC);
  array_push($result2,$tmp);
}

?>

<!-- create a box for each class enrolled, and put the name, id, and code as data to be transferred when the box is clicked -->

<div class="container-box" id="classList">
  <?php
  foreach($result2 as $class){
    $name = $class['className'];
    $classNum = $class['classID'];
    $classCode=$class['classCode'];
?>
<button onclick="location.href='../class/classPageRedirectButton.php?className=<?php echo $name?>&classID=<?php echo $classNum?>&classCode=<?php echo$classCode?>';"
id="classListButton"
class="item-list block"><?php echo $name?></button>
<?php } ?>
</div>  