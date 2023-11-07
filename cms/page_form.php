<?php if (!isset($new_page)) {$new_page = false;}
?>

<p>Page name: <input type="text" name="menu_name" value="<?php if($sel_page){echo $sel_page['menu_name'];} ?>" id="menu_name" /></p>

<p>Position: <select name="position">
	<?php
		if (!$new_page) {
			$page_set = get_pages_for_subject($sel_page['subject_id']);
			$page_count = mysqli_num_rows($page_set);
		} else {
			$page_set = get_pages_for_subject($sel_subj['id']);
			$page_count = mysqli_num_rows($page_set) + 1;
		}
		for ($count=1; $count <= $page_count; $count++) {
			echo "<option value='{$count}'";
			if ($sel_page && $sel_page['position'] == $count) { echo " selected"; }
			echo ">{$count}</option>";
		}
	?>
</select></p>
<p>Visible: 
	<input type="radio" name="visible" value="0"<?php 
	if ($sel_page && $sel_page['visible'] == 0) { echo " checked"; } 
	?> /> No
	&nbsp;
	<input type="radio" name="visible" value="1"<?php 
	if ($sel_page && $sel_page['visible'] == 1) { echo " checked"; } 
	?> /> Yes
</p>
<p>Content:<br />
	<textarea name="content" rows="20" cols="80"><?php  if($sel_page){ echo $sel_page['content']; }  ?></textarea>
</p>