<div ="login">
<?php
if(isset($login)&&$login="true"){ ?>
<h1>Welcome to My site, <?php echo "$user"; ?>!</h1>
<p>Feel free to browse around or go straight to the <a href="forum.php">forum</a>.</p>
<?php }else{ ?>
<table cellspacing="0" cellpadding="0" id="logintable">
	<form method="post" name="loginform" id="loginform">
	    <tr>
	    	<td id="log" colspan="2" style="color:red;" align="center">
	    		<h1>Login to post on the forum.</h1>
	    	</td>
	    </tr>
	    <tr>
	    	<td>Username:</td>
	    	<td>
	    		<input type="text" size='23' name="user" id="user" onChange="updateUserPass();">
	    	</td>
	    </tr>
	    <tr>
	    	<td>Password:</td>
	    	<td>
	    		<input type="password" size='23' name="pass" id="pass" onChange="updateUserPass();">
	    	</td>
	    </tr>
	    <tr>
			<td colspan='2' align="center">
				<div id="submitButton"><button type="button" value="login"/><img id="button" src="images/login.png" /></button></div>
				<p>Rememeber me? <input type="checkbox" name="rem" id="rem" value="rem"></p>
	    		<p>Not a member? <a href="register.php">Sign up</a></p>
	    	</td>
	    </tr>
	</form>
</table>
<?php } ?>
</div>