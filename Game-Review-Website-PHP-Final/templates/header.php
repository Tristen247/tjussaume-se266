<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap V5.3-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!--My CSS-->
    <link href="../style.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <main class="content">
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
                <a class="navbar-brand" href="index.php">
                    <img src="../images/Video-Game-Controller-Icon.svg.png" width="40" height="40" alt="">
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
                            <a class="nav-link active text-white" href="./index.php" aria-current="page">
                                Home <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="./search.php" aria-current="page">
                                Search Games <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['user'])): ?>
                            <li class="nav-item">
                                <a class="nav-link active text-white" href="./dashboard.php" aria-current="page">
                                    Profile <span class="visually-hidden">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active text-white" href="./logoff.php" aria-current="page">
                                    Log Out <span class="visually-hidden">(current)</span>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link active text-white" href="./login.php" aria-current="page">
                                    Log In <span class="visually-hidden">(current)</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="./admin_dashboard.php" aria-current="page">
                                Admin <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                    </ul>
                    <a href="your_facebook_link" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="your_twitter_link" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="your_instagram_link" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="your_github_profile_link" class="social-icon"><i class="fab fa-github"></i></a>
                </div>
            </nav>
