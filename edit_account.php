
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
  
  <?php
  require('flashme-connectdb.php');
  $user_id = $_SESSION['session_user_id'];
  $query = "SELECT * FROM user_info WHERE user_id=$user_id";
  $result = $db->query($query);
  //echo "num_rows=$num_rows\n";
    // output data of each row
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $name = $row["name"];
      $email = $row["email"];
      $password = $row["password"];
  }
  ?>

  <div class="jumbotron" style="background-color:#ff9d26">
  <div class="container" align = "middle">
        <br/>
        <h1 style="color:white">Edit Your Information </h1>
      <div  class ="container "align="left" style="border: 1px solid gray; background-color: white; width:100%; height:500px;" >
          <br/>
          <form action="edit_account_update.php" name="RegisterForm" method="POST" onsubmit="return signUpValidate()">
                <div class = "form-group">
                    <h5>Name </h5>
                     <input type="text" class="form-control" value="<?php echo $name ?>" name = "Name" id="Name">
                </div>
                <div class = "form-group">
                    <h5>Email </h5>
                  <input type="email" class="form-control" value="<?php echo $email ?>" name = "Email" id="Email" onclick="editEmail()" readonly>
                </div>
                <div class = "form-group">
                    <h5>Password </h5>
                  <input type="password" class="form-control" value="<?php echo $password ?>" name = "Password" id="Password">
                </div>
              <div class = "form-group">
                  <h5>Confirm Password</h5>
                  <input type="password" class="form-control" value="<?php echo $password ?>" id="PasswordConf">
                </div>
                <div class ="form-check" align="left">
                  <input type="checkbox" class="form-check-input" id="createShowPass" onclick="pass()">
                  <label class="form-check-label" for="createShowPass">Show Password</label>
                </div>
              <br>
              <input type = "submit" value = "Confirm Changes" class ="btn btn-secondary btn-lg" style="background-color:#0008f7"/>
              <!-- <a  class="btn btn-primary btn-lg" href="account.html" role="button" style="background-color:red">Cancel</a>-->
              <a href="account.html" style="color:red">Cancel</a>
          </form>

          <br>
      </div>
    </div>




      <br/>



  </div>


<script>

       function showPassFunction(){
        var password = document.getElementById("loginPassword");
        if (password.type === "text"){
          password.type = "password";
          return 0;
          }
        password.type = "text";
        return 0;

    }


    var pass = function(){
        var password = document.getElementById("Password");
        var passwordconf = document.getElementById("PasswordConf");
        if (password.type === "text"){
          password.type = "password";
          passwordconf.type = "password";
          return 0;
          }

        password.type = "text";
        passwordconf.type = "text";
        return 0;
    }

    function signUpValidate(){
        var first_name = document.getElementById("Name");
        var email = document.getElementById("Email");
        var password = document.getElementById("Password");
        var passwordConf = document.getElementById("PasswordConf");

        var passwordVal = password.value;
        var passwordString = passwordVal.toString();

        var passwordConfVal = passwordConf.value;
        var passwordConfString = passwordConfVal.toString();

        if(first_name.value.length == 0){
          alert("First Name cannot be blank");
          return false;
          }

        if(email.value.length == 0){
          alert("Email cannot be blank");
          return false;
          }

        if(password.value.length < 6){
          alert("Password must be at least 6 characters");
          return false;
          }

        if((passwordString.localeCompare(passwordConfString)) != 0){
          alert("Passwords do not match");
          return false;
          }

        return True;
    }

 function editEmail(){
   alert("Cannot change email!");

}
</script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>



  </body>


</html>
