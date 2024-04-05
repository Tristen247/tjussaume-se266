<?php
// start a session and include the functions page
session_start();
require 'functions.php';

//initiate errors array
$errors = [];
//initiate weight, age, and bmi variables
$weight = null;
$age = null;
$bmi = null;

//if the page has been submitted them check/validate
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fields = [
        'fName' => ['maxLength' => 50],
        'lName' => ['maxLength' => 75],
    ];

    foreach ($fields as $fieldName => $fieldAttributes) {
        $fieldValue = $_POST[$fieldName] ?? '';
        $error = validateName($fieldValue, $fieldAttributes['maxLength']);
        if ($error) {
            $errors[$fieldName] = $error;
        }
    }

    //confirm that one of the radio buttons are checked
    /*
    if (isset($_POST['married'])) {
        $married = $_POST['married'];
    } else {
        $errors['married'] = "ERROR: The user did not select a marital status."; //add to 'errors' array
    }*/

    $marriedStatus = validateRadioButton('married');
    if ($marriedStatus === null) {
        $errors['married'] = "ERROR: The user did not select a marital status.";
    } else {
        // If married status is set, you can do additional processing with it
    }


    //validate birthday
   
    if (!validateDate($_POST['b-date'])) {
        $errors['b-date'] = "ERROR: Invalid entry. Date must NOT be a future date."; //add to 'errors' array
    }

    //Provide user feedback based on input and validate they're height.
    if (empty($_POST['height'])) {
        $errors['height'] = "Height is required.";
    } else {
        $heightError = validateHeight($_POST['height']);
        if ($heightError) {
            $errors['height'] = $heightError;
        } else {
            // If height is valid, extract feet and inches, store them in a list and parse according to the FT/IN format ex. 5' 11"
            list($feet, $inches) = sscanf($_POST['height'], "%d'%d\"");
        }
    }

    //Validate Height
    $weightError = validateWeight($_POST['weight'] ?? null);
    if ($weightError) {
        $errors['weight'] = $weightError;
    }  else {
        $weight = $_POST['weight']; // If no errors, assign the weight for BMI calculation
    }

    //calculate the patients age:
    $age = age($_POST['b-date']);

    //Calculate patient BMI
   
    list($feet, $inches) = sscanf($_POST['height'], "%d'%d\""); // Assume $height is in the format "5' 10" 
    //$bmi = calculateBMI($feet, $inches, $weight);
    if (isset($feet) && isset($inches) && $weight) { // Make sure these variables are set
        $bmi = calculateBMI($feet, $inches, $weight);
    }

    //Specify patient's bmi classification
    $bmiDesc = bmiClassification($bmi);

   

//************************************************************************************************************
// Logic for returning information to the user.

    if (empty($errors)) {
       
        // If there are no errors, store the submitted data to display back to the user :D
        $_SESSION['submittedData'] = [
            'First Name' => $_POST['fName'],
            'Last Name' => $_POST['lName'],
            'Married' => $marriedStatus,
            'Date of Birth' => $_POST['b-date'],
            'Height' => $_POST['height'],
            'Weight' => $_POST['weight'],
            'Age' => $age,
            'BMI' => $bmi,
            'BMI Classification' => $bmiDesc
            
        ];

        // Redirect to the same page to clear POST data ONLY.
        // to improve this method I should send the user to a new page 
        header('Location: ' . $_SERVER["PHP_SELF"]);
        exit;
    }
}

require 'index.view.php';
?>
