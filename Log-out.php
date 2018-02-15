<?php
	session_start();
	session_destroy();
	setcookie('user',"",time()-1);
	setcookie('email',"",time()-1);
	setcookie('img',"",time()-1);
	$_SESSION['message'] = "You are now logged out";
	header("location: index.php");
?>