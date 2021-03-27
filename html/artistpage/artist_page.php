<?php
//connect this page to the data base
  include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";
  session_start();

  //check if a user login
  if(!isset($_SESSION['username']) || $_SESSION['username']==""){
      header("Location: ../Home.php");
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
    <div class=header>
      <h1 id="nameOfWebsite">
        <!--somthing wrong in this line -->
          <a href="../Home.php">My Space</a>
      </h1>
      <p>YOUR DREAM HOUSE IS<br> NO LONGER DREAM</p>
    </div>
    <!--page of  Artist-->
    <div class="Center Artist_picture">

      <h2 id="Artist_">
        <?php
           if(isset($_SESSION['username']))
             echo $_SESSION['username'];
        ?>
      </h2>
      <a id="toAddArtWork" href="#Add"><input type="button" value="add artwork"></a>

      <div class="Account_boarder">
        <!--all img will be here-->
        <?php
          if(!$conn ){
            die("Connection failed: " . mysqli_connect_error());
          }else{
            //query to check if artist is approve or not (0=approve)
              $sql ="SELECT * FROM artwork
                            WHERE Artist='$_SESSION[username]'
                            ORDER BY Date DESC;";
                            //$_SESSION[username]
              //connect query with DB
              $result= mysqli_query($conn,$sql);
              //check if there is result?
             $resultCheck= mysqli_num_rows($result);
//data:image/jpeg;base64,'.base64_encode($row['Artwork']).'
              if($resultCheck>0){
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<div class="images_border">';
                  echo'<p id="infoArtist"> <strong>Title: </strong>'.$row["title"].'<br><strong> Date:</strong>'.$row["Date"].'</p>';
                   $folder='../../img/';
                    $image_name = $row['Artwork'];
                    $folder.$image_name;
                  echo '<img class="images" id="image" src="'.$folder.$image_name.'">';
                  echo'<p id="InfoDesc" style="background-color: #1d393c; margin-bottom:-0.5px; color:white;">'.$row["Description"].'<br>';
                  echo $row["category"].'<br>';
                  if($row["comment_able"]==0){
                    echo 'comment: Enable</p>';
                  }else{
                    echo 'comment: Disable</p>';
                  }
                  echo'<div class="dropdown">
                            <button class="dropbtn">Menu</button>
                            <div class="dropdown-content">
                              <a id="DeleteImg" class="DeleteImg" href="DeleteImageArtist.php?id='.$row["workId"].'"> Delete</a>
                              <a id="ChangeComment" class="ChangeComment" href="EditImageArtist.php?id='.$row["workId"].'">Edit</a>
                              <div class="dropdown_sub">
                                <a href="#">
                                  <button class="dropbtn_sub">Comment :</button>
                                  <div class="dropdown-content_sub">
                                    <a href="ChangeCommentArtist.php?id='.$row["workId"].'&comment=Enable">Enable</a>
                                    <a href="ChangeCommentArtist.php?id='.$row["workId"].'&comment=Disable">Disable</a>
                                  </div>
                                </a>
                              </div>
                            </div>
                          </div>';
                  echo '</div>';
                }//end of while
              }//end of if statment
          }//end of else
        ?>

      <!--end of Account border-->
      </div>
    <!--end of Artist content-->
    </div>

    <!--Center "add ArtWorks"-->
    <div class="Center" id="Add">

      <h3 id=Artist_><strong>Add Artworks<strong></h3>

      <form action="addArtwork.php" method="post" enctype="multipart/form-data">
        <!-- title-->
        <div class="row">
          <div class="col-25">
            <label for="Title">Title</label>
          </div>
          <div class="col-75">
            <input type="text" id="Title" name="Title" placeholder="title..">
          </div>
        </div>
        <!--picture-->
        <div class="row">
          <div class="col-25">
            <label for="Media">ArtWork</label>
          </div>
          <div class="col-75">
            <input type="file" id="Media" name="Media" placeholder="add your work here..">
          </div>
        </div>
        <!--colors pattern-->
        <div class="row">
          <div class="col-25">
            <label for="Colors_pattern">Colors Pattern</label>
          </div>
          <div class="col-75">
            <input type="file" id="Colors_pattern" name="Colors_pattern" placeholder="add Colors pattern here..">
          </div>
        </div>
        <!--date-->
        <div class="row">
          <div class="col-25">
            <label for="date">Date</label>
          </div>
          <div class="col-75">
            <input type="date" id="date" name="date">
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
              <option value="LivingRooms" selected>Livingroom</option>
              <option value="BedRooms">Bedroom</option>
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
    <!--End of add atrwork-->
    </div>

    <div class="footer">
        <p>Your Home should tell the <strong>story</strong> of who you are,<br> and be a Collection of what you Love.</p>
    </div>

    <!--javascript-->
    <!---->
  </body>
</html>


<script>

//check if artist add all input in add artwork field
$(document).ready(function(){
  $('#button').click(function(){
    //title
    var title=$('#Title').val();
    if(title==''){
      alert("please add title");
      return false;
    }//end of title

    //artwork image
    var artwork=$('#Media').val();
    if(artwork == ''){
      alert("please Select artwork Image ");
      return false;
    }else{
      var extensionArt =$('#Media').val().split('.').pop().toLowerCase();
      if(jQuery.inArray(extensionArt,['gif','png','jpg','jpeg']) == -1){
        alert('Invalid artwork Image File');
        $('#Media').val('');
        return false;
      }
    }//end of artwork image

    //colors pattern
    var colorPattern=$('#Colors_pattern').val();
    if(colorPattern == ''){
      alert("please Select ColorPattern img ");
      return false;
    }else{
      var extensionColor =$('#Colors_pattern').val().split('.').pop().toLowerCase();
      if(jQuery.inArray(extensionColor,['gif','png','jpg','jpeg']) == -1){
        alert('Invalid ColorPattern Image File');
        $('#Colors_pattern').val('');
        return false;
      }
    }//end of colors Pattern

    //Descripcion
    var Descripcion=$('#Descripcion').val();
    if(Descripcion==''){
      alert("please add Descripcion");
      return false;
    }//end of Descripcion
    return true;
  });//end of click button submit
});

//delete artwork
$(document).ready(function(){
  $('.DeleteImg').click(function(){
      var x=confirm("are you sure you want to delete this image?");
      if(!x){
        return false;
      }
  });
});

//get today date
$(document).ready(function(){
   $("#date").val($.datepicker.formatDate('yy-mm-dd', new Date()));
});
</script>
