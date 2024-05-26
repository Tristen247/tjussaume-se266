<?php
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../models/db.php';
include __DIR__ . '/../models/game_review.php';  // Including the file where your functions are defined

// Get the game_id from the query parameter
$game_id = isset($_GET['game_id']) ? (int)$_GET['game_id'] : 0;

if ($game_id > 0) {
    // Fetch the reviews for the specified game
    $reviews = GetReviewsByGameId($game_id);

    if (!empty($reviews)) {
        $game_title = htmlspecialchars($reviews[0]['game_title']);
    } else {
        $game_title = "Unknown Game";
    }
} else {
    $game_title = "Invalid Game ID";
}
?>

<body>
    
<div class="container mt-5">
    <h1 class="page-title">Reviews for <?php echo $game_title; ?></h1>
    <?php if (!empty($reviews)): ?>
        <?php foreach ($reviews as $review): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Review by <?php echo htmlspecialchars($review['username']); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Rating: <?php echo htmlspecialchars($review['rating']); ?>/5</h6>
                    <p class="card-text"><?php echo htmlspecialchars($review['review_text']); ?></p>
                    <p class="card-text"><small class="text-muted">Posted on <?php echo htmlspecialchars($review['date_posted']); ?></small></p>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="alert alert-warning">No reviews found for this game.</p>
    <?php endif; ?>
</div>
<div>
    <form class="container" action="index.php" method="get">
            <button type="submit" class="btn btn-primary">back</button>
            
    </form>
</div>
<?php include __DIR__ . '/../templates/footer.php';?>



