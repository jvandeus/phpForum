<script src="loginInstant.js"></script>

<?php include('phpfiles/header.php');?>

<table id="intro" cellpadding="0px" cellspacing="0px">
	<tr><td id="greeting">
		<div id="greeting">
		<?php
		if(isset($login) && $login=="true" && $acess==1)
		{?>
			<h1>Welcome Administrator. </h1>
			<p></p><a href="addtop.php">Click here to add a Topic.</a></p>
		<?php } ?>
			<h1>Welcome to my Forum!</h1>
			<p>Currently there is known issues with some of the functionality of this forum, but its a work in progress. Most issues will be
				fixed soon, but untill then, progress can be monitored on the <a href="https://github.com/jvandeus/phpForum" target="_blank">github</a> page.
				If there is anything you would like to see done, please let me know by email or in the feedback topic.</p>		
		</div>
	</td>
	<td>
		<div id="filler">
			<!-- Fills extra space that is currently Not used -->
			<?php include 'loginForm.php'; ?>
		</div>
	</td></tr>
</table>

<div id="thtop"></div>
<div id="header">
	<table cellspacing="0" cellpadding="0">
		<tr><th id="topic">Topic</th>
			<th id="posts">Posts</th>
			<th id="lastpost">Last Post</th>
			<th id="date">Date Created</th>
		</tr>
	</table>
</div>
<div id="thbot"></div>

<div id="forum">
<table>
<?php
	//display all the news
	$result = mysql_query("select * from fordat order by timed desc"); 
	
	$color="#444";
	//run the while loop that grabs all content
	while($r=mysql_fetch_array($result)) 
	{ 
		//grab everything and assign it to variables
		$title=$r["name"];
		$uuser=$r["user"];
		$timed=date("M. j, Y g:ia", strtotime($r["timed"]));
		$id=$r["id"];
		$rslt=mysql_query("select * from forcon where id=$id order by idpost desc");
		$s=mysql_fetch_array($rslt);
		$latestusr=$s["user"];

		$posts=mysql_num_rows(mysql_query("select * from forcon where id=$id"));
		$pages=ceil($posts/10);
		
		//include('filter.php');
		//$title=str_replace($origional, $new, $title);
		if($color == "#444")
		{
			$color="#555";
		}
		else
		{
			$color="#444";
		}
		echo("<tr style='background-color:$color;' ><td id='leftSpace'></td><td id='topic' style='background-color:$color;'><p>
		<a href='content.php?id=$id'>$title</a> - Page: ");//echo topic start
		
		for($a=1; $a<=$pages; $a++)
		{
			echo("<a href='content.php?page=$a&id=$id'>$a</a> ");
		}
		
		if(isset($login)&&$login=="true"){ //if user is logged in
			if($acess == 1 || $user == $uuser){//user is either admin or the origional creator
				echo(" - <a href='topdel.php?cmd=topdel&id=$id'>DELETE</a></p>");//end topic
			}
		}
		echo("</td><td id='posts'>$posts</td>
		<td id='lastpost'>");//echo number of posts
		$i=0;
		while(1 > $i)
		{
		echo("$latestusr");
		$i++;
		}
		echo("</td>
		<td id='date'>$timed</td><td id='rightSpace'></td</tr>");
	}
?>
</table>
</div>
<div id="thtop"></div> <!-- insert divider-->
<?php include('phpfiles/footer.php'); ?>