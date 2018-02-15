<?php include("inc/function.php");?>
<div id="bodyright">
	<h3>View All Categories</h3>
	<form method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<th>Sr No.</th>
				<th>Category Name</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
				<?php viewall_category();?>
		</table>
	</form>
	
	<?php
	include("inc/db.php");
	
		$fetch_pro=$con->prepare("SELECT *FROM main_cat ORDER BY 1 DESC");
		$fetch_pro->execute();
		
		$nbr_rows=$fetch_pro->rowCount();
		$a=$nbr_rows/10; //display 10 records by page
		$a=ceil($a);
		
		echo"<ul style='list-style:none;padding:15px 15px 25px 15px;'>";
			for($b=1; $b<=$a;$b++){
				echo "<center><a href='indexAdmin.php?viewall_cat=$b' style='text-decoration:none;color:#fff;'><li>$b</li></a></center>";
			}
		echo"</ul>";
	?>
	
	<h3 id="add_cat">Add New Category Form</h3>
	<form method="post">
		<table>
			<tr>
				<td>Enter Category Name: </td>
				<td><input type="text" name="cat_name"></td>
			</tr>
		</table>
		<center><button name="add_cat">Add Category</button></center>
	</form>
</div>

<?php echo add_cat();?>