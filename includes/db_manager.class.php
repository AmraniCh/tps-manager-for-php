<?php

  final class DBManager{
    private static $table;
    private static $limit;
    private static $where;
    private static $query;

    public static function setTable($table){
      self::$table = $table;
    }

    public static function getColumns($table): array{
      global $con;
      $column_names = array();
      $query = $con->query("SELECT `COLUMN_NAME`
          FROM `INFORMATION_SCHEMA`.`COLUMNS`
          WHERE `TABLE_SCHEMA`='gsexercices'
              AND `TABLE_NAME`= '$table'");
      while($row =  $query->fetch_row()){
        $column_names[] = $row[0];
      }
      return $column_names;
    }

    public static function getAllRows($table = null, $min = null, $max = null){
      global $con;
      ($table != null) ? self::$table = $table : $table = self::$table;
      if( $min != null ){
        self::$query .= "LIMIT $min";
      }
      if($max != null){
        self::$query .= "LIMIT $min, $max";
      }
      $query = $con->query(" SELECT * FROM $table ");
      if( $query->num_rows > 0 ){
        while( $row = $query->fetch_assoc() ){
            $column_names = self::getColumns($table);
            foreach ( $column_names  as $col_name) {
              $fetch[] = $row[$col_name];
            }
        }
      }
      else
        return ("Empty Result");
      return $fetch;
    }

    public static function select($table = null, $select = "*"){
      global $con;
      ($table != null) ? self::$table = $table : $table = self::$table;/*
      if( !in_array("*", $select) ){
        $slct = implode(",", $select);
      }
      else {
        $slct = $select[0];
      }
      $table = self::$table;*/
      $query = "SELECT * FROM $table ";
      self::$query = $query;
      return new static;
    }

    public static function where($where, $type = "AND"){
      global $con;
      $table = self::$table;
      if( is_array($where) && !empty($where)){
        foreach ($where as $key => $value) {
          if( empty(self::$where) ){
            self::$query.= sprintf(" WHERE %s = '%s'", $key, $value);
            self::$where = $where;
          }
          else{
            self::$query.= sprintf(" %s %s = '%s' ", $type, $key, $value);
          }
        }
      }
      return new static;
    }

    public static function getRow($fetch_type = "assoc"){
      global $con;
      //return self::$query;
      $query = $con->query(self::$query);
      $table = self::$table;
      if( $query->num_rows > 0 ){
        while( $row = $query->fetch_assoc() ){
            $column_names = self::getColumns($table);
            foreach ( $column_names  as $col_name) {
              ($fetch_type == "row") ? $fetch[] = $row[$col_name] : $fetch[$col_name] = $row[$col_name];
            }
        }
        mysqli_free_result($query);
      }
      else
        return "empty result";
      return $fetch;
    }

    public static function limit($min, $max = null){
      global $con;
      if( $max == null ){
        self::$query .= "LIMIT $min";
      }
      else{
        self::$query .= "LIMIT $min, $max";
      }
      return new static;
    }

  }

?>
