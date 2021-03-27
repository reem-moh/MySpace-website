<?php
//connect this page to the data base
  include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";
  session_start();
  //check if a user login
  //if(!isset($_SESSION['username'])){
    //header("Location: Login.php");
  //}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>MySpace: Adminstor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../CSS/Admin.css">
    <!--<script src="../JS/Admin.js"></script>-->
  </head>

  <body>
    <!--Navigation Bar-->
    <div class="topnav">
      <a href="Home.php">Home page</a>
      <!-- dropdwon-->
      <div class="dropdown">
        <button class="dropbtn">Categories</button>
        <div class="dropdown-content">
          <a href="Home.php#livingrooms">Livingrooms</a>
          <a href="Home.php#bedrooms">Bedrooms</a>
          <a href="Home.php#kitchens">Kitchens</a>
          <a href="Home.php#bathrooms">Bathrooms</a>
        </div>
      </div>
      <!--href is the home page-->
      <a href="logout.php">log-out</a>
    </div>

    <!--header-->
    <div class=header>
      <h1 id="nameOfWebsite">
          <a  href="Home.php">My Space</a>
      </h1>
      <p>YOUR DREAM HOUSE IS<br> NO LONGER DREAM</p>
    </div>

    <!--page of  ArtWorks-->
  <div class="Center ">

      <h1 id="Artist_">
        <strong>Request<strong>
      </h1>

      <!-- div contain all artist request-->
      <div class="Account_boarder">
        <?php
          //check if connect to database
          if(!$conn ){
            die("Connection failed: " . mysqli_connect_error());
          }else{
            //query to check if artist is approve or not (0=approve)
              $sql ="SELECT * FROM artist
                            WHERE Approved='1';";
              //connect query with DB
              $result= mysqli_query($conn,$sql);
              //check if there is result?
              $resultCheck= mysqli_num_rows($result);

              if($resultCheck>0){
                //change name of radio button
                $count=0;
                //while I have result display it
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<div class="req_border">';
                  //each req have one div
                  echo '<label for="ArtistName">'.$row["ArtistUsername"].'</label>';
                  echo '<p>  sample of his/her work : </p> ';

                  $nameOfArtist=$row['ArtistUsername'];
                  $sql2="SELECT * FROM artwork
                                WHERE Artist='$nameOfArtist';";
                  $result2= mysqli_query($conn,$sql2);
                  $resultCheck2= mysqli_num_rows($result2);
                  $row2='';
                  if($resultCheck2>0){
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                      //artist doesn't approve yet, have one img(sample)
                      $folder='../img/';
                      $image_name = $row2['Artwork'];
                     echo '<img class="images" id="image" src="'.$folder.$image_name.'">';
                      break;
                    }
                    echo '<label>
                                <a id="a_inside" style="text-decoration: none; color:white;" href="showresultadmin.php?id='.$row2["workId"].'&user=Approve&artist='.$nameOfArtist.'">
                                  Approve
                                </a>
                              </label>
                              <br>
                              <br>
                              <label>
                                  <a id="a_inside" style="text-decoration: none; color:white;" href="showresultadmin.php?id='.$row2["workId"].'&user=disApprove&artist='.$nameOfArtist.'">
                                    disApprove
                                  </a>
                              </label>';


                    echo '</div>';
                  }else{//if there is no picture
                    echo $img='<img src="Blank" alte="sample picture" class="images">';
                    echo '<label>
                                <a id="a_inside" style="text-decoration: none; color:white;" href="showresultadmin.php?id=-1&user=Approve&artist='.$nameOfArtist.'">
                                  Approve
                                </a>
                              </label>
                              <br>
                              <br>
                              <label>
                                  <a id="a_inside" style="text-decoration: none; color:white;" href="showresultadmin.php?id=-1&user=disApprove&artist='.$nameOfArtist.'">
                                    disApprove
                                  </a>
                              </label>';


                    echo '</div>';
                  }


                  $count++;
                }//end of display all req
              }
            }//end of connection

         ?>
      </div>




  </div>


    <!--Footer-->
    <div class="footer">
        <p>Your Home should tell the <strong>story</strong> of who you are,<br> and be a Collection of what you Love.</p>
    </div>

  </body>
</html>
