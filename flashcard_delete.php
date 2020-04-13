<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "GET")
  {
    require('flashme-connectdb.php');
    $class_id = $_GET['class_id'];
    $set_id = $_GET['set_id'];
    $card_id = $_GET['card_id'];

    // if (checkEmail($email) == true)
    // {
    // echo "There is already an account with that email";
    // }

    $query = "DELETE FROM `flashcard` WHERE class_id=$class_id AND set_id=$set_id AND card_id=$card_id";
    $result = $db->query($query);

    //echo "set_id=$set_id, term=$term, def=$definition";
    // $_SESSION['session_flashcard_name'] = $flashcard_name;
    // $_SESSION['email'] = $email;
    // $_SESSION['password'] = $password;

    //echo("<script>location.href = 'flashcardset.php';</script>");

  }
  ?>