<?php

#Validates the name inputs, checks for blanks and exeeding the max length.
function validateName($name, $maxLength) {
    if (empty($name)) {
        return 'ERROR: Patients first and last name are required.';
    } elseif (strlen($name) > $maxLength) {
        return "ERROR: This field must not exceed {$maxLength} characters.";
    }
    return '';
}

// this function validates a height input uses a Regular expression to validate the ft/in format
function validateHeight($height) {
    if (preg_match('/^([0-9]+)\'\s*([0-9]+)"$/', $height, $matches)) {
        $feet = (int)$matches[1];
        $inches = (int)$matches[2];

        return ''; // Valid format
    }else {
        return 'ERROR: Height must be in ft/in format e.g., 5\' 10".';
    }
}

#Checks if the date is valid and 
function validateDate($date, $format = 'Y-m-d') {
    $dateTime = DateTime::createFromFormat($format, $date);
    $currentDate = new DateTime();

    // Check if the date is valid and not a future date
    return $dateTime && $dateTime->format($format) === $date && $dateTime <= $currentDate;
}

function age ($bdate) {
    $date = new DateTime($bdate);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->y;
}

#calculation patient BMI
function calculateBMI($feet, $inches, $weight) {
    if ($feet == 0 || $inches == 0 || $weight == 0) {
        // Return some error or null because BMI cannot be calculated
        return null;
    } else{
        $totalInches = $feet * 12 + $inches; // Converting feet to inches and add the remaining inches 
        $heightInMeters = $totalInches * 0.0254; // Converting inches to meters
        $weightInKilos = $weight * 0.453592; // Converting pounds to kilograms
        $bmi = $weightInKilos / ($heightInMeters * $heightInMeters); // Calculate patients BMI
        return round($bmi, 1); // Return the BMI rounded to 1 decimal place
    }    
    
}

?>