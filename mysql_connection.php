<?php
$connection = mysqli_connect("localhost", "root", "");

if (!$connection) {
    die("connection failed - " . mysqli_connect_error());
} else {
    echo ("Database Connected! ");
}

$db = mysqli_select_db($connection, "php_training");
if (!$db) {
    die("Database selection failed" . mysqli_connect_error());
} else {
    echo ("Database selected! ");
}

?>
<html>

<head>
    <title>Hello World!</title>
</head>

<body>
    <h1>Mysql connection</h1>
    <?php
    $data = mysqli_query($connection, "select * from subjects");
    print_r($data);
    ?>
    <br />
    <ul>
        <?php
        while ($row = mysqli_fetch_array($data)) {
            echo "<li>id = {$row['id']} </li>";
            echo "<li>teacher = {$row['teacher']}</li>";
        }
        ?>
    </ul>
    <form method="POST" >
        <input type="text" name="teacher" placeholder="Teacher name" />
        <input type="number" name="mark" placeholder="Mark" />
        <input type="submit" name="submit" value="Save" />
    </form>
</body>

</html>

<?php

if (isset($_POST["submit"])) {
    $teacher = $_POST["teacher"];
    $mark = $_POST["mark"];
    mysqli_prepare(
        $connection,
        "INSERT INTO subjects(teacher,mark) VALUES($teacher,$mark)"
    );
}
mysqli_close($connection);
?>