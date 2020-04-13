<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST")
  {
    require('flashme-connectdb.php');
    $class_name = $_POST['form_class_name'];
    $user_id = $_SESSION['session_user_id'];

    // if (checkEmail($email) == true)
    // {
    // echo "There is already an account with that email";
    // }

    $query = "INSERT INTO class (name, user_id) VALUES (:query_class_name, :query_user_id)";
    $statement = $db->prepare($query);
    $statement->bindValue(':query_class_name', $class_name);
    $statement->bindValue(':query_user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();

    //$_SESSION['session_class_name'] = $class_name;
    // $_SESSION['email'] = $email;
    // $_SESSION['password'] = $password;
    
    // echo "user_id=$user_id class_name=$class_name";
    // echo "\nPDO::errorInfo():\n";
    // print_r($db->errorInfo());

    echo("<script>location.href = 'landing.php';</script>");

  }
  ?>