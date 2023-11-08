<?php
require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php 
if(is_login()){
	redirect("staff.php");
}
?>

<?php
	include_once("includes/form_functions.php");
	$errors = array();
	if (isset($_POST['submit'])) { 
		// validations on the form data
		$required_fields = array('username', 'password');
		$errors = array_merge($errors, check_required_fields($required_fields));

		$fields_with_lengths = array('username' => 30, 'password' => 30);
		$errors = array_merge($errors, check_field_length($fields_with_lengths));

		$username = $_POST['username'];
		$password = $_POST['password'];
		$hashed_password = sha1($password);
		
		if ( empty($errors) ) {
			$query = "SELECT id, username ";
			$query .= "FROM users ";
			$query .= "WHERE username = '{$username}' ";
			$query .= "AND hashed_password = '{$hashed_password}' ";
			$query .= "LIMIT 1";
			$result_set = mysqli_query($connection, $query);
			confirm_query($result_set);
			if (mysqli_num_rows($result_set) == 1) {
				$found_user = mysqli_fetch_array($result_set);
				$_SESSION["user_id"] = $found_user["id"];
				$_SESSION["username"] = $found_user["username"];
				redirect("staff.php");
			} else {
				$message = "incorrect username or password.<br />
					Please try again.";
				$message_class = "fail";
			}
		} else {
			$message_class="warning";
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
		
		
	} else { 
		if(isset($_GET["logout"]) && $_GET["logout"]==1){
			$message = "Your are successfully logged out!";
			$message_class = "success";
		}
		$username = "";
		$password = "";
	}
?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<a href="index.php">Return to public site</a>
		</td>
		<td id="page">
			<h2>Staff Login</h2>
			<?php 
			if (!empty($message)) {
				display_errors($message, $message_class, $errors);
			}
			?>
			<br/>
			<form action="login.php" method="post">
			<label>Username:</label><br />
				<input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
				<br /><br />
				<label>Password:</label><br />
				<input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
				<br /><br />
			<input type="submit" name="submit" value="Login" /></td>
				
			</form>
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>