<h1>This is other page</h1>

<?php
include("functions.php"); //show warning only if the file not exist
require("number.php"); //It throw error and doesn't execute following code if the file doent exist
require_once("firstpage.php") //since it is alread there on functions.php, require_once will resist from dublicating
?>

<h3>
    My mark is <?php echo find_percentage(30,300); ?>
</h3>

<hr/>