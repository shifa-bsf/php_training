<html>
	<head>
		<title>Hello World!</title>
	</head>
	<body>
		<h1>this is second page</h1>
        <?php
        // get url parameter if exist
        echo $_GET["name"].'<br/>';

        // get encoded version 
        echo rawurlencode('a@3shif').'<br/>';

        // get form data

        // cookies
        if(isset($_POST['username'])){
            echo 'Hi ' . $_POST['username'].'<br/>';
            setcookie('username',$_POST['username'],time()+(60*60*24*7));
        }
        echo $_COOKIE['username'];
        ?>
	</body>
</html>