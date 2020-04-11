<?php
    session_start();
    include('edit_account.html');
?>

  <?php
  if ($_SERVER['REQUEST_METHOD'] == "POST")
  {
    require('flashme-connectdb.php');
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];


    $query = "UPDATE user_info SET name=:name, password=:password WHERE email=:email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();

    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

    echo("<script>location.href = 'landing.php';</script>");
    

  }
    ?>

