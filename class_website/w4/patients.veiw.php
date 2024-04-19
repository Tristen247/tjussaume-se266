<?php include __DIR__ . 'model.php'; ?>

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
                    <a class="nav-link active text-white" href="../site/index.php" aria-current="page">
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
    
    <h1 class="page-title">Patient Intake Form</h1>

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
                <input type="text" name="height" placeholder="5&apos; 11&quot;" value="<?php echo isset($_POST['height']) ? htmlspecialchars($_POST['height']) : ''; ?>">
            </div>

            <div>
                <label for="weight">Weight: (lbs)</label>
            </div>
            <div>
                <input type="text" name="weight" placeholder="175" value="<?php echo isset($_POST['weight']) ? htmlspecialchars($_POST['weight']) : ''; ?>">
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


<footer class="footer">
    <p>&copy; 2024 TJ Web Solutions. All rights reserved.</p>
    <p>Connect with us:</p>
    <a href="your_facebook_link" class="social-icon"><i class="fab fa-facebook-f"></i></a>
    <a href="your_twitter_link" class="social-icon"><i class="fab fa-twitter"></i></a>
    <a href="your_instagram_link" class="social-icon"><i class="fab fa-instagram"></i></a>
    <a href="your_github_profile_link" class="social-icon"><i class="fab fa-github"></i></a>
</footer>

    
</body>
</html>