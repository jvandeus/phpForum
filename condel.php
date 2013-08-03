<?php
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

if(isset($_GET["page"])){
	$page = $_GET["page"];
	$page = clean($page);
}
$idpost = $_GET["idpost"];
$idpost = clean($idpost);
$id = $_GET["id"];
$id = clean($id);

include('phpfiles/connect.php');

mysql_query("DELETE FROM forcon WHERE idpost = '$idpost'") or die(mysql_error());

$loc = "content.php?id=$id";
if(isset($page)) {
	$loc = "$loc&page=$page";
}
header("Location: $loc");
?>
