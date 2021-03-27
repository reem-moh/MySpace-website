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
  if(!$conn ){
    die("Connection failed: " . mysqli_connect_error());
    header("Location: artist_page.php");
  }else{

    $username=  $_SESSION["username"];
    $workId= $_GET['workId'];
    $sql = "INSERT INTO `favoritelist`(`workId`, `visitorUser`) VALUES ('$workId','$username')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      echo 'Artwork added to favorite List';}
      header("Location: Home.php");
    }
}
?>
