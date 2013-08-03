<?php include('phpfiles/header.php');?>

<div id="spacer">
<?php
if(isset($login) && $login=="true" && $acess==1)
{?>
	<h1>Welcome Administrator. <a href="addtop.php">Click here to add a Topic.</a></h1>
<?php } ?>
	<br>
	<h1>Welcome to the Forums!</h1>
	<p>Feel free to Browse around, or maybe give me some feedback. Any suggestions or bugs pointed out would be greatly 
	appreciated so I can fix them as soon as possible. I build this forum from the ground up and plan to continue 
	expanding the features here. I understand everything about this code, so it is very easy for me to customize it to do 
	whatever is needed. If there is something I don't know how to do, I have no problem doing the research.</p>
	
	<p>If you want you can log in as an admin to add a topic and see ho things run from that side of things. I can also 
	implement a multi-level permissions system for users, but this site only has use for 2 levels, user and admin.</p>
</div>
<div id="thtop"></div>
<table id="header" cellspacing="0" cellpadding="0">
	<tr><th id="topic">Topic</th>
		<td class="divider"></td>
		<th id="posts">Posts</th>
		<td class="divider"></td>
		<th id="lastpost">Last Post</th>
		<td class="divider"></td>
		<th id="createdby">Date Created</th>
	</tr>

<tr><td id="thbot" colspan="7"></td></tr><!-- insert divider-->

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
		echo("<tr><td colspan='2' id='forum' style='background-color:$color;'><p>
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
		echo("</td><td colspan='2' id='forum' style='background-color:$color;'>$posts</td>
		<td colspan='2' id='forum' style='background-color:$color;'>");//echo number of posts
		$i=0;
		while(1 > $i)
		{
		echo("$latestusr");
		$i++;
		}
		echo("</td>
		<td id='forum' style='background-color:$color;'>$timed</td></tr>");
	}
?>
<tr><td id="thtop" colspan="7"></td></tr> <!-- insert divider-->
</table>
<?php include('phpfiles/footer.php'); ?>