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

            // Both $name and {$name} works inside double qoutes
            echo "<br/> my name is $name, Iam {$age} years older <br/>";

            // String functions
            $title = 'Welcome home.';
            $subTitle = ' Have a seat!!!';
            $message = $title;
            $message .= $subTitle;
            echo strtoupper($message).'<br/>';
            // uppercase first letter of a sentance
            echo ucfirst($message).'<br/>';
            // Capitalise each words
            echo ucwords($message).'<br/>';
            echo strlen($message).'<br/>';

            echo $newmessage = $title . trim($subTitle,'! ').'<br/>';
            echo strstr($message,"home").'<br/>';
            echo str_replace('seat','tea',$message).'<br/>';
		?><br />
	</body>
</html>