<!-- Shannon Chu (slc8jz), Max Lindquist (mrl2dj), Jerome Romualdez (jhr3kd) -->

<?php
    session_start();
    echo count($_SESSION);
    foreach ($_SESSION as $key => $value)
    {
      unset($_SESSION[$key]);
   }

    session_destroy();
    echo("<script>location.href = 'index.php';</script>");

?>
