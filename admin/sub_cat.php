<?php include("inc/function.php"); ?>

<div id="bodyright">
	<h3>View All Sub Categories</h3>
	<form method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<th>Sr No.</th>
				<th>Sub Category Name</th>
				<th><center>Edit</center></th>
				<th>Delete</th>
			</tr>
				<?php viewall_sub_category();?><!-- print out all sub categories -->
		</table>
	</form>
	<br><br>
	<?php
	
	include("inc/db.php");
	
		$fetch_pro=$con->prepare("SELECT *FROM sub_cat ORDER BY 1 DESC");
		$fetch_pro->execute();
		
		$nbr_rows=$fetch_pro->rowCount();
		$a=$nbr_rows/10; //display 10 records by page
		$a=ceil($a);
		echo"<ul style='list-style:none;padding-left:10px;'>";
			for($b=1; $b<=$a;$b++){
				echo "<center><a href='indexAdmin.php?viewall_Sub_cat=$b' style='text-decoration:none;color:#fff;'><li>$b</li></a></center>";
			}
		echo"</ul>";
	?>
	<br><br>
	
	<h3 id="add_cat">Add New Sub Category Form</h3>
	<form method="post">
		<table>
			<tr>
				<td>Select Category Name: </td>
				<td>
					<select name="main_cat">
						<?php echo viewall_cat();
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Enter Sub Category Name: </td>
				<td><input type="text" name="sub_cat_name"></td>
			</tr>
		</table>
		<center><button name="add_sub_cat">Add Sub Category</button></center>
	</form>
</div>

<?php echo add_sub_cat();?>