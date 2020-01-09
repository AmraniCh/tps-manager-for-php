<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>TP1</title>
    <style>
      table td, table th{ border: 1px solid #999; padding: 10px}
      table { border-collapse: collapse }
      .td-color{ padding: 15px 10px}
    </style>
  </head>
  <body>
    <?php

      $ville = "tanger";
      $temp_ville = -30;

      $data = array (
        array("COULEUR" => array("NOM" => "Rouge fonc%uFFFD", "CODE" => "#8B0000"), 'minT' => 33, 'maxT' => 50),
        array("COULEUR" => array("NOM" => "Rouge", "CODE" => "#F00"), 'minT' => 28, 'maxT' => 32),
        array("COULEUR" => array("NOM" => "Ecarlate", "CODE" => "#ED0000"), 'minT' => 22, 'maxT' => 27),
        array("COULEUR" => array("NOM" => "Orange", "CODE" => "#FFA500"), 'minT' => 17, 'maxT' => 21),
        array("COULEUR" => array("NOM" => "Jaune", "CODE" => "#FF0"), 'minT' => 11, 'maxT' => 16),
        array("COULEUR" => array("NOM" => "Vert Riche", "CODE" => "#3AF24B"), 'minT' => 5, 'maxT' => 10),
        array("COULEUR" => array("NOM" => "Vert", "CODE" => "#008000"), 'minT' => 0, 'maxT' => 4),
        array("COULEUR" => array("NOM" => "Blue", "CODE" => "#00F"), 'minT' => -6, 'maxT' => -1),
        array("COULEUR" => array("NOM" => "Blue ciel", "CODE" => "#87CEEB"), 'minT' => -11, 'maxT' => -5),
        array("COULEUR" => array("NOM" => "Violet", "CODE" => "#8A2BE2"), 'minT' => -17, 'maxT' => -12),
        array("COULEUR" => array("NOM" => "Violet rose", "CODE" => "#9400D3"), 'minT' => -23, 'maxT' => -18),
        array("COULEUR" => array("NOM" => "Magenta", "CODE" => "#CD00CD"), 'minT' => -50, 'maxT' => -24),
      );


      echo '
      <table>
        <thead>
          <th>Couleur</th>
          <th>Tomp%uFFFDrature</th>
          <th>Ville</th>
        </thead>
      <tbody>
      ';

      foreach( $data as $deg ){
        echo '
        <tr>
          <td class="td-color" style="background-color:'. $deg['COULEUR']['CODE']. '"></td>
          <td> Entre '. $deg['maxT'] .' et '. $deg['minT'] .'  </td>
          <td>
        ';

        if( $temp_ville <= $deg['maxT'] && $temp_ville >= $deg['minT'] ):
          echo $ville;
        endif;

        echo '</td>';
      }

      echo '
        </tbody>
      </table>';

    ?>
  </body>
</html>
