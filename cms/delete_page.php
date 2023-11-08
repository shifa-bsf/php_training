<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if (intval($_GET['page']) == 0) {
	redirect('content.php');
}

$id = intval($_GET['page']);
if ($page = get_page_by_id($id)) {
	$query = "DELETE FROM pages WHERE id = {$page['id']} LIMIT 1";
	$result = mysqli_query($connection, $query);
	echo $result;
	if ($result) {
		// Successfully deleted
		redirect("edit_subject.php?subj={$page['subject_id']}");
	} else {
		// Deletion failed
		$message = "<p>Page deletion failed.</p>";
		$message .= "<p>" . mysqli_connect_error() . "</p>";
		redirect("edit_page.php?page=$id",$message);
	}
} else {
	redirect('content.php');
}
?>
<?php
mysqli_close($connection);
?>