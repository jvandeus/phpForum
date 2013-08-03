<?php
function cleaner($input)
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
?>