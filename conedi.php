<?php include('phpfiles/header.php'); ?>
<div id="spacer" style="height: 100%">
<?php
if(isset($_GET["page"])){
	$page = $_GET["page"];
	$page = clean($page);
}
$idpost = $_GET["idpost"];
$idpost = clean($idpost);

if(isset($login) && $login=="true")//if logged in
{
	$result = mysql_query("SELECT * FROM forcon WHERE idpost=$idpost");
	$r = mysql_fetch_array($result);
	$id = $r["id"];
	$uuser = $r["user"];
	$content = $r["content"];
	
	if (($user==$uuser || $acess == 1) && isset($_POST['submit']))// check if authorized to edit and form was submitted.
	{
		$ncontent = $_POST['ncontent'];
		$ncontent = clean($ncontent);
		$result = mysql_query("UPDATE forcon SET content='$ncontent', timed=NOW() WHERE idpost=$idpost");
		//header("Location: content.php?&id=$id");
		echo "<h1>Sucess! <a href='content.php?id=$id";
		if(isset($page)){ echo "&page=$page"; }
		echo "'>Click here to return to the topic</a></h1>";
	}
	elseif ($user==$uuser || $acess == 1) // if authorized to edit and form was not yet submitted
	{ ?>
		<form action="conedi.php?idpost=
		<?php echo "$idpost";
			if(isset($page)){ echo "&page=$page"; } ?> " method="post">
			<div id="postarea">
				<h1>Please make the desired changes in the box below.</h1>
				<textarea name="ncontent" id="ncontent" ROWS=10 COLS=50><?php echo $content; ?></textarea><br>
				<script language="javascript" type="text/javascript">
				CKEDITOR.replace( 'ncontent',
					{
						toolbar : [[ 'Bold', 'Italic', '-', 'Link', 'Unlink' ]]
					});
				</script>
			</div>
			<input type="submit" name="submit" value="submit">
		</form>
<?php
	}
	else{//if the user is logged in but is not authorized for this post.
		header("Location: content.php?&id=$id");//send you back to the origional thread.
		die();
	}
}
else{//if not even logged in
	header("Location: content.php?&id=$id");//send you back to the origional thread.
	die();
}
?>
</div>
<?php include('phpfiles/footer.php'); ?>