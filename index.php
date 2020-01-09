<?php

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
  </head>
  <body>

    <!-- Header -->
    <?php include "includes/header.php"; ?>

    <div id="ajx-container">
    <!-- Header Section -->
    <div class="section-hdr">
      <div class="container">
        <div class="inner-section-hdr">
          <div class="sec-hdr-left float-lt">
            <h1 class="heading">tps - exercices</h1>
            <div class="dropdown-menu light-btn btn filter-toggle">
              <span class="mdi mdi-chevron-down"></span>
              <span class="selected-item" data-filter="ancient">Les Plus Ancients</span>
              <div class="filter-dropdown hide">
                <ul class="unstyled-list">
                  <li id="dropdown-menu-select" class="item" data-filter="recent">Les Plus Récents</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="sec-hdr-right float-rt">
            <ul class="unstyled-list">
              <li><span class="icon-bg-white mdi mdi-library-plus"></span></li>
              <li><span id="dlt-selected-tp" class="icon-bg-white mdi mdi-delete"></span></li>
            </ul>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="line"></div>
      </div>
    </div>

    <!-- Section -->
    <div class="main-section">
      <div id="tps-container" class="container">

      </div>

    </div>

    <!-- navigation buttons -->
    <div class="nav-section">
      <div class="container">
        <div class="next-btn-relative">
          <ul id="pagination-btns" class="pagination-btns unstyled-list">
            <li class="active">1</li>
          </ul>
          <div class="next-btn action-btn-icon-right btn" style="opacity: .7">
            <span>Suivant</span>
            <span class="mdi mdi-chevron-right icon-fix"></span>
          </div>
        </div>
      </div>
    </div>

    <!-- overlay box -->
    <div class="overlay hide">
      <div class="overlay-box">
          <div class="input-form">
            <label class="input-label">nom tp : </label>
            <input id="nom-tp" type="text" class="light-input">
          </div>
          <div class="input-form">
            <div class="input-label">description : </div>
            <input id="desc-tp" type="text" class="light-input">
          </div>
          <div class="input-form">
            <div class="input-label">fichier : </div>
            <div class="uplaod-btn btn">
              <span class="mdi mdi-file"></span>
              <label for="uplaod-tp">upload</label>
              <input id="uplaod-tp" type="file" class="hide">
            </div>
            <span id="file-name" class="file-name"></span>
          </div>
          <div class="action">
            <div id="add-tp-btn" class="action-btn btn">
              nouveau tP
            </div>
          </div>
          <span class="close-box mdi mdi-close icon"></span>
      </div>
    </div>
  </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/xhr-abstract.js"></script>
    <script src="js/notifications-xhr.js"></script>
    <script src="js/upload.js"></script>
    <script>
      window.onload = function(){
        const showNumber = 7;
        var file_name = null;

        loadContent();
        pagination();

        document.getElementById("dropdown-menu-select").onclick = function(){
          loadContent();
        };

        document.addEventListener("click", function(e){
          const $this = e.target;
          if( $this.classList.contains("delete-tp-btn") ){
            const tpId = $this.getAttribute("data-id");
            ajaxGET(
              "includes/requests.php",
              { func: "deleteTp", tpId: tpId },
              function(){ loader() },
              function(response){
                if(JSON.parse(response) == true){
                  loadContent();
                  loader("show");
                }

              },
              function(xhr, status, statusText){ console.log(statusText) }
            );
          }
        });

        document.body.onclick = function(e){
          const $this = e.target;
          if( !$this.closest(".course-box") ){
            const boxes = document.querySelectorAll(".course-box.selected");
              Object.keys(boxes).forEach(function($i){
                boxes[$i].classList.remove("selected");
              });
              /*
              for( $i in boxes ){
                console.log(boxes[$i]);
                boxes[$i].classList.remove("selected");
              }*/

          }
        };

        document.body.ondblclick = function(e){
          const $this = e.target;
          if( $this.closest(".course-box") ){
            const idTp = $this.closest(".course-box").getAttribute("data-id");
            window.location.href = "exercice.php?tp="+idTp;
          }
        }

        document.getElementById("uplaod-tp").onchange = function(){
          var file = this.files[0];
          file_name = file.name;
          document.getElementById("file-name").textContent = file_name;
        };

        document.getElementById("add-tp-btn").onclick = function(){

          const nomTp = document.getElementById("nom-tp").value;
          const descTp = document.getElementById("desc-tp").value;

          ajaxGET(
            "includes/requests.php",
            { func: "addTp", nomTp: nomTp, descTp: descTp, nomFichier: file_name },
            function(){},
            function(response){
              const jsonResponse = JSON.parse(response);
              if( jsonResponse == true ){
                document.getElementsByClassName("close-box")[0].click();
                loadContent();
              }
              else{ alert("error"); }
            },
            function(){}
          );

        };

        document.getElementById("dlt-selected-tp").onclick = function(){
          var selected_tps = document.querySelectorAll(".course-box.selected");
          var tp_ids = [];

          Object.keys(selected_tps).forEach(function($i) {
            tp_ids.push(selected_tps[$i].getAttribute("data-id"));
          });

          ajaxPost(
            "includes/requests.php",
            { func: "deleteSpecificTps", tp_ids: JSON.stringify(tp_ids) },
            function(){},
            function(response){
              if(JSON.parse(response) == true){
                loadContent();
              }
            },
            function(){}
          );

        };

        function loadContent(){
          const filter = document.querySelector(".dropdown-menu .selected-item").getAttribute("data-filter");
          ajaxPost(
            "includes/requests.php",
            { func: "getTps", filter: filter, showNumber: showNumber },
            function(){ loader() },
            function(response){
              const tps = JSON.parse(response);
              document.getElementById("tps-container").innerHTML = "";
              const add_box = `<div class="big-add-box box float-lt">
                <span class="line horizontal-line">
                  <span class="line vertical-line"></span>
                </span>
              </div>`;
              if( tps == false ){
                document.getElementById("tps-container").innerHTML = add_box;
              }
              else{
                var output = "";

                for( $i in tps ){
                  const tp = tps[$i];
                  if( $i == 0 ) output+= `<div class="row">`;
                  if( $i == 0 ) output+= `${add_box}`;
                  output += `
                    <div data-id="${tp.idTp}" class="course-box box float-lt">
                      <div class="course-title">
                        <h2>${tp.nomTp}</h2>
                      </div>
                      <div class="course-info">
                        <div class="course-name float-lt">
                          <span class="mdi mdi-link"></span>
                          ${tp.nomFichier}
                        </div>
                        <div class="course-date float-rt">
                          ${tp.dateAjoute}
                        </div>
                      </div>
                      <span data-id="${tp.idTp}" class="delete-tp-btn delete-icon mdi mdi-delete icon"></span>
                    </div>`;
                    if( $i == 2 ) output += `</div><div class="row">`;
                }
                document.getElementById("tps-container").innerHTML += output;
                var rows = document.querySelectorAll(".row");
                for( $i in rows ){
                  rows[$i].innerHTML += `<div class="clearfix"></div>`;
                }
              }
              loader("hide");
            },
            function(xhr, status, statusText){ console.log(statusText) }
          );
        }

        function pagination(){
          ajaxPost(
            "includes/requests.php",
            { func: "getPagination", showNumber: showNumber },
            function(){},
            function(response){
              if( response > 1 ){
                var $pagination = document.getElementById("pagination-btns");
                for( $i = 2; $i <= response; $i++ ){
                  $pagination.innerHTML += `<li>${$i}</li>`;
                }
              }
            },
            function(){}
          );
        }

        /*
                document.ondblclick = function(e){

                  const $this = e.target;
                  if( $this.closest(".course-box") ){
                    const idTp = $this.closest(".course-box").getAttribute("data-id");
                    ajaxGET(
                      "includes/exercices.php",
                      { idTp: idTp },
                      function(){ document.getElementById("loader").classList.add("active") },
                      function(response){
                        document.getElementById("ajx-container").innerHTML = response;
                        console.log(response);
                        ajaxPost(
                          "includes/requests.php",
                          { func: "getTpsCode", idTp: idTp },
                          function(){},
                          function(response){
                            document.getElementById("loader").classList.remove("active");


                            console.log(JSON.stringify(response));

                          },
                          function(){}
                        );
                      },function(){}
                    );
                  }
                }
        */
      };
    </script>
    <?php include "includes/loader.html" ?>
  </body>
</html>
