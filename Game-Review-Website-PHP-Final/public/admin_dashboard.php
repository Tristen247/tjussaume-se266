<?php
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../models/db.php';

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] == 0) {
    header('Location: login.php');
    exit();
}
?>

<div class="container mt-5">
    <h1 class="page-title">Admin Dashboard</h1>
    <div class="mb-4">
        <a href="manage_users.php" class="btn btn-primary">Manage Users</a>
        <a href="manage_reviews.php" class="btn btn-secondary">Manage Reviews</a>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
