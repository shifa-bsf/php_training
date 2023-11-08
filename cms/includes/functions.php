<?php
// All basic functions added here
session_start();

function redirect($location = NULL, $message = '', $errors = '')
{
	if ($location != NULL) {
		header("Location: {$location}");
		if (!empty($message)) {
			// Set a session variable for the flash message
			$_SESSION['flash_message'] = $message;
			$_SESSION['flash_errors'] = $errors;
		}
		exit;
	}
}
//check if the database query failed or not
function confirm_query($result_set)
{
	if (!$result_set) {
		die("Database query failed: " . mysqli_connect_error());
	}
}

function get_all_subjects($public = true)
{
	global $connection;
	$query = "SELECT * 
				FROM subjects ";
	if ($public) {
		$query .= "WHERE visible = 1 ";
	}
	$query .= "ORDER BY position ASC";
	$subject_set = mysqli_query($connection, $query);
	confirm_query($subject_set);
	return $subject_set;
}

function get_pages_for_subject($subject_id, $public = true)
{
	global $connection;
	$query = "SELECT * 
				FROM pages 
				WHERE subject_id = {$subject_id} ";
	if ($public) {
		$query .= "AND visible = 1 ";
	}
	$page_set = mysqli_query($connection, $query);
	confirm_query($page_set);
	return $page_set;
}

function get_subject_by_id($sub_id)
{
	global $connection;
	$query = "SELECT * FROM subjects ";
	$query .= "WHERE id=" . $sub_id . " ";
	$query .= "LIMIT 1";
	$result_set = mysqli_query($connection, $query);
	confirm_query($result_set);
	// if no rows are returned, fetch_array will return false
	if ($subject = mysqli_fetch_array($result_set)) {
		return $subject;
	} else {
		return NULL;
	}
}

function get_page_by_id($page_id)
{
	global $connection;
	$query = "SELECT * FROM pages ";
	$query .= "WHERE id=" . $page_id . " ";
	$query .= "LIMIT 1";
	$result_set = mysqli_query($connection, $query);
	confirm_query($result_set);
	if ($page = mysqli_fetch_array($result_set)) {
		return $page;
	} else {
		return NULL;
	}
}
function get_default_page($subject_id)
{
	// Get all visible pages
	$page_set = get_pages_for_subject($subject_id, true);
	if ($first_page = mysqli_fetch_array($page_set)) {
		return $first_page;
	} else {
		return NULL;
	}
}
//get selected page 	 
function find_selected_page()
{
	global $sel_subj;
	global $sel_page;
	if (isset($_GET['subj'])) {
		$sel_subj = get_subject_by_id($_GET['subj']);
		$sel_page = get_default_page($sel_subj['id']);
	} elseif (isset($_GET['page'])) {
		$sel_subj = NULL;
		$sel_page = get_page_by_id($_GET['page']);
	} else {
		$sel_subj = NULL;
		$sel_page = NULL;
	}
}

function navigation($sel_subj, $sel_page, $public = false)
{
	$subject_set = get_all_subjects($public);

	$output = "<ul class=\"subjects\">";
	while ($subject = mysqli_fetch_array($subject_set)) {
		$output .= "<li";
		if (!is_null($sel_subj) && $subject["id"] == $sel_subj["id"]) {
			$output .= " class='selected'";
		}
		$output .= "><a href=\"edit_subject.php?subj=" . urlencode($subject["id"]) .
			"\">{$subject["menu_name"]}</a></li>";
		$page_set = get_pages_for_subject($subject["id"], $public);
		$output .= "<ul class=\"pages\">";
		while ($page = mysqli_fetch_array($page_set)) {
			$output .= "<li";
			if (!is_null($sel_page) && $page["id"] == $sel_page["id"]) {
				$output .= " class='selected'";
			}
			$output .= "><a href=\"content.php?page=" . urlencode($page["id"]) .
				"\">{$page["menu_name"]}</a></li>";
		}
		$output .= "</ul>";
	}
	$output .= "</ul>";
	return $output;
}

function display_errors($message, $message_class, $errors = array())
{

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

function public_navigation($sel_subj, $sel_page, $public = true)
{
	$output = "<ul class=\"subjects\">";
	$subject_set = get_all_subjects($public);
	while ($subject = mysqli_fetch_array($subject_set)) {
		$output .= "<li";
		if (!is_null($sel_subj) && $subject["id"] == $sel_subj['id']) {
			$output .= " class=\"selected\"";
		}
		$output .= "><a href=\"index.php?subj=" . urlencode($subject["id"]) .
			"\">{$subject["menu_name"]}</a></li>";
		// show pages only when clicked on subject
		if (!is_null($sel_subj) && $subject["id"] == $sel_subj['id']) {

			$page_set = get_pages_for_subject($subject["id"], $public);
			$output .= "<ul class=\"pages\">";
			while ($page = mysqli_fetch_array($page_set)) {
				$output .= "<li";
				if (!is_null($sel_page) && $page["id"] == $sel_page['id']) {
					$output .= " class=\"selected\"";
				}
				$output .= "><a href=\"index.php?page=" . urlencode($page["id"]) .
					"\">{$page["menu_name"]}</a></li>";
			}
			$output .= "</ul>";
		}

	}
	$output .= "</ul>";
	return $output;
}

function is_login(){
	return isset($_SESSION['user_id']);
}
function conform_login(){
	if(!is_login()){
		redirect('login.php');
	}
}
?>