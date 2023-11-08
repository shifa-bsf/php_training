<?php require_once("includes/functions.php"); ?>
<?php
		
		// Unset all the session variables
		$_SESSION = array();
		
		// Destroy the session cookie
		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-42000, '/');
		}
		
		// Destroy the session
		session_destroy();
		
		redirect("login.php?logout=1");
?>