<?php
  include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";
  session_start();
  //press submit
    if(!$conn ){
      die("Connection failed: " . mysqli_connect_error());
      header("Location: administrator.php");
    }else{
      $user=$_GET['user'];
      $artist=$_GET['artist'];
      //approve=0,diapprove=1;
      if($user=='Approve'){
        $query="UPDATE `artist`
                SET `Approved`='0'
                WHERE `ArtistUsername`='$artist'";
        //connect query with DB
        $result= mysqli_query($conn,$query);

        //delete sample from artwork table
        $query1="DELETE FROM `artwork`
                  WHERE `Artist`='$artist'";
        //connect query with DB
        $result1= mysqli_query($conn,$query1);

        if($result&& $result1){
          header("Location: administrator.php");
        }

      }elseif($user=='disApprove'){
        //delete sample from artwork table
        $query1="DELETE FROM `artwork`
                  WHERE `Artist`='$artist'";
        //connect query with DB
        $result1= mysqli_query($conn,$query1);

        //delete artist from artist table
        $query="DELETE FROM `artist`
                  WHERE `ArtistUsername`='$artist'";
        //connect query with DB
        $result= mysqli_query($conn,$query);

        if($result&& $result1){
            header("Location: administrator.php");
        }

      }

    }//end connection
    header("Location: administrator.php");

?>
