
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css" />
    <title>Sign Up</title>

  </head>
  <body style="background-color:#ff9d26">
    <header>
      <div>
        <nav class="navbar navbar-expand-md bg-custom navbar-dark" style="background-color:#0052cc; color:#0052cc">
          <a class="navbar-brand" href="index.html" style="color:white; font-size: 50px;"><b>fLaSh mE!</b></a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="about.html" style="color:white; font-size: 25px;">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="signup.html" style="color:white; font-size: 25px;">Sign up</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>

    </header>

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
    <div class = "jumbotron" style="background-color:#ff9d26; padding:0; margin:0">
      <div class = "row">
        <div class = "col-lg">
        </h3>
        </div>
      </div>
    </div>
    </div>
    <div class="jumbotron" style="background-color:#ff9d26; margin:0">
    <div class="form-horizontal" style="display:inline-block; width:50%;">
      <div class="from-group">
          <h3 style="color:black">New? Make an Account!</h3>
          <br>
          <form action="landing.html" name="RegisterForm" method="post" onsubmit="return signUpValidate()">
                <div class = "form-group">
                    <input type="text" class="form-control" placeholder="Name" id="Name">
                </div>
                <div class = "form-group">
                  <input type="email" class="form-control" placeholder="Email" id="Email">
                </div>
                <div class = "form-group">
                  <input type="password" class="form-control" placeholder="Password" id="Password">
                </div>
                <div class = "form-group">
                  <input type="password" class="form-control" placeholder="Confirm Password" id="PasswordConf">
                </div>
                <div class ="form-check" align="left">
                  <input type="checkbox" class="form-check-input" id="createShowPass" onclick="createShowPassFunction()">
                  <label class="form-check-label" for="createShowPass">Show Password</label>
                </div>
                &nbsp;
              <input type = "submit" name = "btnaction" value = "Create Account" class ="btn btn-secondary btn-block" style="background-color:#0008f7"/>
        </form>
      </div>
    </div>
  </div>
  <footer class="page-footer" style="background-color:#ff9d26">

  </footer>


  <?php

  if (isset($_GET['btnaction']))
  {
    require('flashme-connectdb.php');
    $name = $_GET['Name'];
    $email = $_GET['Email'];
    $password = $_GET['Password'];

    $query = "INSERT INTO user_info (email, name, password) VALUES (:email,:name,:password)";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
    header('Location: survey-instruction.php');
  }
    ?>



    <!-- To use bootstrap.min.js, need jquery
         note: js bootstrap allows menu interaction such as dropdown
         (if only use css bootstrap, only link to the css)
    -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <!-- <script src="js/bootstrap.min.js"></script> if you downloaded bootstrap to your computer -->

    <!-- Why should JS be put at the bottom of the page? -->
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


    function createShowPassFunction(){
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
        var name = document.getElementById("Name");
        var email = document.getElementById("Email");
        var password = document.getElementById("Password");
        var passwordConf = document.getElementById("PasswordConf");

        var passwordVal = password.value;
        var passwordString = passwordVal.toString();

        var passwordConfVal = passwordConf.value;
        var passwordConfString = passwordConfVal.toString();

        if(name.value.length == 0){
          alert("Name cannot be blank");
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
    </script>

  </body>
</html>