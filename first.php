<?php
$name = 'shifa';
$age = 25;
?>
<html>
	<head>
		<title>Hello World!</title>
	</head>
	<body>
		<h1>Examples</h1>
		<?php
			// concatenation
            echo "<h5>Hello World!<br /></h5>";
            echo 'ID:' . 2 + 3 . '<br />';
            echo $name . '</br>';
            echo $age;
            print "<h2>Thank you</h2>";

            // update varible value
            $age = 50;
            echo $age;
            $age = 10;
		?><br />
	</body>
</html>