<?php include('phpfiles/header.php');?>
<script language="javascript" type="text/javascript">
function limitText(target, limitField, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		document.getElementById(""+target+"").innerHTML = "<h1><br>You have " + (limitNum - limitField.value.length) + " characters left.</h1>";
	}
}
</script>
<?php
$warning = "";
if(isset($_GET['act'])){
	$act = $_GET['act']; //retrives the page action
}
else{ $act = ""; }//set the variable as blank if there is no action

if($act == "auth") //if the page action = auth
{
	$user = $_POST["user"];//pulls the username from the form
	$pass = $_POST["pass"];//pulls the pass from the form
	
	$login = mysql_query("SELECT * FROM login WHERE BINARY name='$user'");
	if(!mysql_num_rows($login))//if the name is not taken
	{
		$pass = sha1($pass);//hash the password
		mysql_query("INSERT INTO login (id,name,pass) VALUES('NULL','$user','$pass')");
	?>
		<div align=center><br><br><br>
		You are now registered! <a href='index.php'>Click here to log in.</a>
		</div>
		<?php
	}
	else// if user name is already taken
	{
?>
		<table id="header" cellspacing="0" cellpadding="0">
		<tr>
			<th id="topic">Register</th>
		</tr>
		<tr><td id="thbot"></td></tr><!-- insert divider-->
		<tr><td id="register">
			<h1>Sorry, the username you entered is already in use. Please Try again.</h1>
			<p>The rules are simple. You have to register to be able to post on the forum. You can still check out the forum 
			when not logged in, you just won't be able to post. Also I would appreciate it if you left feedback if you manage 
			to break anythign on this site or if you like or don't like something. Besides that, you are limited to 20 
			charcaters each. This just makes things easier is all. Thank you.</p>
			<table cellspacing="0" cellpadding="0" align="center">
			<form action="register.php?act=auth" method="post" name="regform" id="regform">
			<tr height="25px">
				<td id='infouser' align="center" colspan="2"><h1><br>You have 20 characters left.</h1></td></tr>
		    <tr height="25px">
		    	<td>Username:</td>
		    	<td><input type="text" size='23' name="user" id="user" onKeyDown="limitText('infouser',this.form.user,20);" onKeyUp="limitText('infouser',this.form.user,20);"></td>
		    <tr height="25px">
				<td id='infopass' align="center" colspan="2"><h1><br>You have 20 characters left.</h1></td></tr>
		    </tr><tr height="25px">
		    	<td>Password:</td>
			    <td><input type="password" size='23' name="pass" id="pass" onKeyDown="limitText('infopass',this.form.pass,20);" onKeyUp="limitText('infopass',this.form.pass,20);"></td>
			</tr><tr>
		    	<td colspan='2' align="center" height="35px"><input type="submit" name="Submit" value="submit"></a></td>
		    </tr>
		    </form>
		    </table>
		</td></tr>
		</table>
	</div>
<?php
	}
}
else
{
?>
<table id="header" cellspacing="0" cellpadding="0">
	<tr>
		<th id="topic">Register</th>
	</tr>
	<tr><td id="thbot"></td></tr><!-- insert divider-->
	<tr><td id="register">
		<?php echo("$warning"); ?>
		<p>The rules are simple. You have to register to be able to post on the forum. You can still check out the forum 
		when not logged in, you just won't be able to post. Also I would appreciate it if you left feedback if you manage 
		to break anythign on this site or if you like or don't like something. Besides that, you are limited to 20 
		charcaters each. This just makes things easier is all. Thank you.</p>
		<table cellspacing="0" cellpadding="0" align="center">
		<form action="register.php?act=auth" method="post" name="regform" id="regform">
		<tr height="25px">
			<td id='infouser' align="center" colspan="2"><h1><br>You have 20 characters left.</h1></td></tr>
	    <tr height="25px">
	    	<td>Username:</td>
	    	<td><input type="text" size='23' name="user" id="user" onKeyDown="limitText('infouser',this.form.user,20);" onKeyUp="limitText('infouser',this.form.user,20);"></td>
	    <tr height="25px">
			<td id='infopass' align="center" colspan="2"><h1><br>You have 20 characters left.</h1></td></tr>
	    </tr><tr height="25px">
	    	<td>Password:</td>
		    <td><input type="password" size='23' name="pass" id="pass" onKeyDown="limitText('infopass',this.form.pass,20);" onKeyUp="limitText('infopass',this.form.pass,20);"></td>
		</tr><tr>
	    	<td colspan='2' align="center" height="35px"><input type="submit" name="Submit" value="submit"></a></td>
	    </tr>
	    </form>
	    </table>
	</td></tr>
	</table>
</div>
<?php
}
include('phpfiles/footer.php');?>