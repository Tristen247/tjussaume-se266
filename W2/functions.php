<?php

#Validates the name inputs,checks for blanks and exeeding the max length.
function validateName($name, $maxLength) {
    if (empty($name)) {
        return 'ERROR: Patients first and last name are required.';
    } elseif (strlen($name) > $maxLength) {
        return "ERROR: This field must not exceed {$maxLength} characters.";
    }
    return '';
}

#Valdating DOB entry.
function validateDate($date, $format = 'Y-m-d') {
    $dateTime = DateTime::createFromFormat($format, $date);
    $currentDate = new DateTime();

    // Check if the date is valid and not a future date
    return $dateTime && $dateTime->format($format) === $date && $dateTime <= $currentDate;
}

// This function validates a height input uses a Regular expression to validate the ft/in format
function validateHeight($height) {
    if (preg_match('/^([0-9]+)\'\s*([0-9]+)"$/', $height, $matches)) {
        $feet = (int)$matches[1];
        $inches = (int)$matches[2];

        return ''; // if Valid format return empty string.
    }else {
        return 'ERROR: Height must be in ft/in format e.g., 5\' 10".';
    }
}

// This function validates weight and returns an error message based on the particular error
function validateWeight($weight) {
    if (empty($weight)) {
        return "ERROR: Weight is required.";
    } elseif (!is_numeric($weight)) {
        return "ERROR: Weight must be a number.";
    } elseif ($weight <= 0) {
        return "ERROR: Weight must be a positive number.";
    }
    return ''; // No error
}

#calculating age based on DOB entered.
# took this function from Prof. DRose's functions on Canvas.
function age ($bdate) {
    $date = new DateTime($bdate);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->y;
}

#calculation patient BMI.
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

function bmiClassification($BMI) {
    if ($BMI <= 18.5){
        return "Underweight";
    } elseif ($BMI > 18.5 && $BMI <= 24.9){
        return "Normal Weight";
    } elseif ($BMI > 24.9 && $BMI <= 29.9) {
        return "Overweight";
    } else {
        return "Obese";
    }
}

?>