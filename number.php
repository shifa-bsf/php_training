<?php
$num = 10;
$float = 3.043;
 ?>
<html>
	<head>
		<title>Hello World!</title>
	</head>
	<body>
		<h1>Examples</h1>

		+= <?php $num += 4; echo $num; ?><br />
		-= <?php $num -= 4; echo $num; ?><br />
		*= <?php $num *= 3; echo $num; ?><br />
		/= <?php $num /= 5; echo $num; ?><br />
		<br />
		<!-- increment -->
		<?php $num++; echo $num; ?><br />
        <!-- Decrement -->
		<?php $num--; echo $num; ?><br />

        <h2>Floating numbers</h2>
        <?php
        echo round($float).'<br />';
        echo ceil($float).'<br />'; //closest integer that is greater than the number
        echo rand(1,20); //closest integer that is less than the number
        ?>
	</body>
</html>