<?php  
	session_start();
	if(isset($_SESSION["sess_committeeid"])) {  
		echo '0';     //session not expired       
	}  
	else {  
		echo '1';     //session expired  
	}
?>