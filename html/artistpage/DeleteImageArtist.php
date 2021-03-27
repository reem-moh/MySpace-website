<?php
  include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";
  session_start();

    if(!$conn ){
      die("Connection failed: " . mysqli_connect_error());
      header("Location: artist_page.php");
    }else{
      $id = (int)$_GET['id'];
      $query="DELETE FROM artwork WHERE workId='$id'";
      //connect query with DB
      $result= mysqli_query($conn,$query);
      //check if there is result?
      $resultCheck= mysqli_num_rows($result);

    }
    header("Location: artist_page.php");

?>
