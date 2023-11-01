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

		<?php
        $a = 2;
        $b = '3 me';
        $c = $b + 4;
        echo $c .'<br />';
        echo gettype($c) .'<br/>';
        settype($c, "string");
        echo gettype($c) .'<br/>';
        $abc = (int) $c;
        echo gettype($abc) .'<br/>';
        echo is_int($abc) .'<br/>';

        define("WIDTH",900);
        echo WIDTH;

        switch($a){
            case 0:
                echo "a = zero";
                break;
            case 1:
                echo "a = one";
                break;
            case 2:
                echo "a = two";
                break;
            default:
                 echo "a is unknown";
                 break;
            
        }
        ?>
	</body>
</html>