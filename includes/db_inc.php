<?php
  require "db.class.php";

  db::selectDB("gsexercices");
  db::setCharset("UTF8"); // OPTIONAL
  $con = db::connect();

?>
