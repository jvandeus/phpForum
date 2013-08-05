var url = "login.php?user="; // The server-side script 

function handleHttpResponse() 
{ 
	if (http.readyState != 4) 
	{
		document.getElementById('log').innerHTML="<img src='images/loading.gif'>";
	}else{
		var results = http.responseText.split(",");
		var nameRes = results[0];
		var passRes = results[1];
		var failRes = "";
		
		if (nameRes == failRes){
			document.getElementById('log').innerHTML = "*Sorry, that username and password is incorrect.";
			document.getElementById('user').value = "";
			document.getElementById('pass').value = "";
			document.loginform.user.focus() = "";
		}else{
			if (passRes == "nopass"){
				document.getElementById('log').innerHTML = "*Sorry, that password is incorrect.";
				document.getElementById('pass').value = "";
				document.loginform.pass.focus() = "";
			}else{
				document.cookie="user="+nameRes+"; expires=";
				document.cookie="pass="+passRes+"; expires=";
				window.location="index.php";
			}
		}	
	} 
}

function clearwarning()
{
	document.getElementById('log').innerHTML = "";
}

function updateUserPass() 
{
	var userForm = document.getElementById('user').value;
	var passForm = document.getElementById('pass').value;

	if((passForm && userForm) != '')//if username and password are not empty, run the code
	{
		http.open("GET", url + escape(userForm) + "&pass=" + escape(passForm), true); 
		http.onreadystatechange = handleHttpResponse; 
		http.send(null);
	}
}

function getHTTPObject() {

  var xmlhttp;

  /*@cc_on
  @if (@_jscript_version >= 5)
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
        xmlhttp = false;
      }
    }
  @else
  xmlhttp = false;
  @end @*/

  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
    try {
      xmlhttp = new XMLHttpRequest();
    } catch (e) {
      xmlhttp = false;
    }
  }
  return xmlhttp;
}
var http = getHTTPObject(); // We create the HTTP Object