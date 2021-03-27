<?php
session_start();
include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";


//|| isset($_GET['myLink1'])
  if(($_SESSION["username"] == null || $_SESSION["username"]=="") ){
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

      $sql = "DELETE FROM `favoritelist` WHERE `workId`='$workId'";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        echo 'Artwork removed from favorite List';
        header("Location: Home.php");
      }
    }
  }

?>
