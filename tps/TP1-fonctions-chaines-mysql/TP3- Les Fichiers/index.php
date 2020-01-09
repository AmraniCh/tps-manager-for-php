<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Les Fichiers</title>
    <style>
      .tp{
        background-color: #EEE;
        padding: 10px;
        margin-bottom: 20px;
        border: 2px solid #999
      }
      .tp form{
        margin-top: 10px
      }
    </style>
  </head>
  <body>
    <?php

    // A)
    function CreerFichier($nom, $contenu){
      $file = fopen($nom, "w");
      fwrite($file, $contenu);
      fclose($file);
    }

    if( isset($_POST['submit1']) ):

      $nom = $_POST['nom-a-b'];
      $contenu = $_POST['contenu-a-b'];

      CreerFichier($nom, $contenu);

    endif;

    // B)
    function AfficherFichier($nom){
      $file = fopen($nom, "r");
      $contenu = fread($file, 99);
      fclose($file);
      return $contenu;
    }

    if( isset($_POST['submit2']) ):

      $nom = $_POST['nom-a-b'];
      $contenu = $_POST['contenua-a-b'];

      $contenu = AfficherFichier($nom);

    endif;

    // C)
    function monFichier1($ch){
      if( !file_exists($ch1) )
        CreerFichier($ch1, "Contenu de Fichier 1");
    }


    // D)
    function monFichier2($ch1, $ch2){
      $contenu = AfficherFichier($ch1);
      CreerFichier($ch2, $contenu);
    }

    monFichier2("ch1.text", "ch2.text");

    // E)
    function Calculer1($nom){

      $contenu = AfficherFichier($nom);
      $content_array = str_split($contenu);
      $n_voyelles = 0;

      $voyelles = array("a", "e", "i", "u", "o");

      foreach( $content_array as $char ){
        ( in_array($char, $voyelles) ) ? $n_voyelles   : null;
      }

      return $n_voyelles;
    }

    if( isset($_POST['submit3']) ):
      $n_voyelles = Calculer1($_POST['nom-e']);
    endif;

    // F)
    function Calculer2($nom){
      $contenu = AfficherFichier($nom);
      $content_array = str_split($contenu);
      $nombres = 0;
      $chars = 0;

      foreach( $content_array as $char ){
        ( is_numeric($char) ) ? $nombres   : $chars  ;
      }

      return array("nombres" => $nombres, "chars" => $chars);
    }

    if( isset($_POST['submit4']) ):
      $n_occ_chars = Calculer2($_POST['nom-f'])['chars'];
      $n_occ_nbrs = Calculer2($_POST['nom-f'])['nombres'];
    endif;

    // G)
    function Calculer3($nom){
      //$count = count(file($nom));
      $contenu = AfficherFichier($nom);
      $count = substr_count($contenu, "\n");
      return $count;
    }

    if( isset($_POST['submit5']) ):
      $arr = array("Nombre des caract%uFFFDres : " => Calculer2($_POST['nom-g'])['chars'], "Nombre des chiffres : " => Calculer2($_POST['nom-g'])['nombres'], "Nombre de lignes : " => Calculer3($_POST['nom-g']));
      $file = fopen("Resultat.txt", "w");
      asort($arr);

      $output = "";
      foreach ( $arr as $key => $value) {
        $output.= $key . $value . "\n";
      }

      $write = fwrite($file, $output);
    endif;

    // H)
    function ChercherMot($nom, $mot){
      $contenu = AfficherFichier($nom);
      return substr_count($contenu, $mot);
    }

    if( isset($_POST['submit6']) ):
      $n_occ_mot = ChercherMot($_POST['nom-h'], $_POST['mot-h']);
    endif;

    // I)
    function InverserFichier(){
      $contenu = AfficherFichier("inverse1.txt");
      $arr = str_split($contenu);
      $reverse = array_reverse($arr);
      CreerFichier("inverse2.txt", join("", $reverse));
    }

    InverserFichier();

    // J)
    $erreur_taille = "";
    function ChargerFichier($id, $nom, $origin){
      global $erreur_taille;
      $file = fopen("info.txt", "a");
      $size = filesize("info.txt");
      if($size < 100)
        fwrite($file, $id . "      " . $nom . "      " . $origin . "\n");
      else
        $erreur_taille.= "Vous avez attaiez la taille maximale de fichier!";
    }

    if( isset($_POST['submit7']) ):
      ChargerFichier($_POST['id-j'], $_POST['nom-j'], $_POST['origin-j']);
    endif;

    //K)
    function ChercherCode($code){
      $contenu = file_get_contents("info.txt");
      $lignes = explode("\n", $contenu);

      foreach ($lignes as $value) {
        $cols = explode(" ", $value);
        if( $cols[0] == $code )
          return array(
            "nom" => $cols[1],
            "origin" => $cols[2]
          );
        // override last empty line
        if( $i === (count($lignes) - 2) ) break;
      }
    }

    if( isset($_POST['submit8']) ):
      $nom_k = ChercherCode($_POST['id-k'])['nom'];
      $origin_k = ChercherCode($_POST['id-k'])['origin'];
    endif;

    // L)
    function ChargerFichier2(){
      $contenu = file_get_contents("info.txt");
      $lignes = explode("\n", $contenu);
      $info = array();

      foreach ($lignes as $i => $value) {
        $cols = explode(" ", $value);
        $info[$cols[0]] = array($cols[1], $cols[2]);
        // override last empty line
        if( $i === (count($lignes) - 2) ) break;
      }
      return $info;
    }
    //echo var_dump(ChargerFichier2());

    // M)
    $nbr_v = 0;
    function CompterVille($v, $info){
      global $nbr_v;
      foreach ($info as $value) {
        if( $v == trim($value[1]) ) $nbr_v  ;
      }
    }

    if( isset($_POST['submit9']) ):
      CompterVille($_POST['ville-m'], ChargerFichier2());
    endif;

    // N)
    function DistribuerVille($info){
      foreach ($info as $key => $val) {
        $file = fopen( trim($val[1]).".txt", "a" );
        fwrite($file, $key . " " . $val[0] . " " . $val[1] . "\n");
      }
    }

    DistribuerVille(ChargerFichier2());


// array_unique
// file_get_content
// substr_count => \n

    ?>
    <div class="tp">
      <span class="titre">A) - B)</span>
      <form action="" method="post">
        <label>Nom de fichier : </label>
        <input type="text" name="nom-a-b">
        <label>Contenu de fichier : </label>
        <input type="text" name="contenu-a-b" value="<?php if(isset($contenu)) echo $contenu ?>">
        <input type="submit" name="submit1" value="Cr%uFFFDer Fichier">
        <input type="submit" name="submit2" value="Afficher Fichier">
      </form>
    </div>

    <div class="tp">
      <span class="titre">E)</span>
      <form action="" method="post">
        <label>Nom : </label>
        <input type="text" name="nom-e">
        <label>Nombre des voyelles : </label>
        <input type="text" value="<?php if(isset($n_voyelles)) echo $n_voyelles ?>">
        <input type="submit" name="submit3" value="Afficher">
      </form>
    </div>

    <div class="tp">
      <span class="titre">F)</span>
      <form action="" method="post">
        <label>Nom : </label>
        <input type="text" name="nom-f">
        <label>Nombre d'occurence - caract%uFFFDres : </label>
        <input type="text" value="<?php if(isset($n_occ_chars)) echo $n_occ_chars ?>">
        <label>Nombre d'occurence - nombres : </label>
        <input type="text" value="<?php if(isset($n_occ_nbrs)) echo $n_occ_nbrs ?>">
        <input type="submit" name="submit4" value="Afficher">
      </form>
    </div>

    <div class="tp">
      <span class="titre">G)</span>
      <form action="" method="post">
        <label>Nom : </label>
        <input type="text" name="nom-g">
        <input type="submit" name="submit5" value="Resultat.txt">
      </form>
    </div>

    <div class="tp">
      <span class="titre">H)</span>
      <form action="" method="post">
        <label>Nom de fichier : </label>
        <input type="text" name="nom-h">
        <label>Mot recherch%uFFFD : </label>
        <input type="text" name="mot-h">
        <label>Nombre d'occurence : </label>
        <input type="text" value="<?php if(isset($n_occ_mot)) echo $n_occ_mot ?>">
        <input type="submit" name="submit6" value="Afficher">
      </form>
    </div>

    <div class="tp">
      <span class="titre">J)</span>
      <form action="" method="post">
        <label>ID : </label>
        <input type="text" name="id-j">
        <label>Nom : </label>
        <input type="text" name="nom-j">
        <label>Origin : </label>
        <input type="text" name="origin-j">
        <input type="submit" name="submit7" value="Ajouter">
        <h5><?php if( isset($erreur_taille)) echo $erreur_taille ?></h5>
      </form>
    </div>

    <div class="tp">
      <span class="titre">K)</span>
      <form action="" method="post">
        <label>ID recherc%uFFFD : </label>
        <input type="text" name="id-k">
        <input type="submit" name="submit8" value="Afficher">
        <label>Nom : </label>
        <input type="text" value="<?php if(isset($nom_k)) echo $nom_k ?>">
        <label>Origin : </label>
        <input type="text" value="<?php if(isset($origin_k)) echo $origin_k ?>">
      </form>
    </div>

    <div class="tp">
      <span class="titre">M)</span>
      <form action="" method="post">
        <label>Ville : </label>
        <input type="text" name="ville-m">
        <input type="submit" name="submit9" value="Afficher">
        <label>Nombre d'article : </label>
        <input type="text" value="<?php if(isset($nbr_v)) echo $nbr_v ?>">
      </form>
    </div>
  </body>
</html>
