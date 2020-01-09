<?php

  if( $_SERVER['REQUEST_METHOD'] == "GET"):

    require "db_inc.php";

    $data["MYSQL_CONN"] = "ON";

    if(db::$connected == false)
      $data["MYSQL_CONN"] = "OFF";

    if( !in_array($_SERVER['REMOTE_ADDR'], array("127.0.0.1", "[::1]", "::1"))) $data["APACHE_CONN"] = "OFF";

    echo json_encode($data);
  endif;

?>
