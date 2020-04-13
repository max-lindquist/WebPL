<!-- Shannon Chu (slc8jz), Max Lindquist (mrl2dj), Jerome Romualdez (jhr3kd) -->


<?php session_start();

if (!isset($_SESSION['session_user_id'])) {
  echo "<script>location.href = 'index.php';</script>";
}
else if (!isset($_GET['class_id'])) {
  echo "<script>location.href = 'landing.php';</script>";
}

$user_id = $_SESSION['session_user_id'];
$class_id = $_GET['class_id'];

require('flashme-connectdb.php');

$query = "SELECT * FROM class WHERE class_id=$class_id";
$result = $db->query($query);
$num_rows = $result->rowCount();
//echo "num_rows=$num_rows\n";
if ($num_rows > 0) {
  if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $class_name = $row["name"];
    $_SESSION['session_class_name'] = $class_name;
  }
}

?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <title>Flashcard Sets</title>

<style>
/*pop-up form styling*/
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}
/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
</head>
  
<body style="background-color:#ff9d26">
    <header>
      <div>
        <nav class="navbar navbar-expand-md bg-custom navbar-dark" style="background-color:#0052cc; color:#37609e">
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
      
      <br><br/>

      <center><h1 style="color:white"><?php echo $_SESSION['session_class_name'] ?></h1></center>
      
      <div class="row-center">
        <button class="btn" onclick="openForm()" style="margin-top: 40px; background-color:#0052cc; border: none; color: white; padding: 12px 30px; cursor: pointer;font-size: 20px;"></i>Add a set!</button>
      </div>

      <div class="form-popup" id="myForm" style="width:300px; background-color:white; height:250px; padding-top:20px; position:fixed;bottom:300px; right:41%">
        <form action="flashcardset_add.php" method="POST" onsubmit="return addValidate()">
          <div class = "form-group">
              <h5>Flashcard Set Name?</h5>
              <input type="text" class="form-control" name="form_flashcard_name" id="form_flashcard_name" style="width=250px;">
          </div>
          <br>
          <input type="hidden" name="class_id" value="<?php echo $class_id ?>">
          <input type="submit" value="Add set" class="btn btn-secondary btn-lg" style="background-color:#0008f7"/>
          <br>
          <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
      </div>

      <div class = "container" style="margin-top:50px; margin-bottom:50px; background-color:white; border-radius: 25px;">
<?php

$query = "SELECT * FROM flashcard_set WHERE user_id=$user_id AND class_id=$class_id";
$result = $db->query($query);
$num_rows = $result->rowCount();
//echo "num_rows=$num_rows\n";
if ($num_rows == 0) {
  echo "<center><h4>You have no sets! Add a set by clicking the button above.</h4></center>";
}
if ($num_rows > 0) {
  // output data of each row
  $count = 0;
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $set_id = $row["set_id"];
      $name = $row["name"];
      // end and start the row
      if (($count % 4) == 0) {
        if ($count > 0) {
          echo "</div>\n";
        }
        echo "<div class =\"row\">\n";
      }
      $div_id = "card".$set_id;
      ?>
      <div class="col-md-3">
      <div class="text-center" style="text-align:center" id="<?php echo $div_id ?>">
          <img src="images/flashcard.png" style="text-align:center; margin-bottom:25px; margin-top:25px; width:150px; border:1px solid black";alt="" class="img-responsive">
        <div class="carousel-caption" style="text-align:center">
          <a href="flashcard.php?set_id=<?php echo $set_id ?>&class_id=<?php echo $class_id ?>" style="margin-bottom:25px; text-align:center; font-family: impact; color:black; font-size:20px;">
            <p id="label1"><?php echo $name ?></p>
          </a>
          </div>

      </div>
      </div>
      <?php
      $count++;
  }
  // end the row
  if ($count > 0) {
    echo "</div>\n";
  }
}
?>

        </div>
      </div>
    </header>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script>
    function openForm() {
      document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }
    
    function addValidate(){
        var name = document.getElementById("form_flashcard_name");

        if(name.value.length == 0){
          alert("Set name cannot be blank!");
          return false;
        }
    }
    
    //   card1 = document.getElementById("card1");

    //   card1.addEventListener("contextmenu", e => {
    //   e.preventDefault();
    //   var newText = prompt("Enter a new set name","Set 1");
    //   label1.innerHTML = newText;
    //   });
    </script>
  </body>
</html>
