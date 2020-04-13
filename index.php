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
                $_SESSION['session_user_id'] = $result['user_id']; 
                $_SESSION['session_name'] = $result['name'];
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
    echo "<script type='text/javascript'>
    alert('Error: That is not a valid username and password ')
    </script>";
    }

    else
    {
    //$_SESSION['session_name'] = $name;
    $_SESSION['session_email'] = $email;
    $_SESSION['session_password'] = $password;

    echo("<script>location.href = 'landing.php';</script>");
    }

  }
?>