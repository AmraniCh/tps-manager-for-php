
"use strict";


setInterval( function() {
  ajaxGET(
    "includes/mysql_conn_status.php",
    null,
    function(){},
    function(response){
      const prsJson = JSON.parse(response);
      if( prsJson.MYSQL_CONN == "OFF" ){
        mysql_popup("offline");
        php_popup("online");
      }
      else {
        mysql_popup("online");
        php_popup("online");
      }
    },
    function(xhr){
      if( xhr.response == "" ){
        mysql_popup("offline");
        php_popup("offline");
      }
    });
  }, 8000);

function mysql_popup(status){
  if( status === "offline" )
    $("#mysql-conn").removeClass("online").addClass("offline");
  else
  $("#mysql-conn").removeClass("offline").addClass("online");
}

function php_popup(status){
  if( status === "offline" )
    $("#apache-conn").removeClass("online").addClass("offline");
  else
  $("#apache-conn").removeClass("offline").addClass("online");
}
