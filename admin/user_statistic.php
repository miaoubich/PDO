<?php include("inc/function.php"); ?>
<div id="bodyright"> 
	
	<?php
		include("inc/db.php");
	
		$fetch_user=$con->prepare("SELECT *FROM user ORDER BY 1 DESC");
		$fetch_user->execute();
		
		$nbr_rows=$fetch_user->rowCount();
		$a=$nbr_rows/10; //display 4 records by page
		$a=ceil($a);
		
		echo"<ul style='list-style:none;padding:10px 0px 0px 10px;'>";
			for($b=1; $b<=$a;$b++){
				echo "<center><a href='indexAdmin.php?user_statistic=$b' style='text-decoration:none;color:#fff;'><li>$b</li></a></center>";
			}
		echo"</ul>";
	?>
	
	<h3>View All Users Form</h3>
	<div class="scroll">
	<form method="post" enctype="multipart/form-data" >
		<table>
		<tr>
			<th>Sr No.</th>
			<th>Status</th>
			<th>Name</th>
			<th>Email</th>
			<th>Password</th>
			<th>Username</th>
			<th>Birth-date</th>
			<th>Phone N°</th>
			<th>Image</th>
			<th>Address</th>
			<th>Country</th>
			<th>City</th>
			<th>Registration Date</th>
		</tr>
			<?php echo user_statistic();?>
		</table>
	</form>
	</div>
	
</div>
