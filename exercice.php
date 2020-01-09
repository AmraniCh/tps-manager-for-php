<?php
  require "includes/db_inc.php";
  require "includes/db_manager.class.php";
  require "includes/tps_manager.class.php";

  $idTp = $_GET['tp'];

  $tp_path = TPSManager::getTPPath($idTp);



?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Gestion D'exercies</title>
    <link rel="stylesheet" href="css/standard.css">
    <link rel="stylesheet" href="css/animation.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mdi/css/materialdesignicons.min.css">
    <!-- CodeMirror stylesheets -->
    <link rel="stylesheet" type="text/css" href="plugin/codemirror/lib/codemirror.css">
		<link rel="stylesheet" type="text/css" href="plugin/codemirror/theme/moxer.css">
    <!-- JQUERY -->
    <script src="js/jquery.min.js"></script>
  </head>
  <body>

    <!-- Header -->
    <?php include "includes/header.php"; ?>

    <!-- Header Section -->
    <?php
    $query = $con->query("SELECT tp.* FROM exercice INNER JOIN tp ON exercice.idTp = tp.idTp WHERE tp.idTp = $idTp ");

    if( $query->num_rows > 0 ){

        $row = $query->fetch_array();

        $idTp = $row['idTp'];
        $nomTp = $row['nomTp'];
        $descTp = $row['description'];
        $nomFichier = $row['nomFichier'];
        $dataAjouteTp = $row['dateAjoute'];
    ?>
    <div class="section-hdr">
      <div class="container">
        <div class="inner-section-hdr">
          <div class="sec-hdr-left float-lt">
            <h1 class="heading">
              <?php
                  echo $nomTp;
                  if(!empty($descTp))
                    echo '<span class="desc">'. $descTp .'</span></h1>';
               ?>
          </div>
          <div class="sec-hdr-right float-rt">
            <a href="<?php echo $tp_path ?>" target="_blank">
              <div class="action-btn-icon-right btn">
                <span>ouvrir</span>
                <span class="mdi mdi-file-pdf-box"></span>
              </div>
            </a>
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
<?php } ?>
    <!-- Section -->
    <div class="main-section">
      <div class="container">

        <?php
        $query = $con->query("SELECT exercice.* FROM exercice INNER JOIN tp ON exercice.idTp = tp.idTp WHERE tp.idTp = $idTp ");

        if( $query->num_rows > 0 ){

          while($row = $query->fetch_array()){

            $idExer = $row['idExercice'];
            $nomExer = $row['nomExercice'];
            $descExer = $row['description'];
            $dataAjouteExer = $row['dateAjoute'];
            $codeFichier = $row['codeFichier'];


        ?>

        <div class="accordion-section">
          <div class="accordion accordion-shadow accordion-toggle closed">
            <div class="float-lt">
              <span class="title">
                <span class="mdi mdi-menu-right icon-toggle">
                  <?php
                    echo $nomExer;
                   if(!empty($descExer)) echo " - " . $descExer
                  ?>
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
                <textarea id="<?php echo "editor-".$idExer ?>" class="codemirror-textarea"></textarea>
                <script>
                var insts = [];
                var editorInstance_<?php echo $idExer ?> = null;

                $(document).ready(function(){
                  var editorElement = document.getElementById("<?php echo "editor-".$idExer ?>");
                    var editor = CodeMirror.fromTextArea(editorElement, {
                        mode: "text/x-php",
                        lineNumbers: true,
                        matchBrackets: true,
                        theme: "moxer",
                        lineWiseCopyCut: true,
                        undoDepth: 200,
                        lineWrapping : false,
                        autoRefresh:true,
                        styleActiveLine: true,
                        fixedGutter:true,
                        lint:true,
                        coverGutterNextToScrollbar:false,
                        gutters: ['CodeMirror-lint-markers']
                      });
                      editor.setSize(null, 500);
                      var myCode = `<?php echo base64_decode($codeFichier) ?>`;
                      editor.setValue(`${myCode}`);
                      insts[<?php echo $idExer ?>] = editor;
                });
                </script>
              </div>
            </div>
            <div class="accordion-actions">
              <div id="save-tp" data-id="<?php echo $idExer ?>" class="action-btn-icon-right btn">
                <span>Enregistrer</span>
                <span class="mdi mdi-content-save"></span>
              </div>
              <a href="<?php echo TPSManager::getPathExercice($idExer); ?>" target="_blank">
                <div id="excute-tp" data-id="<?php echo $idExer ?>" class="action-btn-icon-right btn">
                  <span>S'excuter</span>
                  <span class="mdi mdi-code-not-equal-variant"></span>
                </div>
              </a>
            </div>
          </div>
        </div>

        <?php
      }
    }
         ?>
      </div>
    </div>

    <!-- small add btn -->
    <div class="container">
      <div class="small-add-box btn">
        <span class="line"><span class="line vertical-line"></span></span>
      </div>
    </div>

    <!--  -->


    <!-- Scripts -->
    <script src="js/main.js"></script>
    <script src="js/xhr-abstract.js"></script>
    <!-- CodeMirror scripts -->
    <script type="text/javascript" src="plugin/codemirror/lib/codemirror.js"></script>
		<script src="plugin/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="plugin/codemirror/mode/xml/xml.js"></script>
		<script src="plugin/codemirror/mode/javascript/javascript.js"></script>
		<script src="plugin/codemirror/mode/css/css.js"></script>
		<script src="plugin/codemirror/mode/clike/clike.js"></script>
		<script type="text/javascript" src="plugin/codemirror/mode/php/php.js"></script>
    <script src="plugin/codemirror/addon/display/autorefresh.js"></script>
		<script>
      window.onload = function(){

        document.body.onclick = function(e){
          const $this = e.target;
          if( $this.closest("#save-tp") ){
            const idExer = $this.closest("#save-tp").getAttribute("data-id");
            const changes = insts[idExer].getValue();
            ajaxPost2(
              "includes/requests.php",
              { func: "saveExerciceCode", idExer: idExer, changes: changes },
              function(){
                  loader();
              },
              function(response){
                //console.log("%c"+changes, "color:#f0f");
                const jsonResponse = JSON.parse(response);
                console.log(jsonResponse);
                if( jsonResponse !== false )
                  loader("hide");
              },
              function(){}
            );
          }
        };

      }
    </script>
    <?php include "includes/loader.html" ?>
  </body>
</html>
