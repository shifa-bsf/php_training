<?php
// 
$id = 123;
function find_percentage($value, $total){
   $result = ($value / $total) *100;
   return $result;
}

echo find_percentage(50,200).'%';

function updateID(){
    global $id;
    $id = 3;
    return $id;
}
updateID();
echo $id;
var_dump($id)
?>