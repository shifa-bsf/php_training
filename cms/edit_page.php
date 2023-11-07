<?php
require_once("includes/connection.php");
require_once("includes/functions.php");
require_once("includes/form_functions.php");
?>
<?php
// make sure the subject id sent is an integer
if (intval($_GET['page']) == 0) {
	redirect('content.php');
}
if (isset($_SESSION['flash_message'])) {
	$message = $_SESSION['flash_message'];
	$message_class = 'fail';
	$errors = $_SESSION['flash_errors'];
	unset($_SESSION['flash_message']);
}
include_once("includes/form_functions.php");


if (isset($_POST['submit'])) {
	$errors = array();

	// form validations
	$required_fields = array('menu_name', 'position', 'visible', 'content');
	$errors = array_merge($errors, check_required_fields($required_fields));

	$fields_with_lengths = array('menu_name' => 30);
	$errors = array_merge($errors, check_field_length($fields_with_lengths));

	$id = intval($_GET['page']);
	$menu_name = mysqli_real_escape_string($connection, $_POST['menu_name']);
	$position = intval($_POST['position']);
	$visible = intval($_POST['visible']);
	$content = mysqli_real_escape_string($connection, $_POST['content']);

	// Database submission only proceeds if there were NO errors.
	if (empty($errors)) {
		$query = "UPDATE pages SET 
							menu_name = '{$menu_name}',
							position = {$position}, 
							visible = {$visible},
							content = '{$content}'
						WHERE id = {$id}";
		$result = mysqli_query($connection, $query);
		if (mysqli_affected_rows($connection) == 1) {
			$message = 'Updated successfully';
			$message_class = 'success';
		} else {
			$message_class = 'fail';
			$message = 'Updation failed!';
			$message .= "<br/> " . mysqli_error($connection);
		}

	} else {
		// Errors occurred
		$message_class = 'warning';
		$message = "There were " . count($errors) . " errors in the form";

	}
	// END FORM PROCESSING
}
?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<?php echo navigation($sel_subj, $sel_page); ?>
			<br />
			<a href="new_subject.php">+ Add a new subject</a>
		</td>
		<td id="page">
			<?php
			if (!empty($message)) {
				display_errors($message, $message_class, $errors);
			}
			?>
			<div class="flex-between">
				<h2>Edit page:
					<?php echo $sel_page['menu_name']; ?>
				</h2>
				<a href="content.php?page=<?php echo $sel_page['id']; ?>">Cancel</a><br />
			</div>

			<form action="edit_page.php?page=<?php echo $sel_page['id']; ?>" method="post">
				<?php include "page_form.php" ?>
				<div class="flex-btns">
					<input type="submit" name="submit" value="Update Page" class="blue_btn" />
					<a href="delete_page.php?page=<?php echo $sel_page['id']; ?>" class="red_btn"
						onclick="return confirm('Are you sure you want to delete this page?');">Delete page</a>

				</div>
			</form>
			<br />
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>