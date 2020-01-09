<?php

  final class db{
    private static $con;
    private static $database;
    public static $connected;
    public static $charset = "UTF-8";

    public static function connect(){
      try{
        if( self::$con = @mysqli_connect("localhost", "root", "", self::$database) ){
          self::$con->set_charset(self::$charset);
          self::$connected = true;
          return self::$con;
        }
        else {
          self::$connected = false;
          throw new Exception ("connection failed to database!");
        }
      }
      catch(Exception $ex){
        $current_exception = $ex->getMessage();
        return $ex->getMessage();
      }
    }

    public static function selectDB($new_database){
      self::$database = $new_database;
    }

    public static function setCharset($charset){
      self::$charset = $charset;
    }


  }

?>
