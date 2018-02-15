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
			include("inc/db.php");
			include("inc/function.php");
			include("inc/header.php");
			include("inc/navbar.php");
		?>

			<div id="bodyleft">
				<div id="bodyleft-left">
					
						<form method="POST" action="" enctype="multipart/form-data" style="margin-top:20px;">
							<input type='file' name='img_user' style='width:145px;'/>
							<div id="photoID">
		<?php    		      	if(isset($_COOKIE['email'])){
									$email=$_COOKIE['email'];

									$user=$con->prepare("SELECT *FROM user WHERE email='$email'");  
									$user->setFetchMode(PDO:: FETCH_ASSOC);
									$user->execute();
									$row=$user->fetch();
									
								echo"<img src='imgs/user_img/".$row['img']."' width='81' height='100' alt='elf' style='border-radius:5px;'>";
			          			} 
		?>                  
							</div>                          
		    				<br><br>
							<i class="glyphicon glyphicon-download-alt"></i> <input type="submit" name="img_load" value="Save Photo" style="background:#fff;color:#445ebb;border:none;">

		<?php 				echo Edit_Myprofile_photo(); ?>

						</form>
					<br>
					<a href="Myprofile.php?editProfile" style="height:35px;line-height:35px;"><i class="glyphicon glyphicon-pencil"></i> Edit my profile</a>
					<br><br>
		<?php		if(!isset($_GET['editPass'])){ ?>
						<a href="Myprofile.php?editPass" class="btn btn-default"><i class="glyphicon glyphicon-lock"></i> Change password</a>
		<?php		} ?>
				</div>

				<div id="bodyleft-right">

		<?php  		if(isset($_GET['editProfile'])){

						echo Edit_Myprofile();

					}else if(isset($_GET['editPass'])){ 

						echo editPass();

					}else{

						echo Myprofile();
					}
		?>
				</div>
			</div>

		<div id="bodyright">
			<h3>GREATE DEALS</h3>

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
		<script src="js/jquery_Myprofile_validation.js"></script>

		<script src="js/popupHide.js">
			$(document).ready(function(){
				function fetch_data(){
					$.ajax({  
	                url:"select.php",  
	                method:"POST",  
	                success:function(data){  
	                     $('#live_data').html(data);  
	                }
           });  
				}
			});
		</script>
	</body>
</html>