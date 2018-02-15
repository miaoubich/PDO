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
		<!--<br clear="all"/>-->
		<!-- To print one product with its detail -->
		<?php	
			include("inc/db.php");
		
			if(isset($_GET['id'])){
				$pro_id=$_GET['id'];
				
				$pro_fetch=$con->prepare("SELECT *FROM products WHERE id=$pro_id");
				$pro_fetch->setFetchMode(PDO:: FETCH_ASSOC);
				$pro_fetch->execute();
				$row_prod=$pro_fetch->fetch();
				$cat_id=$row_prod['cat_id'];
				?>
					
					<div id="pro_img">
						<img src="imgs/pro_img/<?php echo $row_prod['pro_img2'] ?>" width="100%" height="450" alt="Nean" />
						<ul>
							<li><img src="imgs/pro_img/<?php echo $row_prod["pro_img1"] ?>"  alt="" /></li>
							<li><img src="imgs/pro_img/<?php //echo $row_prod["pro_img2"] ?>"  alt="" /></li>
							<li><img src="imgs/pro_img/<?php echo $row_prod["pro_img3"] ?>"  alt="" /></li>
							<li><img src="imgs/pro_img/<?php echo $row_prod["pro_img4"] ?>"  alt="" /></li>
						</ul>
					</div>
					
					<div id="pro_feature">
						<h3><?php echo $row_prod["pro_name"]?></h3>
							<ul>
								<li><span class="a-list-item"><?php echo $row_prod["pro_feature1"]?></span></li>
								<li><span class="a-list-item"><?php echo $row_prod["pro_feature2"]?></span></li>
								<li><span class="a-list-item"><?php echo $row_prod["pro_feature3"]?></span></li>
								<li><span class="a-list-item"><?php echo $row_prod["pro_feature4"]?></span></li>
								<li><span class="a-list-item"><?php echo $row_prod["pro_feature5"]?></span></li>
							<!--</ul>-->
								<!--
								<p><?php echo $row_prod["pro_feature1"]?>.</p>
								<p><?php echo $row_prod["pro_feature2"]?>.</p>
								<p><?php echo $row_prod["pro_feature3"]?>.</p>
								<p><?php echo $row_prod["pro_feature4"]?>.</p>
								<p><?php echo $row_prod["pro_feature5"]?>.</p>
								-->
							<!--<ul id="list2">-->
								<li><span class="a-list-item">Model No: <?php echo $row_prod["pro_model"]?></span></li>
								<li><span class="a-list-item">Warranty: <?php echo $row_prod["pro_warranty"]?></span></li>
								<li><span class="a-list-item">KeyWord: <?php echo $row_prod["pro_keyword"]?></span></li>
							</ul><br clear="all"/>
							<center>
								<h4>Selling Price: <?php echo $row_prod["pro_price"]?> €</h4>
								<form method="post">
									<input type="hidden" value="<?php echo $row_prod['id']; ?>" name="pro_id"/>
									<button id="buy_btn" name="buy_now"><span class="glyphicon glyphicon-credit-card"></span> Buy Now</button>
									<button id="buy_btn" name="cart_btn"><span class="glyphicon glyphicon-plus"></span> Add To Cart</button>
								</form>
							</center>
					</div><br clear="all"/><!-- because we are using float left -->
					<div id="sim_pro">
						<h3>Similar Items</h3>
						<ul>
							<?php 
								echo add_cart();
								$sim_pro=$con->prepare("SELECT *FROM products WHERE id!=$pro_id AND cat_id=$cat_id LIMIT 0,5");   
								$sim_pro->setFetchMode(PDO:: FETCH_ASSOC);
								$sim_pro->execute();
								while($row=$sim_pro->fetch()){
									echo"<li>
											<a href='pro_detail.php?id=".$row['id']."'>
												<img src='imgs/pro_img/".$row['pro_img1']."'/><br clear='all'/>
												<p>".$row['pro_name']."</p>
												<p id='P_price'>Price: ".$row['pro_price']."</p>
											</a>
										</li>";
								}
							?>
						</ul>
					</div>
				<?php
			}
		?>
		<br><br>
		
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