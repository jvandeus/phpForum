<?php
include('connect.php'); 
function clean($input)
{
	if(get_magic_quotes_gpc())
	{
		$result = stripslashes($input);
	}
	else
	{
		$result = mysql_real_escape_string($input);
	}
	return $result;
}
if(isset($_COOKIE['user'])){//checks for cookie
	$user = $_COOKIE['user']; //gets the user from the cookies
	$user = clean($user);
}
if(isset($_COOKIE['pass'])){//checks for cookie
	$pass = $_COOKIE['pass']; //gets the user from the cookies
	$pass = clean($pass);
}
if(isset($user) && isset($pass)){
	$clogin = mysql_query("SELECT * FROM login WHERE BINARY name ='$user' AND BINARY pass='$pass'") or die ("Could not connect to mysql because ".mysql_error());
	if(!mysql_num_rows($clogin))//if the username and pass are wrong
	{
		$login="false";
	}else{
		$login="true";
		$a=mysql_fetch_array($clogin);
		$acess=$a["acess"];
	}
}
//use the folling if statement to check for login
/*
if(isset($login)&&$login=="true"){
	
}
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
   
<html>
<head>
<link rel="shortcut icon" type='image/x-icon' href="images/favicon.ico">

<title>Forum</title>
<style type="text/css" media="all">
		@import "main.css";
</style>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckeditor/myConfig.js"></script>

<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>

<body onLoad="MM_preloadImages('images/homeover.png','images/forumover.png','images/profileover.png','images/logoutover.png','images/loading.gif')">
	
<div id="main">
	<div id="sideleft"></div><div id="sideright"></div>
	<div id="mainbody">
	<div id="title"><!-- Title Box -->
		<div id="info">
			<p>phpforum --version<br />
			version 1.0 @ 08/03/13 - 10:14pm<br />
			user: ERROR - user not found.<br />
			login to acess account info.</p>
		</div>
		<div id="indicator">
			<p>root</p><img src="images/arrowRight.png" />
		</div>
	</div>
	<div height="31px" valign="middle">
		<table cellpadding="0" cellspacing="0" id="nav">
			<tr height="31px" align="center">
				<td>
					<a href="index.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image7','','images/homeOver.png',1)"><img name="Image7" border="0" src="images/home.png"></a>
				</td>
				<td>
					<a href="forum.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image8','','images/forumOver.png',1)"><img name="Image8" border="0" src="images/forum.png"></a>
				</td>
				<td>
					<a href="profile.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','images/profileOver.png',1)"><img name="Image9" border="0" src="images/profile.png"></a>
				</td>
<?php //this will remove the logout link in the bar when use is not logged in.
if(isset($login)&&$login="true"){ ?>
				<td>
					<a href="logout.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image11','','images/logoutOver.png',1)"><img name="Image11" border="0" src="images/logout.png"></a>
				</td>
<?php }else{//in here goes what is shown when user is not logged in.
} ?>
		    </tr>
		</table>
	</div>