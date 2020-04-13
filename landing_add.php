<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST")
  {
    require('flashme-connectdb.php');
    $class_name = $_POST['form_class_name'];

    // if (checkEmail($email) == true)
    // {
    // echo "There is already an account with that email";
    // }

    $query = "INSERT INTO class (name) VALUES (:query_class_name)";
    $statement = $db->prepare($query);
    $statement->bindValue(':query_class_name', $class_name);
    $statement->execute();
    $statement->closeCursor();

    //$_SESSION['session_class_name'] = $class_name;
    // $_SESSION['email'] = $email;
    // $_SESSION['password'] = $password;

    echo("<script>location.href = 'landing.php';</script>");

  }
  ?>