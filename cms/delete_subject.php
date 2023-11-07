<?php
require_once("includes/connection.php");
require_once('includes/functions.php');
$id = intval($_GET["subj"]);

if($id==0){
	redirect("content.php");
}

if(get_subject_by_id($id)){

	$query = "DELETE from subjects WHERE id={$id} LIMIT 1";
	$result = mysqli_query($connection,$query);
	echo $result;
	if($result){
		redirect("content.php");
	}
	else{
		$message = "<p>Subject deletion failed.</p>";
		$message .= "<p>" . mysqli_connect_error() . "</p>";
		redirect("edit_subject.php?subj=$id",$message);
	}

}
else{
	redirect("content.php");
}

?>