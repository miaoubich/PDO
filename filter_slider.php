<?php
	include("inc/db.php");

		if(isset($_POST["fixed_price"])){

		    $query=$con->prepare("SELECT *FROM products WHERE pro_price <= ".$_POST['fixed_price']." ORDER BY pro_price desc");  
		    $query->setFetchMode(PDO:: FETCH_ASSOC);
		    $query->execute();

		    echo"<ul style='list-style:none; margin-bottom:1.5%;'>";
		    while($row_product=$query->fetch()){
				echo"<li style='border-radius:3px; margin-bottom:5px; margin-top:10px; margin-left:1%; float:left; width:31%; min-height:350px; border:3px solid #e6e6e6;'>
						<form method='post' enctype='multipart/form-data'>
							<a href='pro_detail.php?id=".$row_product['id']."' style='text-decoration:none; color: #2e2e2e; display:block;'>
								<h4 style='overflow:hidden; white-space:nowrap; text-overflow:ellipsis; margin-top:5px; text-align:center; font-size:12px;'>".$row_product['pro_name']."</h4>
								<img src='imgs/pro_img/".$row_product['pro_img2']."' style='width:90%; height:240px; margin:10px 10px 30px 10px;' />
									
								<center>
									<a href='pro_detail.php?id=".$row_product['id']."'><button id='pro_btn' style='font-size:12px; cursor:pointer; float:left; margin-left:7px !important; width:30%; height:30px; background:#fff; border-radius:3px; border:1px solid #b3003b; color:#000;'>View</button></a>
									<input type='hidden' value='".$row_product['id']."' name='pro_id'/>
									<button id='pro_btn' name='cart_btn' style='color:#000; font-size:12px; cursor:pointer; float:left; margin-left:7px !important; width:30%; height:30px; background:#fff; border-radius:3px; border:1px solid #b3003b;'>Add To Cart</button>
									<a href='#'><button id='pro_btn' style='font-size:12px; cursor:pointer; float:left; margin-left:7px !important; width:30%; height:30px; color:#000; background:#fff; border-radius:3px; border:1px solid #b3003b;'>Wishlist</button></a>
								</center>
							</a>
						</form>
					</li>";
			}
			echo"</ul>";
		}
?>