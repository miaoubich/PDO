<!DOCTYPE>
<html>
	<head>
			<meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
			<title>TESTING PAGE</title>
			<link rel="stylesheet" href="css/style.css">
			
			<!-- Bootstrap -->
	    	<link href="js/css/bootstrap.min.css" rel="stylesheet">
		    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->

		    <!-- font-awesome -->
			<!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">-->
			<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
			<!--
			<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
			-->
		</head>

	<body>
		
		<div id="bodyleftbrand">
			<center>
				<div id="myslider" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#myslider" data-slide-to="0" class="active"></li>
						<li data-target="#myslider" data-slide-to="1"></li>
						<li data-target="#myslider" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner">
						<div class="item active">
							<img src="imgs/pro_img/allrounder1.jpg" width="50%">
						</div>
						<div class="item">
							<img src="imgs/pro_img/allrounder2.jpg" width="50%">
						</div>
						<div class="item">
							<img src="imgs/pro_img/allrounder4.jpg" width="50%">
						</div>
					</div>

					<a class="carousel-control left" href="#myslider" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>

					<a class="carousel-control right" href="#myslider" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>

				</div>
			</center>
			<br><br>

			<div style="border:1px solid #eaeaea;width:120px;height:35px;border-bottom:none;border-top:2px solid orange;">	
				<center><p style="height:35px;line-height:35px;">Best Brands</p></center>
			</div>

			<div style="border:1px solid #eaeaea;width:800px;height:350px;">	
				<ul>
					<?php
					include("inc/function.php");
					echo display_brand_detail();
					?>
				</ul>
			</div>
		</div>


		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/js/bootstrap.min.js"></script>

	</body>

</html>