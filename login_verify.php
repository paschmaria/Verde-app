<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST['submit'])){ 
    $dbHost = "localhost";    
    $dbUser = "root";          
    $dbPass = "SperaenDeo1";   
    $dbDatabase = "Verde";    

    $appUsr = test_input($_POST['username']);
    $appPass = test_input($_POST['password']);
    $appCheck = $_POST['onoffswitch'];

    if(isset($appCheck)) {
      $hour = time() + 3600 * 24 * 7;
      setcookie('username', $appUsr, $hour);
      setcookie('password', $appPass, $hour);
    }

    $db = mysqli_connect($dbHost,$dbUser,$dbPass,$dbDatabase);

    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $usr = mysqli_real_escape_string($db, $appUsr); 
    $pas = hash('sha256', mysqli_real_escape_string($db, $appPass)); 
    $sql = "SELECT *
            FROM verde_app_user
            WHERE user_name='$usr'
            AND password='$pas'";
    $result = mysqli_query($db,$sql);
    if($result){ 
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
        session_start();
        $_SESSION['username'] = $row["user_name"];
        $_SESSION['logged'] = TRUE;
        // printf ($row['user_name']);
        header("Location: verde/dashboard.php");
        exit; 
    }else{ 
        header("Location: login.html");
        exit; 
    } 
}else{
    header("Location: login.html");
    exit; 
} 
?>