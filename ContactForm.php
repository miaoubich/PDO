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

		<div id="ContactForm">
			<h3>Welcome to our customer services</h3>
			<p>Look forward to answer your questions</p>
		</div>
		<div id="bodyleft">
			<div id="bodyleft-left">
			</div>
			<div id="bodyleft-right">

				<div id="contact_us">
					<h4>Contct Us</h4>
				</div>

				<p style="padding:10px;font-size:12px;">To save you time we have printed the answers to some of our most common questions in our <b><a href="#">FAQs</a></b> section, Please check it before contacting us may you would get the answer for your question, otherwise please contact us using the following.</p>

				<br><br>

		<?php  if(isset($_COOKIE['contact_name'])){ ?>

					<div id="sent_message_div" style="background:#e6ffe6;padding:10px;position:absolute;border-radius:5px;margin-left:300px;">Message Sent</div>
		<?php	} ?>

				<p style="text-decoration:underline;font-size:20px;color:#004d99;padding:1% 3% 0% 3%;">By email</p>
				
				<div id="Contact_errors" style="position:absolute;padding:10px;font-size:10px;color:red;font-weight:bold;">
					<div id="Empty_name"></div>
					<div id="Empty_tel"></div>
					<div id="Empty_email"></div>
				</div>

				<form method="POST" action="" id="formContact">

					<div id="contact_div">
							<label style="margin:10px 120px;">Name<span style="color:red;font-size:10px;">*</span></label><br>
							<input type="text" name="contact_name" id="contact_name" autofocus /><br>
							<label>Telephone<span style="color:red;font-size:10px;">*</span></label><br>
							<input type="text" name="contact_tel" id="contact_tel" /><br>
							<label style="margin:10px 120px;">Email<span style="color:red;font-size:10px;">*</span></label><br>
							<input type="text" name="contact_email" id="contact_email"/>
					</div>
					<div id="textarea_contact">
							<label>Further Information</label><br>
							<textarea name="contact_message" id="contact_message" col="100" rows="10"></textarea>
					</div>
					<input type="submit" name="submitContact" id="submitContact" value="SUBMIT ENQUIRY" disabled/>

					<?php  echo ContactForm(); ?>
				</form>

				<br><br>

				<p style="text-decoration:underline;font-size:20px;color:#004d99;padding:1% 3% 0% 3%;">By Post</p>
				<div style="padding:1% 3%;margin-top:20px;background:#ecf2f9;border-radius:3px;">
					<address style="width:150px;padding-top:10px;">Jakova Banicevica 12, 20260, Island Of Korčula</address>
				</div>

			</div>
		</div>
		<div id="body-right">

		</div>


		<br clear="all"/>

		<center>
			<div id="ViewBrands">
				<ul><?php echo Display_brands_img(); ?></ul>
			</div>
		</center>
		
		<?php	
			include("inc/footer_new.php");
		?>

		
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/js/bootstrap.min.js"></script>
		<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
		<script src="js/jquery.js"></script>
		<script src="js/popupHide.js"></script>	
	</body>
</html>