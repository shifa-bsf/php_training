<?php
require_once("includes/connection.php");
require_once("includes/functions.php");
?>
<?php
find_selected_page();
if (isset($_SESSION['flash_message'])) {
	$message = $_SESSION['flash_message'];
	$message_class = 'warning';
	$errors = $_SESSION['flash_errors'];
	unset($_SESSION['flash_message']);
}
?>

<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<?php echo navigation($sel_subj, $sel_page); ?>
		</td>
		<td id="page">
			<?php
			if (!empty($message)) {
				display_errors($message, $message_class, $errors);
			}

			?>
			<div class="flex-between">
				<h2>Add Subject</h2>
				<a href="content.php">Cancel</a>

			</div>
			<form action="create_subject.php" method="post">
				<p>Subject name:
					<input type="text" name="menu_name" value="" id="menu_name" />
				</p>
				<p>Position:
					<select name="position">
						<?php
						$subject_set = get_all_subjects();
						$subject_count = mysqli_num_rows($subject_set);
						for ($count = 1; $count <= $subject_count + 1; $count++) {
							echo "<option value=\"{$count}\">{$count}</option>";
						}
						?>
					</select>
				</p>
				<p>Visible:
					<input type="radio" name="visible" value="0" /> No
					&nbsp;
					<input type="radio" name="visible" value="1" /> Yes
				</p>
				<input type="submit" value="Add Subject" name="submit" class="blue_btn" />
			</form>
			<br />
		</td>
	</tr>
</table>
<?php require("includes/footer.php"); ?>