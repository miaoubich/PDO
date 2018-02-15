<?php 
	include("inc/function.php"); 
	include("inc/db.php");
?>
<div id="bodyright"> 
	
		<form method="POST">
			<input type="submit" name="clearContact" style="width:130px;height:30px;border-radius:5px;position:absolute;margin:15px 20px !important;" value="Clear All Messages" />
		</form>
		<?php
			if(isset($_POST['clearContact'])){
				$TRUNCATE=$con->prepare("TRUNCATE TABLE tbl_contact");

				if($TRUNCATE->execute()){
					echo "<script>windows.open('indexAdmin.php?user_contactMessages','_self')</script>";
					echo "<script>alert('Message deleted Successfully !')</script>";
				}
			}
		?>
		<div id="searchContactDiv">
			<form method="POST" id="formSearchContact;>
				<label for="name">Enter email:</label>
				<input type="text" name="searchContact" id="searchContact" style="">
				<input type="submit" name="submitContact" id="submitContact" value="Search" />
			</form>
		</div>
	
	<br/>
	<hr/>
	<?php
		$fetch_tbl=$con->prepare("SELECT *FROM tbl_contact ORDER BY 1 DESC");
		$fetch_tbl->execute();
		
		$nbr_rows=$fetch_tbl->rowCount();
		$a=$nbr_rows/5; //display 5 records by page
		$a=ceil($a);
		
		echo"<ul style='list-style:none;padding:10px 0px 0px 10px;'>";
			for($b=1; $b<=$a;$b++){
				echo "<center><a href='indexAdmin.php?user_contactMessages=$b' style='text-decoration:none;color:#fff;'><li>$b</li></a></center>";
			}
		echo"</ul>";
	?>
	
	<h3>View All Messages from Contact Users</h3>
	<div class="scroll">
		<form method="get" action="contactMessageSearch.php" enctype="multipart/form-data" >
			<table>
			<tr>
				<th>Sr No.</th>
				<th>Contact Name</th>
				<th>Contact Telephone Number</th>
				<th>Contact Email</th>
				<th>Contact Message</th>
				<th>Received Date</th>
				<th>Delete</th>
			</tr>
				<?php 
					if(!isset($_POST['submitContact'])){
						echo Message_Contact();
					}else{
						echo searchContact();
					}
				?>
			</table>
		</form>
	</div>
	
</div>
