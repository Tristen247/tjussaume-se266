<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <main class="content">
          
            <nav
            class="navbar navbar-expand-sm navbar-light bg-primary fixed-top">
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
                            Home <span class="visually-hidden">(current)</span></a>
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

    
        <h1 class="page-title">Patient Intake</h1>
        <form method="post" name="patientIntake">
            <div class="container">
                <div class="label">
                    <label for="fName">First Name: </label>
                </div>
                <div>
                    <input type="text" name="fName" placeholder="ex. John" value="<?php echo isset($_POST['fName']) ? htmlspecialchars($_POST['fName']) : ''; ?>">
                </div>
                <div class="label">
                    <label for="lName">Last Name: </label>
                </div>
                <div>
                    <input type="text" name="lName" placeholder="ex. Doe" value="<?php echo isset($_POST['lName']) ? htmlspecialchars($_POST['lName']) : ''; ?>">
                </div>
                <br>

                <div class="label">
                <p>Married?</p>
                <input type="radio" id="yes" name="married" value="yes" <?php echo (isset($_POST['married']) && $_POST['married'] === 'yes') ? 'checked' : ''; ?>>
                <label for="yes">Yes</label><br>
                <input type="radio" id="no" name="married" value="no" <?php echo (isset($_POST['married']) && $_POST['married'] === 'no') ? 'checked' : ''; ?>>
                <label for="no">No</label><br>
                </div>
                <div>
                    <label for="b-date">DOB:</label>
                </div>
                <div>
                    <input type="date" id="b-date" name="b-date" value="<?php echo isset($_POST['b-date']) ? htmlspecialchars($_POST['b-date']) : ''; ?>">
                </div>

                <br>
                <button type="submit" class="btn btn-primary">Add Patient</button>        
                <hr>
            </div>
        </form>

        <?php
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
            $fName = $_POST['fName'];
            $lName = $_POST['lName'];
            $married = ($_POST['married'] == 'yes') ? 1 : 0;
            $bDate = $_POST['b-date'];
            
            // Call the function to add the patient
            $result = addPatient($fName, $lName, $married, $bDate);
            
            // Set the result message
            $resultMessage = $result ? "Patient added successfully!" : "Failed to add patient.";
            }
            
        }
        ?>

        <!-- If there's a message, display that the patient was added ********************-->
        <?php if ($resultMessage != ''): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($resultMessage); ?>
            </div>
        <?php endif; ?>

        <!-- Displaying error message from the errors Array *******************************-->
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        </main>
        <footer class="footer">
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
</html>