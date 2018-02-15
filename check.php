<?php
	include("inc/db.php");
	
	if(isset($_POST["user_email"])){
		
		 $useremail = $_POST["user_email"];
		 $userEmail=$con->prepare("SELECT * FROM user WHERE email = '".$useremail."'");
		 $userEmail->setFetchMode(PDO:: FETCH_ASSOC);
		 $userEmail->execute();

		 $row=$userEmail->rowCount();
		 echo $row;
	}
?>