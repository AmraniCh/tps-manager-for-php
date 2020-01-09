<?php
  $host = "localhost";
  $user = "root";
  $password = "";
  $db = "gestionnotes";

  $con = mysqli_connect($host, $user, $password, $db);
  $con->set_charset("UTF8");

  if($con)
    echo "connected";
  else
    echo "Failed";
?>
