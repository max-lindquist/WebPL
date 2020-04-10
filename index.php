<?php
    session_start();
    include('index.html');
?>


<?php
    function validate($emailAttempt, $passwordAttempt)
    {
        require('flashme-connectdb.php');
        $query = "SELECT * FROM user_info";
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closecursor();

        foreach ($results as $result)
        {
            if ($emailAttempt == $result['email'] && $passwordAttempt == $result['password']){
                return true;
                }
        }
    }

?>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == "POST")
  {
    require('flashme-connectdb.php');
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    if (validate($email, $password) == false)
    {
    echo "That is not a valid email and password";
    }

    else
    {

    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

    echo("<script>location.href = 'landing.php';</script>");
    }

  }
?>