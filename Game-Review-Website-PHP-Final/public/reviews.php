<?php
include __DIR__ . '/db.php';
include __DIR__ . '/game.php';  // Including the file where your functions are defined

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reviews for <?php echo $game_title; ?></title>
</head>
<body>
    <h1>Reviews for <?php echo $game_title; ?></h1>
    <?php if (!empty($reviews)): ?>
        <?php foreach ($reviews as $review): ?>
            <div class='review'>
                <p><strong>User:</strong> <?php echo htmlspecialchars($review['username']); ?></p>
                <p><strong>Rating:</strong> <?php echo htmlspecialchars($review['rating']); ?>/5</p>
                <p><strong>Review:</strong> <?php echo htmlspecialchars($review['review_text']); ?></p>
                <p><strong>Date Posted:</strong> <?php echo htmlspecialchars($review['date_posted']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No reviews found for this game.</p>
    <?php endif; ?>
</body>
</html>
