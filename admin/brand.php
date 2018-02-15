<?php include("inc/function.php");?>
<div id="bodyright">

	<h3>View All Brands</h3>
	<form method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<th>Sr No.</th>
				<th>Brand Name</th>
				<th>Brand Image</th>
				<th>No of Models</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
				<?php viewall_brands();?>
		</table>
	</form>
	
	<?php
	include("inc/db.php");
	
		$fetch_pro=$con->prepare("SELECT *FROM brand ORDER BY 1 DESC");
		$fetch_pro->execute();
		
		$nbr_rows=$fetch_pro->rowCount();
		$a=$nbr_rows/10; //display 10 records by page
		$a=ceil($a);
		
		echo"<ul style='list-style:none;padding:15px 15px 25px 15px;'>";
			for($b=1; $b<=$a;$b++){
				echo "<center><a href='indexAdmin.php?viewall_brands=$b' style='text-decoration:none;color:#fff;'><li>$b</li></a></center>";
			}
		echo"</ul>";
	?>
	
	<h3 id="add_cat">Add BRAND ICON</h3>
	<form method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Enter a Brand Name: </td>
				<td><input type="text" name="brand_name"></td>
			</tr>
			<tr>
				<td>Upload Photo Brand: </td>
				<td><input type="file" name="brand_img"></td>
			</tr>
		</table>
		<center><button name="add_brand">Add Brand Photo</button></center>
	</form>
</div>

<?php echo add_brand_img();?>
