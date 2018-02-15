<div id="bodyleft">

	<?php if(!isset($_GET['cat_id'])){?>
		<div id="slider">
			<h2>Deals Of The Day</h2>
			<figure>
				<!--<img src="imgs/shopping/sale.jpg" width="" height="" alt="picture!"/>-->
				<img src="imgs/shopping/shopping1.jpeg" width="" height="" alt="picture!"/>
				<img src="imgs/shopping/shopping2.jpeg" width="" height="" alt="picture!"/>
				<img src="imgs/shopping/shopping3.jpeg" width="" height="" alt="picture!"/>
				<img src="imgs/shopping/shopping4.jpeg" width="" height="" alt="picture!"/>
				<img src="imgs/shopping/shopping5.jpeg" width="" height="" alt="picture!"/>
				<img src="imgs/shopping/shopping7.jpeg" width="" height="" alt="picture!"/>
			</figure>
		</div>
	<?php } ?>
			<ul><?php echo electronics();?></ul><br clear="all">
			<ul><?php echo High_Tech();?></ul><br clear="all">
			<ul><?php echo Photos_Camcorders();?></ul><br clear="all">
			<ul><?php echo Luggage();?></ul><br clear="all">
			<ul><?php echo Smart_phones();?></ul><br clear="all">
			<ul><?php echo Sport_Health();?></ul><br clear="all">
			<ul><?php echo Parfumerie();?></ul><br clear="all">

</div><!--end of bodyleft-->