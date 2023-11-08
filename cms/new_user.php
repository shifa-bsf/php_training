<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
include_once("includes/form_functions.php");

// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.
	$errors = array();

	// perform validations on the form data
	$required_fields = array('username', 'password');
	$errors = array_merge($errors, check_required_fields($required_fields));

	$fields_with_lengths = array('username' => 30, 'password' => 30);
	$errors = array_merge($errors, check_field_length($fields_with_lengths));

	$username = $_POST['username'];
	$password = $_POST['password'];
	$hashed_password = sha1($password);

	if (empty($errors)) {
		$query = "INSERT INTO users (
							username, hashed_password
						) VALUES (
							'{$username}', '{$hashed_password}'
						)";
		$result = mysqli_query($connection, $query);
		if ($result) {
			$message = "The user was successfully created.";
			$message_class = "success";
		} else {
			$message_class = "fail";
			$message = "The user could not be created.";
			$message .= "<br />" . mysqli_connect_error();
		}
	} else {
		$message_class = "warning";
		if (count($errors) == 1) {
			$message = "There was 1 error in the form.";
		} else {
			$message = "There were " . count($errors) . " errors in the form.";
		}
	}
} else { // Form has not been submitted.
	$username = "";
	$password = "";
}
?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<a href="staff.php">Return to Menu</a><br />
			<br />
		</td>
		<td id="page">
			<h2>Create New User</h2>
			<?php
			if (!empty($message)) {
				display_errors($message, $message_class, $errors);
			}
			?>
			<br />
			<form action="new_user.php" method="post">
				<label>Username:</label><br />
				<input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
				<br /><br />
				<label>Password:</label><br />
				<input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
				<br /><br />
				<input type="submit" name="submit" value="Create user" class="blue_btn" />
			</form>
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>