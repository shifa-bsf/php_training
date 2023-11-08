<?php
require_once("includes/connection.php");
require_once("includes/functions.php");
require_once("includes/form_functions.php");
?>
<?php
$id = intval($_GET['subj']);
if ($id == 0) {
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
	$errors = array_merge($errors, check_required_fields($required_fields));
	$fields_with_lengths = array('menu_name' => 30);
	$errors = array_merge($errors, check_field_length($fields_with_lengths));

	if (empty($errors)) {
		// Perform Update
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
				display_errors($message, $message_class, $errors);
			}
			?>
			<div class="flex-between">
				<h2>Edit Subject:
					<?php echo $sel_subj['menu_name']; ?>
				</h2>
				<a href="content.php">Cancel</a>
			</div>
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
				<div class="flex-btns">
					<input type="submit" name="submit" value="Update Subject" class="blue_btn" />
					<a href="delete_subject.php?subj=<?php echo urlencode($sel_subj['id']); ?>" class="red_btn"
						onclick="return confirm('Are you sure?');">
						Delete Subject
					</a>
				</div>
			</form>
			<br />
			<hr />
			<div class="pages_list">
				<h2>Pages</h2>

				<?php
				$page_set = get_pages_for_subject($id);
				// Fetch all rows from $page_set and store them in an array
				$pages = array();
				while ($page = mysqli_fetch_array($page_set)) {
					$pages[] = $page;
				}

				if (!empty($pages)) {
					// Display the list of pages
					?>
					<ul>
						<?php
						foreach ($pages as $page) {
							echo "<li><a href=\"content.php?page=" . urlencode($page["id"]) . "\">{$page["menu_name"]}</a></li>";
						}
						?>
					</ul>
					<?php
				} else {
					echo "No pages under this subject <br/><br/>";
				}
				?>
				
				<a href="new_page.php?subj=<?php echo $id; ?>">+ Add new page</a>
			</div>
		</td>
	</tr>
</table>
<?php require("includes/footer.php"); ?>