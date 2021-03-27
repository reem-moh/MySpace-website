<?php
//connect this page to the data base
  include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";
  session_start(); // Initialize the session
// $queryi = "SELECT id FROM Enrolment WHERE studentID={$_SESSION['id']}";
// Check if the user is logged in, if not then redirect him to login page

?>
<!DOCTYPE html>
<html>
  <head>
    <title>MySpace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../CSS/Home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <!--Navigation Bar-->
    <div class="topnav">
      <!-- dropdwon-->
      <div class="dropdown">
        <button class="dropbtn">Categories</button>
        <div class="dropdown-content">
          <a href="#livingrooms">Livingrooms</a>
          <a href="#bedrooms">Bedrooms</a>
          <a href="#kitchens">Kitchens</a>
          <a href="#bathrooms">Bathrooms</a>
        </div>
      </div>

      <?php
          if(!isset($_SESSION['username']) || $_SESSION['username']==""){
            echo '<a href="#Home">Home page</a>';
            echo'<a href="Login.php">log in</a>';
          }else{
            //know what is the type of this username
            $sql ="SELECT * FROM `artist`
                    WHERE `ArtistUsername`='$_SESSION[username]'";
            $result= mysqli_query($conn,$sql);
            $resultCheck= mysqli_num_rows($result);
            if($resultCheck>0){
              echo '<a href="artistpage/artist_page.php">my page</a>';
            }else{
              $sql ="SELECT * FROM `admin`
                      WHERE `username`='$_SESSION[username]'";
              $result= mysqli_query($conn,$sql);
              $resultCheck= mysqli_num_rows($result);
              if($resultCheck>0){
                echo '<a href="administrator.php">my page</a>';
              }else{
                echo '<a href="#Home">Home page</a>';
              }
            }
            echo'<a href="logout.php">log-out</a>';
          }

      ?>

    </div>

      <!--div class="text"-->

    <!--header-->
    <div class=header>
      <div class="slideshow-container">
        <!--first img on the header-->
        <div class="mySlides fade">
            <img src=" ../img/h2.png" style="width:100%;">
            <div class="headerText" id="nameOfWebsite">MySpace</div>
            <div class="headerQuote">YOUR DREAM HOUSE IS<br> NO LONGER DREAM</div>
        </div>
        <!--second img on the header-->
        <div class="mySlides fade">
          <img src=" ../img/h3.png" style="width:100%">
          <div class="headerText" id="nameOfWebsite">MySpace</div>
          <div class="headerQuote">YOUR DREAM HOUSE IS<br> NO LONGER DREAM</div>
        </div>
        <!--third img on the header-->
        <div class="mySlides fade">
          <img src=" ../img/h4.png" style="width:100%">
          <div class="headerText" id="nameOfWebsite">MySpace</div>
          <div class="headerQuote">YOUR DREAM HOUSE IS<br> NO LONGER DREAM</div>
        </div>
        <!--fourth img on the header-->
        <div class="mySlides fade">
          <img src=" ../img/h1.jpg" style="width:100%">
          <div class="headerText" id="nameOfWebsite">MySpace</div>
          <div class="headerQuote">YOUR DREAM HOUSE IS<br> NO LONGER DREAM</div>
        </div>
    </div>

    <div style="text-align:center">
      <span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span>
    </div>
  </div>




  <div class="Center">

    <!--livingrooms-->
      <h1 id="livingrooms"><strong>LivingRooms<strong></h1>
      <div calss=Content>
        <!--livingroom images-->
        <div class="row">
        <?php
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }
          //check the spelling it could cause an error
          $sql = "SELECT * FROM artwork
                  WHERE category='LivingRooms'";
          $result = mysqli_query($conn, $sql);
          $resultCheck= mysqli_num_rows($result);
          if ($resultCheck > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {

            echo'<div class="column">';
            echo'<div class="dropdown">';
            echo'<h4> title:' . $row["title"].'</h4> ';
            $folder ='../img/';
            $image_name= $row['Artwork'];
            echo'<img style= "width="300" height="300"" src="'.$folder.$image_name.'">';
                //comments section
              if( $row["comment_able"]=='0'){
                echo '<button class="button button4">
                        <a style="color:white"href="ViewComments.php?workId='.$row["workId"].'">View comments</a>
                      </button>';
                echo '<form name="form" action="AddComment.php" method="get">';
                echo '<input type="text" id="comment" name="comment" placeholder="write your comment here..">';
                echo '<input type="hidden" id="workId" name="workId" value="'.$row["workId"].'">';
                echo '<button type="submit" class="button button4">
                          <a style="color:white">Add comment</a>
                          </button>';
                echo '</form>';

                  }
            // add to favorite list
            echo '<button class="button button4">
                    <a style="color:white"href="AddToFavoriteList.php?workId='.$row["workId"].'">Add to Favorite list</a>
                  </button>';
            //like and dislike
            echo'<p><span>';
            //like
            echo'
                  <a style="font-size:29px; color:rgb(29, 57, 60)" href="Like.php?workId='.$row["workId"].'">
                    <button class="fa fa-thumbs-up"></button>
                  </a>';
            //dislike
            echo' <a style="font-size:29px; color:rgb(29, 57, 60)" href="Dislike.php?workId='.$row["workId"].'">
                    <button class="fa fa-thumbs-down"></button>
                  </a>
                  </span></p>';

            //echo'<i style="font-size:29px; color:rgb(29, 57, 60)"onclick="document.location ='Like.asp'"class="fa fa-thumbs-up"></i>';
            //echo'<i style="font-size:29px; color:rgb(29, 57, 60)" onclick="dislike(this)" class="fa fa-thumbs-down"></i>';


            echo'<div class="dropdown-content">';
            $folder2 ='../img/';
            $image_name2= $row['colorPattern'];
            echo'<img style="width:100%" src="'.$folder2.$image_name2.'" >';
            echo'<div class="desc">'. $row["Description"].'</div>';
            echo'</div>';
            echo'</div>';
            echo'</div>';

          }
         } else {
          echo '<h1><strong>No LivingRooms<strong></h1>';
         }
        ?>

          </div>
          </div>

  <!--bedrooms-->
  <h1 id="bedrooms"><strong>BedRooms<strong></h1>
    <div calss=Content>
      <!--Bedrooms images-->
     <div class="row">
      <?php
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        //check the spelling it could cause an error
        $sql = "SELECT * FROM artwork
                WHERE category='BedRooms'";
        $result = mysqli_query($conn, $sql);
        $resultCheck= mysqli_num_rows($result);
        if ($resultCheck > 0) {
        // output data of each row
          while($row = mysqli_fetch_assoc($result)) {

            echo'<div class="column">';
            echo'<div class="dropdown">';
            echo'<h4> title:' . $row["title"].'</h4> ';
            $folder ='../img/';
            $image_name= $row['Artwork'];
            echo'<img style= "width="300" height="300"" src="'.$folder.$image_name.'">';
                //comments section
                if( $row["comment_able"]=='0'){
                  echo '<button class="button button4">
                          <a style="color:white"href="ViewComments.php?workId='.$row["workId"].'">View comments</a>
                        </button>';
                  echo '<form name="form" action="AddComment.php" method="get">';
                  echo '<input type="text" id="comment" name="comment" placeholder="write your comment here..">';
                  echo '<input type="hidden" id="workId" name="workId" value="'.$row["workId"].'">';
                  echo '<button type="submit" class="button button4">
                            <a style="color:white">Add comment</a>
                            </button>';
                  echo '</form>';

                    }
            // add to favorite list
            echo '<button class="button button4">
                    <a style="color:white"href="AddToFavoriteList.php?workId='.$row["workId"].'">Add to Favorite list</a>
            </button>';
            //like and dislike
            echo'<p><span>';
            //like
            echo'
                  <a style="font-size:29px; color:rgb(29, 57, 60)" href="Like.php?workId='.$row["workId"].'">
                    <button class="fa fa-thumbs-up"></button>
                  </a>';
            //dislike
            echo' <a style="font-size:29px; color:rgb(29, 57, 60)" href="Dislike.php?workId='.$row["workId"].'">
                    <button class="fa fa-thumbs-down"></button>
                  </a>
                  </span></p>';


            //echo'<i style="font-size:29px; color:rgb(29, 57, 60)"onclick="document.location ='Like.asp'"class="fa fa-thumbs-up"></i>';
            //echo'<i style="font-size:29px; color:rgb(29, 57, 60)" onclick="dislike(this)" class="fa fa-thumbs-down"></i>';


            echo'<div class="dropdown-content">';
            $folder2 ='../img/';
            $image_name2= $row['colorPattern'];
            echo'<img style="width:100%" src="'.$folder2.$image_name2.'" >';
            echo'<div class="desc">'. $row["Description"].'</div>';
            echo'</div>';
            echo'</div>';
            echo'</div>';

        }
       } else {
        echo '<h1><strong>No BedRooms<strong></h1>';
       }
      ?>

      </div>
  </div>
  <!--Kitchens-->
  <h1 id="kitchens"><strong>Kitchens<strong></h1>
    <div calss=Content>
      <!--Kitchens images-->
      <div class="row">
      <?php
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        //check the spelling it could cause an error
        $sql = "SELECT * FROM artwork
                WHERE category='Kitchens'";
        $result = mysqli_query($conn, $sql);
        $resultCheck= mysqli_num_rows($result);
        if ($resultCheck > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

          echo'<div class="column">';
          echo'<div class="dropdown">';
          echo'<h4> title:' . $row["title"].'</h4> ';
          $folder ='../img/';
          $image_name= $row['Artwork'];
          echo'<img style= "width="300" height="300"" src="'.$folder.$image_name.'">';
              //comments section
              if( $row["comment_able"]=='0'){
                echo '<button class="button button4">
                        <a style="color:white"href="ViewComments.php?workId='.$row["workId"].'">View comments</a>
                      </button>';
                echo '<form name="form" action="AddComment.php" method="get">';
                echo '<input type="text" id="comment" name="comment" placeholder="write your comment here..">';
                echo '<input type="hidden" id="workId" name="workId" value="'.$row["workId"].'">';
                echo '<button type="submit" class="button button4">
                          <a style="color:white">Add comment</a>
                          </button>';
                echo '</form>';

                  }
          // add to favorite list
          echo '<button class="button button4">
                  <a style="color:white"href="AddToFavoriteList.php?workId='.$row["workId"].'">Add to Favorite list</a>
          </button>';
          //like and dislike
          echo'<p><span>';
          //like
          echo'
                <a style="font-size:29px; color:rgb(29, 57, 60)" href="Like.php?workId='.$row["workId"].'">
                  <button class="fa fa-thumbs-up"></button>
                </a>';
          //dislike
          echo' <a style="font-size:29px; color:rgb(29, 57, 60)" href="Dislike.php?workId='.$row["workId"].'">
                  <button class="fa fa-thumbs-down"></button>
                </a>
                </span></p>';

          echo'<div class="dropdown-content">';
          $folder2 ='../img/';
          $image_name2= $row['colorPattern'];
          echo'<img style="width:100%" src="'.$folder2.$image_name2.'" >';
          echo'<div class="desc">'. $row["Description"].'</div>';
          echo'</div>';
          echo'</div>';
          echo'</div>';

        }
       } else {
        echo '<h1><strong>No Kitchens<strong></h1>';
       }
      ?>

        </div>
        </div>
  <!--bathrooms-->
  <h1 id="bathrooms"><strong>BathRooms<strong></h1>
    <div calss=Content>
      <!--Bathrooms images-->
      <div class="row">
      <?php
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        //check the spelling it could cause an error
        $sql = "SELECT * FROM artwork
                WHERE category='BathRooms'";
        $result = mysqli_query($conn, $sql);
        $resultCheck= mysqli_num_rows($result);
        if ($resultCheck > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

          echo'<div class="column">';
          echo'<div class="dropdown">';
          echo'<h4> title:' . $row["title"].'</h4> ';
          $folder ='../img/';
          $image_name= $row['Artwork'];
          echo'<img style= "width="300" height="300"" src="'.$folder.$image_name.'">';
          //comments section
          if( $row["comment_able"]=='0'){
            echo '<button class="button button4">
                    <a style="color:white"href="ViewComments.php?workId='.$row["workId"].'">View comments</a>
                  </button>';
            echo '<form name="form" action="AddComment.php" method="get">';
            echo '<input type="text" id="comment" name="comment" placeholder="write your comment here..">';
            echo '<input type="hidden" id="workId" name="workId" value="'.$row["workId"].'">';
            echo '<button type="submit" class="button button4">
                      <a style="color:white">Add comment</a>
                      </button>';
            echo '</form>';

              }
          // add to favorite list
          echo '<button class="button button4">
                  <a style="color:white"href="AddToFavoriteList.php?workId='.$row["workId"].'">Add to Favorite list</a>
                  </button>';
          //like and dislike
          echo'<p><span>';
          //like
          echo'
                <a style="font-size:29px; color:rgb(29, 57, 60)" href="Like.php?workId='.$row["workId"].'">
                  <button class="fa fa-thumbs-up"></button>
                </a>';
          //dislike
          echo' <a style="font-size:29px; color:rgb(29, 57, 60)" href="Dislike.php?workId='.$row["workId"].'">
                  <button class="fa fa-thumbs-down"></button>
                </a>
                </span></p>';

          echo'<div class="dropdown-content">';
          $folder2 ='../img/';
          $image_name2= $row['colorPattern'];
          echo'<img style="width:100%" src="'.$folder2.$image_name2.'" >';
          echo'<div class="desc">'. $row["Description"].'</div>';
          echo'</div>';
          echo'</div>';
          echo'</div>';

        }
       }  else {
        echo '<h1><strong>No BathRooms<strong></h1>';
       }
      ?>

        </div>
        </div>


<!---->
<h1 id="FavoriteList"><strong>Favorite list<strong></h1>
  <div calss=Content>

    <div class="row">
      <?php
      // double check the query / a query to fetch the favoriteList of the session user
      if( isset($_SESSION) && isset($_SESSION['username'])){
      $sqlFL =  "SELECT * FROM artwork WHERE workId IN (SELECT workId FROM favoritelist WHERE visitorUser='{$_SESSION['username']}' )";
      $resultFL =mysqli_query($conn, $sqlFL);
      if (mysqli_num_rows($resultFL) > 0) {

      while($row1=mysqli_fetch_assoc($resultFL)){
        $artworkID  = "SELECT workId FROM " ;
                  echo '<div class="column">';
                  echo '<div class="dropdown">';
                  $folder='../img/';
                  echo '<img src="'.$folder.$row1['Artwork'].'"alt='.$row1['workId'].' width="300" height="300">';
                  // remove from favorite list
                  echo '<button class="button button4">
                          <a style="color:white"href="RemoveFromFavoriteList.php?workId='.$row1["workId"].'">
                            remove from Favorite list
                          </a>
                        </button>';
                 echo'<div class="dropdown-content">';
                 $folder='../img/';
                 echo'<img src="'.$folder. $row1["colorPattern"].'"alt=". $row["workId"]. " style="width:100%">';
                 echo'<div class="desc">'. $row1["Description"].'</div>';
                 echo'</div>';
                 echo'</div>';
                 echo'</div>';
              }

            }
            else{
              echo ' <h3> no favorite List elements </h3>';
            }
        }else{
          echo ' <h3> please Login </h3>';
        }
      ?>


</div>
</div>
  </div>


<!--footer-->

        <div class="footer">
            <p>Your Home should tell the <strong>story</strong> of who you are,<br> and be a Collection of what you Love.</p>
        </div>

        <!--slideshow-->
        <script>
        var slideIndex = 0;
        showSlides();

        function showSlides() {
          var i;
          var slides = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("dot");
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
          }
          slideIndex++;
          if (slideIndex > slides.length) {slideIndex = 1}
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";
          dots[slideIndex-1].className += " active";
          setTimeout(showSlides, 6000); // Change image every 2 seconds
        }
        //function editFavoriteList(){}


      /*  function like(x){
          if(($_SESSION["username"])=="" || ($_SESSION["username"] == null )){
            if(!$conn ){
              die("Connection failed: " . mysqli_connect_error());
                  }
                  header("location:Login.php");
                }else{

                  // a query to remove the visitor from liked list
        }
      }
        function dislike(x){
          if(($_SESSION["username"])=="" || ($_SESSION["username"] == null )){
            if(!$conn ){
              die("Connection failed: " . mysqli_connect_error());
                  }
                  header("location:Login.php");
                }else{
                  // a query to remove the visitor from liked list

        }
      }*/





        </script>

      </body>
    </html>
