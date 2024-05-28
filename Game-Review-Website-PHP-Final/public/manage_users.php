<?php
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../models/db.php';
include __DIR__ . '/../models/user.php'; // Assuming user functions are in user.php

// Fetch all users
$users = GetAllUsers();
echo "<!-- Number of users retrieved: " . count($users) . " -->"; // Debugging output

// Handle form submission for updating a user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateUser'])) {
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING); // Optional
    $is_admin = filter_input(INPUT_POST, 'is_admin', FILTER_VALIDATE_INT);

    if ($user_id && $username && $email) {
        $result = UpdateUser($user_id, $username, $email, $password, $is_admin);
        if ($result) {
            echo "<script>alert('User updated successfully!'); window.location.href='manage_users.php';</script>";
        } else {
            echo "<script>alert('Failed to update user.');</script>";
        }
    }
}

// Handle form submission for deleting a user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteUser'])) {
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
    if ($user_id) {
        $result = DeleteUser($user_id);
        if ($result) {
            echo "<script>alert('User deleted successfully!'); window.location.href='manage_users.php';</script>";
        } else {
            echo "<script>alert('Failed to delete user.');</script>";
        }
    }
}
?>

<div class="container">
    <h1 class="page-title">Manage Users</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <form method="post">
                        <td><?= htmlspecialchars($user['user_id']); ?></td>
                        <td><input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" class="form-control" required></td>
                        <td><input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" class="form-control" required></td>
                        <td>
                            <select name="is_admin" class="form-control">
                                <option value="1" <?= $user['is_admin'] == 1 ? 'selected' : ''; ?>>Admin</option>
                                <option value="0" <?= $user['is_admin'] == 0 ? 'selected' : ''; ?>>User</option>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']); ?>">
                            <button type="submit" name="updateUser" class="btn btn-primary">Update</button>
                            <button type="submit" name="deleteUser" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
include __DIR__ . '/../templates/footer.php';
?>
