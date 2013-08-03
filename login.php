<?php
include('phpfiles/connect.php');

$user = $_GET["user"];//pulls the username from the form
$pass = $_GET["pass"];//pulls the pass from the form
$pass = sha1($pass);//hashes the password

$clogin = mysql_query("SELECT * FROM login WHERE BINARY name ='$user' AND BINARY pass='$pass'")
or die ("Could not connect to mysql because ".mysql_error());

if(!mysql_num_rows($clogin))//if the username and pass are wrong
{
	$nopass = mysql_query("SELECT * FROM login WHERE BINARY name ='$user'");
	if(!mysql_num_rows($nopass))
	{
		echo(",");
	}
	else
	{
		$result = $user . ",nopass,";
		echo($result);
	}
}
else
{
	$result = $user . "," . $pass . ",";
	echo($result);
}
?>