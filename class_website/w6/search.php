<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                                    Home <span class="visually-hidden">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active text-white" href="./add_patients.php" aria-current="page">
                                    Patient Check-in <span class="visually-hidden">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active text-white" href="./logoff.php" aria-current="page">
                                    Log-Out <span class="visually-hidden">(current)</span></a>
                            </li>
                        </ul>
                        <a href="your_facebook_link" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="your_twitter_link" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="your_instagram_link" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="your_github_profile_link" class="social-icon"><i class="fab fa-github"></i></a>
                    </div>
                </nav>
                <!--End Nav-->
                <div>
                    <h1 class="page-title">PHP Urgent Care</h1>
                </div>
                

                <?php
                    include __DIR__ . '/models/model_patients.php';
                    // Initialize variables
                    $fName = '';
                    $lName = '';
                    $married = '';

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $fName = $_POST['fName'] ?? '';
                        $lName = $_POST['lName'] ?? '';
                        $married = $_POST['married'] ?? '';
                    
                        
                        $results = searchPatients($fName, $lName, $married);
                    }
                    
                    $pa = searchPatients($fName,$lName,$married);
                ?>
                <div class="container">
                    <h2>Patient Search:</h2>
                    <form method="POST" name='search_patients'>
                        <div>
                            <div>
                                <label>First Name:</label>
                            </div>
                            <div>
                                <input type="text" name="fName" value="<?=$fName; ?>">
                            </div>
                            <div>
                                <label>Last Name:</label>
                            </div>
                            <div>
                            <input type="text" name="lName" value="<?=$lName; ?>">
                            </div>
                            <div>
                            <label>Marital Status:</label>
                            </div>
                            <div>
                                <select name="married">
                                    <option value="">Any</option>
                                    <option value="1">Married</option>
                                    <option value="0">Single</option>
                                </select>
                            </div>
                            <br>
                            <div>
                                <input type="submit" class="btn btn-primary" name="search" value="Search">
                            </div>
                            <br>
                            
                        </div>
                    </form>
                </div>
                <a href="patients.view.php">View All Patients</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name </th>
                            <th>Last Name</th>
                            <th>Marital Status</th>
                            <th>DOB</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pa as $p): ?>
                            <tr>
                                <td>
                                    <?= $p['id']; ?>
                                </td>
                                <td>
                                    <?= $p['patientFirstName']; ?>
                                </td>
                                <td>
                                    <?= $p['patientLastName']; ?> 
                                </td>
                                <td>
                                    <?php 
                                        if($p['patientMarried'] == 1) {
                                            echo"Married";
                                        }else{
                                            echo"Single";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?= $p['patientBirthDate']; ?> 
                                </td>
                                <td>
                                    <a href="edit_patient.php?action=Update&patientId=<?= $p['id']; ?>">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        
                    </tbody>
                </table>
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
