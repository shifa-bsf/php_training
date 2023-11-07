<?php

// form functions
function check_required_fields($required_fields){
    $errors = array();
    foreach ($required_fields as $fieldname) {
        if (!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]) && $_POST[$fieldname] != 0)) {
            $errors[] = $fieldname;
        }
    }
    return $errors;
}
function check_field_length($fields_with_lengths){
    global $connection;
    $errors = array();
    foreach ($fields_with_lengths as $fieldname => $maxlength) {
        if (strlen(trim(mysqli_prepare($connection, $_POST[$fieldname]))) > $maxlength) {
            $errors[] = $fieldname;
        }
    }
    return $errors;
}

?>