
<!-- Shannon Chu (slc8jz), Max Lindquist (mrl2dj), Jerome Romualdez (jhr3kd) -->

<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Bootstrap example</title>
    <link rel="stylesheet" href="main.css" />

  </head>
  <body style="background-color:#ff9d26">
    <header>
      <div>
        <nav class="navbar navbar-expand-md bg-custom navbar-dark" style="background-color:#0052cc; color:#0052cc">
            <a class="navbar-brand" href="landing.php" style="color:white; font-size: 50px;"><b>fLaSh mE!</b></a>
    
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- The button is hidden on desktop and becomes a dropdown hamburger menu on mobile.
               The navigation bar is hidden on small screens and
               replaced by a button in the top right corner (try to re-size this window).
               Only when the button (hamburger menu) is clicked, the navigation bar will be displayed.  -->
    
          <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="about_loggedin.php" style="color:white; font-size: 25px;">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="landing.php" style="color:white; font-size: 25px;">My Classes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="account.php" style="color:white; font-size: 25px;">My Account</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php" style="color:white; font-size: 25px;">Logout</a>
              </li>
            </ul>
          </div>
        </nav>
    </div>

    </header>

    <!--
        Bootstrap jumbotron header is one big, attention-grabbing header
        (that people view it as "modern" but we may view it as "space-wasting")
    -->

    <div class="jumbotron" style="background-color: #ff9d26;">
      <div class="container">
        <h1 style="color:white">About fLaSh mE!</h1>
        <br>
        <img src="images/flashmelogocolored.png" style="width:500px">
        <h4 style="color:white">This study tool is the best way for you to remember what you need to remember, whether it's Computer Science terms, History terms, Biology terms, ANYTHING! </h4>
        <h4 style="color:white">And, the best part is: IT'S FREE!!!</h4>
        <h4 style="color:white"> Created by: Shannon Chu, Max Lindquist, and Jerome Romualdez (hoo came up with this ingenious name 😎)</h4>
        &nbsp;
      </div>
      <br/>

    <!-- Use a grid-like idea for the content layout.
         Grids are rows that contain columns.
         Bootstrap works on a 12-column system.

         The Bootstrap grid system has four classes:
             xs (for phones - screens less than 768px wide)
             sm (for tablets - screens equal to or greater than 768px wide)
             md (for small laptops - screens equal to or greater than 992px wide)
             lg (for laptops and desktops - screens equal to or greater than 1200px wide)

         Let's assume we will use the md class
         To have three columns (1/3 width each in full-screen width), use col-md-4.
         These three columns will stack on mobile and become 100% width.
         (col-md-x specifies that we are using a medium size column)
    -->

    <!-- To use bootstrap.min.js, need jquery
         note: js bootstrap allows menu interaction such as dropdown
         (if only use css bootstrap, only link to the css)
    -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <!-- <script src="js/bootstrap.min.js"></script> if you downloaded bootstrap to your computer -->

    <!-- Why should JS be put at the bottom of the page? -->

  </body>
  <script>
  </script>
</html>