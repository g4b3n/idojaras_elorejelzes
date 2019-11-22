<!DOCTYPE html>
<?php
session_start();
include("adatok.php");
include("fuggvenytar.php");
$db = connectdb($dbhost, $dbuser, $dbpass, $dbname);
?>
<html>

<head>
	<meta charset="utf-8">
	<title>
		<?php echo $pagename; ?>
	</title>
	<!-- stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/idojaras_elorejelzes.css">
	<!-- javascripts -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.canvasjs.min.js"></script>
</head>

<body>
	<div id="container" class="container">
		<div id="header" class="col-xs-12">
			<?php echo $pagename; ?>
		</div>
		<div id="content">
			<div id="menu" class="col-xs-12 col-sm-12">
				<?php include("belepes.php"); ?>
			</div>
			<div id="center" class="col-xs-12 col-sm-12">
				<?php include("betolto.php"); ?>
			</div>
		</div>
		<div id="footer" class="col-xs-12">Produced by:
			<?php echo $company . ' - ' . $author; ?>
		</div>
	</div>
</body>

</html>