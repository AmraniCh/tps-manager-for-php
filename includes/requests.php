<?php
  require "db_inc.php";
  require "tps_manager.class.php";

    if( isset($_POST['func']) )
      define("CALLED_FUNCTION", $_POST["func"]);
    else{
      define("CALLED_FUNCTION", $_GET["func"]);
    }

    switch( CALLED_FUNCTION ){
      case "getTps":
        echo getTps($_POST['filter'], $_POST['showNumber']);break;
      case "deleteTp":
        echo deleteTp($_GET['tpId']);break;
      case "getPagination":
        echo getPagination($_POST['showNumber']);break;
      case "getTpsCode":
        echo getTpsCode($_POST['idTp']);break;
      case "saveExerciceCode":
        echo saveExerciceCode($_POST['idExer'], $_POST['changes']);break;
      case "addTp":
        echo addTp($_GET['nomTp'], $_GET['descTp'], $_GET['nomFichier']);break;
      case "deleteSpecificTps":
        echo deleteSpecificTps($_POST['tp_ids']);break;
      default: json_encode(null);
    }


    function getTps($filter, $showNumber){
      global $con;
      /*
      $filter = filter_var($_filter, FILTER_SANITIZE_STRING);
      $showNumber = filter_var($_showNumber, FILTER_SANITIZE_NUMBER_INT);*/
      ($filter == "ancient") ? $filter = "ASC" : $filter = "DESC";
      $query = $con->query("SELECT * FROM tp ORDER BY dateAjoute $filter LIMIT 0,$showNumber");
      if( $query->num_rows > 0 ){
        while($row = $query->fetch_array()){
          $tps[] = [
            "idTp" => $row[0],
            "nomTp" => $row[1],
            "description" => $row[2],
            "nomFichier" => $row[3],
            "dateAjoute" => strftime("%d/%m/%Y", strtotime($row[4]))
          ];
        }
        return json_encode($tps);
      }
      return json_encode(false);
    }

    function deleteTp($tpId){
      global $con;
      $con->query("DELETE FROM tp WHERE idTp = $tpId");
      return json_encode(true);
    }

    function getPagination($showNumber){
      global $con;
      $query = $con->query(" SELECT COUNT(*) FROM tp");
      $row = $query->fetch_row();
      $tp_count = $row[0];
      $pages = ceil($tp_count / $showNumber);
      return $pages;
    }

    function getTpsCode($idTp){
      global $con;
      $query = $con->query("SELECT * FROM exercice WHERE idTp = $idTp ");
      if( $query->num_rows > 0 ){
        $row = $query->fetch_assoc();
          $codes = array(
            "idExercice" => $row['idExercice'],
            "codeFichier" => $row['codeFichier']
          );

          return json_encode($codes["codeFichier"]);
      }
    }

    function saveExerciceCode($idExer, $changes){
      global $con;
      $query = $con->query(" SELECT nomTp, nomExercice FROM tp INNER JOIN exercice ON tp.idTp = exercice.idTp WHERE idExercice = $idExer");
      $row = $query->fetch_row();
      $nomTp = $row[0];
      $nomExer = $row[1];
      return TPSManager::tp($nomTp)::exercice($nomExer)::saveExerciceCode($idExer, $changes);
    }

    function addTp($nomTp, $descTp, $nomFichier){
      global $con;
      $con->query(" INSERT INTO tp VALUES(NULL, '$nomTp', '$descTp', '$nomFichier', default) ");
      return ( $con->affected_rows > 0 ) ? json_encode(true) : json_encode(false);
    }

    function deleteSpecificTps($_tp_ids){
      global $con;
      $tp_ids = json_decode($_tp_ids);
      foreach($tp_ids as $idTp){
        $con->query(" DELETE FROM tp WHERE idTp = $idTp ");
      }
      return json_decode(true);
    }

/*
    $uploadTp = function($file) use ($con){
      if(is_array($_FILES))
        move_uploaded_file($_FILES['file']['tmp_name'], "../fichiers/".$_FILES['file']['name']);
    }
*/
?>
