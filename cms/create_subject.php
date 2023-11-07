<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
$errors = array();

// Form Validation
$required_fields = array('menu_name', 'position', 'visible');
foreach ($required_fields as $fieldname) {
	if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
		$errors[] = $fieldname;
	}
}

$fields_with_lengths = array('menu_name' => 30);
foreach ($fields_with_lengths as $fieldname => $maxlength) {
	if (strlen(trim(mysqli_prepare($connection, $_POST[$fieldname]))) > $maxlength) {
		$errors[] = $fieldname;
	}
}

if (!empty($errors)) {
	// redirect("new_subject.php");
	header("Location: new_subject.php");
	die();
}
?>
<?php
$menu_name = $_POST['menu_name'];
$position = $_POST['position'];
$visible = $_POST['visible'];
?>
<?php
$query = "INSERT INTO subjects (
				menu_name, position, visible
			) VALUES (
				'{$menu_name}', {$position}, {$visible}
			)";
$result = mysqli_query($connection, $query);
if ($result) {
	// Success
	header("Location: content.php");
	die();
} else {
	// Display error message.
	echo "<p>Subject creation failed.</p>";
	echo "<p>" . mysqli_error($connection) . "</p>";
}
?>

<?php mysqli_close($connection); ?>