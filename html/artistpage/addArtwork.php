<?php
  include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";
  session_start();

  if(isset($_POST['button'])){
    if(!$conn ){
      die("Connection failed: " . mysqli_connect_error());
    }else{
      //add artwork
      $filename=$_FILES['Media']['name'];
      $filetmpname=$_FILES['Media']['tmp_name'];
      $folder='/opt/lampp/htdocs/MySpace/img/';
      move_uploaded_file($filetmpname,$folder.$filename);
      //colorPattern
      $filename2=$_FILES['Colors_pattern']['name'];
      $filetmpname2=$_FILES['Colors_pattern']['tmp_name'];
      move_uploaded_file($filetmpname2,$folder.$filename2);

      $sql="INSERT INTO `artwork`( `title`, `Artist`, `colorPattern`, `Date`, `Description`, `Artwork`, `category`, `comment_able`)
                    VALUES ('$_POST[Title]','$_SESSION[username]','$filename2','$_POST[date]','$_POST[Descripcion]','$filename','$_POST[Category]','$_POST[Comment]')";
      //connect query with DB
      if($result= mysqli_query($conn,$sql)){
          header("Location: artist_page.php");
      }
    }

  }
?>
