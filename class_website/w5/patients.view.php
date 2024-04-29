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
                <!--End Nav-->
                <div>
                    <br>
                    <h1 class="page-title">PHP Urgent Care </h1>
                    <br>
                    <h2 class="under-title">Patient Log:</h2>
                    <br>
                    <h4 class="under-title"><?php
                        $file = basename($_SERVER['PHP_SELF']);
                        $mod_date=date("F d Y h:i:s A", filemtime($file));
                        echo "Page last updated $mod_date ";
                    ?></h4>
                    <br>
                </div>
                <div>
                    <a href="add_patients.php">Add Patient</a>
                </div>
                
                <?php
                    include __DIR__ . 'model/model_patients.php';

                    $pa = getPatients();
                ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name </th>
                            <th>Last Name</th>
                            <th>Marital Status</th>
                            <th>DOB</th>

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
