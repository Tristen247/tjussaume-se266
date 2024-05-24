<?php
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../models/db.php';
include __DIR__ . '/../models/game_review.php';
include __DIR__ . '/../models/user.php';
session_start();
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Debugging: Print session data to verify that it's an array
/*
echo '<pre>';
print_r($_SESSION['user']);
echo '</pre>';
*/ 

$user_id = $_SESSION['user']['user_id'];

// Fetch reviews
$reviews = GetReviewsByUserId($user_id);

/*
// Debugging: Print reviews data
echo '<pre>';
print_r($reviews);
echo '</pre>';
*/
?>

<body>
<div class="container mt-5">
    <h1 class="page-title">My Reviews</h1>
    <?php if (!empty($reviews) && is_array($reviews)): ?>
        <?php foreach ($reviews as $review): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($review['game_title']); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Rating: <?php echo htmlspecialchars($review['rating']); ?>/5</h6>
                    <p class="card-text"><?php echo htmlspecialchars($review['review_text']); ?></p>
                    <p class="card-text"><small class="text-muted">Posted on <?php echo htmlspecialchars($review['date_posted']); ?></small></p>
                    <a href="edit_review.php?review_id=<?php echo $review['review_id']; ?>" class="btn btn-warning">edit</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="alert alert-warning">You have not posted any reviews.</p>
    <?php endif; ?>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include __DIR__ . '/../templates/footer.php'; ?>
