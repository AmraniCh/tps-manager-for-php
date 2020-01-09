
class XhxResponseError extends Error{
  // custom error name
  name = "XhrResponseError";

  // Error super constructor
  constructor(name, message, status, statusText){ // or ...params
    super(name, message);
    // additional parameters
    this.status = status;
    this.statusText = statusText;
    // handle error where error was thrown
    if( Error.captureStackTrace ){
      Error.captureStackTrace(this, XhxResponseError);
    }
  }

  log(stack, status, statusText){
    console.log(`%c ${stack}
      Response Server Status => ${status}
      Response Status Description => ${statusText}`
      , "color:#F0F");
  }

}

class XHR{ }

// prototype properties
XHR.prototype.errorHandle = true;

// prototype functions
XHR.prototype.getResponse = function(){ (this.xhr.status == 200) ? this.xhr.response : null }; // response
XHR.prototype.getResponseText = function(){
  return (this.xhr.status == 200) ? this.xhr.responseText : null;
}; // response parsed as text
XHR.prototype.getResponse = function(){
    return this.xhr.status;
}; // status message
XHR.prototype.getResponse = function(){ return this.xhr.statusText }; // status description
XHR.prototype.getResponseURL = function(){ return this.xhr.responseXML }; // response parsed as xml
XHR.prototype.getResponseURL = function(){ return this.xhr.responseURL }; // response url

// no user functions
XHR.prototype.POSTurlQueryString = function(data){
  var params = "";
  for(var key in data){
    var value = data[key];
    params+= key + "=" + data[key] + "&";
  }
  return params;
};

XHR.prototype.post = function(url, data, sync = true, errorHandle = true){
  // parse data object as a post url query string
  var params = this.POSTurlQueryString(data);
  // using promis for prevent THIS CONTEXT problem
  const xhr_post_promise = new Promise( function(resolve, reject){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url, sync);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(params);
    xhr.onload = function (){
      if( this.status == 200 ){
        //resolve(XHR.response = JSON.parse(xhr.responseText));
        resolve(this);
      }
      else{
        try{
          throw new XhxResponseError("An Error Has Accured, Request Response Hasn't Returned From The Server.");
        }
        catch(e){
          reject(this);
          e.status = this.status;
          e.statusText = this.statusText;
          // console logging error if error handle propertie is true
          if( this.errorHandle = errorHandle !== false ){
            var params = [e.stack, e.status, e.statusText];
            e.log(...params);
          }
        }
      }
    }
  });

  xhr_post_promise.then((xhr) =>{ // using arrow function to get THIS CONTEXT for previous function
      this.xhr = xhr;
      console.log(this);
  }, (xhr) =>{
      this.xhr = xhr;
      console.log(this);
    });
};

XHR.prototype.test = function(url, data, sync = true, errorHandle = true){
  // parse data object as a post url query string
  var params = this.POSTurlQueryString(data);
  // using promis for prevent THIS CONTEXT problem
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url, sync);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(params);
    xhr.onload = () => {
      if( xhr.status == 200 ){
        //resolve(XHR.response = JSON.parse(xhr.responseText));
          this.xhr = xhr;
      }
      else{

        try{
          throw new XhxResponseError("An Error Has Accured, Request Response Hasn't Returned From The Server.");
        }
        catch(e){
          e.status = this.status;
          e.statusText = this.statusText;
          // console logging error if error handle propertie is true
          if( this.errorHandle = errorHandle !== false ){
            var params = [e.stack, e.status, e.statusText];
            e.log(...params);
          }
        }
      }
    }
  };


var x1 = new XHR();
console.log( x1.test("includes/courses_exercices.php", {user: "chakir", age: 20}, true, true) );
//console.log(x1.getResponse());
setTimeout( () => console.log(x1.getResponseText()), 500);

/*
var promise = new Promise(function(resolve){
    x1.post("includes/courses_exercices.php", {user: "chakir", age: 20});
    resolve(x1);
});

promise.then(function(x1){
  console.log(x1.getResponseText());
});
*/

/**** EX ****************
XHR.prototype.test = function(){
  this.status = "ssss";
  this.response = "rrrr";
};
var x1 = new XHR();
x1.test();
console.log(x1);
var x2 = new XHR();
x2.response = "r2";
x2.status = "s2";
console.log(x2);
********************/

/*
var promise_test = new Promise(function(resolve){
  var x1 = new XHR();
  x1.post("includes/courses_exercices.php", true);
  resolve(x1);
});

promise_test.then(function(resolve){
  console.log(resolve);
});*/



/*
var getData = function(method, url, responseHandle){

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function (){
      if( this.status == 200 ){
        responseHandle(JSON.parse(xhr.responseText));
      }
      else{
        try{
          throw new XhxResponseError("Your Response Request Has Not Returned From The Server Because On Error Has Accured!");
        }
        catch(e){
          e.status = this.status;
          e.statusText = this.statusText;
          console.log(`%c${e.stack}
            Error Status => ${e.status}
            Error Description => ${e.statusText}`, "color:#F0F");
        }
      }
    }
    xhr.send("user=elamrani");
}

getData("POST", "includes/courses_exrcices.php", function(response){
  console.log(response);
});
*/
/*
var getJSON = function(url, success, error) {
	var xhr = new XMLHttpRequest;
	xhr.open('post', url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function() {
		var status;
		var data;
		// https://xhr.spec.whatwg.org/#dom-xmlhttprequest-readystate
		if (xhr.readyState == 4) { // `DONE`
			status = xhr.status;
			if (status == 200) {
				success(JSON.parse(this.responseText));
			} else {
				error(this.status);
			}
		}
	};
  xhr.send("user=elamrani");
};

getJSON("includes/courses_exrcices.php", function(data) {
	console.log(data);
}, function(status) {
	console.log(status);
});
*/
