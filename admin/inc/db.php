<?php
	$con = new PDO("mysql:host=localhost;dbname=project","root","");

	/*try{
		$con = new PDO("mysql:host=localhost;dbname=project","root","");
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$con->exec('SET NAMES ""utf8');
	}
	catch(Exception $e){
		echo $e->getMessage();
		exit;
	}*/
?>