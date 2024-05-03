<?php
include __DIR__ . '/models/model_patients.php';

session_start(); 

if (isset($_POST['login'])) {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    $user = login($username, $password);

    if (!empty($user)) {
        $_SESSION['user'] = $username; // Storing the username in session
        header('Location: patients.view.php');
        exit();
    } else {
        $login_error = "Invalid username or password.";
        session_unset();  // Clearing session on a failed login attempot
    }
}

$username = $username ?? ''; // Ensuring that the variable is set for the form
$password = ''; // Clear password after its been used
?>

<!-- Display any login error -->
<?= !empty($login_error) ? $login_error : '' ?>

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

        <style>
            form {
                display: flex;
                position:absolute;

            }
        </style>
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
                                PHP Urgent Care <span class="visually-hidden">(current)</span></a>  
                    </ul>
                    <a href="your_facebook_link" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="your_twitter_link" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="your_instagram_link" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="your_github_profile_link" class="social-icon"><i class="fab fa-github"></i></a>
                </div>
            </nav>
                <!--End Nav-->
            <h2 class="page-title">Login</h2>
            <form name="login_form" method="post">
                    <div class="container">
                        <div class="label">
                            <label>Username:</label>
                        </div>
                        <div>
                            <input type="text" name="username" value="<?= htmlspecialchars($username); ?>" />
                        </div>
                        <div class="label">
                            <label>Password:</label>
                        </div>
                        <div>
                            <input type="password" name="password" />
                        </div>
                        <div>&nbsp;</div>
                        <div>
                            <input type="submit" class="btn btn-primary" name="login" value="Login" />
                        </div>
                    </div>
            </form>
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

