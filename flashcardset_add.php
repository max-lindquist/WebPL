<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST")
  {
    require('flashme-connectdb.php');
    //$class_id = $_GET['class_id'];
    $flashcard_name = $_POST['form_flashcard_name'];
    $class_id = $_POST['class_id'];



    // if (checkEmail($email) == true)
    // {
    // echo "There is already an account with that email";
    // }

    $query = "INSERT INTO flashcard_set (name, class_id) VALUES (:query_flashcard_name, :query_class_id)";
    $statement = $db->prepare($query);
    $statement->bindValue(':query_flashcard_name', $flashcard_name);
    $statement->bindValue(':query_class_id', $class_id);
    $statement->execute();
    $statement->closeCursor();

    //$_SESSION['session_flashcard_name'] = $flashcard_name;
    // $_SESSION['email'] = $email;
    // $_SESSION['password'] = $password;

    echo("<script>location.href = 'flashcardset.php?class_id=$class_id';</script>");

  }
  ?>