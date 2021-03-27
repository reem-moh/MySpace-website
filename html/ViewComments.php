<!DOCTYPE html>
<html>
  <head>
    <title>MySpace:Artist Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../CSS/Artist.css">

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
    </div>
    <!--header-->
    <div class="Center"id="Add">


        <?php
        session_start();
        include_once "/opt/lampp/htdocs/MySpace/html/DBH.php";
        //check if user is loggedin .. it doesn't work if we dont have a "loggedin" function

          if(!$conn ){
            die("Connection failed: " . mysqli_connect_error());
          }else{


             $workId= $_GET['workId'];
             echo '<h3 id=Artist_><strong>Commet of img: '.$workId.'<strong></h3>';

             $sql1 =  "SELECT * FROM commentlist WHERE workId = '$workId' ";
             $result = mysqli_query($conn, $sql1);
             if ($result) {
               if ($result->num_rows > 0) {

                 // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                  echo "<tr><td>" . $row["comment"]. "</td></tr>";
                 }
               }else{
                 echo "no comments";
               }
              }

                //header("Location: Home.php");
              }


        ?>

    <!--End of Edit atrwork-->
    </div>

    <div class="footer">
      <p>Your Home should tell the <strong>story</strong> of who you are,<br> and be a Collection of what you Love.</p>
    </div>
  </body>
</html>
