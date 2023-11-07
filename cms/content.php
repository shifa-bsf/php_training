<?php
require_once("includes/connection.php");
require_once("includes/functions.php");

find_selected_page();
include("includes/header.php");
?>
<table id="structure">
	<tr>
		<td id="navigation">
			<?php echo navigation($sel_subj, $sel_page); ?>
			<br />
			<a href="new_subject.php">+ Add a new subject</a>
		</td>
		<td id="page">
			<?php if (!is_null($sel_subj)) { // subject selected ?>
				<h2>
					<?php echo $sel_subj['menu_name']; ?>
				</h2>
			<?php } elseif (!is_null($sel_page)) { // page selected ?>
				<h2>
					<?php echo $sel_page['menu_name']; ?>
				</h2>
				<div class="page-content">
					<?php echo $sel_page['content']; ?>
				</div>
			<?php } else { // nothing selected ?>
				<h2>Select a subject or page to edit</h2>
			<?php } ?>
		</td>
	</tr>
</table>
<?php require("includes/footer.php"); ?>