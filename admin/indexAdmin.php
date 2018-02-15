<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Admin Panel</title>
		<link rel="stylesheet" href="css/styleAdmin.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery-3.2.1.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.js"></script>
		
	</head>
	
	<body>
		<div id="pre_header" style="color:white; padding:1px 3px 0px 0px;text-align:right;">
			<?php
				if(isset($_COOKIE['user'])){
					echo "Welcome: " .$_COOKIE['user'];
				}else{
					//echo "Nothing";
				}
			?>
		</div>
		<?php
			include("inc/header.php");
			include("inc/bodyleft.php");
			include("inc/bodyright.php");
		?>
	</body>
</html>