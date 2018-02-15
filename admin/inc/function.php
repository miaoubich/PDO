<?php
	function add_cat(){
		include("inc/db.php");
		if(isset($_POST['add_cat'])){
			$name=$_POST['cat_name'];
			if(empty($name)){
				echo "<script>alert('Prease enter a category.');</script>";
			}else{
				$add=$con->prepare("insert into main_cat(name)values('$name')");
				if($add->execute()){
					echo "<script>alert('Category added successfully!');</script>";
					echo "<script>window.open('indexAdmin.php?viewall_cat','_self')</script>";
				}
			}
		}	
	}

	function add_brand_img(){
		include("inc/db.php");

		if(isset($_POST['add_brand'])){

			$brand_name=$_POST['brand_name'];

			$brand_img=$_FILES['brand_img']['name'];
			$brand_img_temp=$_FILES['brand_img']['tmp_name'];
			move_uploaded_file($brand_img_temp, "../imgs/brand_img/$brand_img");

			if(empty($brand_img)){
				echo"<script>alert('Prease select a brand photo icon.');</script>";
			}else{
				$add_img=$con->prepare("UPDATE brand SET brand_img='$brand_img' WHERE name='$brand_name'");

				if($add_img->execute()){
					echo "<script>alert('Brand Icon added successfully!');</script>"; 
					echo "<script>window.open('indexAdmin.php?viewall_brands','_self')</script>";
				}
			}

		}
	}
	
	function add_sub_cat(){
		include("inc/db.php");
		if(isset($_POST['add_sub_cat'])){
			$cat_id=$_POST['main_cat'];
			$name=$_POST['sub_cat_name'];
			if(empty($name)){
				echo "<script>alert('Please enter a sub-category.');</script>";
			}else{
				$add=$con->prepare("insert into sub_cat(name, cat_id)values('$name','$cat_id')");
				if($add->execute()){
					echo "<script>alert('Sub-category added successfully!');</script>";
					echo "<script>window.open('indexAdmin.php?viewall_Sub_cat','_self')</script>";
				}
			}
		}
	}
	
	function add_pro(){
		include("inc/db.php");
		if(isset($_POST['add_product'])){
			$pro_name=$_POST['pro_name'];
			$cat_id=$_POST['cat_id'];
			$sub_cat_id=$_POST['sub_cat_id'];
			
			$pro_img1=$_FILES['pro_img1']['name'];
			$pro_img1_temp=$_FILES['pro_img1']['tmp_name'];
			
			$pro_img2=$_FILES['pro_img2']['name'];
			$pro_img2_temp=$_FILES['pro_img2']['tmp_name'];
			
			$pro_img3=$_FILES['pro_img3']['name'];
			$pro_img3_temp=$_FILES['pro_img3']['tmp_name'];
			
			$pro_img4=$_FILES['pro_img4']['name'];
			$pro_img4_temp=$_FILES['pro_img4']['tmp_name'];
			
			//$location="../imgs/pro_img/$pro_img1_temp";
			move_uploaded_file($pro_img1_temp, "../imgs/pro_img/$pro_img1"); 
			move_uploaded_file($pro_img2_temp, "../imgs/pro_img/$pro_img2");
			move_uploaded_file($pro_img3_temp, "../imgs/pro_img/$pro_img3");
			move_uploaded_file($pro_img4_temp, "../imgs/pro_img/$pro_img4");
			
			$pro_Feature1=$_POST['pro_Feature1'];
			$pro_Feature2=$_POST['pro_Feature2'];
			$pro_Feature3=$_POST['pro_Feature3'];
			$pro_Feature4=$_POST['pro_Feature4'];
			$pro_Feature5=$_POST['pro_Feature5'];
			$pro_price=$_POST['pro_price'];
			$pro_brand=$_POST['pro_brand'];
			$pro_model=$_POST['pro_model'];
			$pro_warranty=$_POST['pro_warranty'];
			$pro_keyword=$_POST['pro_keyword'];
			$pro_gender=$_POST['pro_gender'];
			
			if(empty($pro_name)){
				echo "<script>alert('Prease enter at least a product name.');</script>";
			}else{
				$add=$con->prepare("insert into products
									(pro_name,cat_id,sub_cat_id,pro_img1,pro_img2,pro_img3,pro_img4,
									 pro_Feature1,pro_Feature2,pro_Feature3,pro_Feature4,pro_Feature5,
									 pro_price,pro_brand,pro_model,pro_warranty,pro_keyword,pro_added_date,pro_gender)
									 values('$pro_name','$cat_id','$sub_cat_id','$pro_img1','$pro_img2',
									 '$pro_img3','$pro_img4','$pro_Feature1','$pro_Feature2','$pro_Feature3',
									 '$pro_Feature4','$pro_Feature5','$pro_price','$pro_brand','$pro_model','$pro_warranty','$pro_keyword',NOW(),'$pro_gender')");

				//Add brand to Brand table
				$brand_query=$con->prepare("SELECT name, nbr FROM brand WHERE name='$pro_brand'");
				$brand_query->setFetchMode(PDO:: FETCH_ASSOC);
				$brand_query->execute();

				$brand_row=$brand_query->rowCount();


				if($brand_row>0){
					$brand=$brand_query->fetch();
					$name=$brand['name'];
					$nbr=$brand['nbr'];
					$nbr1=$nbr+1;
					$brand_number=$con->prepare("UPDATE brand SET nbr=$nbr1 WHERE name='$name'");
					$brand_number->execute();
				}else{
					$brand_add=$con->prepare("INSERT INTO brand(name,nbr) VALUES('$pro_brand',1)");
					$brand_add->execute();
				}
			
				if($add->execute()){
					echo "<script>alert('Product detail added successfully!');</script>"; 
					echo "<script>window.open('indexAdmin.php?viewall_products1','_self')</script>";
				}
			}
		}
	}
	
	function viewall_cat(){
		include("inc/db.php");
		$fetch_cat=$con->prepare("SELECT *FROM main_cat");
		$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_cat->execute();
							
		while($row=$fetch_cat->fetch()){
			echo"<option value='".$row['id']."'>".$row['name']."</option>";
		}
	}
	
	function viewall_sub_cat(){
		include("inc/db.php");
		$fetch_sub_cat=$con->prepare("SELECT *FROM sub_cat");
		$fetch_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_sub_cat->execute();
							
		while($row=$fetch_sub_cat->fetch()){
			echo"<option value='".$row['id']."'>".$row['name']."</option>";
		}
	}
	
	function user_statistic(){
		include("inc/db.php");
		
		$page=$_GET['user_statistic'];
				
			if($page=="" || $page=="1"){
				$page1=0;
			}else{
				$page1=($page*10)-10;
			}
		$j=1;
		$fetch_user=$con->prepare("SELECT *FROM user ORDER BY 1 DESC LIMIT $page1,10");
		$fetch_user->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_user->execute();
		//$i=1+$page1;
		while($row=$fetch_user->fetch()){
			echo "<tr>
					<td style='width:100px'>".$j++."</td>
					<td style='width:100px'>".$row['status']."</td>
					<td style='min-width:180px'>".$row['name']."</td>
					<td style='min-width:140px'>".$row['email']."</td>
					<td style='min-width:140px'>".$row['password']."</td>
					<td style='min-width:140px'>".$row['nickname']."</td>
					<td style='min-width:140px'>".$row['dob']."</td>
					<td style='min-width:130px'>".$row['phone']."</td>
					<td style='min-width:200px'>
						<img src= ../imgs/user_img/".$row['img']." width='20' height='15'/>
					</td>
					<td style='min-width:140px'>".$row['address']."</td>
					<td style='min-width:140px'>".$row['country_id']."</td>
					<td style='min-width:100px'>".$row['state_id']."</td>
					<td style='min-width:150px'>".$row['user_reg_date']."</td>
				</tr>";
		}
	}

	function viewall_product(){
		include("inc/db.php");
		
		
		
			$page=$_GET['viewall_products1'];
				
			if($page=="" || $page=="1"){
				$page1=0;
			}else{
				$page1=($page*4)-4;
			}
		
		
		$fetch_pro=$con->prepare("SELECT *FROM products ORDER BY 1 DESC LIMIT $page1,4");
		$fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_pro->execute();
		$i=1+$page1;
		while($row=$fetch_pro->fetch()){
			echo "<tr>
					<td style='width:100px'>".$i++."</td>
					<td style='width:100px'><a href='indexAdmin.php?edit_pro=".$row['id']."'>&#x270f;</a></td>
					<td><a href='indexAdmin.php?delete_pro=".$row['id']."' style='padding-left:px;color:red;font-weight:bold;'>x</a></td>
					<td style='min-width:180px'>".$row['pro_name']."</td>
					<td style='min-width:200px'>
						<img src= ../imgs/pro_img/".$row['pro_img1']." width='20' height='15'/>
						<img src= ../imgs/pro_img/".$row['pro_img2']." width='20' height='15'/>
						<img src= ../imgs/pro_img/".$row['pro_img3']." width='20' height='15'/>
						<img src= ../imgs/pro_img/".$row['pro_img4']." width='20' height='15'/>
					</td>
					<td style='min-width:140px'>".$row['pro_feature1']."</td>
					<td style='min-width:140px'>".$row['pro_feature2']."</td>
					<td style='min-width:130px'>".$row['pro_feature3']."</td>
					<td style='min-width:140px'>".$row['pro_feature4']."</td>
					<td style='min-width:140px'>".$row['pro_feature5']."</td>
					<td>".$row['pro_price']."</td>
					<td style='min-width:100px'>".$row['pro_brand']."</td>
					<td style='min-width:130px'>".$row['pro_model']."</td>
					<td style='min-width:120px'>".$row['pro_warranty']."</td>
					<td style='min-width:130px'>".$row['pro_keyword']."</td>
					<td style='min-width:100px'>".$row['pro_gender']."</td>
					<td style='min-width:150px'>".$row['pro_added_date']."</td>
				</tr>";
		}
	}

	function viewall_brands(){
		include("inc/db.php");

		$page=$_GET['viewall_brands'];
				
		if($page=="" || $page=="1"){
			$page1=0;
		}else{
			$page1=($page*10)-10;
		}

		$fetch_brand=$con->prepare("SELECT *FROM brand ORDER BY name LIMIT $page1,10");
		$fetch_brand->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_brand->execute();
		$i=1+$page1;
		while($row_brand=$fetch_brand->fetch()){
			echo "
				<tr style='height:40px;line-height:40px;'><center>
					<td style='width:12%;'>".$i++."</td>
					<td style='width:25%;'>".$row_brand['name']."</td>
					<td style='width:25%;padding-top:5px;'><center><img src= ../imgs/brand_img/".$row_brand['brand_img']." width='40' height='30'/></center></td>
					<td style='width:22%;'><center>".$row_brand['nbr']."</center></td>
					<td style='width:10%;'><a href='indexAdmin.php?edit_brand=".$row_brand['id']."' style='padding-left:20px;'>&#x270f;</a></td>
					<td style='width:22%;'><a href='indexAdmin.php?delete_brand=".$row_brand['id']."' style='padding-left:25px; color:red; font-weight:bold;'>x</a></td>
				</tr>";
		}
	}
	
	function viewall_category(){ 
		include("inc/db.php");
		
		$page=$_GET['viewall_cat'];
				
		if($page=="" || $page=="1"){
			$page1=0;
		}else{
			$page1=($page*10)-10;
		}
		
		$fetch_cat=$con->prepare("SELECT *FROM main_cat ORDER BY name LIMIT $page1,10");
		$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_cat->execute();
		$i=1+$page1;
		while($row=$fetch_cat->fetch()){
			echo "<tr>
					<td>".$i++."</td>
					<td>".$row['name']."</td>
					<td><a href='indexAdmin.php?edit_cat=".$row['id']."' style='padding-left:20px;'>&#x270f;</a></td>
					<td><a href='indexAdmin.php?delete_cat=".$row['id']."' style='padding-left:25px;color:red;font-weight:bold;'>x</a></td>
				  </tr>";
		}
	}
	function viewall_sub_category(){
		include("inc/db.php");
		
		$page=$_GET['viewall_Sub_cat'];
				
		if($page=="" || $page=="1"){
			$page1=0;
		}else{
			$page1=($page*10)-10;
		}
		
		$fetch_cat=$con->prepare("SELECT *FROM sub_cat ORDER BY name LIMIT $page1,10");
		$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_cat->execute();
		$i=1+$page1;
		while($row=$fetch_cat->fetch()){
			echo "<tr>
					<td>".$i++."</td>
					<td>".$row['name']."</td>
					<td><a href='indexAdmin.php?edit_sub_cat=".$row['id']."'style='padding-left:20px;'>&#x270f;</a></td>
					<td><a href='indexAdmin.php?delete_sub_cat=".$row['id']."' style='padding-left:25px;color:red;font-weight:bold;'>x</a></td>
				  </tr>";
		}
	}
	
	function edit_cat(){
		include("inc/db.php");
		if(isset($_GET['edit_cat'])){
			$cat_id=$_GET['edit_cat'];
			
			$fetch_cat_name=$con->prepare("SELECT * FROM main_cat WHERE id=$cat_id");
			$fetch_cat_name->setFetchMode(PDO:: FETCH_ASSOC);
			$fetch_cat_name->execute();
			$row=$fetch_cat_name->fetch();
			echo"<form method='post'>
					<table>
						<tr>
							<td>Update Category Name: </td>
							<td><input type='text' name='cat_name' value='".$row['name']."'></td>
						</tr>
					</table>
					<center><button name='update_cat'>Update Category</button></center>
				</form> ";
				
					if(isset($_POST['update_cat'])){
						$up_cat_name=$_POST['cat_name'];
						
						$update_cat=$con->prepare("UPDATE main_cat SET name='$up_cat_name' WHERE id=$cat_id ");
						
						if($update_cat->execute()){
							echo "<script>alert('Category Updated Successfully');</script>";
							echo "<script>window.open('indexAdmin.php?viewall_cat','_self');</script>";
						}
					}
					
		}
	}
	
	function edit_sub_cat(){
		include("inc/db.php");
		if(isset($_GET['edit_sub_cat'])){
			$sub_cat_id=$_GET['edit_sub_cat'];
			
			$fetch_sub_cat_name=$con->prepare("SELECT * FROM sub_cat WHERE id=$sub_cat_id");
			$fetch_sub_cat_name->setFetchMode(PDO:: FETCH_ASSOC);
			$fetch_sub_cat_name->execute();
			$row=$fetch_sub_cat_name->fetch();
			
			$cat_id=$row['cat_id'];
			
			$fetch_cat=$con->prepare("SELECT *FROM main_cat WHERE id=$cat_id");
			$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
			$fetch_cat->execute();
			$row_cat=$fetch_cat->fetch();
			
			$cat_name=$row_cat['name'];
			
			echo"<form method='post'>
					<table>
						<tr>
							<td>Select Main Category Name:</td>
							<td>
								<select name='main_cat'>
									<option value='".$row_cat['id']."'>".$row_cat['name']."</option>";
									echo viewall_cat();
								echo"</select>
							</td>
						</tr>
						<tr>
							<td>Update Sub Category Name: </td>
							<td><input type='text' name='sub_cat_name' value='".$row['name']."'></td>
						</tr>
					</table>
					<center><button name='update_sub_cat'>Update Sub Category</button></center>
				</form> ";
				
					if(isset($_POST['update_sub_cat'])){
						$cat_name=$_POST['main_cat'];
						$up_sub_cat_name=$_POST['sub_cat_name'];
						
						$update_sub_cat=$con->prepare("UPDATE sub_cat SET name='$up_sub_cat_name', cat_id=$cat_name WHERE id=$sub_cat_id ");
						
						if($update_sub_cat->execute()){
							echo "<script>alert('Sub Category Updated Successfully');</script>";
							echo "<script>window.open('indexAdmin.php?viewall_Sub_cat','_self');</script>";
						}
					}
					
		}
	}
	
	function edit_pro(){
		include("inc/db.php");
		if(isset($_GET['edit_pro'])){
			$id_pro=$_GET['edit_pro'];
			
			$fetch_pro=$con->prepare("SELECT *FROM products WHERE id=$id_pro");
			$fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
			$fetch_pro->execute();
			$row=$fetch_pro->fetch();
			
			$cat_id=$row['cat_id'];
			
			$sub_cat_id=$row['sub_cat_id'];
			
			$fetch_cat=$con->prepare("SELECT *FROM main_cat WHERE id=$cat_id");
			$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
			$fetch_cat->execute();
			$row_cat=$fetch_cat->fetch();
			
			$fetch_sub_cat=$con->prepare("SELECT *FROM sub_cat WHERE id=$sub_cat_id");
			$fetch_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
			$fetch_sub_cat->execute();
			$row_sub_cat=$fetch_sub_cat->fetch();
			
				echo"
				<form method='post' enctype='multipart/form-data'>
					<table>
						<tr>
							<td>Update Product Name: </td>
							<td><input type='text' name='pro_name' value='".$row['pro_name']."'></td>
						</tr>
						<tr>
							<td>Update Category Name: </td>
							<td>
								<select name='cat_id'>
									<option value='".$row_cat['id']."'>".$row_cat['name']."</option>";
									echo viewall_cat();
						   echo"</select>
							</td>
						</tr>
						<tr>
							<td>Update Sub-Category Name: </td>
							<td>
								<select name='sub_cat_id'>
									<option value='".$row_sub_cat['id']."'>".$row_sub_cat['name']."</option>";
									echo viewall_sub_cat();
							echo"</select>
							</td>
						</tr>
						<tr>
							<td>Update Product Image 1: </td>
							<td>
								<input type='file' name='pro_img1' />
								<img src='../imgs/pro_img/".$row['pro_img1']."' width='59' height='44'/>
							</td
							>
						</tr>
						<tr>
							<td>Update Product Image 2: </td>
							<td>
								<input type='file' name='pro_img2' />
								<img src='../imgs/pro_img/".$row['pro_img2']."' width='59' height='44'/>
							</td>
						</tr>
						<tr>
							<td>Update Product Image 3: </td>
							<td>
								<input type='file' name='pro_img3' />
								<img src='../imgs/pro_img/".$row['pro_img3']."' width='59' height='44'/>
							</td>
						</tr>
						<tr>
							<td>Update Product Image 4: </td>
							<td>
								<input type='file' name='pro_img4'/>
								<img src='../imgs/pro_img/".$row['pro_img4']."' width='59' height='44'/>
							</td>
						</tr>
						<tr>
							<td>Update Feature1: </td>
							<td><input type='text' name='pro_Feature1' value='".$row['pro_feature1']."'></td>
						</tr>
						<tr>
							<td>Update Feature2: </td>
							<td><input type='text' name='pro_Feature2' value='".$row['pro_feature2']."'></td>
						</tr>
						<tr>
							<td>Update Feature3: </td>
							<td><input type='text' name='pro_Feature3' value='".$row['pro_feature3']."'></td>
						</tr>
						<tr>
							<td>Update Feature4: </td>
							<td><input type='text' name='pro_Feature4' value='".$row['pro_feature4']."'></td>
						</tr>
						<tr>
							<td>Update Feature5: </td>
							<td><input type='text' name='pro_Feature5' value='".$row['pro_feature5']."'></td>
						</tr>
						<tr>
							<td>Update Price: </td>
							<td><input type='text' name='pro_price' value='".$row['pro_price']."'></td>
						</tr>
						<tr>
							<td>Update Brand: </td>
							<td><input type='text' name='pro_brand' value='".$row['pro_brand']."'></td>
						</tr>
						<tr>
							<td>Update Model No. : </td>
							<td><input type='text' name='pro_model' value='".$row['pro_model']."'></td>
						</tr>
						<tr>
							<td>Update Warranty: </td>
							<td><input type='text' name='pro_warranty' value='".$row['pro_warranty']."'></td>
						</tr>
						<tr>
							<td>Update Keyword: </td>
							<td><input type='text' name='pro_keyword' value='".$row['pro_keyword']."'></td>
						</tr>
						<tr>
							<td>Gender: </td>
							<td>
								<select name='pro_gender'>
									<option></option>
									<option value='men'>Men</option>
									<option value='women'>Women</option>
									<option value='kids'>Kids</option>
								</select>
							</tr>
					</table>
					<center><button name='update_product'>Update Product</button></center>
				</form>";
			
			if(isset($_POST['update_product'])){
				$pro_name=$_POST['pro_name'];
				$cat_id=$_POST['cat_id'];
				$sub_cat_id=$_POST['sub_cat_id'];
				

				if($_FILES['pro_img1']['tmp_name'] == ''){

				}else{
					$pro_img1=$_FILES['pro_img1']['name'];
					$pro_img1_temp=$_FILES['pro_img1']['tmp_name'];
					move_uploaded_file($pro_img1_temp, "../imgs/pro_img/$pro_img1");
					$up_img1=$con->prepare("UPDATE products SET pro_img1='$pro_img1' WHERE id=$id_pro");
					$up_img1->execute();
				}
				
				if($_FILES['pro_img2']['tmp_name'] == ''){

				}else{
					$pro_img2=$_FILES['pro_img2']['name'];
					$pro_img2_temp=$_FILES['pro_img2']['tmp_name'];
					move_uploaded_file($pro_img2_temp, "../imgs/pro_img/$pro_img2");
					$up_img2=$con->prepare("UPDATE products SET pro_img2='$pro_img2' WHERE id=$id_pro");
					$up_img2->execute();
				}
				
				if($_FILES['pro_img3']['tmp_name'] == ''){

				}else{
					$pro_img3=$_FILES['pro_img3']['name'];
					$pro_img3_temp=$_FILES['pro_img3']['tmp_name'];
					move_uploaded_file($pro_img3_temp, "../imgs/pro_img/$pro_img3");
					$up_img3=$con->prepare("UPDATE products SET pro_img3='$pro_img3' WHERE id=$id_pro");
					$up_img3->execute();
				}
				
				if($_FILES['pro_img3']['tmp_name'] == ''){

				}else{
					$pro_img4=$_FILES['pro_img4']['name'];
					$pro_img4_temp=$_FILES['pro_img4']['tmp_name'];
					move_uploaded_file($pro_img4_temp, "../imgs/pro_img/$pro_img4"); 
					$up_img4=$con->prepare("UPDATE products SET pro_img4='$pro_img4' WHERE id=$id_pro");
					$up_img4->execute();
				}
				
				//$location="../imgs/pro_img/$pro_img1_temp";
				//move_uploaded_file($pro_img1_temp, "../imgs/pro_img/$pro_img1");
				//move_uploaded_file($pro_img2_temp, "../imgs/pro_img/$pro_img2");
				//move_uploaded_file($pro_img3_temp, "../imgs/pro_img/$pro_img3");
				//move_uploaded_file($pro_img4_temp, "../imgs/pro_img/$pro_img4");
				
				$pro_Feature1=$_POST['pro_Feature1'];
				$pro_Feature2=$_POST['pro_Feature2'];
				$pro_Feature3=$_POST['pro_Feature3'];
				$pro_Feature4=$_POST['pro_Feature4'];
				$pro_Feature5=$_POST['pro_Feature5'];
				$pro_price=$_POST['pro_price'];
				$pro_brand=$_POST['pro_brand'];
				$pro_model=$_POST['pro_model'];
				$pro_warranty=$_POST['pro_warranty'];
				$pro_keyword=$_POST['pro_keyword'];
				$pro_gender=$_POST['pro_gender'];
				
				$up_pro=$con->prepare("UPDATE products SET pro_name='$pro_name', cat_id='$cat_id',sub_cat_id='$sub_cat_id', pro_Feature1='$pro_Feature1',
										pro_Feature2='$pro_Feature2', pro_Feature3='$pro_Feature3',pro_Feature4='$pro_Feature4',pro_Feature5='$pro_Feature5',
										pro_price='$pro_price', pro_brand='$pro_brand', pro_model='$pro_model', pro_warranty='$pro_warranty', pro_keyword='$pro_keyword',
										pro_added_date=NOW(), pro_gender='$pro_gender' WHERE id=$id_pro");
				
				if($up_pro->execute()){
					echo"<script>alert('Product Updated Successfulyy!')</script>";
					echo"<script>window.open('indexAdmin.php?viewall_products1','_self')</script>";
				}
			}
		}
	}

	function delete_brand(){
		include("inc/db.php");
		
		if(isset($_GET['delete_brand'])){
			$delete_brand_id=$_GET['delete_brand'];
			
			$delete_brand=$con->prepare("DELETE FROM brand WHERE id=$delete_brand_id");
			
			if($delete_brand->execute()){
				echo "<script>alert('Brand Deleted Successfully!')</script>";
				echo "<script>window.open('indexAdmin.php?viewall_brands','_self')</script>";
			}
		}
	}
	
	function delete_cat(){
		include("inc/db.php");
		
		if(isset($_GET['delete_cat'])){
			$delete_cat_id=$_GET['delete_cat'];
			
			$delete_cat=$con->prepare("DELETE FROM main_cat WHERE id=$delete_cat_id");
			
			if($delete_cat->execute()){
				echo "<script>alert('Category Deleted Successfully!')</script>";
				echo "<script>window.open('indexAdmin.php?viewall_cat','_self')</script>";
			}
		}
	}
	
	function delete_sub_cat(){
		include("inc/db.php");
		
		if(isset($_GET['delete_sub_cat'])){
			$delete_sub_cat_id=$_GET['delete_sub_cat'];
			
			$delete_sub_cat=$con->prepare("DELETE FROM sub_cat WHERE id=$delete_sub_cat_id");
			if($delete_sub_cat->execute()){
				echo "<script>alert('Sub Category Deleted Successfully!')</script>";
				echo "<script>window.open('indexAdmin.php?viewall_Sub_cat','_self')</script>";
			}
		}
	}
	
	function delete_pro(){
		include("inc/db.php");
		
		if(isset($_GET['delete_pro'])){
			$delete_pro_id=$_GET['delete_pro'];
			
			$delete_pro=$con->prepare("DELETE FROM products WHERE id=$delete_pro_id");
			if($delete_pro->execute()){
				echo "<script>alert('Product Deleted Successfully!')</script>";
				echo "<script>window.open('indexAdmin.php?viewall_products1','_self')</script>";
			}
		}
	}
	
	function pro_details(){
		include("inc/db.php");
		
		if(isset($_GET['id'])){
			$pro_id=$_GET['id'];
			
			$pro_fetch=$con->prepare("SELECT *FROM products WHERE id=$pro_id");
			$pro_fetch->setFetchMode(PDO:: FETCH_ASSOC);
			$pro_fetch->execute();
			$row_prod=$pro_fetch->fetch();
			
			echo"<div id='pro_img'>
					<img src='imgs/pro_img/".$row_pro['pro_img1']."' />
				</div>
			";
		}
	}
	
	function Message_Contact(){
		include("inc/db.php");
		
			$page=$_GET['user_contactMessages'];
				
			if($page=="" || $page=="1"){
				$page1=0;
			}else{
				$page1=($page*5)-5;
			}

			$j=1;
			$tbl_message=$con->prepare("SELECT *FROM tbl_contact ORDER BY 1 DESC LIMIT $page1,5");
			$tbl_message->setFetchMode(PDO:: FETCH_ASSOC);
			$tbl_message->execute();
			$i=1+$page1;
			while($row_message=$tbl_message->fetch()){
				echo"<tr>
						<td style='width:50px'>".$j++."</td>
						<td style='width:100px'>".$row_message['contact_name']."</td>
						<td style='width:100px'>".$row_message['contact_tel']."</td>
						<td style='width:100px'>".$row_message['contact_email']."</td>
						<td style='width:300px; line-height:25px;'>".$row_message['contact_message']."</td>
						<td style='width:100px'>".$row_message['received_date']."</td>
						<td style='width:35px'><a href='indexAdmin.php?delete_Message=".$row_message['id']."' style='color:red;'>&times</a></td>
					</tr>";
			}
	}

	function searchContact(){
		include("inc/db.php");

		if(isset($_POST['submitContact'])){

			$emailContact=$_POST['searchContact'];

			$contact=$con->prepare("SELECT *FROM tbl_contact WHERE contact_email = '$emailContact'");
			$contact->setFetchMode(PDO:: FETCH_ASSOC);
			$contact->execute();

			$j=1;
			while($contactRow=$contact->fetch()){
				echo"<tr>
						<td style='width:50px'>".$j++."</td>
						<td style='width:100px'>".$contactRow['contact_name']."</td>
						<td style='width:100px'>".$contactRow['contact_tel']."</td>
						<td style='width:100px'>".$contactRow['contact_email']."</td>
						<td style='width:300px;line-height:25px;padding:10px;'>".$contactRow['contact_message']."</td>
						<td style='width:100px'>".$contactRow['received_date']."</td>
						<td style='width:35px'><a href='indexAdmin.php?delete_Message=".$contactRow['id']."' style='color:red;'>&times</a></td>
					</tr>";
			}
		}
	}

	function delete_Message(){
		include("inc/db.php");

		if(isset($_GET['delete_Message'])){

			$del_id=$_GET['delete_Message'];
			$query_delete=$con->prepare("DELETE FROM tbl_contact WHERE id='$del_id'");

			
			if($query_delete->execute()){
				echo "<script>window.open('indexAdmin.php?user_contactMessages','_self')</script>";
				echo "<script>alert('Message Deleted Successfully!')</script>";
			}	
		}
	}
?>