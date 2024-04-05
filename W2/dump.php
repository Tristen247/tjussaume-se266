<?php

 /*if (!empty($_POST['height'])) {
        $heightError = validateHeight($_POST['height']);
        if ($heightError) {
            $errors['height'] = $heightError;
        }
    } else {
        $errors['height'] = "ERROR: Height is required.";
    }*/

    /*
    $weight = $_POST['weight'];
    if (!is_numeric($weight) || $weight < 50 || $weight > 300) {
        $errors['weight'] = "ERROR: Weight is not valid or out of range.";
    }*/


    // Validate and process weight 
    #$weight = $_POST['weight'] ?? null;
    #if (empty($weight) || !is_numeric($weight) || $weight <= 0) {
       # $errors['weight'] = "ERROR: Weight is required and must be a positive number."; //add to errors array
    #} 