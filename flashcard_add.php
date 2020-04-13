<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "GET")
  {
    require('flashme-connectdb.php');
    $user_id = $_SESSION['session_user_id'];
    $class_id = $_GET['class_id'];
    $set_id = $_GET['set_id'];
    $term = $_GET['term'];
    $definition = $_GET['def'];

    // if (checkEmail($email) == true)
    // {
    // echo "There is already an account with that email";
    // }

    $query = "INSERT INTO flashcard (user_id, class_id, set_id, term, definition) VALUES (:query_user_id, :query_class_id, :query_set_id, :query_term, :query_definition)";
    $statement = $db->prepare($query);
    $statement->bindValue(':query_user_id', $user_id);
    $statement->bindValue(':query_class_id', $class_id);
    $statement->bindValue(':query_set_id', $set_id);
    $statement->bindValue(':query_term', $term);
    $statement->bindValue(':query_definition', $definition);
    $statement->execute();
    $lastInsertID = $db->lastInsertId();
    $statement->closeCursor();

    echo $lastInsertID;

    //echo "set_id=$set_id, term=$term, def=$definition";
    // $_SESSION['session_flashcard_name'] = $flashcard_name;
    // $_SESSION['email'] = $email;
    // $_SESSION['password'] = $password;

    //echo("<script>location.href = 'flashcardset.php';</script>");

  }
  ?>