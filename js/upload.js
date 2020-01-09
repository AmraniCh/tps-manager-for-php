
"use strict";
/*

document.getElementById("uplaod-tp").oninput = function(){

  var formData = new FormData();

  formData.append("file", this.file);
  console.log(formData);

  ajaxPost(
    "includes/uplaod.php",
    { formData: formData },
    function(){},
    function(response){ console.log(response); },
    function(xhr, status, statusText){ console.log(statusText) }
  );

};
*/
/*

$("#uplaod-tp").on("input", function(){

  var formData = new FormData();
  formData.append("file", this.files[0]);

  $.ajax({
    url: "includes/requests.php",
    method: "POST",
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function(){},
    success: function(response){
      alert();
      console.log(response);
    }
  });

});
*/
