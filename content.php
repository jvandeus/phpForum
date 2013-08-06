<?php include('phpfiles/header.php'); 

if (isset($_GET["id"]))
{
	$id = $_GET["id"];
	$id = clean($id);
}else{
	header("Location: forum.php");
}
$posts=mysql_num_rows(mysql_query("select * from forcon where id=$id")) or die ("Could not connect to mysql because ".mysql_error());
$pages=ceil($posts/10);

if (isset($_GET["page"]))
{
$page=$_GET["page"];
$page=clean($page);
}
else
{
$page=$pages;
}
$startfrom=($pages*10)-($page*10);

if(isset($_POST['submit']) && isset($login) && $login=="true")
{
	$content = $_POST['content'];
	$content = clean($content);
	
	$result = mysql_query("SELECT * FROM forcon")
	or die(mysql_error());
	
	$result = MYSQL_QUERY("INSERT INTO forcon (idpost,id,user,timed,content)".
	"VALUES('NULL', '$id', '$user', NOW(), '$content')") or die(mysql_error()); 
	
	echo "<div align='center'><h1>Content added. <a href='content.php?id=$id'>Return to Topic</a></h1></div>";
	
	include("phpfiles/footer.php");
	die();
}
if(isset($login)&&$login=="true"){ //if user is logged in
?>
		<div id="postarea">
			<form name="forpost" method="post" action="content.php?&id=<?php echo $id; ?>">
			<textarea name="content" id="content" ROWS=10 COLS=50></textarea><br>
			<input type="submit" name="submit" value="Post a Comment">
			</form>
		</div>
		<script language="javascript" type="text/javascript">
		CKEDITOR.replace( 'content',
		    {
		    	resize_dir : 'vertical',
				resize_maxHeight : 500,
				tabSpaces : 4,
				
				toolbar : [
				    [ 'Bold', 'Italic', '-', 'Link', 'Unlink' ]
				],
		    });
		</script>
<?php
}
echo("<div id='pages'><h1>Go to Page: ");
for($i=1; $i<=$pages; $i++)
{
	echo("<a href='content.php?page=$i&id=$id' style='color:");
	if($i == $page)
	{
		echo("#05B9DD");
	}
	else
	{
		echo("#1F91B2");
	}
	echo(";'>$i</a> ");
}
echo ("</h1></div>");

//Begin Fetching Content
$pgcon=mysql_query("select * from forcon where id=$id order by idpost desc limit $startfrom, 10") or die(mysql_error());

$color = "#444";

while($r=mysql_fetch_array($pgcon))
{
	$uuser=$r["user"];
	$iid=$r["id"];
	$idpost=$r["idpost"];
	$timed=date("m/j/y g:ia", strtotime($r["timed"]));
	$content=$r["content"];
	if($color == "#444") {
		$color="#555";
	}else {
		$color="#444";
	}
	
echo("
<div id='thtop'></div>
<div id='coninfo'><h1>$uuser</h1><p>");//begins the post header

if(isset($login)&&$login=="true"){ //if user is logged in
	if($acess == 1 || strcmp($user,$uuser) == 0){//user is either admin or the origional creator CASE SENSITIVE
		echo ("<a href='condel.php?id=$iid&idpost=$idpost");
		if(isset($_GET["page"])){ echo ("&page=$page"); }
		echo ("'>DELETE</a> | <a href='conedi.php?id=$iid&idpost=$idpost");
		if(isset($_GET["page"])){ echo ("&page=$page;"); }
		echo ("'>EDIT</a> | ");
	}
}
echo("$timed");//ends the post header
echo nl2br("</p></div><div id='thbot'></div><div id='content' style='background-color:$color;' >$content</div>");//begins the content
}?>
<br>
<h1 align="center"><a href="forum.php">Back to Forum</a></h1>
<br>
<div class='divider'></div>

<?php include('phpfiles/footer.php'); ?>