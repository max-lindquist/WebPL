<!-- Shannon Chu (slc8jz), Max Lindquist (mrl2dj), Jerome Romualdez (jhr3kd) -->

<?php session_start();

if (!isset($_SESSION['session_user_id'])) {
  echo "<script>location.href = 'index.php';</script>";
}
else if (!isset($_GET['set_id']) || !isset($_GET['class_id'])) {
  echo "<script>location.href = 'flashcardset.php';</script>";
}

$user_id = $_SESSION['session_user_id'];
$set_id = $_GET['set_id'];
$class_id = $_GET['class_id'];

require('flashme-connectdb.php');

$query = "SELECT * FROM `flashcard_set` WHERE set_id=$set_id AND class_id=$class_id";
$result = $db->query($query);
$num_rows = $result->rowCount();
//echo "num_rows=$num_rows\n";
if ($num_rows > 0) {
  if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $set_name = $row["name"];
    $_SESSION['session_flashcardset_name'] = $set_name;
  }
}


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
    <style>
      table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
        }
    </style>

  </head>
  <body style="background-color:#ff9d26;" onload="initRows()">
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
        <!--<h1 style="color:white"><?php echo $_SESSION['session_class_name'] ?></h1>-->
        <h1 style="color:white"><?php echo $_SESSION['session_flashcardset_name'] ?></h1>
        &nbsp;
      <!-- 4. use bootstrap form layouts
              Bootstrap provides three types of form layouts: 
                - verical form (default)
                - horizontal form
                - inline form
              Standard rules for all three form layouts: 
                - wrap labels and form controls in <div class="form-group">
                  (needed for optimum spacing) 
                - add class .form-control to all textual <input>, <textarea>, 
                  and <select> elements
         --> 
         
        <!-- <label> tag defines a label for an <input> element.
             It does not render as anything special for the user. 
             It provides a usability improvement for mouse useres, because 
             if the user clicks on the text within the <label> element,
             it toggles the control. 
             The for attribute of the <label> tag should be equal to the id attribute
             of the related element to bind them together. 
         -->
         
        <!-- Bootstrap provides several different styles of buttons.
             Here, we use the basic, default style 
         -->
         
        <!-- <form name="mainform" action="" method="get"> -->
        <center>
        <form name = "">
          <form class="form-inline" action="">
              <div class="form-group">
                <label for="term" style="color:white">Term</label>
                &nbsp;
                <input type="text" id="term" class="form-control" name="term" style="width:70%"/>
                <span class="error" id="term-note"></span> 
              </div>
              <div class="form-group">
                <label for="definition" style="color:white">Definition</label>
                &nbsp;
                <input type="text" id="definition" class="form-control" name="definition" style="width:70%" />
                <span class="error" id="definition-note"></span>  
              </div>
          </form>
        </form>
        </center>
        &nbsp;
          <div class="buttonHolder">
            <input type="button" class="btn btn-light" style="width:150px; height:50px; background-color: #0008f7; color:white; border:black; font-size:20px" id="add" value="Add flashcard" onclick="addRow()"/>
          </div>

          <br><br/>


        
        <!-- <div class="row">
        <form name="mainform" >
          <div class="form-group" style="display:inline-block; min-width: 48.8%">
            <label for="term" style="color:white">Term</label>
            <input type="text" id="term" class="form-control" name="term" />
            <span class="error" id="term-note"></span>        
            
           5. To set focus (i.e., put a cursor) in a particular form input, 
                   an <input> tag's autofocus attribute may be used 
                   and thus the html form will have the following <input> tag -->
           <!--  <input type="text" id="taskdesc" class="form-control" name="desc" autofocus /> -->
           
           <!-- Alternatively, we can use a JS function to set focus when the page is loaded 
                (that is, on <body> load). Thus, we need to add an onload event listener and handle the event. 
                In this example, we add an onload event to <body> tag. -->
              
            <!-- </div>
            <div class="form-group" style="display:inline-block; min-width: 48.8%; margin-right: 1.4%"> 
              <label for="definition" style="color:white">Definition</label>
              <input type="text" id="definition" class="form-control" name="definition" />
              <span class="error" id="definition-note"></span>  
            <br>
            <input type="button" class="btn btn-light" style="background-color: #0008f7; color:white" id="add" value="Add flashcard" onclick="addRow()"/> 
          </div>
        </form>
        </div>
    
        <br><br/> --> 
          
          
      <!-- 6. display to do list using a table
       
           When an HTML document is loaded into a browser, 
           the browser converts the HTML elements into a tree-like structure. 
           This tree is called the DOM tree.  
           To manipulate DOM, there are three ways to access the element
           (i) use the element's id attribute, 
           (ii) use the element's name attribute, and 
           (iii) use the element's position.
           Let's access the element using it's id. 
           To access content of that element, use getElementById(id) method
           To get the current value of the element, use value property
           To set the HTML between the open/closing tags of element, use innerHTML property        
      -->
          
      <!-- A basic Bootstrap table has a light padding and horizontal dividers.
           To use the basic style, use .table class.   
      -->      
        <div id="todo">
          <table id="todoTable" class="table" style="background-color:white" >
            <col width="700">
            <col width="600">
            <col width="50">
            <thead>   <!-- set table headers -->
              <tr>
                <th>Term</th>
                <th>Definition</th>
                <th>(Delete)</th>
              </tr> 
            </thead>
            
            <!-- JS will dynamically create add new row upon form submission -->
            
          </table> 
        </div>
      </div>
      <br/> 
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

  function initRows()
  {
    <?php

    $query = "SELECT * FROM flashcard WHERE user_id=$user_id AND class_id=$class_id AND set_id=$set_id";
    $result = $db->query($query);
    $num_rows = $result->rowCount();
    //echo "num_rows=$num_rows\n";
    if ($num_rows > 0) {
      // output data of each row
      $count = 0;
      while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $card_id = $row["card_id"];
          $term = $row["term"];
          $def = $row["definition"];
          ?>
          addRow3("<?php echo $card_id ?>", "<?php echo $term ?>", "<?php echo $def ?>");
          <?php
          $count++;
      }
    }
    ?>
  }
  function goForward() 
  {
     window.history.forward();
  }
  function goBack() 
  {
     window.history.back();
  }
  function goBack2pages() 
  {
     window.history.go(-2);
  }  

  function displayLocationInfo()
  {
	 // both lines produce the same result 
     // window.document.getElementById("demo").innerHTML = location.href;   
     document.getElementById("demo").innerHTML = location.href;
  }
  
  // function ChangeFieldByName(by, str) 
  // {
  //    document.mainform.desc.value = str + " (access element by " + by.getAttribute("data-change-by") + ")";
  // }   
  // function ChangeFieldById(by, str) 
  // {
  //    document.getElementById("taskdesc").value = str + " (access element by " + by.getAttribute("data-change-by") + ")";  	 
  // }
  // function ChangeFieldByPosition(by, str) 
  // {
  //    document.forms[0].elements[0].value = str + " (access element by " + by.getAttribute("data-change-by") + ")";  	 
  // }     
  
  // add event listener to the element 
  // when this element gets focus, call a validateTaskDesc function 
  // note: to add an event, don't include the prefix "on" -- e.g., use "click" and "mouseover" not "onclick" and "onmouseover"  
  //document.getElementById("duedate").addEventListener("focus", validateTaskDesc);
  function validateTerm() 
  {
     if (document.getElementById("term").value === '')
     {
        // if user needs to fix this element, put cursor to it (reduce excise task)
        // and tell user how to fix it
        document.getElementById("term").focus();
        document.getElementById("term-note").innerHTML = "Please enter a term";
     }
     else 
    	document.getElementById("term-note").innerHTML = ""; // if nothing is wrong, let's make sure no left-over message 
  }
  
  function addRow()
  {
    var term = document.getElementById("term").value;
    var definition = document.getElementById("definition").value;

    // ajax call
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          addRow2(this.responseText);
        }
    };
    var uri = "flashcard_add.php?class_id=<?php echo $class_id ?>&set_id=<?php echo $set_id ?>&term=" + term + "&def=" + definition;
    //alert(uri);
    //alert(encodeURI(uri));
    xmlhttp.open("GET", encodeURI(uri), true);
    xmlhttp.send();
  }

  function addRow2(card_id)
  {
    var term = document.getElementById("term").value;
    var definition = document.getElementById("definition").value;
    addRow3(card_id, term, definition);
  }

  function addRow3(card_id, term, definition)
  {
	 // use getElementById() method
	 // If the element is found, the method will return the element as an object 	 
	 // If the element is not found, a null is returned	  
   //  var term = document.getElementById("term").value;
   //  var definition = document.getElementById("definition").value;
   // delRow(10, "term")
     var removeoption = "<input type=button value=' X ' onClick='delRow(" + card_id + ", \"" + term + "\")'>";
     
     // Another way to validate taskdesc is to have the checking here 
     // (instead of using an addEventListener() and the validateTaskDesc() function above).       
     if (term === '')    // check if appropriate data are entered
     {
        document.getElementById("term").focus();
        document.getElementById("term-note").innerHTML = "Please enter a term";
     } 
     else
     {
    	document.getElementById("term-note").innerHTML = ""; 
    	
        if (definition === '')    // check if appropriate data are entered
        {
            document.getElementById("definition").focus();
            document.getElementById("definition-note").innerHTML = "Please enter a definition";
        } 
        else
        {
           document.getElementById("definition-note").innerHTML = "";
    	
           // put all pieces of data in an array for later used to create cell content of a row 
           var rowdata = [term, definition, removeoption];
     
           // clear data entries (in the form)
           document.getElementById("term").value = "";
           document.getElementById("definition").value = "";
 
           // find a <table> element to add row to (in this example, a table with id="todoTable")
           var tableRef = document.getElementById("todoTable");
     
           // create an empty <tr> element and add it to the table
           // using insertRow(index) method
           var newRow = tableRef.insertRow(tableRef.rows.length);    // table_object.rows.length returns the number of <tr> elements in the collection
           // add event listener, on mouseover, set row index. This will be used when deleting a row
           newRow.onmouseover = function() { 
        	  // rowIndex returns the position of a row in the rows collection of a table
              tableRef.clickedRowIndex = this.rowIndex;     
           };    
           // alternatively, use data-index to store index of the line 
           //  (note: data-* attributes can store arbitrary data with elements)
           // eg: <div id="elem" data-index=3></div>
          
           var newCell = "";       
           var i = 0;
           // insert new cells (<td> elements) at the 1st, 2nd, 3rd, 4th position of the new <tr> element
           // using insertCell(method) method        	      
           while (i < 3)
           {
              newCell = newRow.insertCell(i);
              newCell.innerHTML = rowdata[i];
              newCell.onmouseover = this.rowIndex;
              i++;
           }
        }
     }
  }  
  
  function delRow(card_id, term)
  {
    if (confirm("Press OK to delete '" + term + "'. This action is unrecoverable.") == true) { 
      // ajax call
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("todoTable").deleteRow(document.getElementById("todoTable").clickedRowIndex);
          }
      };
      var uri = "flashcard_delete.php?class_id=<?php echo $class_id ?>&set_id=<?php echo $set_id ?>&card_id=" + card_id;
      //alert(uri);
      //alert(encodeURI(uri));
      xmlhttp.open("GET", encodeURI(uri), true);
      xmlhttp.send();
    }
  }

  // function delRow2(card_id, term)
  // {

  //   //var tbl = document.getElementById("todoTable");
  //   //var index = tbl.clickedRowIndex;
  //   //alert(tbl.rows[index].cells[0].innerHTML);
  //    // since deletion action is unrecoverable, add hesitation to minimize/avoid user error 
	//  if (confirm("Press OK to delete '" + term + "' (" + card_id + "). This action is unrecoverable.") == true) { 
  //       document.getElementById("todoTable").deleteRow(document.getElementById("todoTable").clickedRowIndex);
  //  }
  //}
  
  </script>
</html>
