<?php
  include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";
  session_start();

    if(!$conn ){
      die("Connection failed: " . mysqli_connect_error());
      header("Location: artist_page.php?connection=failed");
    }else{
      $id = (int)$_GET['id'];
      $comment=$_GET['comment'];
      //Enable =0,Disabl=1;
      if($comment=='Enable'){
        $query="UPDATE artwork
                 set comment_able='0'
                  WHERE workId='$id';";

      }elseif($comment=='Disable'){
        $query="UPDATE artwork
                 set comment_able='1'
                  WHERE workId='$id';";

      }

      //connect query with DB
      $result= mysqli_query($conn,$query);
      //check if there is result?
      $resultCheck= mysqli_num_rows($result);

    }
    header('Location: artist_page.php?comment=changed');

?>
