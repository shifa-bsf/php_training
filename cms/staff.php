<?php require_once("includes/functions.php"); ?>
<?php conform_login(); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			&nbsp;
			<h3>Staff menu</h3>
		</td>
		<td id="page">
			<h2>Hi <?php echo $_SESSION["username"]?>!</h2>
			<p>Welcome to the staff area.</p>
			<ul>
				<li><a href="content.php">Manage Website Content</a></li>
				<li><a href="new_user.php">Add Staff User</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>
