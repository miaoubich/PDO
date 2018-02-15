<!DOCTYPE html>
<html lang="en">
	<div id="empty-grey-div"></div>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Korčula Shopping Center</title>
		<link rel="stylesheet" href="css/style.css">
		
		<!-- Bootstrap -->
    	<link href="js/css/bootstrap.min.css" rel="stylesheet">
	    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->

	    <!-- font-awesome -->
		<!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">-->
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		
		<!--<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
	</head>
	
	<body>
		<?php 
			include("inc/function.php");
			include("inc/header.php");
			include("inc/navbar.php");
		?>
		<!-- <br clear="all"/> -->
		<div class="cart">
			<form method="POST" enctype="multipart/form-data">
				
					<?php echo cart_display();?>
				</table>
			</form>
		</div>

		<center>
			<div id="ViewBrands">
				<ul><?php echo Display_brands_img(); ?></ul>
			</div>
		</center>
		
		<?php include("inc/footer_new.php"); ?>

	    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
	    <script src="js/js/bootstrap.min.js"></script>
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/jquery.js"></script>
		<script src="js/popupHide.js"></script>
	</body>
</html>