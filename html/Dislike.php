<?php
session_start();
include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";

//$_SESSION["username"]="PeterJones";
//|| isset($_GET['myLink1'])
if(($_SESSION["username"])=="" || $_SESSION["username"] == null ){
  if(!$conn ){
    die("Connection failed: " . mysqli_connect_error());
  } header("location:Login.php");
  echo "empty session";
}else{

    $username=  $_SESSION["username"];
    echo $workId= $_GET['workId'];
    $sql = "INSERT INTO `dislikelist`(`visitorUser`,`workId`) VALUES ('$username','$workId')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
      echo 'Dislike!';
    }
    $sql2 = "DELETE FROM `likeslist`
              WHERE (`workId`='$workId' AND `visitorUser`='$username')";
    $result2 = mysqli_query($conn, $sql2);

    header("Location: Home.php");
}
?>
