
var ajaxPost = function(url, data, beforeSend, success, error) { // [ url, data, sync ]

  var POSTurlQueryString = function(){
    var params = "";
    for(var key in data){
      var value = data[key];
      params+= key + "=" + data[key] + "&";
    }
    return params;
  };

	var xhr = new XMLHttpRequest;
	xhr.open('post', url, true);
  beforeSend();
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(POSTurlQueryString(data));
	xhr.onreadystatechange = function() {
		var status;
		var data;
    if (xhr.readyState == 4) {
			if ( xhr.status == 200 ) {
				success(this.response);
			} else {
				error(this, this.status, this.statusText);
			}
		}
	};

};

var ajaxPost2 = function(url, data, beforeSend, success, error) { // [ url, data, sync ]

  var POSTurlQueryString = function(){
    var params = "";
    for(var key in data){
      var value = data[key];
      params+= key + "=" + escape(data[key]) + "&";
    }
    return params;
  };

	var xhr = new XMLHttpRequest;
	xhr.open('post', url, true);
  beforeSend();
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(POSTurlQueryString(data));
	xhr.onreadystatechange = function() {
		var status;
		var data;
    if (xhr.readyState == 4) {
			if ( xhr.status == 200 ) {
				success(this.response);
			} else {
				error(this, this.status, this.statusText);
			}
		}
	};

};

var ajaxGET = function(url, data, beforeSend, success, error) { // [ url, data ]
  var GETurlQueryString = function(){
    var params = "";
    for(var key in data){
      var value = data[key];
      params+= key + "=" + data[key] + "&";
    }
    return params;
  };

	var xhr = new XMLHttpRequest;
	xhr.open('get', url + "?" + GETurlQueryString(data), true);
  beforeSend();
  xhr.send();
	xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
			if ( xhr.status == 200 ) {
				success(this.response);
			} else {
        error(this, this.status, this.bstatusText);
			}
		}
	};

};

var ajaxGET2 = function(url, data, beforeSend, success, error) { // [ url, data ]
  var GETurlQueryString = function(){
    var params = "";
    for(var key in data){
      var value = data[key];
      params+= key + "=" + data[key] + "&";
    }
    return params;
  };

	var xhr = new XMLHttpRequest;
	xhr.open('get', url + "?" + GETurlQueryString(data), true);
  xhr.setRequestHeader("Content-type", "application/json");
  beforeSend();
  xhr.send();
	xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
			if ( xhr.status == 200 ) {
				success(this.response);
			} else {
        error(this, this.status, this.bstatusText);
			}
		}
	};

};

// examples
/*
ajaxGET("includes/courses_exercices.php", { pass: "ell" }, function(data) {
	console.log(data);
}, function(status, statusText) {
	console.log(status + "\n" + statusText);
});

ajaxPost("includes/courses_exercices.php", { user: "chakir" }, function(data) {
	console.log(data);
}, function(status, statusText) {
	console.log(status + "\n" + statusText);
});
*/
