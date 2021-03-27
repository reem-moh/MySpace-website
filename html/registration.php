<?php
//connect this page to the data base
  include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";
  session_start();
  session_destroy();
  if(isset($_POST['button'])){
    if(!$conn ){
      die("Connection failed: " . mysqli_connect_error());
    }else{
       $username=$_POST['UserName'];
       $password=$_POST['psw'];
       $re_password=$_POST['psw-repeat'];
       $email=$_POST['Email'];
       $usertype=$_POST['group1'];
      //$file=$_POST[];
      if($usertype=="visitor"){
        $sql ="SELECT * FROM `visitor`
                WHERE   (`username`='$username' OR `Email`='$email')";

        //connect query with DB
        $result= mysqli_query($conn,$sql);
        $resultCheck= mysqli_num_rows($result);
        if($resultCheck>0){
          echo "already taken username or email";
        }else{
          if($password==$re_password){
            $sqlAddV="INSERT INTO `visitor`(`username`, `password`, `Email`)
                      VALUES ('$username','$password','$email')";
            $result2= mysqli_query($conn,$sqlAddV);
            if($result2){
              echo "you register succesfully";
            }
          }elseif($password!=$re_password){
            echo "the passwords are not match";
          }
        }
      }elseif($usertype=="Artist"){
        $sql ="SELECT * FROM `artist`
                WHERE   (`ArtistUsername`='$username' OR `Email`='$email')";

        //connect query with DB
        $result= mysqli_query($conn,$sql);
        $resultCheck= mysqli_num_rows($result);
        if($resultCheck>0){
          echo "already taken username or email";
        }else{
          if($password==$re_password ){
            $sqlAddA="INSERT INTO `artist`(`ArtistUsername`, `password`, `Email`, `Approved`)
                      VALUES ('$username','$password','$email','1')";
            $result2= mysqli_query($conn,$sqlAddA);

             $filename=$_FILES['select_img']['name'];
             $filetmpname=$_FILES['select_img']['tmp_name'];
            $folder='/opt/lampp/htdocs/MySpace/img/';
            move_uploaded_file($filetmpname,$folder.$filename);
            $des="sampleimage";
            $title="sample";
            $date="2020-04-12";

            $query="INSERT INTO `artwork`( `title`, `Artist`,`Date`, `Description`, `Artwork`, `category`, `comment_able`)
                                      VALUES ('$title','$username','$date','$des','$filename','$title','1')";

            $result3=mysqli_query($conn,$query);
            if($result3){
              echo "you register succesfully";
            }
          }elseif($password!=$re_password){
            echo "the passwords are not match";
          }
        }
      }


    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../CSS/registration.css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
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
      <a href="Login.php">Login</a>
    </div>

    <!--header-->
    <div class=header>
      <h1 id="nameOfWebsite">
          <a  href="Home.php">My Space</a>
      </h1>
      <p>YOUR DREAM HOUSE IS<br> NO LONGER DREAM</p>
        <!--Register-->
        <div class="Center ">

        <h1 id="Artist_">
          <strong>Register<strong>
        </h1>
        <form action="" method="post" enctype="multipart/form-data">
        <!--username-->
        <div class="row">
          <div class="col-25">
            <label for="UserName">User Name</label>
          </div>

          <div class="col-75">
              <input type="text" id="UserName" name="UserName" placeholder="Enter user name"  required>
          </div>
        </div>
        <!--password-->
        <div class="row">
          <div class="col-25">
            <label for="psw">Password</label>
          </div>

          <div class="col-75">
            <input type="password"  name="psw" placeholder="Enter Password"  required></p>
          </div>
        </div>
        <!--re-password-->
        <div class="row">
          <div class="col-25">
            <label for="psw-repeat">check Password</label>
          </div>

          <div class="col-75">
            <input type="password" id="psw-repeat" name="psw-repeat" placeholder="Repeat the Password"  required>
          </div>
        </div>
        <!--Email-->
        <div class="row">
          <div class="col-25">
              <label for="Email">Email</label>
          </div>

          <div class="col-75">
            <input type="text"  id="Email"name="Email" placeholder="Enter Email" required>
          </div>
        </div>
        <!--usertype-->
        <div class="row">
          <div class="col-25">
              <label for="group1">user type:</label>
          </div>

          <div class="col-75">
            <div id="regtype" class="radiogroup">
              <label>
                  <input id="group1" name="group1" type="radio" value="visitor">
                  visitor
                </label>
                <label>
                  <input id="group1"name="group1" type="radio" value="Artist">
                  Artist
                </label>
            </div>

          </div>
        </div>
        <!--upload-->
         <div id="uploading" >

          <div class="row">
            <div class="col-25">
                <label for="select_img"> Select sample of <br>your work to upload:</label>
            </div>

            <div class="col-75">
              <input type="file" name="select_img" id="select_img">
            </div>
            </div>
          </div>

          <!--submit-->
        <div class="row">
          <input name ="button" type="submit" value="Register" class="Registerbtn">
        </div>
</form>
        </div>
    </div>


    <!--Footer-->
  <div class="footer">
    <p>Your Home should tell the <strong>story</strong> of who you are,<br> and be a Collection of what you Love.</p>
  </div>

  </body>
</html>

<script>
    $(document).ready(function(){
      $('#uploading').hide();
       $("input[type='radio']").click(function(){
           var radioValue = $("input[name='group1']:checked").val();
           if(radioValue=="visitor"){
               $('#uploading').hide();
           }else if (radioValue=="Artist") {
             $('#uploading').show();
           }{

           }
       });
   });


</script>
