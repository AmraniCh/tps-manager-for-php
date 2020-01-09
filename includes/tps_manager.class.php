<?php


  final class TPSManager{
    public static $root = "tps/";
    private static $tp;
    private static $exercice;
    private static $default = "/index.php";

    public static function setRoot($new_root){
      self::$root = $new_root;
    }

    public static function getTPPath($idTp){
      $row = DBManager::select("tp")::where(["idTp" => $idTp])::getRow();
      return self::$root . $row['nomTp'] . "/" . $row['nomFichier'];
    }

    // chain
    public static function tp($nomTp){
      self::$tp .= $nomTp . "/";
      return new static;
    }

    // chain
    public static function exercice($nomExer){
      self::$exercice .= '../tps/' . self::$tp . $nomExer . self::$default;
      return new static;
    }

    public static function saveExerciceCode($idExer, $changes){
        file_put_contents(self::$exercice, $changes);
        return self::updateExerciceDB($idExer);
    }

    public static function getExerciceCode(){
        return file_get_contents(self::$exercice);
    }

    public static function updateExerciceDB($idExer){
      global $con;
      $code = base64_encode(self::getExerciceCode());
      $con->query(" UPDATE exercice SET codeFichier = '".$code."' WHERE idExercice = $idExer ");
      return json_encode(true);
    }

    public static function getPathExercice($idExer){
      global $con;
      $query = $con->query("SELECT * FROM tp INNER JOIN exercice ON tp.idTp = exercice.idTp WHERE exercice.idExercice = $idExer");
      $row = $query->fetch_assoc();
      $nomTp = $row['nomTp'] . '/';
      $nomExer = $row['nomExercice'];
      return self::$root . $nomTp . $nomExer . self::$default;
    }

  }

?>
