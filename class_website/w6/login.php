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
          body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f2ef;
        }
        .login-form {
            width: 100%;
            max-width: 360px;
            background-color: #fff;
            margin-top: 160px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .login-form h2 {
            margin-bottom: 20px;
        }
        .login-form input[type="submit"] {
            width: 100%;
        }

        #sign-in {
            font-size: 2.5rem;
        }

        #greeting {
            font-size: 2rem;
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
            <div class="login-form">
                <h2 id="sign-in" class="text-center">Sign in</h2>
                <p id="greeting" class="text-center">PHP helping you help others.</p>
                <?= !empty($login_error) ? '<p class="text-danger">' . $login_error . '</p>' : '' ?>

                <form name="login_form" method="post">
                    <div class="form-group mb-3">
                        <label for="username">Email or Phone</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= htmlspecialchars($username); ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-primary" name="login" value="Sign in">
                    </div>
                    <div class="text-center">
                        <a href="password_recovery.php">Forgot password?</a>
                    </div>
                </form>
            </div>
            
        </main>
        
    </div>
    
   
</body> 
</html>

