
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>W2 patient Intake Form</title>
     <!--V5.3-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
        body{
            background-color: lightgrey;
        }

        .errors{
            color: red
        }
    </style>
</head>
<body>

    <h1>Patient Intake Form</h1>

    <form method="post" name="patientIntake" action="<?php echo $_SERVER["PHP_SELF"];?>">
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
                <input type="text" name="lName" value="<?php echo isset($_POST['lName']) ? htmlspecialchars($_POST['lName']) : ''; ?>">
            </div>
            <br>

            <div class="label">
            <p>Married?</p>
            <input type="radio" id="yes" name="married" value="yes" <?php echo (isset($_POST['married']) && $_POST['married'] === 'yes') ? 'checked' : ''; ?>>
            <label for="yes">Yes</label><br>
            <input type="radio" id="no" name="married" value="no" <?php echo (isset($_POST['married']) && $_POST['married'] === 'no') ? 'checked' : ''; ?>>
            <label for="no">No</label><br>
            </div>


            <br>
            <div>
                <label for="b-date">DOB:</label>
            </div>
            <div>
                <input type="date" id="b-date" name="b-date" value="<?php echo isset($_POST['b-date']) ? htmlspecialchars($_POST['b-date']) : ''; ?>">
            </div>

            <div>
                <label for="height">Height: </label>
            </div>
            <div>
                <input type="text" name="height" value="<?php echo isset($_POST['height']) ? htmlspecialchars($_POST['height']) : ''; ?>">
            </div>

            <div>
                <label for="weight">Weight: </label>
            </div>
            <div>
                <input type="text" name="weight" value="<?php echo isset($_POST['weight']) ? htmlspecialchars($_POST['weight']) : ''; ?>">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>        
            <hr>
        </div>
    </form>

   <!--Displaying error message from the errors Array-->
   <?php if (!empty($errors)): ?>
        <div class="errors">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php 
    //Confirmation display
    //check if sesion var is not null.
    if (isset($_SESSION['submittedData'])): ?>
    <div class="submitted-data">
        <h2> Patient Confirmation:</h2>
        <ul>
            <?php foreach ($_SESSION['submittedData'] as $key => $value): ?>
                <li><strong><?php echo htmlspecialchars($key); ?>:</strong> <?php echo htmlspecialchars($value); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
    // Clear the session data so it doesn't show again on page refresh
    unset($_SESSION['submittedData']);
    ?>
<?php endif; ?>

    
</body>
</html>