<!-- select databse -->

<?php

session_start();


// same as create account   
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

// get email passcode
$u = "SELECT personID,personname,email, passcode FROM loginInfo 
WHERE email= '".$_POST['email']."'";


//$result = mysqli_query($conn, $u);
$conn->exec($u);

// if password + email are right or exist, if right create session variables

//if(mysqli_num_rows($result)>0){
if($result->rowCount()>0){
    $row = mysqli_fetch_assoc($result);
    if($row['email'] == $_POST['email'] && $row['passcode'] == $_POST['passcode']){
        $_SESSION["userID"] = $row['personID'];
        $_SESSION["userName"]=$row['personname'];
        $_SESSION["userEmail"]=$_POST['email'];
        header('Location: ../login/loginSuccessful.php');
        die();
    }
    else{
        $_SESSION["error"] = 'Incorrect email and/or password';
        header("Location: ../login/notsuccessful.php");
    }
}
else{
    $_SESSION["error"] = 'Incorrect email and/or password';
    header("Location: ../login/notsuccessful.php");
}
//$conn->close();
$conn=null;
?>