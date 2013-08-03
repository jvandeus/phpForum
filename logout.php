<?php
$user = $_COOKIE['user']; //gets the user from the cookies
$pass = $_COOKIE['pass']; //gets the pass from cookies

setcookie("user", $user, time()-5184000);
setcookie("pass", $pass, time()-5184000);

header("location: index.php");
?>