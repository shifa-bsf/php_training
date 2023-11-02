<?php

session_start();
?>
<html>
	<head>
		<title>Hello World!</title>
	</head>
	<body>
    <?php
    $_SESSION['name'] = 'shifa';
    $name = $_SESSION['name'];
    echo $name;
    ?>    
	</body>
</html>