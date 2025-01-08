<?php
// connect set variables
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
try{
    $conn = new PDO("mysql:host=localhost;dbname=$dbname",$username,$password);
    } catch (PDOException $e){
        die("Failed to connect to database: ". $e->getMessage());
    }
//$conn = new mysqli($servername,$username,$password,$dbname);

$studentID=$_SESSION['userID'];
$classID=$_SESSION['classID'];
$className=$_SESSION['className'];
$classCode=$_SESSION['classCode'];
$taskID=$_GET['taskID'];
$taskName=$_GET['name'];

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

     <!-- big text + home button -->
<div class = "myDashboard">
  <b>'<?php echo $taskName?>' Assignment Submissions</b>
</div>
<div class = "homeButton">
  <button onclick="location.href='../class/classPageRedirect.php';" style ="border:0;background:transparent;float:right;margin-top:5px">
  <img src ="../img/home.png" style="height:50px;width:50px;border-radius:25px;overflow:hidden"></button>
</div>

<!-- get the submission ids where the taskid matches current task -->
<?php
$sql="SELECT submitID FROM submitted WHERE taskID='".$taskID."'";
//$result=mysqli_query($conn,$sql);
$result=$conn->query($sql);
//$result=mysqli_fetch_all($result);
$result=$result->fetchAll(PDO::FETCH_ASSOC);
$result2=[];

// get all data related to the submission
foreach($result as $submitID){
    $a="SELECT studentID, color, comment FROM submitted 
    WHERE submitID='".$submitID[0]."'";
    //$tmp=mysqli_fetch_assoc(mysqli_query($conn,$a));
    $sql2=$conn->query($a);
    $tmp=$sql2->fetch(PDO::FETCH_ASSOC);
    array_push($result2,$tmp);
}
// create table headers
?>
<table id ="studentListTable">
    <tr>
        <th onclick="sortTable(0)">Student Name ↑↓</th>
        <th>Student Email</th>
        <th onclick="sortTable(2)">Submitted Color ↑↓</th>
        <th onclick="sortTable(3)">Student Comments ↑↓</th>
</tr>

<!-- for every submission display all of the submission data in a new row -->

<div class="studentList">
    <?php
    foreach($result2 as $submit){
        $personID=$submit['studentID'];
        $color = $submit['color'];
        $comment=$submit['comment'];
        $sql="SELECT personname,email FROM loginInfo WHERE personID = '".$personID."'";
       // $result=mysqli_query($conn,$sql);
       $result=$conn->query($sql);
       // $row=mysqli_fetch_assoc($result);
       $fow=$result->fetch(PDO::FETCH_ASSOC);
        $personName=$row['personname'];
        $email=$row['email'];

        ?>
        <tr>
            <td><?php echo $personName?></td>
            <td><?php echo $email?></td>
            <?php
            if($color=='red'){
                ?><td><img src = "../img/red.png" style="height:60px;width:60px;border-radius:30px;margin-left:40%;"></td>
                <?php
            }
            elseif($color=='yellow'){?>
                <td><img src = "../img/yellow.png" style="height:60px;width:60px;border-radius:30px;margin-left:40%;"></td>
                <?php
            }
            elseif($color=='green'){?>
                <td><img src = "../img/green.png" style="height:60px;width:60px;border-radius:30px;margin-left:40%;"></td>
                <?php
            }?>
            <td><?php echo $comment?></td>
        </tr>
        <?php } ?>
        </table>
        </div>