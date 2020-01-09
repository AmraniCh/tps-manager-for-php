<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>TP2</title>
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

      // a)
      if( isset($_POST['sub-tp1']) ):

          function NomComplet(){
            return $_POST['tp1-nom'] . ' ' . $_POST['tp1-prenom'];
          }

          $tp1_res = NomComplet();

      endif;

      // b)
      if( isset($_POST['sub-tp2']) ):

        function Remplacer(){
           return str_replace( $_POST['tp2-x'], $_POST['tp2-y'], $_POST['tp2-chaine'] );
        }

        $tp2_res = remplacer();


      endif;

      // c)
      function Repition($chaine, $indice){

        $rep = 0;
        $array_chaine = str_split($chaine);
        $first = $array_chaine[$indice];

        for( $i=$indice; $i<count($array_chaine); $i   ){
          if( $array_chaine[$i] == $first )
            $rep  ;
          else
            break;
        }

        return $rep;
      }

      if( isset($_POST['sub-tp3']) ):

        $chaine = $_POST['tp3-chaine'];
        $indice = $_POST['tp3-indice'];

        $tp3_res = Repition($chaine, $indice);

      endif;

      // d)
      function Entier($chaine, $indice){

        $entier = 0;
        $array_chaine = str_split($chaine);

        for( $i=$indice; $i<count($array_chaine); $i   ){
          if( is_numeric($array_chaine[$i]) )
            $entier  ;
          else
            break;
        }

        return $entier;
      }

      if( isset($_POST['sub-tp4']) ):

        $chaine = $_POST['tp4-chaine'];
        $indice = $_POST['tp4-indice'];

        $tp4_res = Entier($chaine, $indice);

      endif;

      // e)
      if( isset($_POST['sub-tp5']) ):

        $chaine = $_POST['tp5-chaine'];

        function CodageRLE($chaine){

          $array_chaine = str_split($chaine);

          $char = 0;
          $output = "";
          $count = 0;

          for( $i=$char; $i<count($array_chaine); $i   ){
            if( $i == $char ):
              $rep = Repition($chaine, $char);
              $output.= $rep . $array_chaine[$char];
              $char = $rep;
            endif;
          }

          return $output;
        }

        $tp5_res = CodageRLE($chaine);

      endif;

      // d)
      if( isset($_POST['sub-tp6']) ):

        $chaine = $_POST['tp6-chaine'];

        function DecodageRLE($chaine){

          $array_chaine = str_split($chaine);

          $output = "";
          $number = "";
          $char = "";

          for( $i=0; $i<count($array_chaine); $i   ){
            if( is_numeric($array_chaine[$i]) ){
              $number.= $array_chaine[$i];
            }
            else{
              $char = $array_chaine[$i];

              for( $j=0; $j<$number; $j   ){
                $output.= $char;
              }

              $number = "";
            }
          }

          return $output;

        }

        $tp6_res = DecodageRLE($chaine);

      endif;
    ?>
    <div class="tp">
      <span class="titre">A)</span>
      <form action="" method="post">
        <label for="tp1-nom">Nom : </label>
        <input type="text" name="tp1-nom">
        <label for="tp1-prenom">Pr%uFFFDnom : </label>
        <input type="text" name="tp1-prenom">
        <input type="submit" name="sub-tp1" value="Appliquer">
        <input type="text" readonly="true" placeholder="R%uFFFDsultat" value="<?php
          if( isset($tp1_res) )
            echo $tp1_res;
        ?>">
      </form>
    </div>

    <div class="tp">
      <span class="titre">B)</span>
      <form action="" method="post">
        <label for="tp2-nom">Chaine : </label>
        <input type="text" name="tp2-chaine">
        <label for="tp2-prenom">X : </label>
        <input type="text" name="tp2-x">
        <label for="tp2-prenom">Y : </label>
        <input type="text" name="tp2-y">
        <input type="submit" name="sub-tp2" value="Appliquer">
        <input type="text" readonly="true" placeholder="R%uFFFDsultat" value="<?php
          if( isset($tp2_res) )
            echo $tp2_res;
        ?>">
      </form>
    </div>

    <div class="tp">
      <span class="titre">C)</span>
      <form action="" method="post">
        <label for="tp3-nom">Chaine : </label>
        <input type="text" name="tp3-chaine">
        <label for="tp3-indice">Indice : </label>
        <input type="text" name="tp3-indice">
        <input type="submit" name="sub-tp3" value="Appliquer">
        <input type="text" readonly="true" placeholder="R%uFFFDsultat" value="<?php
          if( isset($tp3_res) )
            echo $tp3_res;
        ?>">
      </form>
    </div>

    <div class="tp">
      <span class="titre">D)</span>
      <form action="" method="post">
        <label for="tp4-nom">Chaine : </label>
        <input type="text" name="tp4-chaine">
        <label for="tp4-indice">Indice : </label>
        <input type="text" name="tp4-indice">
        <input type="submit" name="sub-tp4" value="Appliquer">
        <input type="text" readonly="true" placeholder="R%uFFFDsultat" value="<?php
          if( isset($tp4_res) )
            echo $tp4_res;
        ?>">
      </form>
    </div>

    <div class="tp">
      <span class="titre">E)</span>
      <form action="" method="post">
        <label for="tp5-nom">Chaine : </label>
        <input type="text" name="tp5-chaine">
        <input type="submit" name="sub-tp5" value="Appliquer">
        <input type="text" readonly="true" placeholder="R%uFFFDsultat" value="<?php
          if( isset($tp5_res) )
            echo $tp5_res;
        ?>">
      </form>
    </div>

    <div class="tp">
      <span class="titre">D)</span>
      <form action="" method="post">
        <label for="tp6-nom">Chaine : </label>
        <input type="text" name="tp6-chaine">
        <input type="submit" name="sub-tp6" value="Appliquer">
        <input type="text" readonly="true" placeholder="R%uFFFDsultat" value="<?php
          if( isset($tp6_res) )
            echo $tp6_res;
        ?>">
      </form>
    </div>
  </body>
</html>
