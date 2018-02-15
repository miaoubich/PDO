<?php
ob_start();

	function Sign_Up(){
		include("inc/db.php");
		
		if(isset($_POST['u_signup'])){
			
			$name=$_POST['u_name'];
			$email=$_POST['u_email'];
			$add=$_POST['u_add'];
			$nickname=$_POST['u_nickname'];
			$country=$_POST['u_country'];
			$state=$_POST['u_state'];
			$date=$_POST['u_date'];
			$phone=$_POST['u_phone'];
				
			$img=$_FILES['u_img']['name'];
			$img_temp=$_FILES['u_img']['tmp_name'];
			move_uploaded_file($img_temp, "imgs/user_img/$img");
			
			$password=mt_rand(); //for having a new number for each load
			$Crypted_password=SHA1($password);

			//$d=mktime(11, 14, 54, 8, 12, 2014);
			$time=date("Y-m-d h:i:sa");//, $d);
			
			//$add_user=$con->prepare("INSERT INTO user(name,email,address,pin,dob,phone,img,country_id,state_id,user_reg_date,password) 
			//             VALUES('$name','$email','$add','$pin','$date','$phone','$img','$country','$state',NOW(),'$Crypted_password')");
			
			$add_user=$con->prepare("INSERT INTO user(name,email,address,nickname,dob,phone,img,country_id,state_id,user_reg_date,password,password2) 
			          VALUES(:name,:email,:address,:nickname,:dob,:phone,'$img',:country_id,:state_id,:user_reg_date,:password,:password2)");

			$add_newsletter=$con->prepare("INSERT INTO newslatter(email) VALUES('$email')");
			$add_newsletter->execute();
			
			$add_user->bindParam(':name',$name);
			$add_user->bindParam(':email',$email);
			$add_user->bindParam(':address',$add);
			$add_user->bindParam(':nickname',$nickname);
			$add_user->bindParam(':dob',$date);
			$add_user->bindParam(':phone',$phone);
			//$add_user->bindParam(':img',$img);
			$add_user->bindParam(':country_id',$country);
			$add_user->bindParam(':state_id',$state);
			$add_user->bindParam(':user_reg_date',$time);
			$add_user->bindParam(':password',$Crypted_password);
			$add_user->bindParam(':password2',$password);
			
			if($add_user->execute()){
				
				$message = "Hello ".$name.",
							Username: ".$email."
							Password: ".$password." ";
							
				mail($email,'Your Password',$message,'From: ali.bouzar@gmail.com');// TO:, Title, message, From:
				
				echo"<script>alert('Your account have created successfully, Please check your email to get the password.');</script>";
				echo"<script>window.open('index.php','_self')</script>";
			}else{
				echo"<script>alert('Registration failed!');</script>";
			}	
		}
	}
	
	function SignIn(){
		include("inc/db.php");
		//session_start();

		if(isset($_POST['login_btn'])){
			
			$email=$_POST['username'];
			$password=$_POST['password'];
			$password_crypted=SHA1($password);
			
			$user=$con->prepare("SELECT *FROM user WHERE email='$email' AND password='$password_crypted'");
			$user->setFetchMode(PDO:: FETCH_ASSOC);
			$user->execute();
			
			$row=$user->fetch();
			
			$user_row=$user->rowCount();
			
			if($user_row>0){

				$name=$row['name'];
				$status=$row['status'];
				$img=$row['img'];

				setcookie('user',$name,time()+60*60*24*10);
				setcookie('email',$email,time()+60*60*24*10);
				setcookie('img',$img,time()+60*60*24*10);

				if(isset($_POST['remember'])){
					setcookie('username', $email, time()+60*60*24*10);
					setcookie('password', $password, time()+60*60*24*10);
					//$_SESSION['username']=$username;
					//$_SESSION['password']=$password;
				}
				if($status>"0"){
					echo"<script>window.open('admin/indexAdmin.php','_self')</script>";
				}else{
					echo"<script>window.open('index.php','_self')</script>";
				}

			}else if(empty($username) || empty($password)){
				echo"<script>alert('Please enter username and password!');</script>";
			}else{
				echo"<script>alert('Wrong username or password!');</script>";
			}
		}
	}
	
	function forgot_pass(){
		include("inc/db.php");

		if(isset($_POST["send_password"])){
			$email=$_POST['Forgotpasswordemail'];

			$query=$con->prepare("SELECT *FROM user WHERE email='$email'");
			$query->setFetchMode(PDO:: FETCH_ASSOC);
			$query->execute();
			$query_data=$query->fetch();

			$name_user=$query_data['name'];

			$query_row=$query->rowCount();

			if($query_row>0){
				$r=SHA1(mt_rand($email + date('YmdHi'), 1000000));

				$message = "Hello ".$name_user.",
							We received a request to access your account in www.korčulashopping.com,
							please click the link bellow to reset your password 
							http://localhost/project_php2/resetPassword.php?name=$name_user&validation_code=$r";

				mail($email,'Reset Password Validation Link',$message,'From: ali.bouzar@gmail.com');// TO:, Title, message

				setcookie('resetPass', $name_user, time()+4);

				$add_validation_code=$con->prepare("UPDATE user SET validation_code='$r' WHERE email='$email'");

				$add_validation_code->execute();

				echo"<script>window.open('index.php','_self')</script>";
				
			}
		}
	} 

	function resetpassword(){
		include("inc/db.php");

		if(isset($_POST['submitpass'])){

			if(isset($_GET['name'], $_GET['validation_code'])){

				$name=$_GET['name'];
				$validation_code=$_GET['validation_code']; 

				$password=$_POST['password1'];
				$crypted_password=SHA1($password);

				$update_validation_code=$con->prepare("UPDATE user SET password='$crypted_password', password2='$password', validation_code='0' WHERE validation_code='$validation_code'");

				if($update_validation_code->execute()){

					setcookie('updatedPass', $name, time()+4);

					echo"<script>window.open('index.php','_self')</script>";
				}

			}
		}
	}

	function getIp(){
		$ip = $_SERVER['REMOTE_ADDR'];
	 
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	 
		return $ip;
	}

	function display_brand(){
		include("inc/db.php");
		
		$brand_query=$con->prepare("SELECT *FROM brand");
		$brand_query->setFetchMode(PDO:: FETCH_ASSOC);
		$brand_query->execute();

		while($brands=$brand_query->fetch()){
			echo"<li>
					<table style='width:100%'>
						<tr>
							<td style='width:78%'>".$brands['name']. "</td><td style='width:10%'>(".$brands['nbr'].")</td>
						</tr>
					</table>
				</li>";
		}
	}

	function display_brand_detail(){
		include("inc/db.php");

		$brand_detail=$con->prepare("SELECT *FROM brand");
		$brand_detail->setFetchMode(PDO:: FETCH_ASSOC);
		$brand_detail->execute();

				
				while($row_brand=$brand_detail->fetch()){
					echo"<li>
							<form method='POST' action='' enctype='multipart/form-data'>
								<a href='#'><img src='imgs/brand_img/".$row_brand['brand_img']."'/></a>
							</form>
						</li>";
				}
		
	}
	
	function add_cart(){
		include("inc/db.php");
		if(isset($_POST['cart_btn'])){
			$pro_id=$_POST['pro_id'];
			$ip=getIp();
			
			$check_pro=$con->prepare("SELECT *FROM cart WHERE pro_id=$pro_id AND ip_add='$ip'");
			$check_pro->execute();
			$row_check=$check_pro->rowCount();
			
			if($row_check == 1){
				echo"<script>alert('You Already Have Added This Product in your Cart.');</script>";
			}else{
				
				$add_cart=$con->prepare("INSERT INTO cart(pro_id,qty,ip_add) VALUES('$pro_id','1','$ip')");
				
				if($add_cart->execute()){
					echo "<script>window.open('index.php','_self');</script>";
				}else{
					echo"<script>alert('Try Again !!!');</script>";
				}
			}
			
		}
	}
	
	function cart_count(){
		include("inc/db.php");
		$ip=getIp();
		$get_cart_item=$con->prepare("SELECT *FROM cart WHERE ip_add='$ip'");
		$get_cart_item->execute();
		$count_cart=$get_cart_item->rowCount();
		
		echo $count_cart;
	}
	
	function cart_display(){
		include("inc/db.php");
		$ip=getIp();
		
		$get_cart_item=$con->prepare("SELECT *FROM cart WHERE ip_add='$ip'");
		$get_cart_item->setFetchMode(PDO:: FETCH_ASSOC);
		$get_cart_item->execute();
		
		$cart_empty=$get_cart_item->rowCount();
		
		$net_total=0;
		
		if($cart_empty==0){
			echo"<center><h4>No poduct found in Cart.<a href='index.php' style='text-decoration:none; color:orange;'> Continue Shopping</a></h4></center>";
		}else{
			if(isset($_POST['up_qty'])){
				$quantity=$_POST['qty'];
				
				foreach($quantity as $key=>$value){
					$update_qty=$con->prepare("UPDATE cart SET qty='$value' WHERE id='$key'");
					
					if($update_qty->execute()){
						echo"<script>window.open('cart.php','_self');</script>";
					}
				}
			}
		echo"<table cellpadding='0' cellspacing='0'>
				<tr>
					<th>Image</th>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Sub Total</th>
					<th>Remove</th>
				</tr>";
			while($row=$get_cart_item->fetch()){
				$pro_id=$row['pro_id'];
				
				$get_pro=$con->prepare("SELECT *FROM products WHERE id=$pro_id");
				$get_pro->setFetchMode(PDO:: FETCH_ASSOC);
				$get_pro->execute();
				$row_pro=$get_pro->fetch();
				echo"<tr>
						<td><img src='imgs/pro_img/".$row_pro['pro_img1']."' /></td>
						<td>".$row_pro['pro_name']."</td>
						<td><input type='text' name='qty[".$row['id']."]' value='".$row['qty']."'/><input type='submit' id='submit_btn' name='up_qty' value='save' /></td>
						<td>".$row_pro['pro_price']."</td>
						<td>";
							$pro_price=$row_pro['pro_price'];
							$qty=$row['qty'];
							$sub_total=$pro_price * $qty;
							echo $sub_total;echo' €';
							$net_total+=$sub_total;
					echo"</td>
						<td><a href='delete.php?delete_id=".$row_pro['id']."' style='font-size:17px; font-weight:bold; padding-left:25px; color:#808080;'><span class='glyphicon glyphicon-trash'></span></a></td>
					</tr>";
			}
			echo"<tr id='net_total_tr'>
					<td></td>
					<td><button id='buy_btn'><a href='index.php'>Continue Shopping</a></button></td>
					<td><button id='buy_btn'>Check Out</button></td>
					<td style='text-align:right; text-decoration:underline; font-size:15px; color:#006622;'><b>Net Total</b></td>
					<td style='color:#248f24; font-size:20px;'>=$net_total €</td>
					<td></td>
				</tr>";
		}
	}
	
	function delete_cart_items(){
		include("inc/db.php");
		if(isset($_GET['delete_id'])){
			$pro_id=$_GET['delete_id'];
			
			$delete_pro=$con->prepare("DELETE FROM cart WHERE pro_id='$pro_id'");
			
			if($delete_pro->execute()){
				//echo "<script>alert('Product Deleted Successfully');</script>";
				echo "<script>window.open('cart.php','_self')</script>";
			}
		}
	}

	function Display_brands_img(){
		include("inc/db.php");

		$fetch_brand=$con->prepare("SELECT *FROM brand LIMIT 0,10");
		$fetch_brand->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_brand->execute();

		while($row_brand=$fetch_brand->fetch()){
			echo"<li>
					<form method='POST' action='' enctype='multipart/form-data'>
						<a href='#'><img src='imgs/brand_img/".$row_brand['brand_img']."'/></a>
					</form>
				</li>";
		}
	}
	
	function electronics(){
		include("inc/db.php");
		
		$fetch_cat=$con->prepare("SELECT *FROM main_cat WHERE id=1");
		$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_cat->execute();
		
		$row_cat=$fetch_cat->fetch();
		$cat_id=$row_cat['id'];
		echo"<h3>".$row_cat['name']."</h3>";
		
		$fetch_product=$con->prepare("SELECT *FROM products WHERE cat_id=$cat_id LIMIT 0,3");
		$fetch_product->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_product->execute();
		
		while($row_product=$fetch_product->fetch()){
			echo"<li>
					<form method='post' enctype='multipart/form-data'>
						<a href='pro_detail.php?id=".$row_product['id']."'>
							<h4>".$row_product['pro_name']."</h4>
							<img src='imgs/pro_img/".$row_product['pro_img3']."' />
						
							<center>
								<a href='pro_detail.php?id=".$row_product['id']."'><button id='pro_btn'>View</button></a>
								<input type='hidden' value='".$row_product['id']."' name='pro_id'/>
								<button id='pro_btn' name='cart_btn'>Add To Cart</button>
								<a href='#'><button id='pro_btn'>Wishlist</button></a>
							</center>
						</a>
					</form>
				</li>";
		}
		
	}
	
	function High_Tech(){
		include("inc/db.php");
		
		$fetch_cat=$con->prepare("SELECT *FROM main_cat WHERE id=3");
		$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_cat->execute();
		
		$row_cat=$fetch_cat->fetch();
		$cat_id=$row_cat['id'];
		echo"<h3>".$row_cat['name']."</h3>";
		
		$fetch_product=$con->prepare("SELECT *FROM products WHERE cat_id=$cat_id  LIMIT 0,3");
		$fetch_product->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_product->execute();
		
		while($row_product=$fetch_product->fetch()){
			echo"<li>
					<form method='post' enctype='multipart/form-data'>
						<a href='pro_detail.php?id=".$row_product['id']."'>
							<h4>".$row_product['pro_name']."</h4>
							<img src='imgs/pro_img/".$row_product['pro_img4']."' />
						
							<center>
								<a href='pro_detail.php?id=".$row_product['id']."'><button id='pro_btn'>View</button></a>
								<input type='hidden' value='".$row_product['id']."' name='pro_id1'/>
								<button id='pro_btn' name='cart_btn1'>Add To Cart</button>
								<a href='#'><button id='pro_btn'>Wishlist</button></a>
							</center>
						</a>
					<form>
				</li>";
		}
	}
	
	function Smart_phones(){
		include("inc/db.php");
		
		$fetch_cat=$con->prepare("SELECT *FROM main_cat WHERE id=2");
		$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_cat->execute();
		$row_cat=$fetch_cat->fetch();
		
		$cat_id=$row_cat['id'];
		echo"<h3>".$row_cat['name']."</h3>";
		
		$fetch_product=$con->prepare("SELECT *FROM products WHERE cat_id=$cat_id LIMIT 0,3");
		$fetch_product->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_product->execute();
		
		while($row_product=$fetch_product->fetch()){
			echo"<li>
					<form method='post' enctype='multipart/form-data'>
						<a href='pro_detail.php?id=".$row_product['id']."'>
							<h4>".$row_product['pro_name']."</h4>
							<img src='imgs/pro_img/".$row_product['pro_img3']."' alt='Smart Phone'/>
						</a>
						
						<center>
							<a href='pro_detail.php?id=".$row_product['id']."'><button id='pro_btn'>View</button></a>
							<input type='hidden' value='".$row_product['id']."' name='pro_id2'/>
							<button id='pro_btn' name='cart_btn'>Add To Cart</button>
							<a href='#'><button id='pro_btn'>Wishlist</button></a>
						</center>
					</form>
				</li>";
		}
	}
	
	function Photos_Camcorders(){
		include("inc/db.php");
		
		$fetch_cat=$con->prepare("SELECT *FROM main_cat WHERE id=12");
		$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_cat->execute();
		$row_cat=$fetch_cat->fetch();
		
		$cat_id=$row_cat['id'];
		echo"<h3>".$row_cat['name']."</h3>";
		
		$fetch_product=$con->prepare("SELECT *FROM products WHERE cat_id=$cat_id LIMIT 0,3");
		$fetch_product->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_product->execute();
		
		while($row_product=$fetch_product->fetch()){
			echo"<li>
					<form method='post' enctype='multipart/form-data'>
						<a href='pro_detail.php?id=".$row_product['id']."'>
							<h4>".$row_product['pro_name']."</h4>
							<img src='imgs/pro_img/".$row_product['pro_img1']."' alt='Smart Phone'/>
						</a>
						
						<center>
							<a href='pro_detail.php?id=".$row_product['id']."'><button id='pro_btn'>View</button></a>
							<input type='hidden' value='".$row_product['id']."' name='pro_id3'/>
							<button id='pro_btn' name='cart_btn'>Add To Cart</button>
							<a href='#'><button id='pro_btn'>Wishlist</button></a>
						</center>
					</form>
				</li>";
		}
	}
	
	function Luggage(){
		include("inc/db.php");
		
		$fetch_cat=$con->prepare("SELECT *FROM main_cat WHERE id=13");
		$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_cat->execute();
		$row_cat=$fetch_cat->fetch();
		
		$cat_id=$row_cat['id'];
		echo"<h3>".$row_cat['name']."</h3>";
		
		$fetch_product=$con->prepare("SELECT *FROM products WHERE cat_id=$cat_id LIMIT 0,3");
		$fetch_product->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_product->execute();
		
		while($row_product=$fetch_product->fetch()){
			echo"<li>
					<form method='post' enctype='multipart/form-data'>
						<a href='pro_detail.php?id=".$row_product['id']."'>
							<h4>".$row_product['pro_name']."</h4>
							<img src='imgs/pro_img/".$row_product['pro_img1']."' alt='Smart Phone'/>
						</a>
						
						<center>
							<a href='pro_detail.php?id=".$row_product['id']."'><button id='pro_btn'>View</button></a>
							<input type='hidden' value='".$row_product['id']."' name='pro_id4'/>
							<button id='pro_btn' name='cart_btn'>Add To Cart</button>
							<a href='#'><button id='pro_btn'>Wishlist</button></a>
						</center>
					</form>
				</li>";
		}
	}
	
	function Sport_Health(){
		include("inc/db.php");
		
		$fetch_cat=$con->prepare("SELECT *FROM main_cat WHERE id=14");
		$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_cat->execute();
		$row_cat=$fetch_cat->fetch();
		
		$cat_id=$row_cat['id'];
		echo"<h3>".$row_cat['name']."</h3>";
		
		$fetch_product=$con->prepare("SELECT *FROM products WHERE cat_id=$cat_id LIMIT 0,3");
		$fetch_product->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_product->execute();
		
		while($row_product=$fetch_product->fetch()){
			echo"<li>
					<form method='post' enctype='multipart/form-data'>
						<a href='pro_detail.php?id=".$row_product['id']."'>
							<h4>".$row_product['pro_name']."</h4>
							<img src='imgs/pro_img/".$row_product['pro_img1']."' alt='Smart Phone'/>
						</a>
						
						<center>
							<a href='pro_detail.php?id=".$row_product['id']."'><button id='pro_btn'>View</button></a>
							<input type='hidden' value='".$row_product['id']."' name='pro_id5'/>
							<button id='pro_btn' name='cart_btn'>Add To Cart</button>
							<a href='#'><button id='pro_btn'>Wishlist</button></a>
						</center>
					</form>
				</li>";
		}
	}
	
	function Parfumerie(){
		include("inc/db.php");
		
		$fetch_cat=$con->prepare("SELECT *FROM main_cat WHERE id=15");
		$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_cat->execute();
		$row_cat=$fetch_cat->fetch();
		
		$cat_id=$row_cat['id'];
		echo"<h3>".$row_cat['name']."</h3>";
		
		$fetch_product=$con->prepare("SELECT *FROM products WHERE cat_id=$cat_id LIMIT 0,3");
		$fetch_product->setFetchMode(PDO:: FETCH_ASSOC);
		$fetch_product->execute();
		
		while($row_product=$fetch_product->fetch()){
			echo"<li>
					<form method='post' enctype='multipart/form-data'>
						<a href='pro_detail.php?id=".$row_product['id']."'>
							<h4>".$row_product['pro_name']."</h4>
							<img src='imgs/pro_img/".$row_product['pro_img1']."' alt='Smart Phone'/>
						</a>
						
						<center>
							<a href='pro_detail.php?id=".$row_product['id']."'><button id='pro_btn'>View</button></a>
							<input type='hidden' value='".$row_product['id']."' name='pro_id7'/>
							<button id='pro_btn' name='cart_btn'>Add To Cart</button>
							<a href='#'><button id='pro_btn'>Wishlist</button></a>
						</center>
					</form>
				</li>";
		}
	}
	
	function all_cat(){
		include("inc/db.php");
		
		$all_cat=$con->prepare("SELECT *FROM main_cat");
		$all_cat->setFetchMode(PDO:: FETCH_ASSOC);
		$all_cat->execute();
		
		while($row=$all_cat->fetch()){
			echo"<li><a href='cat_detail.php?cat_id=".$row['id']."'>".$row['name']."</a></li>";
		}
	}
	
	function cat_detail(){
		include("inc/db.php");
		
		if(isset($_GET['cat_id'])){
			$cat_id=$_GET['cat_id'];
		
			$cat_pro=$con->prepare("SELECT *FROM products WHERE cat_id=$cat_id");
			$cat_pro->setFetchMode(PDO:: FETCH_ASSOC);
			$cat_pro->execute();	
			
			$cat_name=$con->prepare("SELECT *FROM main_cat WHERE id=$cat_id");
			$cat_name->setFetchMode(PDO:: FETCH_ASSOC);
			$cat_name->execute();
			$row=$cat_name->fetch();
			$row_cat_name=$row['name'];
			echo"<h3>$row_cat_name</h3>";
			
			while($row_cat=$cat_pro->fetch()){
			echo"<li>
					<a href='pro_detail.php?id=".$row_cat['id']."'>
						<h4>".$row_cat['pro_name']."</h4>
						<img src='imgs/pro_img/".$row_cat['pro_img1']."' alt='Smart Phone'/>
					</a>
					
					<center>
						<a href='pro_detail.php?id=".$row_cat['id']."'><button id='pro_btn'>View</button></a>
						<a href='#'><button id='pro_btn'>Cart</button></a>
						<a href='#'><button id='pro_btn'>Wishlist</button></a>
					</center>
			
				</li>";
			}
		}	
	}
	
	function viewall_cat(){
		include("inc/db.php");
		
		if(isset($_GET['sub_cat_id'])){
			
			$main_cat=$con->prepare("SELECT *FROM main_cat");
			$main_cat->setFetchMode(PDO:: FETCH_ASSOC);
			$main_cat->execute();
			
			echo"<h3>Categories:</h3>";
			
			while($row=$main_cat->fetch()){
				echo"<li><a href='cat_detail.php?cat_id=".$row['id']."'>".$row['name']."</a></li>";
			}
		}
	}
	
	function viewall_sub_cat(){
		include("inc/db.php");
		
		if(isset($_GET['cat_id'])){
			$cat_id=$_GET['cat_id'];
			
			$sub_cat=$con->prepare("SELECT *FROM sub_cat WHERE cat_id=$cat_id");
			$sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
			$sub_cat->execute();
			
			echo"<h3>Sub Categories:</h3>";
			
			while($row=$sub_cat->fetch()){
				echo"<li><a href='cat_detail.php?sub_cat_id=".$row['id']."'>".$row['name']."</a></li>";
			}
		}
	}
	
	function sub_cat_detail(){
		include("inc/db.php");
		
		if(isset($_GET['sub_cat_id'])){
			$sub_cat_id=$_GET['sub_cat_id'];
		
			$sub_cat_pro=$con->prepare("SELECT *FROM products WHERE sub_cat_id=$sub_cat_id");
			$sub_cat_pro->setFetchMode(PDO:: FETCH_ASSOC);
			$sub_cat_pro->execute();	
			
			$sub_cat_name=$con->prepare("SELECT *FROM sub_cat WHERE id=$sub_cat_id");
			$sub_cat_name->setFetchMode(PDO:: FETCH_ASSOC);
			$sub_cat_name->execute();
			$row=$sub_cat_name->fetch();
			
			$row_sub_cat_name=$row['name'];
			
			echo"<h3>$row_sub_cat_name</h3>";
			
			while($row_sub_cat=$sub_cat_pro->fetch()){
			echo"<li>
					<a href='pro_detail.php?id=".$row_product['id']."'>
						<h4>".$row_sub_cat['pro_name']."</h4>
						<img src='imgs/pro_img/".$row_sub_cat['pro_img1']."' alt='Smart Phone'/>
					</a>
					
					<center>
						<a href='pro_detail.php?id=".$row_sub_cat['id']."'><button id='pro_btn'>View</button></a>
						<a href='#'><button id='pro_btn'>Cart</button></a>
						<a href='#'><button id='pro_btn'>Wishlist</button></a>
					</center>
			
				</li>";
			}
		}	
	}
	
	function bd_men(){
		include("inc/db.php");
		if(isset($_GET['bd_men'])){
			
			$fetch_pro=$con->prepare("SELECT *FROM products WHERE pro_gender='men'");
			$fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
			$fetch_pro->execute();
			
			echo"<h3>Birthday Gifts for Men</h3>";
			
			while($row_men=$fetch_pro->fetch()){
			echo"<li>
					<a href='pro_detail.php?id=".$row_men['id']."'>
						<h4>".$row_men['pro_name']."</h4>
						<img src='imgs/pro_img/".$row_men['pro_img1']."' alt='Picture Not Found'/>
					</a>
					
					<center>
						<a href='pro_detail.php?id=".$row_men['id']."'><button id='pro_btn'>View</button></a>
						<a href='#'><button id='pro_btn'>Cart</button></a>
						<a href='#'><button id='pro_btn'>Wishlist</button></a>
					</center>
			
				</li>";
			}
		}
	}
		
	
	function bd_women(){
		include("inc/db.php");
		if(isset($_GET['bd_women'])){
			
			$fetch_pro=$con->prepare("SELECT *FROM products WHERE pro_gender='women'");
			$fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
			$fetch_pro->execute();
			
			echo"<h3>Birthday Gifts for Women</h3>";
			
			while($row_women=$fetch_pro->fetch()){
			echo"<li>
					<a href='pro_detail.php?id=".$row_women['id']."'>
						<h4>".$row_women['pro_name']."</h4>
						<img src='imgs/pro_img/".$row_women['pro_img1']."' alt='Picture Not Found'/>
					</a>
					
					<center>
						<a href='pro_detail.php?id=".$row_women['id']."'><button id='pro_btn'>View</button></a>
						<a href='#'><button id='pro_btn'>Cart</button></a>
						<a href='#'><button id='pro_btn'>Wishlist</button></a>
					</center>
			
				</li>";
			}
		}
	}
		
	function bd_kids(){
		include("inc/db.php");
		if(isset($_GET['bd_kids'])){
			
			$fetch_pro=$con->prepare("SELECT *FROM products WHERE pro_gender='kids'");
			$fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
			$fetch_pro->execute();
			
			echo"<h3>Birthday Gifts for Kids</h3>";
			
			while($row_kids=$fetch_pro->fetch()){
			echo"<li>
					<a href='pro_detail.php?id=".$row_kids['id']."'>
						<h4>".$row_kids['pro_name']."</h4>
						<img src='imgs/pro_img/".$row_kids['pro_img1']."' alt='Picture Not Found'/>
					</a>
					
					<center>
						<a href='pro_detail.php?id=".$row_kids['id']."'><button id='pro_btn'>View</button></a>
						<a href='#'><button id='pro_btn'>Cart</button></a>
						<a href='#'><button id='pro_btn'>Wishlist</button></a>
					</center>
			
				</li>";
			}
		}
	}
	
	function all_about_men(){
		include("inc/db.php");
		
		if(isset($_GET['men_watch'])){
			$men_watch="watch";
			
			$watch=$con->prepare("SELECT *FROM products WHERE pro_gender='men' AND pro_name LIKE '%$men_watch%'");
			$watch->setFetchMode(PDO:: FETCH_ASSOC);
			$watch->execute();
			
			echo"<h3>Watches For Men</h3>";
			
			while($row_watch=$watch->fetch()){
			echo"<li>
					<a href='pro_detail.php?id=".$row_watch['id']."'>
						<h4>".$row_watch['pro_name']."</h4>
						<img src='imgs/pro_img/".$row_watch['pro_img1']."' alt='Picture Not Found'/>
					</a>
					
					<center>
						<a href='pro_detail.php?id=".$row_watch['id']."'><button id='pro_btn'>View</button></a>
						<a href='#'><button id='pro_btn'>Cart</button></a>
						<a href='#'><button id='pro_btn'>Wishlist</button></a>
					</center>
			
				</li>";
			}
		}
		
		if(isset($_GET['men_laptop'])){
			$men_laptop="Laptop";
			
			$laptop=$con->prepare("SELECT *FROM products WHERE pro_gender='men' AND pro_name LIKE '%$men_laptop%'");
			$laptop->setFetchMode(PDO:: FETCH_ASSOC);
			$laptop->execute();
			
			echo"<h3>Laptop For Men</h3>";
			
			while($row_laptop=$laptop->fetch()){
			echo"<li>
					<a href='pro_detail.php?id=".$row_laptop['id']."'>
						<h4>".$row_laptop['pro_name']."</h4>
						<img src='imgs/pro_img/".$row_laptop['pro_img1']."' alt='Picture Not Found'/>
					</a>
					
					<center>
						<a href='pro_detail.php?id=".$row_laptop['id']."'><button id='pro_btn'>View</button></a>
						<a href='#'><button id='pro_btn'>Cart</button></a>
						<a href='#'><button id='pro_btn'>Wishlist</button></a>
					</center>
			
				</li>";
			}
		}
		
		if(isset($_GET['men_scooter'])){
			$men_scooter="Scooter";
			
			$scooter=$con->prepare("SELECT *FROM products WHERE pro_gender='men' AND pro_name LIKE '%$men_scooter%'");
			$scooter->setFetchMode(PDO:: FETCH_ASSOC);
			$scooter->execute();
			
			echo"<h3>Scooter For Men</h3>";
			
			while($row_scooter=$scooter->fetch()){
			echo"<li>
					<a href='pro_detail.php?id=".$row_product['id']."'>
						<h4>".$row_scooter['pro_name']."</h4>
						<img src='imgs/pro_img/".$row_scooter['pro_img1']."' alt='Picture Not Found'/>
					</a>
					
					<center>
						<a href='pro_detail.php?id=".$row_scooter['id']."'><button id='pro_btn'>View</button></a>
						<a href='#'><button id='pro_btn'>Cart</button></a>
						<a href='#'><button id='pro_btn'>Wishlist</button></a>
					</center>
			
				</li>";
			}
		}
	}
	
	function all_about_women(){
		include("inc/db.php");
		
		if(isset($_GET['women_Parfume'])){
			$women_Parfume="Parfume";
			
			$parfume=$con->prepare("SELECT *FROM products WHERE pro_gender='women' AND pro_name LIKE '%$women_Parfume%'");
			$parfume->setFetchMode(PDO:: FETCH_ASSOC);
			$parfume->execute();
			
			echo"<h3>Parfume For Women</h3>";
			
			while($row_parfume=$parfume->fetch()){
			echo"<li>
					<a href='pro_detail.php?id=".$row_parfume['id']."'>
						<h4>".$row_parfume['pro_name']."</h4>
						<img src='imgs/pro_img/".$row_parfume['pro_img1']."' alt='Picture Not Found'/>
					</a>
					
					<center>
						<a href='pro_detail.php?id=".$row_parfume['id']."'><button id='pro_btn'>View</button></a>
						<a href='#'><button id='pro_btn'>Cart</button></a>
						<a href='#'><button id='pro_btn'>Wishlist</button></a>
					</center>
			
				</li>";
			}
			
		}
	}
	
	function all_about_kids(){
		include("inc/db.php");
		
		if(isset($_GET['kids_bags'])){
			$kids_bags="Bag";
			
			$bags=$con->prepare("SELECT *FROM products WHERE pro_gender='kids' AND pro_name LIKE '%$kids_bags%'");
			$bags->setFetchMode(PDO:: FETCH_ASSOC);
			$bags->execute();
			
			echo"<h3>Bags For Kids</h3>";
			
			while($row_bags=$bags->fetch()){
			echo"<li>
					<a href='pro_detail.php?id=".$row_bags['id']."'>
						<h4>".$row_bags['pro_name']."</h4>
						<img src='imgs/pro_img/".$row_bags['pro_img1']."' alt='Picture Not Found'/>
					</a>
					
					<center>
						<a href='pro_detail.php?id=".$row_bags['id']."'><button id='pro_btn'>View</button></a>
						<a href='#'><button id='pro_btn'>Cart</button></a>
						<a href='#'><button id='pro_btn'>Wishlist</button></a>
					</center>
			
				</li>";
			}
			
		}
	}

	function search(){
		include("inc/db.php");
		
		if(isset($_GET['search'])){
			$user_query=$_GET['user_query'];
			if(empty($user_query)){
				echo"<div id='bodyleft'>
						<ul>
							<h2>Please enter a product name or a keyword !</h2>
						</ul>
					</div>";
			}else{
				$search=$con->prepare("SELECT *FROM products WHERE pro_name LIKE '%$user_query%' OR pro_keyword LIKE '%$user_query%'");
				$search->setFetchMode(PDO:: FETCH_ASSOC);
				$search->execute();
				
				echo"<div id='bodyleft'><ul>";
					if($search->rowCount()==0){
						echo"<h2>Sorry your product not found!</h2>";
					}else{
							while($row=$search->fetch()){
									echo"<li>
											<a href='pro_detail.php?id=".$row['id']."'>
												<h4>".$row['pro_name']."</h4>
												<img src='imgs/pro_img/".$row['pro_img2']."' />
											
												<center>
													<a href='pro_detail.php?id=".$row['id']."'><button id='pro_btn'>View</button></a>
													<a href='#'><button id='pro_btn'>Cart</button></a>
													<a href='#'><button id='pro_btn'>Wishlist</button></a>
												</center>
											</a>
										</li>";
							}
					}
				echo"</ul></div>";
			}
		}
	}

	function filter(){
		include("inc/db.php");
		
		if(isset($_POST['submit1'])){

			$pricemin=$_POST['PriceMin'];
			$pricemax=$_POST['PriceMax'];

			if(empty($pricemin) && empty($pricemax)){

					echo"<script>alert('Please precise your minimum and maximum budget!');</script>";
					echo"<script>window.open('index.php','_self');</script>";

			}else if(!empty($_POST['gender'])){

				$genders=$_POST['gender'];

				foreach($genders as $gender){
					$select=$con->prepare("SELECT *FROM products WHERE (pro_price>=$pricemin AND pro_price<=$pricemax AND pro_gender='$gender')");
					$select->setFetchMode(PDO:: FETCH_ASSOC);
					$select->execute();
				}
			}else {
				$select=$con->prepare("SELECT *FROM products WHERE pro_price>=$pricemin AND pro_price<=$pricemax");
				$select->setFetchMode(PDO:: FETCH_ASSOC);
				$select->execute();
			}
			
			while($row_product=$select->fetch()){
				echo"<li>
								<form method='post' enctype='multipart/form-data'>
									<a href='pro_detail.php?id=".$row_product['id']."'>
										<h4>".$row_product['pro_name']."</h4>
										<img src='imgs/pro_img/".$row_product['pro_img2']."' />
									
										<center>
											<a href='pro_detail.php?id=".$row_product['id']."'><button id='pro_btn'>View</button></a>
											<input type='hidden' value='".$row_product['id']."' name='pro_id'/>
											<button id='pro_btn' name='cart_btn'>Add To Cart</button>
											<a href='#'><button id='pro_btn'>Wishlist</button></a>
										</center>
									</a>
								</form>
							</li>";
			}
		}
	}

	function newsletter(){
		include("inc/db.php");

		if(isset($_POST['popup_btn'])){
			$email=$_POST['email'];

			$email_exist=$con->prepare("SELECT *FROM newslatter WHERE email='$email'");
			$email_exist->setFetchMode(PDO:: FETCH_ASSOC);
			$email_exist->execute();
			$email_row=$email_exist->rowCount();

			if($email_row==0){
				$sql=$con->prepare("INSERT INTO newslatter(email) VALUES('$email')");
				$sql->execute();
			}
		}
	}

	function edit_profile(){
		include("inc/db.php"); 
	 
	 	if(isset($_COOKIE['email'])){
		    $email=$_COOKIE['email'];

		     $output = '';  
		     $user=$con->prepare("SELECT *FROM user WHERE email='$email'");  
		     $user->setFetchMode(PDO:: FETCH_ASSOC);
		     $user->execute();
		     $row_count=$user->rowCount();
		    
		    while($row=$user->fetch()){    
		     echo'
		     	<form method="post" enctype="multipart/form-data">
			        <table>   
			            <tr> 
			              <th>Name</th>
			              <td>'.$row["name"].'</td> 
			            </tr>
			            <tr>
			              <th>Email</th>
			              <td>'.$row["email"].'</td> 
			            </tr>
			            <tr>
			              <th>Pin</th>
			              <td>'.$row["nickname"].'</td> 
			            </tr>
			            <tr>
			              <th>Birth-date</th>
			              <td>'.$row["dob"].'</td>
			            </tr>
			            <tr>
			              <th>Phone N°</th>
			              <td>'.$row["phone"].'</td>
			            </tr>
			            <tr>
			              <th>Address</th>
			              <td>'.$row["address"].'</td>
			            <tr>
			              <th>Country</th>
			              <td>'.$row["country_id"].'</td>
			            </tr>
			            <tr>
			              <th>City</th>
			              <td>'.$row["state_id"].'</td>
			            </tr>
			            <tr>
			              <th>Member Since</th> 
			              <td class="password" disabled>'.$row["user_reg_date"].'</td>
			            </tr> 
			        </table>
			    </form>';
		    }
	  	}
	}

	function Myprofile(){
		include("inc/db.php");
		if(isset($_COOKIE['email'])){
			$email=$_COOKIE['email'];
 
			$user=$con->prepare("SELECT *FROM user WHERE email='$email'");  
			$user->setFetchMode(PDO:: FETCH_ASSOC);
			$user->execute();
			$row_count=$user->rowCount();

			echo'<h2>Personal details</h2>';
				    
			while($row=$user->fetch()){    
			echo'
				<form method="post" enctype="multipart/form-data">
			<center><table style="">   
					    <tr> 
					        <th>Name: <span style="color:red;">*</span></th>
					        <td>'.$row["name"].'</td> 
					    </tr>
					    <tr>
					        <th>Email: <span style="color:red;">*</span></th>
					        <td>'.$row["email"].'</td> 
					    </tr>
					    <tr>
					        <th>Nickname: </th>
					        <td>'.$row["nickname"].'</td> 
					    </tr>
					    <tr>
					        <th>Birth-date:</th>
					        <td>'.$row["dob"].'</td>
					    </tr>
					    <tr>
					        <th>Address:</th>
					        <td>'.$row["address"].'</td>
					    </tr>
					    <tr>
					        <th>City:</th>
					        <td>'.$row["state_id"].'</td>
					    </tr>
					    <tr>
					        <th>Country:</th>
					        <td>'.$row["country_id"].'</td>
					    </tr>
					    <tr>
					        <th>Phone N°:</th>
					        <td>'.$row["phone"].'</td>
					    </tr>
					    <tr>
					        <th>Member Since:</th> 
					        <td>'.$row["user_reg_date"].'</td>
					    </tr> 
					</table>
				</center>
				</form>';
			}
		}
	}

	function Edit_Myprofile(){
		include("inc/db.php");

		if(isset($_GET['editProfile'])){
			$email=$_COOKIE['email'];
 			$errors = array();

			$user=$con->prepare("SELECT *FROM user WHERE email='$email'");  
			$user->setFetchMode(PDO:: FETCH_ASSOC);
			$user->execute();
			$row_count=$user->rowCount();

			echo'<h2>Edit personal details</h2>';
				    
			$row=$user->fetch();    
			echo'
				<form method="post" enctype="multipart/form-data">
					<center>
					<div> 
						<table>   
						    <tr> 
						        <th>Name: <span style="font-size:10px;color:red;">*</span></th>
						        <td><input type="text" id="user_name" name="user_name" value="'.$row["name"].'" style="border:none;border-bottom: 2px solid green; padding-left:10px; height:33px; width:300px;" autofocus></td> 
						    </tr>
						    <tr>
						        <th>Email: <span style="font-size:10px;color:red;">*</span></th>
						        <td><input type="email" id="user_email" name="user_email" value="'.$row["email"].'"style="border:none; border-bottom:2px solid green; padding-left:10px; height:32px; width:300px;"></td> 
						    </tr>
						    <tr>
						        <th>Nickname: </th>
						        <td><input type="text"  id="user_nickname" name="user_nickname" value="'.$row["nickname"].'" style="border:none;border-bottom: 2px solid green; padding-left:10px; height:33px; width:300px;"></td> 
						    </tr>
						    <tr>
						        <th>Birth-date:</th>
						        <td><input type="date" id="user_dob" name="user_dob" value="'.$row["dob"].'" style="border:none;border-bottom: 2px solid green; padding-left:10px; height:33px; width:300px;"></td>
						    </tr>
						    <tr>
						        <th>Address:</th>
						        <td><input type="text" id="user_address" name="user_address" value="'.$row["address"].'" style="border:none;border-bottom: 2px solid green; padding-left:10px; height:33px; width:300px;"></td>
						    </tr>
						    <tr>
						        <th>City:</th>
						        <td><input type="text" id="user_state" name="user_state" value="'.$row["state_id"].'" style="border:none;border-bottom: 2px solid green; padding-left:10px; height:33px; width:300px;"></td>
						    </tr>
						    <tr>
						        <th>Country:</th>
						        <td><input type="text" id="user_country" name="user_country" value="'.$row["country_id"].'" style="border:none;border-bottom: 2px solid green; padding-left:10px; height:33px; width:300px;"></td>
						    </tr>
						    <tr>
						        <th>Phone N°:</th>
						        <td><input type="text" id="user_phone" name="user_phone" value="'.$row["phone"].'" style="border:none;border-bottom: 2px solid green; padding-left:10px; height:33px; width:300px;"></td>
						    </tr>
						    
						</table>
					</div>
					<br>
						<table style="background:#fff;border:none;">
							<tr style="background:#fff;border-bottom:none;">
								<td><input type=button value="Cancel" onClick="window.location.reload()" id="edit_submit">
								<input type="submit" name="edit_submit" id="edit_submit" value="SAVE"></td>
						</table>
					</center>
				</form>';

			$errors = array();//for storing errors

			if(isset($_POST['edit_submit'])){

				$user_name=$_POST['user_name'];
				$user_email=$_POST['user_email'];
				$user_nickname=$_POST['user_nickname'];
				$user_dob=$_POST['user_dob'];
				$user_address=$_POST['user_address'];
				$user_state=$_POST['user_state'];
				$user_country=$_POST['user_country'];
				$user_phone=$_POST['user_phone'];


				
				if(empty($user_name) && empty($user_email)){

					$errors['allfields']="Fields with (*) sign should not be emplty";

				}else if(empty($user_name)){

					$errors['allfields']="Please enter your Name";

				}else if(empty($user_email)){

					$errors['allfields']="Please enter your Email";
				}

				echo'<span style="width:2350px;height:25px;position:absolute;color:red;margin-top:-570px;font-size:12px;padding-left:59px;">° ';if(isset($errors['allfields'])) echo $errors['allfields'];'</span>';

				if(count($errors) == 0){

					$Edit_user=$con->prepare("UPDATE user SET name=:name,email=:email,nickname=:nickname,dob=:dob,address=:address,state_id=:state_id,country_id=:country_id,phone=:phone WHERE email='".$_COOKIE['email']."'");

					$Edit_user->bindParam(':name',$user_name);
					$Edit_user->bindParam(':email',$user_email);
					$Edit_user->bindParam(':nickname',$user_nickname);
					$Edit_user->bindParam(':dob',$user_dob);
					$Edit_user->bindParam(':address',$user_address);
					$Edit_user->bindParam(':state_id',$user_state);
					$Edit_user->bindParam(':country_id',$user_country);
					$Edit_user->bindParam(':phone',$user_phone);

					if($Edit_user->execute()){
						setcookie('email',$user_email,time()+59*59*10000);
						echo"<script>window.open('Myprofile.php','_self')</script>";
					}
				}

			}
		}
	}

	function Edit_Myprofile_photo(){
		include("inc/db.php");

		if(isset($_POST['img_load'])){

			
			$user_img=$_FILES['img_user']['name'];
			$user_img_temp=$_FILES['img_user']['tmp_name'];
			move_uploaded_file($user_img_temp, "imgs/user_img/$user_img");

			$update_img=$con->prepare("UPDATE user SET img='$user_img' WHERE email='".$_COOKIE['email']."' ");

			if($update_img->execute()){
				echo"<script>window.open('Myprofile.php','_self')</script>";
			}

		}
	}

	function editPass(){
		include("inc/db.php");

		if(isset($_GET['editPass'])){

			$user_pass=$con->prepare("SELECT *FROM user WHERE email='".$_COOKIE['email']."'");
			$user_pass->setFetchMode(PDO:: FETCH_ASSOC);
			$user_pass->execute();
			$row_pass=$user_pass->fetch();

			$name=$row_pass['name'];
			$email=$_COOKIE['email'];

			$error=array();

			echo'<h2>Edit Password</h2>';
			echo"
			<form method='POST' action='' class='form-disabled'>
				<center>
				<table>
					<tr>
						<th>Enter Old Password:</th>
						<td><input type='text' id='old_Pass' name='old_Pass' style='border:none;border-bottom: 2px solid red; padding-left:10px; height:33px; width:300px;'/></td>
					</tr>
					<tr>
						<th>Enter New Password:</th>
						<td><input type='text' id='new_Pass' name='new_Pass' style='border:none;border-bottom: 2px solid red; padding-left:10px; height:33px; width:300px;'/></td>
					</tr>
					<tr>
						<th>Re-enter New Password:</th>
						<td><input type='text' id='new_Pass2' name='new_Pass2' style='border:none;border-bottom: 2px solid red; padding-left:10px; height:33px; width:300px;'/></td>
				</table>
				<b><p id='PassNotMatch' style='font-size:10px;color:red;margin-left:75px;'></p></b>
				</center>
				<br>
				<input type='submit' id='submit_new_pass' name='submit_new_pass' value='Confim Change Password' disabled/>
			</form>";

			if(isset($_POST['submit_new_pass'])){

				$old_Pass=$_POST['old_Pass'];
				$new_Pass=$_POST['new_Pass'];
				$new_Pass2=$_POST['new_Pass2'];

				$encrypted_old_Pass=SHA1($old_Pass);
				$encrypted_new_Pass=SHA1($new_Pass);

				if(!empty($old_Pass) && !empty($new_Pass) && !empty($new_Pass2)){

					$old_pass_query=$con->prepare("SELECT *FROM user WHERE password='$encrypted_old_Pass'");
					$old_pass_query->setFetchMode(PDO:: FETCH_ASSOC);
					$old_pass_query->execute();

					$old_pass_query_row=$old_pass_query->rowCount();

					if($old_pass_query_row>0){

						$User_pin=$con->prepare("UPDATE user SET password='$encrypted_new_Pass', password2='$new_Pass' WHERE password='$encrypted_old_Pass'");

						if($User_pin->execute()){

							echo"<script>alert('Password has been changed successfully, Please check your email.');</script>";
							echo"<script>window.open('Myprofile.php','_self')</script>";

							$message = "Hello ".$name.",
									You recently changed your password. Your new credential are the following:
									Username: ".$email."
									New Password: ".$new_Pass." ";
									
							mail($email,'Your Password',$message,'From: ali.bouzar@gmail.com');// TO:, Title, message, From:
							
							
						}else{
							
							$error['errors']="Failed in creatin a new password, Please try again!";

							echo'<span style="width:390px;height:25px;position:absolute;color:red;margin-top:-270px;font-size:11px;padding-left:59px;">° ';if(isset($error['errors'])) echo $error['errors'];echo'</span>';
						}
					}else{
						
						$error['errors']="Old Password is INCORRECT, Please try again";

						echo'<span style="width:390px;height:25px;position:absolute;color:red;margin-top:-270px;font-size:11px;padding-left:59px;">° ';if(isset($error['errors'])) echo $error['errors'];echo'</span>';
					}

				}else{

					$error['errors']="Please Enter all the information in each box";

					echo'<span style="width:390px;height:25px;position:absolute;color:red;margin-top:-270px;font-size:11px;padding-left:59px;">° ';if(isset($error['errors'])) echo $error['errors'];echo'</span>';
				}
			}	
		}
	}

	function ContactForm(){
		include("inc/db.php");

		if(isset($_POST['submitContact'])){

			$contact_name=$_POST['contact_name'];
			$contact_tel=$_POST['contact_tel'];
			$contact_email=$_POST['contact_email'];
			$contact_message=$_POST['contact_message'];

			//$d=mktime(11, 14, 54, 8, 12, 2014);
			$time=date("Y-m-d h:i:sa");

			$contact_query=$con->prepare("INSERT INTO tbl_contact(contact_name,contact_tel,contact_email,contact_message,received_date) VALUES('$contact_name', '$contact_tel', '$contact_email', '$contact_message', '$time')");

			if($contact_query->execute()){

				$message = "From Mr/Mrs ".$contact_name."
							Tel number: ".$contact_tel."
							Email address: ".$contact_email." 
							".$contact_message."";
				

				//mail($email,'Message',$message,'From: '.$contact_email.'');// TO:, Title, message, From:
				mail($contact_email,'Message',$message,'From: miaoubich@gmail.com');// TO:, Title, message, From:

				setcookie('contact_name', $contact_name, time()+5);

				echo"<script>window.open('ContactForm.php','_self')</script>";


			}else{

				echo"<script>alert('Sorry we are facing some difficulties sending your message please check your email address.')</script>";
			}
		}
	}

?>
