<?php
session_start();
include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";
//check if user is loggedin .. it doesn't work if we dont have a "loggedin" function
  if(($_SESSION["username"] == null || $_SESSION["username"]=="")){
    if(!$conn ){
      die("Connection failed: " . mysqli_connect_error());
    }
    header("location:Login.php");
    echo "empty session";
  }else{
       $username=  $_SESSION["username"];
       $workId= $_GET['workId'];
       $comment = $_GET['comment'];

       $sql = "INSERT INTO commentlist(workId, visitorUser ,comment) VALUES ('$workId','$username', '$comment')";
        $result = mysqli_query($conn, $sql);
       if ($result) {
         echo 'comment added';
         header("Location: Home.php");
       }
        header("Location: Home.php");
    }


?>
