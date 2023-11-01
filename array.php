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

    $data = array(1, 2, 'cat', 4, 5, array(100, 200, 300));
    $students = array(
        [
            'id' => 23,
            'name' => 'shifa'
        ],
        [
            'id' => 12,
            'name' => 'fathima'
        ],
    );

    echo $data[2] . '<br />';
    echo $data[5][2] . '<br />';

    echo 'student ' . $students[0]['name'] . '<br />';
    print_r($students);
    ?>

    <br />

    <?php
    //Array functions
    $numbers = array(2, 7, 8, 4, 5, 6, 10);
    echo count($numbers) . '<br />';
    echo max($numbers) . '<br />';
    echo min($numbers) . '<br />';
    sort($numbers);
    print_r($numbers);
    ?>
    <br />
    <?php
    // reverse sort
    rsort($numbers);
    print_r($numbers);
    ?>
    <br />
    <?php
    // array to string
    $books = array('novel', 'poem', 'story');
    echo implode('|', $books) . '<br />';
    // string to array
    $message = "hi,hello,how,hey";
    print_r(explode(',', $message));

    echo '<br/>' . in_array('story', $books).'<br/>'; //return true/false

    echo 'isset'.isset($books).'<br/>';//return true/false
    unset($books);
    isset($books); //prints nothing
    echo 'empty'.empty($books);
    ?>
</body>

</html>