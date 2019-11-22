<?php
	
	$page = @$_GET['pg'];
	if (!empty($page))
	{
		include($page.'.php');
	}
	else
	{
		include('fooldal.php');
	}
?>