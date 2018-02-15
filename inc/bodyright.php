<div id="bodyright">
	<h3>GREATE DEALS</h3>

	<hr>
	<center><h4>BRANDS</h4></center>
	<hr>

	<div id="Budget_Select" style="border:1px solid #e6e6e6; border-radius:5px;"">
		<ul>
		<?php 
			echo display_brand(); 
		?>
		</ul>
	</div>

	<div class="Budget_Select">
		<form method="post" action="filter.php" encrypt="multipart/form-data">
			
			<hr>
			<center><h4>Filter Result</h4></center>
			
			<p style="padding-top:5px;">Price Filter (in €)</p>
			<center>
				From: <input type="text" name="PriceMin" id="PriceMin" placeholder="">
				To: <input type="text" name="PriceMax" id="PriceMax" placeholder="">
			</center>
			<div style="border-top:1px solid #e6e6e6;margin-top:10px; color:#e6e6e6;">
				<p style="margin:10px 0px 5px 0px;">Please Select a Type:</p>
				<input type="checkbox" name="gender[]" value="kids"><p>Kids</p>
				<input type="checkbox" name="gender[]" value="women"><p>Women</p>
				<input type="checkbox" name="gender[]" value="men"><p>Men</p>
			</div>
			<div id="Submit-Div" style="border-top:1px solid #a6a6a6; border-bottom:1px solid #a6a6a6;">
				<center><input type="submit" id="submit" name="submit1" value="Show"></center>
			</div>
		</form>

		<div class="Budget_Select">
			<div class="container" style="width:250px;"><br/>
				<HR>
			    <h4 align="center">Price filter (in €)</h4><br/> 
			     <div align="center">  
			        <input type="range" min="0" max="1000" step="10" value="25" id="min_price" name="min_price"/>  
			        <span id="price_range"></span>  
			    </div><br /> 
			                  
			</div>
		</div> 
	</div>

	<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
	    <script src="js/js/bootstrap.min.js"></script>
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/jquery.js"></script>
		<script src="js/popupHide.js"></script>	

	<!-- Filter by price -->
	<script>
		$('#min_price').change(function(){  
	        var price = $(this).val();  
	        $("#price_range").text("Product under Price: " + price);  
	        $.ajax({  
	            url:"filter_slider.php",  
	            method:"POST",  
	            data:{fixed_price:price},  
	            success:function(data){  
	                $("#bodyleft").fadeIn().html(data);  
	            }  
	        });  
	     });
	</script>
</div><!--end of bodyright-->