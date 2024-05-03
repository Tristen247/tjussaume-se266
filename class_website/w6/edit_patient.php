<?php
require 'functions.php';
require 'models/model_patients.php';

$errors = [];

$resultMessage = '';


// Initializing variables
$id = 0; 
$action = '';

if (isset($_GET['action']) && isset($_GET['patientId'])) { 
    $action = filter_input(INPUT_GET, 'action');
    $id = filter_input(INPUT_GET, 'patientId', FILTER_VALIDATE_INT);  

    if ($action == "Update" && $id) {
        $pa = GetPatient($id);
        if ($pa) {
            $fName = $pa['patientFirstName'] ?? '';
            $lName = $pa['patientLastName'] ?? '';
            $married = $pa['patientMarried'] ?? 0;
            $bDate = $pa['patientBirthDate'] ?? '';
        } else {
            $resultMessage = "No patient found with that ID.";
        }
    }
}

// Married Status
$marriedYesChecked = ($married == 1) ? 'checked' : '';
$marriedNoChecked = ($married == 0) ? 'checked' : '';

// Ensuring the date is recived as type 'Date'
$bDateValue = ($bDate) ? date('Y-m-d', strtotime($bDate)) : '';

//Code behind for deletng a patient record
if (isset($_POST['deletePatient'])) {
    $id = filter_input(INPUT_POST, 'patientId', FILTER_VALIDATE_INT);
    if ($id) {
        deletePatient($id);
        // Confirmation
        echo "<script>alert('Patient ID:$id successfully deleted.'); 
        window.location.href='patients.view.php';</script>";
    } 
}

// Debugging
/*
var_dump($id);
var_dump($pa);
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>w2 patient Intake Form - class site</title>
     <!-- Bootstrap V5.3-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Font awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!--My CSS-->
     <link href="style.css" rel="stylesheet">
   
</head>
<body>
    <div class="wrapper">
        <main class="content">
          
            <nav class="navbar navbar-expand-sm navbar-light bg-primary fixed-top">
                <a class="navbar-brand" href="../site/index.php">
                <img src="../images/hosp-logo.png" width="40" height="40" alt="">
                </a>
                <button
                    class="navbar-toggler d-lg-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                ></button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="./patients.view.php" aria-current="page">
                                View Patients <span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="https://github.com/Tristen247/tjussaume-se266/blob/f3c459fb263921fa19041689d84d9ef63435306e/class_website/w2/index.php" aria-current="page">
                                GitHub<span class="visually-hidden">(current)</span></a>
                        </li>
                    </ul>
                    <a href="your_facebook_link" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="your_twitter_link" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="your_instagram_link" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="your_github_profile_link" class="social-icon"><i class="fab fa-github"></i></a>
                </div>
            </nav>
            
        <h1 class="page-title">Update Patient Record</h1>
       
        <br>
        <form method="post" name="updateForm">
            <div class="container">
                <div>
                    <label for="id">ID:</label>
                </div>
                <div>
                    <input type="text" name="id" value="<?php echo htmlspecialchars($id); ?> " disabled>
                </div>
                <div class="label">
                    <label for="fName">First Name: </label>
                </div>
                <div>
                    <input type="text" name="fName" placeholder="ex. John" value="<?php echo htmlspecialchars($fName); ?>">
                </div>
                <div class="label">
                    <label for="lName">Last Name: </label>
                </div>
                <div>
                    <input type="text" name="lName" placeholder="ex. Doe" value="<?php echo htmlspecialchars($lName); ?>">
                </div>
                <div class="label">
                    <p>Married?</p>
                    <input type="radio" id="yes" name="married" value="1" <?= $marriedYesChecked; ?>>
                    <label for="yes">Yes</label><br>
                    <input type="radio" id="no" name="married" value="0" <?= $marriedNoChecked; ?>>
                    <label for="no">No</label>
                </div>
                <br>
                <div>
                    <label for="b-date">DOB:</label>
                    <input type="date" id="b-date" name="b-date" value="<?= $bDateValue; ?>">
                </div>

                <br>
                <!--Update-->  
                <button type="submit" class="btn btn-primary">Update Patient</button> 
                <!--Delete-->       
                <input type="hidden" name="patientId" value="<?= htmlspecialchars($id) ?>">
                <button type="submit" name="deletePatient" class="btn btn-danger">Delete</button>
                <hr>
            </div>
        </form>

        <?php
        //if the page has been submitted then validate
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

            $marriedStatus = null;
            if (isset($_POST['married'])) {
                $marriedStatus = $_POST['married'] == 'yes' ? 1 : 0;
            } else {
                $errors['married'] = "ERROR: The user did not select a marital status.";
            }

            //validate birthday
            if (!validateDate($_POST['b-date'])) {
                $errors['b-date'] = "ERROR: Invalid entry. Date must NOT be a future date."; //add to 'errors' array
            }
            
            //*******************************************************************************************************
            if (empty($errors)) {
                $id = $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
                $fName = $_POST['fName'];
                $lName = $_POST['lName'];
                $married = ($_POST['married'] == 'yes') ? 1 : 0;
                $bDate = $_POST['b-date'];
                
                // Call the function to add the patient
                $result = updatePatient($id, $fName, $lName, $married, $bDate);
                
                // Set the result message
                if ($result) {
                    echo "<script>
                            alert('Patient ID: $id updated successfully!');
                            window.location.href='patients.view.php';
                        </script>";
                } else {
                    echo "<script>
                            alert('Failed to update Patient ID: $id.');
                            window.location.href='patients.view.php'; // Optionally redirect to the same page to retry or stay on the form page
                        </script>";
                }
                
            }
        }
        ?>
        
        </main>
            <footer class="footer">
            <form class="container" action="patients.view.php" method="get">
            <button type="submit" class="btn btn-warning">Return</button>
           
            
        </form>
        <br>
            <p>&copy; 2024 TJ Web Solutions. All rights reserved.</p>
                <p><?php $file = basename($_SERVER['PHP_SELF']);
                        $mod_date=date("F d Y h:i:s A", filemtime($file));
                        echo "Page last updated $mod_date ";
                        ?></p>
                <p>Connect with us:</p>
                <a href="your_facebook_link" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="your_twitter_link" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="your_instagram_link" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="your_github_profile_link" class="social-icon"><i class="fab fa-github"></i></a>
            </footer>
      </div>
    
    </body>
