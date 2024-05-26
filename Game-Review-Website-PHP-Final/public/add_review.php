<?php
include __DIR__ . '/../templates/header.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

include __DIR__ . '/../models/game.php';
include __DIR__ . '/../models/game_review.php';

$games = GetGames();
$user_id = $_SESSION['user']['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $game_id = filter_input(INPUT_POST, 'game_id', FILTER_VALIDATE_INT);
    $review_text = filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_STRING);
    $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);

    if ($game_id && $review_text && $rating) {
        $result = AddGameReview($game_id, $user_id, $review_text, $rating);
        if ($result) {
            echo "<script>alert('Review added successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Failed to add review.');</script>";
        }
    }
}
?>

<div class="container">
    <h1 class="page-title">Add Review</h1>
    <form method="post">
        <div class="form-group">
            <label for="game_id">Game:</label>
            <select class="form-control" id="game_id" name="game_id" required>
                <?php foreach ($games as $game): ?>
                    <option value="<?= htmlspecialchars($game['game_id']); ?>"><?= htmlspecialchars($game['game_title']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="review_text">Review:</label>
            <textarea class="form-control" id="review_text" name="review_text" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="rating">Rating:</label>
            <select class="form-control" id="rating" name="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
