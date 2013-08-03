<!-- NOTES: 
	I need to make sure there is an error page for stuff like when there are no posts in a topic
	or when there are no topics. 
	Also make sure blank posts are not allowed to be entered
	Make an error page that with also accept error messages via the GET method.
	Add a "last edited" thing to posts.
	Check to make sure the page is valid for content showing.
	Check to see if the id is valid for content showing.-->
	
<script language="javascript" type="text/javascript">

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
</script>

<?php include('phpfiles/header.php'); ?>

<!-- content header -->
<table id="header" cellspacing="0" cellpadding="0">
	<tr><th width="500px"><img src="images/news.png"></th>
		<td class="divider"></td>
		<th width="295px"><img src="images/login.png"></th>
	</tr>
<tr><td id="thbot" colspan="3"></td></tr><!-- insert divider-->
</table>

<table>
<tr>
	<td id="news" colspan="2"><div id="news"><!--display news-->
		<?php
		$pgcon=mysql_query("select * from news order by timed desc") or die(mysql_error());

		while($r=mysql_fetch_array($pgcon))
		{
			$timed=date("m/j/y g:ia", strtotime($r["timed"]));
			$news=$r["content"];
			
			echo "<h1>$timed</h1><p>$news</p><div id='thtop'></div><div id='thbot'></div>";
		}?></div>
	</td>

	<td id="login"><!-- login section -->
<?php
if(isset($login)&&$login="true"){ ?>
		<h1>Welcome to My site, <?php echo "$user"; ?>!</h1>
	    Feel free to browse around or go straight to the <a href="forum.php">forum</a>.
<?php }else{ ?>
		<table cellspacing="0" cellpadding="0" id="logintable">
	    <form method="post" name="loginform" id="loginform">
	    <tr><td height="34px" id="log" colspan="2" style="color:red;" align="center"></td></tr>
	    <tr height="25px">
	    <td>Username:</td>
	    <td><input type="text" size='23' name="user" id="user" onChange="updateUserPass();"></td>
	    </tr><tr height="25px">
	    <td>Password:</td>
	    <td><input type="password" size='23' name="pass" id="pass" onChange="updateUserPass();"></td>
	    </tr><tr>
	    <td colspan='2' align="center" height="35px">Rememeber me? <input type="checkbox" name="rem" id="rem" value="rem"></td>
	    </tr>
	    </tr><tr>
	    <td colspan='2' align="center" height="35px">Not a member? <a href="register.php">Sign up</a></td>
	    </tr>
	    </form>
	    </table>
<?php } ?>
	</td>
</tr>
</table>

<table id="header" cellspacing="0" cellpadding="0">
	<tr><td id="thtop" colspan="3"></td></tr> <!-- insert divider-->
	<tr><th>Feature</th></tr>
	<tr><td id="thbot" colspan="3"></td></tr> <!-- insert divider-->
</table>

<div id="featured">
	<a href="../Client%20Project/index.php"><img src="images/featuresmall.png"></a>
		<p>This is my latest project, a website for a stop motion aniation company. I did all of the codeing 
		for it, as well as design for the little mascot on the upper right. Credit for all of the graphics go to 
		Alex Hoffman. You can click the picture to check out the site design yourself. Check it out in my <a href="portfolio.php">portfolio</a>
		as well, along with all of my other work. I appreciate any feedback on these. You can check out the forums and post what you 
		think about it and what I could do better. I realize that the video are not working, We did not have actual
		videos to use, so we simply but those pictures there for an example. Keep in mind this is only a fake company as well.</p>
</div>
<?php include('phpfiles/footer.php'); ?>