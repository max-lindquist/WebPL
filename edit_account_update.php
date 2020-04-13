<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
  require('flashme-connectdb.php');
  $user_id = $_SESSION['session_user_id'];
  $name = $_POST['Name'];
  $email = $_POST['Email'];
  $password = $_POST['Password'];


  $query = "UPDATE user_info SET name='$name', password='$password' WHERE user_id='$user_id' AND email = '$email'";
  $result = $db->query($query);
  // $statement = $db->prepare($query);
  // // $statement->bindValue(':query_user_id', $user_id);
  // // $statement->bindValue(':query_email', $email);
  // $statement->bindValue(':name', $name);
  // $statement->bindValue(':password', $password);
  // $statement->execute();
  // $statement->closeCursor();

  // echo "name=$name user_id=$user_id email=$email";
  // echo "\nPDO::errorInfo():\n";
  // print_r($db->errorInfo());

  // $_SESSION['session_name'] = $result['name'];
  // $_SESSION['email'] = $result['email'];
  // $_SESSION['password'] = $result['password'];
  $_SESSION['session_name'] = $name;
  $_SESSION['session_email'] = $email;
  $_SESSION['session_password'] = $password;

  echo("<script>location.href = 'account.php';</script>");
  

}
  ?>

