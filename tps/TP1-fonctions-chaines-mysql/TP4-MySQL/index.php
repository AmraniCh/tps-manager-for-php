<?php
  require "db.php";

  //echo $_SESSION['current_lang'];
  if(!isset($_SESSION['current_lang']))
    $_SESSION['current_lang'] = "fr";

  $current_lang = $_SESSION['current_lang'];
  echo $current_lang;
  $lang = [
      "en" => array(
        "dir" => "rtl",
        "en-tete" => "The Kingdom of Morocco",
        "code-national" => "ID number",
        "filiere" => "Division",
        "nom-prenom" => "Name",
        "colonne-1" => "Subject",
        "colonne-2" => "Note",
        "colonne-3" => "Result",
        "moyenne" => "General Note",
        "action" => "Print"
      ),
      "fr" => array(
        "dir" => "ltr",
        "en-tete" => "ROYAUME DU MAROC",
        "code-national" => "Code National",
        "filiere" => "Filière",
        "nom-prenom" => "Nom et Prenom",
        "colonne-1" => "Matière",
        "colonne-2" => "Note",
        "colonne-3" => "Résultat (V/NV/R)",
        "moyenne" => "Note génerale",
        "action" => "Imprimer"
      )
    ];

    if(isset($_POST['lang-fr'])):
      $_SESSION['current_lang'] = "fr";
    endif;

    if(isset($_POST['lang-en'])):
      $_SESSION['current_lang'] = "en";
    endif;

    switch(true){


      case isset($_POST['afficher-code']):
        $filiere = $_POST['filiere'];break;
    }


?>
<!DOCTYPE html>
<html lang="<?php $current_lang ?>">
  <head>
    <meta charset="UTF-8">
    <title>MySQL</title>
    <style>
      .btn-label{
        border: none;
        background-color: transparent;
      }
      .btn-label:hover{
        text-decoration: underline;
        color: #999;
        cursor: pointer
      }
      table{ border-collapse: collapse; margin: 0 auto}
      table th, table td{
        border: 1px solid #333;
        padding: 8px
      }
      h5{margin: 10px}
      .container{ text-align: center; padding: 0 60px }
      .header, .languages, .info, .imprimer{
        margin-bottom: 40px
      }
      .languages{ text-align: right; margin-bottom: 0}
      .info, .imprimer{ margin-top: 40px }
      .info div{
        margin-bottom: 20px
      }
      .label{
        display: inline-block;
        width: 170px
      }
    </style>
  </head>
  <body>
    <div class="container">
      <form action="" method="post">
        <div class="header">
          <?php echo $lang[$current_lang]['en-tete']; ?>
        </div>
        <div class="languages">
          <button class="btn-label" type="submit" name="lang-fr">Français</button>
          <span>/</span>
          <button class="btn-label" type="submit" name="lang-en">English</button>
        </div>
        <h5>...</h5>
        <h5>...</h5>
        <div class="info" dir="<?php echo $lang[$current_lang]['dir'] ?>">
          <div>
            <label class="label"><?php echo $lang[$current_lang]['filiere']; ?></label>
            <select name="filiere">
              <?php
                $query = $con->query("select filiere from Classe");
                if( $query->num_rows > 0 )
                {
                  while( $row = $query->fetch_row() ){
                    echo "<option value='". $row[0] ."'>" . $row[0] . "</option>";
                  }
                }
              ?>
            </select>
            <button name="afficher-code" type="submit">Afficher</button>
          </div>
          <div>
            <label class="label"><?php echo $lang[$current_lang]['code-national']; ?></label>
            <select name="code-national">
              <?php
                  if( isset($filiere) )
                  {

                    $query = $con->query("select codeClasse from Classe where filiere ='$filiere'");
                    $row = $query->fetch_row();
                    $codeClasse = $row[0];

                    $query = $con->query("select cne from etudiant where codeClasse = '$codeClasse'");
                    while($row = $query->fetch_row()){
                      echo '<option value="'. $row[0] .'">' .$row[0]. '</option>';
                    }

                  }
              ?>
            </select>
            <button name="afficher-res" type="submit">Resultat</button>
          </div>
          <div>
            <span class="label"><?php echo $lang[$current_lang]['nom-prenom']; ?></span>
            <span>
              <?php
                if(isset($_POST['afficher-res'])):
                  $cne =  $_POST['code-national'];
                  // nom
                  $query = $con->query("select nom from etudiant where cne = '$cne'");
                  $row = $query->fetch_row();
                  echo $row[0];
                endif;
              ?>
            </span>
          </div>
        </div>

        <table dir="<?php echo $lang[$current_lang]['dir'] ?>">
          <thead>
            <th><?php echo $lang[$current_lang]['colonne-1'] ?></th>
            <th><?php echo $lang[$current_lang]['colonne-2'] ?></th>
            <th><?php echo $lang[$current_lang]['colonne-3'] ?></th>
          </thead>
          <tbody>
            <?php
              if(isset($_POST['afficher-res'])):
                $query = $con->query("select matieres.designation, notes.note
                                    from notes inner join matieres
                                    on notes.codeMat = matieres.codeMat
                                    where notes.cne = '$cne'");

                while($row = $query->fetch_assoc()){
                  if($row['note'] >= 10)
                    $resultat = "V";
                  else if($row['note'] >= 7)
                    $resultat = "R";
                  else
                    $resultat = "NV";

                  echo "<tr>";
                  echo "<td>" . $row['designation'] . "</td>";
                  echo "<td>" . $row['note'] . "</td>";
                  echo "<td>" .$resultat. "</td>";
                  echo "</tr>";
                }

              endif;

            ?>
          </tbody>
        </table>

      <div class="imprimer">
        <button type="submit" name="imprimer"><?php echo $lang[$current_lang]['action'] ?></button>
      </div>
    </form>
  </div>
  </body>
</html>
