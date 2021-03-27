<?php
  include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";
  session_start();

  if(isset($_POST['button'])){
    if(!$conn ){
      die("Connection failed: " . mysqli_connect_error());
    }else{
      $id = (int)$_GET['id'];
      $sql="UPDATE `artwork` SET `title`='$_POST[Title]',
                                  `Description`='$_POST[Descripcion]',
                                  `category`='$_POST[Category]',
                                  `comment_able`='$_POST[Comment]'
                                   WHERE `workId`='$id'";

      //connect query with DB
      if($result= mysqli_query($conn,$sql)){
        header("Location: artist_page.php");
      }else{
        echo "please try again";
      }
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>MySpace:Artist Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../CSS/Artist.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
 </head>

  <body>
    <!--Navigation Bar-->
    <div class="topnav">
      <a href="../Home.php">Home page</a>
      <!-- dropdwon-->
      <div class="dropdown">
        <button class="dropbtn">Categories</button>
        <div class="dropdown-content">
          <a href="../Home.php#livingrooms">Livingrooms</a>
          <a href="../Home.php#bedrooms">Bedrooms</a>
          <a href="../Home.php#kitchens">Kitchens</a>
          <a href="../Home.php#bathrooms">Bathrooms</a>
        </div>
      </div>
      <!--href is the home page-->
      <a href="../logout.php">log-out</a>
    </div>
    <!--header-->
    <div class="Center"id="Add">

      <h3 id=Artist_><strong>Edit Artwork<strong></h3>

      <form action="#" method="post">

        <!-- title-->
        <div class="row">
          <div class="col-25">
            <label for="Title">Title</label>
          </div>
          <div class="col-75">
            <input type="text" id="Title" name="Title" placeholder="title..">
          </div>
        </div>
        <!--Descripcion -->
        <div class="row">
          <div class="col-25">
            <label for="Descripcion">Descripcion</label>
          </div>
          <div class="col-75">
            <textarea id="Descripcion" name="Descripcion" placeholder="Write Descripcion."></textarea>
          </div>
        </div>
        <!--Comment -->
        <div class="row">
          <div class="col-25">
            <label for="Comment">Comment</label>
          </div>
          <div class="col-75">
            <select id="Comment" name="Comment" >
              <option value="0" selected>Enable</option>
              <option value="1">Disable</option>
            </select>
          </div>
        </div>
        <!--Category -->
        <div class="row">
          <div class="col-25">
            <label for="Category">Category</label>
          </div>
          <div class="col-75">
            <select id="Category" name="Category" >
              <option value="livingRooms" selected>Livingroom</option>
              <option value="bedRooms">Bedroom</option>
              <option value="Kitchens" >kitchen</option>
              <option value="BathRooms">bathroom</option>
            </select>
          </div>
        </div>
        <!--submit button-->
        <div class="row">
          <input id="button" name="button" type="submit" value="Submit" class="button_submit" >
        </div>
      <!--End of form-->
      </form>
    <!--End of Edit atrwork-->
    </div>

    <div class="footer">
      <p>Your Home should tell the <strong>story</strong> of who you are,<br> and be a Collection of what you Love.</p>
    </div>
  </body>
</html>
