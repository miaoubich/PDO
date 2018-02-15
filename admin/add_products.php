<?php include("inc/function.php"); ?>
<div id="bodyright"> 
	<h3>Add New Product Form</h3>
	<form method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Enter Product Name: </td>
				<td><input type="text" name="pro_name"></td>
			</tr>
			<tr>
				<td>Select Category Name: </td>
				<td>
					<select name="cat_id">
						<?php echo viewall_cat();?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Select Sub-Category Name: </td>
				<td>
					<select name="sub_cat_id">
						<?php echo viewall_sub_cat();?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Select Product Image 1: </td>
				<td><input type="file" name="pro_img1"></td>
			</tr>
			<tr>
				<td>Select Product Image 2: </td>
				<td><input type="file" name="pro_img2"></td>
			</tr>
			<tr>
				<td>Select Product Image 3: </td>
				<td><input type="file" name="pro_img3"></td>
			</tr>
			<tr>
				<td>Select Product Image 4: </td>
				<td><input type="file" name="pro_img4"></td>
			</tr>
			<tr>
				<td>Enter Feature1: </td>
				<td><input type="text" name="pro_Feature1"></td>
			</tr>
			<tr>
				<td>Enter Feature2: </td>
				<td><input type="text" name="pro_Feature2"></td>
			</tr>
			<tr>
				<td>Enter Feature3: </td>
				<td><input type="text" name="pro_Feature3"></td>
			</tr>
			<tr>
				<td>Enter Feature4: </td>
				<td><input type="text" name="pro_Feature4"></td>
			</tr>
			<tr>
				<td>Enter Feature5: </td>
				<td><input type="text" name="pro_Feature5"></td>
			</tr>
			<tr>
				<td>Enter Price: </td>
				<td><input type="text" name="pro_price"></td>
			</tr>
			<tr>
				<td>Enter Brand: </td>
				<td><input type="text" name="pro_brand"></td>
			</tr>
			<tr>
				<td>Enter Model No. : </td>
				<td><input type="text" name="pro_model"></td>
			</tr>
			<tr>
				<td>Enter Warranty: </td>
				<td><input type="text" name="pro_warranty"></td>
			</tr>
			<tr>
				<td>Gender: </td>
				<td>
					<select name="pro_gender">
						<option></option>
						<option value="men">Men</option>
						<option value="women">Women</option>
						<option value="kids">Kids</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Enter Keyword: </td>
				<td><input type="text" name="pro_keyword"></td>
			</tr>
		</table>
		<center><button name="add_product">Add Product</button></center>
	</form>
</div>

<?php echo add_pro();?>