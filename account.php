
<!-- Shannon Chu (slc8jz), Max Lindquist (mrl2dj), Jerome Romualdez (jhr3kd) -->
<?php session_start();

if (!isset($_SESSION['session_user_id'])) {
  echo "<script>location.href = 'index.php';</script>";
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Bootstrap example</title>

  </head>
  <body style="background-color:#ff9d26">
    <header>
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

    </header>


  

<!-- require('flashme-connectdb.php');
$user_id = $_SESSION['session_user_id'];
$query = "SELECT * FROM user_info WHERE user_id=$user_id";
$result = $db->query($query);
//echo "num_rows=$num_rows\n";
  // output data of each row
while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $name = $row["name"];
    $email = $row["email"];
    $password = $row["password"];
} -->



  <div class="jumbotron" style="background-color:#ff9d26">
    <div class="container" align = "middle">
      <br/>
      <br/>
      <h1 style="color:white">Welcome <?php echo $_SESSION['session_name'] ?>! </h1>
    <legend align="center" style="color:white"> Your information</legend>
    <div  class ="container "align="left" style="border: 1px solid gray; background-color: white; width:65%" >
        <br/>
        <h5>Name </h5>
        <p >&nbsp &nbsp <?php echo $_SESSION['session_name'] ?></p>
        <h5>Email </h5>
        <p >&nbsp &nbsp <?php echo $_SESSION['session_email'] ?></p>
        <h5>Password </h5>
        <p >&nbsp &nbsp <?php echo $_SESSION['session_password'] ?></p>
    </div>
    </div>
  <br>
    <center>
      <a class="btn btn-primary btn-lg" href="edit_account.php" role="button" style="background-color:#0008f7">Edit Account Information</a>
  </center>
  </div>
  }





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>



  </body>


</html>
