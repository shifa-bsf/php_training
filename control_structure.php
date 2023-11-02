<?php

$data = array(
    "ID" => "SD13",
    "name" => "shifa",
    "Fee" => 1000,
);

foreach ($data as $key => $value) {
    echo $key . ': ';
    if (is_int($value)) {
        echo '$' . $value . ' only <br/>';
    } else {
        echo $value . '<br/>';
    }
}

?>
<h4>Switch</h4>
<?php
$a = 400;

switch ($a) {
    case $a > 1000:
        echo 'over priced';
        break;
    case $a < 500:
        echo "$a is Offer price";
        break;
    default:
        echo 'affordable';
}
?>
<h4>Continue</h4>
<?php
$students = array(
    [
        'name' => 'shifa',
        'class' => 10
    ],
    [
        'name' => 'abc',
        'class' => 9
    ],
    [
        'name' => 'sam',
        'class' => 11
    ],
    [
        'name' => 'riya',
        'class' => 10
    ]
);

for ($i = 0; $i < count($students); $i++) {
    if ($students[$i]["class"] != 10) {
        continue;
    }
    echo $students[$i]["name"] . '<br/>';
}
?>
<h4>Pointers</h4>
<?php
$values = array(2, 3, 5, 6, 7, 8, 9);
echo current($values) . '</br>';
next($values);
next($values);
echo current($values) . '</br>';
echo prev($values) . '</br>';

while (current($values)) {
    echo 'shifa';
    next($values);
    if (!current($values)) {
        break;
    }
    echo ' | ';
}
?>