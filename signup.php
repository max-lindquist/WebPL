<?php session_start(); ?>

<?php
    include('signup.html');
?>

<?php
    function checkEmail($entry)
    {
        require('flashme-connectdb.php');
        $query = "SELECT * FROM user_info";
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closecursor();

        foreach ($results as $result)
        {
            if ($entry == $result['email']){
                return true;
                }
        }
    }

?>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == "POST")
  {
    require('flashme-connectdb.php');
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    if (checkEmail($email) == true)
    {
    echo "<script type='text/javascript'>
    alert('Error: There is already an account with that email address ')
    </script>";
    }

    else
    {
    $query = "INSERT INTO user_info (email, name, password) VALUES (:email,:name,:password)";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();

    $_SESSION['session_name'] = $name;
    $_SESSION['session_email'] = $email;
    $_SESSION['session_password'] = $password;

    echo("<script>location.href = 'signup_success.html';</script>");
    }

  }
    ?>
