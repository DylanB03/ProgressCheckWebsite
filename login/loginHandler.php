<!-- select databse -->

<?php

session_start();


// same as create account   
$servername = "progresschecker-server.mysql.database.azure.com";
$username= "ywitupqynh";
$password = "accessProgress123!";
$dbname = "loginDB";
$conn = new mysqli($servername,$username,$password,$dbname);


// get email passcode
$u = "SELECT personID,personname,email, passcode FROM loginInfo 
WHERE email= '".$_POST['email']."'";


$result = mysqli_query($conn, $u);

// if password + email are right or exist, if right create session variables

if(mysqli_num_rows($result)>0){
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
$conn->close();

?>