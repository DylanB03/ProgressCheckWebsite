<?php
// connect
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


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- default make stuff -->
    <meta charset = "utf-8">
    <title>Progress Check Website</title>
    <link rel ="icon" href="../img/logo.png"/>
    <link rel ="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="ht../tps://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
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
  <b>Student List</b>
</div>
<div class = "homeButton">
  <button onclick="location.href='../class/classPageRedirect.php';" style ="border:0;background:transparent;float:right;margin-top:5px">
  <img src ="../img/home.png" style="height:50px;width:50px;border-radius:25px;overflow:hidden"></button>
</div>

<?php
// set vars

$studentID=$_SESSION['userID'];
$classID=$_SESSION['classID'];
$className=$_SESSION['className'];
$classCode=$_SESSION['classCode'];
// get student id who is in the class, and their name and email
$u = "SELECT studentID FROM enrolled WHERE classID = '".$classID."'";
//$result=mysqli_query($conn,$u);
$result=$conn->query($u);
//$result=mysqli_fetch_all($result);
$result=$result->fetchAll(PDO::FETCH_ASSOC);
$result2=[];


//foreach($result as $studentID){
foreach($result as $row){
  $studentID=$row['studentID'];
    $a = "SELECT personname,email FROM loginInfo WHERE personID = '".$studentID."'";
    //$tmp=mysqli_fetch_assoc(mysqli_query($conn,$a));
    $step=$conn->query($a);
    $tmp=$step->fetch(PDO::FETCH_ASSOC);
    array_push($result2,$tmp);
}

?>
<!-- create table headers -->

<table id="studentListTable">
    <tr>
        <th onclick="sortTable(0)">Name ↑↓</th>
        <th onclick="sortTable(1)">Email ↑↓</th>
</tr>

<!-- create a new row for every student and their data in the class -->
<div class = "studentList">
    <?php 
    foreach($result2 as $person){
        $name = $person['personname'];
        $email=$person['email'];
    
    ?>

    <tr>
        <td><?php echo $name?></td>
        <td><?php echo $email?></td>

</tr>
<?php }?>
    </table>
    </div>
