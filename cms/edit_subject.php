<?php
require_once("includes/connection.php");
require_once("includes/functions.php"); ?>
<?php
if (intval($_GET['subj']) == 0) {
	redirect("content.php");
}
if (isset($_SESSION['flash_message'])) {
	$message = $_SESSION['flash_message'];
	$message_class = 'fail';
	unset($_SESSION['flash_message']);
}
if (isset($_POST['submit'])) {
	$errors = array();
	global $connection;
	$required_fields = array('menu_name', 'position', 'visible');
	foreach ($required_fields as $fieldname) {
		if (!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]) && $_POST[$fieldname] != 0)) {
			$errors[] = $fieldname;
		}
	}
	$fields_with_lengths = array('menu_name' => 30);
	foreach ($fields_with_lengths as $fieldname => $maxlength) {
		if (strlen(trim(mysqli_prepare($connection, $_POST[$fieldname]))) > $maxlength) {
			$errors[] = $fieldname;
		}
	}

	if (empty($errors)) {
		// Perform Update
		$id = intval($_GET['subj']);
		$menu_name = mysqli_real_escape_string($connection, $_POST['menu_name']);
		$position = intval($_POST['position']);
		$visible = intval($_POST['visible']);

		$query = "UPDATE subjects SET 
				menu_name = '{$menu_name}', 
				position = {$position}, 
				visible = {$visible} 
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

}
?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<?php echo navigation($sel_subj, $sel_page); ?>
		</td>
		<td id="page">
			<?php
			if (!empty($message)) {
				$message_field = "<div class='message_box message_{$message_class}'>$message";
				// output list of fields that had errors
				if (!empty($errors)) {
					$message_field .= "<p class='errors'>";
					$message_field .= "Please review the following fields:<br />";
					foreach ($errors as $error) {
						$message_field .= " - " . $error . "<br />";
					}
					$message_field .= "</p>";
				}
				$message_field .= "</div>";
				echo $message_field;
			}

			?>
			<h2>Edit Subject:
				<?php echo $sel_subj['menu_name']; ?>
			</h2>
			<form action="edit_subject.php?subj=<?php echo urlencode($sel_subj['id']); ?>" method="post">
				<p>Subject name:
					<input type="text" name="menu_name" value="<?php echo $sel_subj['menu_name'] ?>" id="menu_name" />
				</p>
				<p>Position:
					<select name="position">
						<?php
						$subject_set = get_all_subjects();
						$subject_count = mysqli_num_rows($subject_set);
						for ($count = 1; $count <= $subject_count + 1; $count++) {
							echo "<option value=\"{$count}\"";
							if ($sel_subj['position'] == $count) {
								echo " selected";
							}
							echo ">{$count}</option>";
						}
						?>
					</select>
				</p>
				<p>Visible:
					<input type="radio" name="visible" value="0" <?php if ($sel_subj['visible'] == 0) {
						echo 'checked';
					}
					?> /> No
					&nbsp;
					<input type="radio" name="visible" value="1" <?php if ($sel_subj['visible'] == 1) {
						echo 'checked';
					}
					?> /> Yes
				</p>

				<input type="submit" name="submit" value="Update Subject" class="blue_btn" /><br />
				<a href="delete_subject.php?subj=<?php echo urlencode($sel_subj['id']); ?>"
				class="red_btn"	
				onclick="return confirm('Are you sure?');">
					Delete Subject
				</a>

			</form>
			<br />
			<a href="content.php">Cancel</a>
		</td>
	</tr>
</table>
<?php require("includes/footer.php"); ?>