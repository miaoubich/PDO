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

			if(isset($_COOKIE['resetPass'])){
		?>
			<br>
			<div class="container-fluid">
				<center>
				<div class="alert alert-info" style="width:500px">
				  <strong>Info!</strong> Please check your email to continue the password rest process.
				</div>
				</center>
			</div>

		<?php

			}

			if(isset($_COOKIE['updatedPass'])){
		?>
			<br>
			<div class="container-fluid">
				<center>
				<div class="alert alert-success" style="width:500px">
				  <strong>Info!</strong> Your password has been updated Successfully.
				</div>
				</center>
			</div>

		<?php

			}

			if(!isset($_COOKIE['user'])){
		?>
				<form method="POST" id="pop-up">
				    <img src="imgs/ninja.png">
				    <div class="container">
				    	<span id="crossForm" style="">&times;</span>
				      <h1>NEWSLETTER</h1>
				      <p>For more information about our new coming products, please subscribe down with your email.</p>
				      <input type="email" placeholder="Your Email Address" name="email" id="email">
				      <input type="submit" name="popup_btn" id="popup_btn" value="Subscribe"/>
				    </div>
		  		</form>

		<?php 
			}
			include("inc/navbar.php");
			include("inc/bodyleft.php");
			include("inc/bodyright.php");
			echo add_cart();
			echo newsletter();
		?>

		<br clear="all"/>

		<center>
			<div id="ViewBrands">
				<ul><?php echo Display_brands_img(); ?></ul>
			</div>
		</center>
		
		<?php	
			include("inc/footer_new.php");
		?>

		<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
	    
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/js/bootstrap.min.js"></script>
		<script src="js/jquery.js"></script>
		<script src="js/popupHide.js"></script>	
	</body>
</html>