
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

    <title>Landing Page</title>

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
        <nav class="navbar navbar-expand-md bg-custom navbar-dark" style="background-color:#0052cc; color:#0052cc">
          <a class="navbar-brand" href="landing.html" style="color:white; font-size: 50px;"><b>fLaSh mE!</b></a>
  
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
              <a class="nav-link" href="about_loggedin.html" style="color:white; font-size: 25px;">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="landing.html" style="color:white; font-size: 25px;">My Classes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="account.php" style="color:white; font-size: 25px;">My Account</a>
            </li>
          </ul>
        </div>
        </nav>
      </div>
    </header>
    
    <br><br/>
    <center>
    <h1 style="color:white"><?php echo $_SESSION['name'] ?>'s Classes</h1>
    <h5 style="color:white">Create Classes to hold sets of flashcards</h5>
    <br>
    <div class="row-center">
      <button class="btn" onclick="openForm()" style="background-color:#0052cc; border: none; color: white; padding: 12px 30px; cursor: pointer;font-size: 20px;"></i>Add a class!</button>
    </div>
    <br>
    <div class="form-popup" id="myForm" style="width:300px; background-color:white; height:250px; padding-top:30px; position:fixed;bottom:325px; right:40%">
      <form action="landing_add.php" method="POST">
        <div class = "form-group">
            <h5>Class name?</h5>
        </div>
        <input type="text" class="form-control" value="" name="form_class_name" style="width:250px">
        <br>
        <input type="submit" value="Add class" class="btn btn-secondary btn-lg" style="background-color:#0008f7"/>
        <br>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
      </form>
    </div>
    <!-- <div class="form-group" style ="width:50%;">
      <input type="text" class="form-control" placeholder="Search for flashcards" name="">
    </div> -->
    </center>


    <div class = "container" style="margin-top:25px; margin-bottom:50px; background-color:white; border-radius: 25px; padding-top:5px;">

    <!--
    Here is the button to create a new class. There is the option to make 5 classes. When you make a class, there is the option
    to edit the name of the class or delete the class. Clicking on the class will take you to the class page, where you can view
    all of your flashcard sets.
    -->

      <!--
    Here are the 5 class buttons (all in the same row). An individual button is "activated" after the "Add a class" button is clicked.
    -->

<?php
require('flashme-connectdb.php');

$query = "SELECT * FROM class";
$result = $db->query($query);
$num_rows = $result->rowCount();
//echo "num_rows=$num_rows\n";
if ($num_rows == 0) {
  echo "<center><h4>You have no classes! Add a class by clicking the button above.</h4></center>";
}
else {
  // output data of each row
  $count = 0;
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $class_id = $row["class_id"];
      $name = $row["name"];
      // end and start the row
      if (($count % 4) == 0) {
        if ($count > 0) {
          echo "</div>\n";
        }
        echo "<div class =\"row\">\n";
      }
      $div_id = "card".$class_id;
      ?>
      <div class="col-md-3">
      <div class="text-center" style="text-align:center" id="<?php echo $div_id ?>">
          <img src="images/textbook.png" style="text-align:center; margin-bottom:25px; margin-top:25px; width:150px;" class="img-responsive">
        <div class="carousel-caption" style="position:absolute; top:50px; left:20px; text-align:center">
          <a href="flashcardset.php?class_id=<?php echo $class_id ?>"  style="margin-bottom:25px; text-align:center; font-family: impact; color:black; font-size:20px;">
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

      <!-- <div class="col-md-2">
        <div class="text-center">
        <button type="button" class="btn btn-primary btn-lg" style="background: white;height:150px;width:150px;" id="button1" disabled="true" onclick="window.location.href = 'flashcardset.html';">Class 1</button>
        <div>

          <button type="button" class="btn btn-light" style="width:75px; visibility:hidden" id="edit1" onclick="return editClass1()">Edit</button>
          <button type="button" class="btn btn-danger" style="width:75px; visibility:hidden" id="delete1" onclick="return deleteClass1()">Delete</button>
        </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="text-center">
        <button type="button" class="btn btn-primary btn-lg" style="background: white;height:150px;width:150px;" id="button2" disabled="true" onclick="window.location.href = 'flashcardset.html';">Class 2</button>
        <div>

          <button type="button" class="btn btn-light" style="width:75px;visibility:hidden" id="edit2" onclick="return editClass2()">Edit</button>
          <button type="button" class="btn btn-danger" style="width:75px; visibility:hidden" id="delete2" onclick="return deleteClass2()">Delete</button>
        </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="text-center">
        <button type="button" class="btn btn-primary btn-lg" style="background: white;height:150px;width:150px;" id="button3" disabled="true" onclick="window.location.href = 'flashcardset.html';">Class 3</button>
        <div>

          <button type="button" class="btn btn-light" style="width:75px;visibility:hidden" id="edit3" onclick="return editClass3()">Edit</button>
          <button type="button" class="btn btn-danger" style="width:75px; visibility:hidden" id="delete3" onclick="return deleteClass3()">Delete</button>
        </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="text-center">
        <button type="button" class="btn btn-primary btn-lg" style="background: white;height:150px;width:150px;" id="button4" disabled="true" onclick="window.location.href = 'flashcardset.html';">Class 4</button>
        <div>

          <button type="button" class="btn btn-light" style="width:75px;visibility:hidden" id="edit4" onclick="return editClass4()">Edit</button>
          <button type="button" class="btn btn-danger" style="width:75px; visibility:hidden" id="delete4" onclick="return deleteClass4()">Delete</button>
        </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="text-center">
        <button type="button" class="btn btn-primary btn-lg" style="background: white;height:150px;width:150px;" id="button5" disabled="true" onclick="window.location.href = 'flashcardset.html';">Class 5</button>
        <div>

          <button type="button" class="btn btn-light" style="width:75px;visibility:hidden" id="edit5" onclick="return editClass5()">Edit</button>
          <button type="button" class="btn btn-danger" style="width:75px; visibility:hidden" id="delete5" onclick="return deleteClass5()">Delete</button>
        </div>
        </div>
      </div> -->

</div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <!-- <script src="js/bootstrap.min.js"></script> if you downloaded bootstrap to your computer -->

    <!-- Why should JS be put at the bottom of the page? -->
    <!-- The newClass() function looks to see if classes have been made, and adds a new class in an empty area -->
    <!-- Each class has an editClass() and deleteClass() function that allows users to edit the class name or delete the class -->

     <script>
      function openForm() {
      document.getElementById("myForm").style.display = "block";
      }

      function closeForm() {
        document.getElementById("myForm").style.display = "none";
      }

    //    function newClass(){
    //    var class1 = document.getElementById("button1");
    //    var class2 = document.getElementById("button2");
    //    var class3 = document.getElementById("button3");
    //    var class4 = document.getElementById("button4");
    //    var class5 = document.getElementById("button5");
    //    var class6 = document.getElementById("button6");

    //    var edit1 = document.getElementById("edit1");
    //    var delete1 = document.getElementById("delete1");

    //    var edit2 = document.getElementById("edit2");
    //    var delete2 = document.getElementById("delete2");

    //    var edit3 = document.getElementById("edit3");
    //    var delete3 = document.getElementById("delete3");

    //    var edit4 = document.getElementById("edit4");
    //    var delete4 = document.getElementById("delete4");

    //    var edit5 = document.getElementById("edit5");
    //    var delete5 = document.getElementById("delete5");

    //    if (class1.style.background === "white"){
    //    class1.style.background = "blue";
    //    edit1.style.visibility = "visible";
    //    delete1.style.visibility = "visible";
    //    class1.disabled = false;
    //    return 0;
    //    }

    //    if (class2.style.background === "white"){
    //    class2.style.background = "blue";
    //    edit2.style.visibility = "visible";
    //    delete2.style.visibility = "visible";
    //    class2.disabled = false;
    //    return 0;
    //    }

    //    if (class3.style.background === "white"){
    //    class3.style.background = "blue";
    //    edit3.style.visibility = "visible";
    //    delete3.style.visibility = "visible";
    //    class3.disabled = false;
    //    return 0;
    //    }

    //    if (class4.style.background === "white"){
    //    class4.style.background = "blue";
    //    edit4.style.visibility = "visible";
    //    delete4.style.visibility = "visible";
    //    class4.disabled = false;
    //    return 0;
    //    }

    //    if (class5.style.background === "white"){
    //    class5.style.background = "blue";
    //    edit5.style.visibility = "visible";
    //    delete5.style.visibility = "visible";
    //    class5.disabled = false;
    //    return 0;
    //    }

    //    return 0;
    //    }

    //  function deleteClass1(){
    //     var class1 = document.getElementById("button1");
    //     var edit1 = document.getElementById("edit1");
    //     var delete1 = document.getElementById("delete1");

    //     class1.style.background = "white";
    //     edit1.style.visibility = "hidden";
    //     delete1.style.visibility = "hidden";
    //     class1.disabled = true;
    //     class1.innerHTML = "Class 1";
    //     }

    //  function deleteClass2(){
    //     var class2 = document.getElementById("button2");
    //     var edit2 = document.getElementById("edit2");
    //     var delete2 = document.getElementById("delete2");

    //     class2.style.background = "white";
    //     edit2.style.visibility = "hidden";
    //     delete2.style.visibility = "hidden";
    //     class2.disabled = true;
    //     class2.innerHTML = "Class 2";
    //     }

    //  function deleteClass3(){
    //     var class3 = document.getElementById("button3");
    //     var edit3 = document.getElementById("edit3");
    //     var delete3 = document.getElementById("delete3");

    //     class3.style.background = "white";
    //     edit3.style.visibility = "hidden";
    //     delete3.style.visibility = "hidden";
    //     class3.disabled = true;
    //     class3.innerHTML = "Class 3";
    //     }

    //  function deleteClass4(){
    //     var class4 = document.getElementById("button4");
    //     var edit4 = document.getElementById("edit4");
    //     var delete4 = document.getElementById("delete4");

    //     class4.style.background = "white";
    //     edit4.style.visibility = "hidden";
    //     delete4.style.visibility = "hidden";
    //     class4.disabled = true;
    //     class4.innerHTML = "Class 4";
    //     }

    //  function deleteClass5(){
    //     var class5 = document.getElementById("button5");
    //     var edit5 = document.getElementById("edit5");
    //     var delete5 = document.getElementById("delete5");

    //     class5.style.background = "white";
    //     edit5.style.visibility = "hidden";
    //     delete5.style.visibility = "hidden";
    //     class5.disabled = true;
    //     class5.innerHTML = "Class 5";
    //     }

    //  function editClass1(){
    //     var button1 = document.getElementById("button1");
    //     var newText = prompt("Enter a new class name","Class 1");
    //     button1.innerHTML = newText;
    //     return 0;
    //      }

    //  function editClass2(){
    //     var button2 = document.getElementById("button2");
    //     var newText = prompt("Enter a new class name","Class 2");
    //     button2.innerHTML = newText;
    //     return 0;
    //      }

    //  function editClass3(){
    //     var button3 = document.getElementById("button3");
    //     var newText = prompt("Enter a new class name","Class 3");
    //     button3.innerHTML = newText;
    //     return 0;
    //      }

    //  function editClass4(){
    //     var button4 = document.getElementById("button4");
    //     var newText = prompt("Enter a new class name","Class 4");
    //     button4.innerHTML = newText;
    //     return 0;
    //      }

    //  function editClass5(){
    //     var button5 = document.getElementById("button5");
    //     var newText = prompt("Enter a new class name","Class 5");
    //     button5.innerHTML = newText;
    //     return 0;
    //      }
     </script>
        </body>
</html>