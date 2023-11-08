<?php
require_once("includes/connection.php");
require_once("includes/functions.php");
require_once("includes/form_functions.php");
?>
<?php
// make sure the subject id sent is an integer
if (intval($_GET['subj']) == 0) {
	redirect('content.php');
}


if (isset($_POST['submit'])) {
	$errors = array();

	// form validations
	$required_fields = array('menu_name', 'position', 'visible', 'content');
	$errors = array_merge($errors, check_required_fields($required_fields));

	$fields_with_lengths = array('menu_name' => 30);
	$errors = array_merge($errors, check_field_length($fields_with_lengths));

	// clean up the form data before putting it in the database
	$id = intval($_GET['subj']);


	// Database submission only proceeds if there were NO errors.
	if (empty($errors)) {
		$menu_name = mysqli_real_escape_string($connection, $_POST['menu_name']);
		$position = intval($_POST['position']);
		$visible = intval($_POST['visible']);
		$content = mysqli_real_escape_string($connection, $_POST['content']);
		$query = "INSERT INTO pages (
						menu_name, position, visible, content, subject_id
					) VALUES (
						'{$menu_name}', {$position}, {$visible}, '{$content}', {$id}
					)";
		$result = mysqli_query($connection, $query);
		if ($result) {
			// get the last id inserted on current db insertion
			$new_page_id = mysqli_insert_id($connection);
			redirect("content.php?page={$new_page_id}");
		} else {
			$message_class = "fail";
			$message = "The page could not be created.";
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
	// END FORM PROCESSING
}
?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<?php echo navigation($sel_subj, $sel_page, $public = false); ?>
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
				<h2>Adding New Page</h2>
				<a href="edit_subject.php?subj=<?php echo $sel_subj['id']; ?>">Cancel</a><br />
			</div>
			<form action="new_page.php?subj=<?php echo $sel_subj['id']; ?>" method="post">
				<?php $new_page = true; ?>
				<?php include "page_form.php" ?>
				<input type="submit" name="submit" value="Create Page" class="blue_btn" />
			</form>
			<br />
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>