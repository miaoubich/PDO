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

			include("inc/navbar.php");
		?>


		<div id="bodyleftbrand">

			<div id="myslider" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#myslider" data-slide-to="0" class="active"></li>
					<li data-target="#myslider" data-slide-to="1"></li>
					<li data-target="#myslider" data-slide-to="2"></li>
					<li data-target="#myslider" data-slide-to="3"></li>
					<li data-target="#myslider" data-slide-to="4"></li>
					<li data-target="#myslider" data-slide-to="5"></li>
				</ol>

				<div class="carousel-inner">
					<div class="item active">
						<img src="imgs/shopping/p1.jpg" width="100%">
					</div>
					<div class="item">
						<img src="imgs/shopping/p2.jpg" width="100%">
					</div>
					<div class="item">
						<img src="imgs/shopping/p3.jpg" width="100%">
					</div>
					<div class="item">
						<img src="imgs/shopping/p4.jpg" width="100%">
					</div>
					<div class="item">
						<img src="imgs/shopping/p5.jpg" width="100%">
					</div>
					<div class="item">
						<img src="imgs/shopping/p6.gif" width="100%">
					</div>
				</div>

				<a class="carousel-control left" href="#myslider" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>

				<a class="carousel-control right" href="#myslider" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>

			</div>

			<div style="margin:50px 0px 0px 50px; border:1px solid #eaeaea;width:120px;height:35px;border-bottom:none;border-top:2px solid orange;">	
				<center><p style="height:35px;line-height:35px;">Best Brands</p></center>
			</div>

			<div style="margin-left:50px; border:1px solid #eaeaea;width:800px;min-height:300px;">

				<ul>
					<?php
					echo display_brand_detail();
					?>
				</ul>
			</div>

		</div>

		<div id="bodyright">
			<!--<h3>GREATE DEALS</h3>-->

			<hr>
			<center><h4>BRANDS</h4></center>
			<hr>

			<div id="Budget_Select" style="border:1px solid #e6e6e6; border-radius:5px;"">
				<ul>
				<?php 
					echo display_brand(); 
				?>
				</ul>
			</div>
		</div>

		<br clear="all"/>
		
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