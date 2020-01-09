<?php

  require "db_inc.php";

  $idTp = $_GET['idTp'];

  $query = $con->query("SELECT * FROM exercice INNER JOIN tp ON exercice.idTp = tp.idTp WHERE tp.idTp = $idTp ");

  if( $query->num_rows > 0 ){

    while($row = $query->fetch_array()){

      $idTp = $row['idTp'];
      $nomTp = $row['nomTp'];
      $descTp = $row['description'];
      $nomFichier = $row['nomFichier'];
      $dataAjouteTp = $row['dateAjoute'];

      $idExer = $row['idExercice'];
      $nomExer = $row['nomExercice'];
      $descExer = $row['description'];
      $dataAjouteExer = $row['dateAjoute'];
      $codeFichier = $row['codeFichier'];
?>

<!-- Header Section -->
<div class="section-hdr">
  <div class="container">
    <div class="inner-section-hdr">
      <div class="sec-hdr-left float-lt">
        <h1 class="heading"><?php echo $nomTp ?><span class="desc"><?php echo $descTp ?></span></h1>
      </div>
      <div class="sec-hdr-right float-rt">
        <div class="action-btn-icon-right btn">
          <span>ouvrir</span>
          <span class="mdi mdi-file-pdf-box"></span>
        </div>
        <div class="action-btn-icon-right btn">
          <span>tous</span>
          <span class="mdi mdi-delete"></span>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="line"></div>
  </div>
</div>

<!-- Section -->
<div class="main-section">
  <div class="container">
    <div class="accordion-section">
      <div class="accordion accordion-shadow accordion-toggle closed">
        <div class="float-lt">
          <span class="title">
            <span class="mdi mdi-menu-right icon-toggle">
            <?php echo $nomExer . " - " . $descExer ?>
          </span>
        </div>
        <div class="float-rt delete-btn">
          <span class="mdi mdi-delete icon"></span>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="accordion-content hide">
        <div class="editor-language">
          <div class="input-form">
            <label class="input-label">language d'affichage:</label>
            <select class="light-select">
              <option>PHP7 (par défault)</option>
            </select>
          </div>
        </div>
        <div class="accordion-editor">
          <div class="input-form">
            <label class="input-label">exercice code :</label>
            <textarea class="codemirror-textarea"></textarea>
          </div>
        </div>
        <div class="accordion-actions">
          <div class="action-btn-icon-right btn">
            <span>Enregistrer</span>
            <span class="mdi mdi-content-save"></span>
          </div>
          <div class="action-btn-icon-right btn">
            <span>S'excuter</span>
            <span class="mdi mdi-code-not-equal-variant"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
    }

  }
?>

<!-- small add btn -->
<div class="container">
  <div class="small-add-box btn">
    <span class="line"><span class="line vertical-line"></span></span>
  </div>
</div>
