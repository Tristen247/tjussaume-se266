<?php

include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../models/user.php';



if (isset($_POST['login'])) {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    // Fetch the user data from the database
    $user = login($username, $password);

    if (!empty($user)) {
        // Store the entire user array in the session
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit();
    } else {
        $login_error = "Invalid username or password.";
        session_unset();  // Clearing session on a failed login attempt
    }
}

$username = $username ?? ''; // Ensuring that the variable is set for the form
$password = ''; // Clear password after it's been used
?>

<!-- Display any login error -->
<?= !empty($login_error) ? $login_error : '' ?>

<body class="login-body">
    <div class="wrapper">
        <main class="content">

           
            
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
                        <input type="submit" class="btn btn-dark" name="login" value="Sign in">
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
