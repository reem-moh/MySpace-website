<?php
//connect this page to the data base
  include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";
  session_start();

  if(isset($_POST['button'])){
    if(!$conn ){
      die("Connection failed: " . mysqli_connect_error());
    }else{

       $username=$_POST['UserName'];
       $password=$_POST['psw'];
       $usertype=$_POST['group1'];

      if($usertype=="visitor"){
        $sql ="SELECT * FROM `visitor`
                WHERE (`username`='$username' AND `password`='$password')";
        //connect query with DB
        $result= mysqli_query($conn,$sql);
        $resultCheck= mysqli_num_rows($result);

        if($resultCheck>0){
            $_SESSION['username']=$username;
            header("Location: Home.php");
        }else{
          echo ' username or password is invalid';
          $username="";
          $password="";
          $usertype="";

        }
      }elseif($usertype=="Artist"){
        $sql ="SELECT * FROM `artist`
                WHERE (`ArtistUsername`='$username' AND `password`='$password')";
        //connect query with DB
        $result= mysqli_query($conn,$sql);
        $resultCheck= mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if($resultCheck>0){
          //if approve
            if($row["Approved"]==0){
              $_SESSION['username']=$username;
              header("Location: artistpage/artist_page.php");
            }else{
              echo 'sorry you cann\'t enter your page
                    <br>
                    waite until admin approve you';
            }
        }else{
          echo ' username or password is invalid';
          $username="";
          $password="";
          $usertype="";

        }

      }elseif ($usertype=="Admin") {
        $sql ="SELECT * FROM `admin`
                WHERE (`username`='$username' AND `password`='$password')";
        //connect query with DB
        $result= mysqli_query($conn,$sql);
        $resultCheck= mysqli_num_rows($result);

        if($resultCheck>0){
            $_SESSION['username']=$username;
            header("Location:administrator.php");
        }else{
          echo 'username or password is invalid';
          $username="";
          $password="";
          $usertype="";

        }
      }

    }
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../CSS/Login.css">
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
      <a href="Home.php">Login</a>
    </div>

    <!--header-->
    <div class=header>
      <h1 id="nameOfWebsite">
          <a  href="Home.php">My Space</a>
      </h1>
      <p>YOUR DREAM HOUSE IS<br> NO LONGER DREAM</p>
      <div class="Center">
        <!--Login-->
            <h1 id="Artist_">
              <strong>Login<strong>
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
                <input type="password" id="psw" name="psw" placeholder="Enter Password"  required>
              </div>
            </div>
            <!--usertype-->
            <div class="row">
              <div class="col-25">
                  <label for="group1">user type:</label>
              </div>

              <div class="col-75">
                <div class="radiogroup">
                    <label>
                      <input name="group1" type="radio" value="visitor">
                      visitor
                    </label>
                    <br>
                    <label>
                      <input name="group1" type="radio" value="Artist">
                      Artist
                    </label>
                    <br>
                    <label>
                      <input name="group1" type="radio" value="Admin">
                      Admin
                    </label>
                </div>
              </div>
            </div>
            <!--signup-->
            <div class="row">
              <p>don't have an account?<br>
                 <a href="registration.php">Sign up here</a>
              </p>
            </div>
            <!--submit-->
            <div class="row">
              <input name ="button"type="submit" value="Login" class="Registerbtn">
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
