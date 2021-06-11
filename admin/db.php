<?php 	
	// important that not on root and that the databse has a password!
	$db = new mysqli("localhost", "nicole", "ReD*12345_NJ", "restaurant");	
	if($db->connect_errno) {		
		echo "Error not found! Try again Later!";		
	}	
?>