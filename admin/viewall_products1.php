<?php include("inc/function.php"); ?>
<div id="bodyright"> 
	
	<?php
		include("inc/db.php");
	
		$fetch_pro=$con->prepare("SELECT *FROM products ORDER BY 1 DESC");
		$fetch_pro->execute();
		
		$nbr_rows=$fetch_pro->rowCount();
		$a=$nbr_rows/4; //display 4 records by page
		$a=ceil($a);
		
		echo"<ul style='list-style:none;padding:10px 0px 0px 10px;'>";
			for($b=1; $b<=$a;$b++){
				echo "<center><a href='indexAdmin.php?viewall_products1=$b' style='text-decoration:none;color:#fff;'><li>$b</li></a></center>";
				
			}
		echo"</ul>";
	?>
	
	<h3>View All Product Form</h3>
	<div class="scroll">
	<form method="post" enctype="multipart/form-data" >
		<table>
		<tr>
			<th>Sr No.</th>
			<th>Edit</th>
			<th>Delete</th>
			<th>Product Name</th>
			<th>Product Images</th>
			<th>Feature 1</th>
			<th>Feature 2</th>
			<th>Feature 3</th>
			<th>Feature 4</th>
			<th>Feature 5</th>
			<th>Price (€)</th>
			<th>Brand</th>
			<th>Model No.</th>
			<th>Warranty</th>
			<th>Keyword</th>
			<th>Gender</th>
			<th>Added Date</th>
		</tr>
			<?php echo viewall_product();?>
		</table>
	</form>
	</div>
	
</div>
