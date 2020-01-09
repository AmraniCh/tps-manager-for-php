<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Gestion D'exercies</title>
    <link rel="stylesheet" href="css/standard.css">
    <link rel="stylesheet" href="css/animation.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="http://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
  </head>
  <body style="height: 2000px">
    <div class="container">
      <div style="height:50px;background:#DDD"></div>
      <?php echo "hello" ?>

      <br>
      <h1 class="heading">TPS - EXERCICES<span class="desc">TP pour pratiquer les classes en PHP</span></h1>

      <div class="light-btn btn filter-toggle">
        <span class="mdi mdi-chevron-down"></span>
        <span class="selected-item" data-filter="ancient">Les Plus Ancients</span>
        <div class="filter-dropdown hide">
          <ul class="unstyled-list">
            <li class="item" data-filter="recent">Les Plus Récents</li>
          </ul>
        </div>
      </div>

      <span class="icon-bg-white mdi mdi-library-plus"></span>
      <br>


        <ul class="pagination-btns unstyled-list">
          <li class="active">1</li>
          <li>2</li>
          <li>3</li>
        <ul>


      <br>
      <div class="input-form">
        <div class="input-label">Fichier : </span>
        <div class="uplaod-btn btn">
          <span class="mdi mdi-file"></span>
          Upload
        </div>
      </div>

      <br>
      <div class="input-form">
        <div class="input-label">Label : </span>
        <input type="text" class="light-input">
      </div>

      <br>
      <div class="action-btn btn">
        Nouveau TP
      </div>

      <br>
      <ul class="signal-circle unstyled-list">
        <li data-id="mysql" class="offline">
          <div class="popup">
            <span class="centent">Déconnecté de MySQL</span>
            <span class="triangle-up"><span>
          </div>
        </li>
        <li data-id="php" class="online"></li>
      </ul>

      <br>
      <div class="action-btn-icon-right btn">
        <span>Suivant</span>
        <span class="mdi mdi-chevron-right icon-fix"></span>
      </div>

      <br>
      <br>
      <div class="action-btn-icon-right btn">
        <span>Ouvrir</span>
        <span class="mdi mdi-file-pdf-box"></span>
      </div>

      <br>
      <br>
      <div class="accordion-section">
        <div class="accordion accordion-shadow accordion-toggle closed">
          <div class="float-lt">
            <span class="title">
              <span class="mdi mdi-menu-right icon-toggle">
              Exercice1 : Introduction
            </span>
          </div>
          <div class="float-rt delete-btn">
            <span class="mdi mdi-delete icon"></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="accordion-content hide">
          Content
        </div>
      </div>
      <div class="accordion-section">
        <div class="accordion accordion-shadow accordion-toggle closed">
          <div class="float-lt">
            <span class="title">
              <span class="mdi mdi-menu-right icon-toggle">
              Exercice1 : Introduction
            </span>
          </div>
          <div class="float-rt delete-btn">
            <span class="mdi mdi-delete icon"></span>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="accordion-content hide">
          Content
        </div>
      </div>

      <br>
      <div class="add-box btn">
        <span class="line"><span class="line vertical-line"></span></span>
      </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
  </bodt>
</html>
