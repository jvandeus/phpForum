<?php include('phpfiles/header.php');?>
<script language="javascript" type="text/javascript">
function limitText(target, limitField, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		document.getElementById(""+target+"").innerHTML = "<h1>You have " + (limitNum - limitField.value.length) + " characters left.</h1>";
	}
}
</script>

<div id="spacer" style="height: 100%">
<?php
if(isset($_POST['submit']) && isset($login) && $login=="true" && $acess==1)
{
	$titl = $_POST['titl'];
	$titl = clean($titl);
	$content = $_POST['content'];
	$content = clean($content);
	$r = mysql_query("SHOW TABLE STATUS LIKE 'fordat'");	// must retrieve the auto increment so the proper id can be 
	$row = mysql_fetch_array($r);							// used to link the first forcon post with the new topic.
	$id = $row['Auto_increment'];							// This makes sure both querys can be done without having to
															// make sure the topic was entered and then retrieve it's id.	
	if($titl!="" && $content!=""){
		$result = MYSQL_QUERY("INSERT INTO fordat (id,name,user,timed)".
		"VALUES ('NULL', '$titl', '$user',  NOW() )") or die("Nope1. ".mysql_error()); 
		
		$result = MYSQL_QUERY("INSERT INTO forcon (idpost,id,content,user,timed)".
		"VALUES ('NULL', '$id', '$content', '$user', NOW() )") or die("Nope2. ".mysql_error()); 
		
		echo "<h1>Topic Added!</h1><br>";
	}
	else{
		echo "<h1>You cannot have a blank title or post.</h1><br>";
	}
}
elseif(isset($login) && $login=="true" && $acess==1)
{?>
	<h1>Welcome Administrator. You may add a topic using the following feilds.</h1>
	<form method="post" action="addtop.php">
		<div id="infotitle"><h1>There is a 70 character limit for title.</h1></div>
		Title:<input type="text" size='70' name="titl" id="titl" onKeyDown="limitText('infotitle',this.form.titl,70);" onKeyUp="limitText('infouser',this.form.titl,70);">
		<div id="postarea">
			<h1>Please enter the first post for this topic.</h1>
			<textarea name="content" id="content" ROWS=10 COLS=50></textarea><br>
		</div>
		<script language="javascript" type="text/javascript">
		CKEDITOR.replace( 'content',
			{
				toolbar : [[ 'Bold', 'Italic', '-', 'Link', 'Unlink' ]]
			});
		</script>
		<input type="submit" name="submit" value="submit">
	</form>
</div>
<?php
}
else {
	header("Location: forum.php");
	die();
} 
include('phpfiles/footer.php'); ?>