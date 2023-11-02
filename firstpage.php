<html>
	<head>
		<title>Hello World!</title>
	</head>
	<body>
        <a href="secondpage.php?id=23&name=<?php echo urlencode("T&Co products")?>">go to second page</a>
		
<br/>
<br/>
        <?php
        $content = "This is <b>bold</b> and &amp; special characters: ' & \"";
        echo $content . '<br/>';
        echo htmlspecialchars($content);
        ?>

        <h3>
            <?php echo htmlspecialchars($content); ?>
        </h3>

        <form method="post" action="secondpage.php">
            <input type="text" name="username" placeholder="user name"/>
            <input type="submit" value="Save" />
        </form>
	</body>
</html>