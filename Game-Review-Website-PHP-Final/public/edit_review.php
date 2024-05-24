<?php
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../models/db.php';
include __DIR__ . '/../models/game_review.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$errors = [];
$resultMessage = '';

// Initializing variables
$review_id = 0;
$action = '';
$game_title = '';
$review_text = '';
$rating = '';

if (isset($_GET['review_id'])) {
    $review_id = filter_input(INPUT_GET, 'review_id', FILTER_VALIDATE_INT);

    // Debugging: Print the review_id
    echo '<pre>Review ID: ' . $review_id . '</pre>';

    if ($review_id) {
        $review = GetReview($review_id);

        // Debugging: Print the review data
        echo '<pre>';
        print_r($review);
        echo '</pre>';

        if ($review) {
            $game_title = $review['game_title'] ?? '';
            $review_text = $review['review_text'] ?? '';
            $rating = $review['rating'] ?? '';
        } else {
            $resultMessage = "No review found with that ID.";
        }
    }
}

// Handle form submission for deleting a review
if (isset($_POST['deleteReview'])) {
    $review_id = filter_input(INPUT_POST, 'review_id', FILTER_VALIDATE_INT);
    if ($review_id) {
        DeleteReview($review_id);
        // Confirmation
        echo "<script>alert('Review ID: $review_id successfully deleted.'); 
        window.location.href='dashboard.php';</script>";
    }
}

// Handle form submission for updating a review
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateReview'])) {
    $review_id = filter_input(INPUT_POST, 'review_id', FILTER_VALIDATE_INT);
    $review_text = trim($_POST['review_text'] ?? '');
    $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);

    // Validations
    if (empty($review_text)) {
        $errors['review_text'] = "Review text cannot be empty.";
    }
    if ($rating === false || $rating < 1 || $rating > 5) {
        $errors['rating'] = "Rating must be a number between 1 and 5.";
    }

    if (empty($errors)) {
        $result = UpdateReview($review_id, $review_text, $rating);

        if ($result) {
            echo "<script>
                    alert('Review ID: $review_id updated successfully!');
                    window.location.href='dashboard.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to update Review ID: $review_id.');
                  </script>";
        }
    }
}

function GetReview($review_id) {
    global $db;
    $stmt = $db->prepare('SELECT gr.*, g.game_title FROM game_reviews gr JOIN games g ON gr.game_id = g.game_id WHERE gr.review_id = :review_id');
    $stmt->bindParam(':review_id', $review_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function UpdateReview($review_id, $review_text, $rating) {
    global $db;
    $stmt = $db->prepare('UPDATE game_reviews SET review_text = :review_text, rating = :rating WHERE review_id = :review_id');
    $stmt->bindParam(':review_text', $review_text, PDO::PARAM_STR);
    $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
    $stmt->bindParam(':review_id', $review_id, PDO::PARAM_INT);
    return $stmt->execute();
}

function DeleteReview($review_id) {
    global $db;
    $stmt = $db->prepare('DELETE FROM game_reviews WHERE review_id = :review_id');
    $stmt->bindParam(':review_id', $review_id, PDO::PARAM_INT);
    return $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Review</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="page-title">Edit Review</h1>
    <br>
    <form method="post" name="editReviewForm">
        <div class="container">
            <div>
                <label for="review_id">Review ID:</label>
            </div>
            <div>
                <input type="text" name="review_id" value="<?php echo htmlspecialchars($review_id); ?>" disabled>
                <input type="hidden" name="review_id" value="<?php echo htmlspecialchars($review_id); ?>">
            </div>
            <div class="label">
                <label for="game_title">Game Title: </label>
            </div>
            <div>
                <input type="text" name="game_title" value="<?php echo htmlspecialchars($game_title); ?>" disabled>
            </div>
            <div class="label">
                <label for="review_text">Review Text: </label>
            </div>
            <div>
                <textarea name="review_text" class="form-control" rows="5"><?php echo htmlspecialchars($review_text); ?></textarea>
                <?php if (isset($errors['review_text'])): ?>
                    <div class="alert alert-danger"><?php echo $errors['review_text']; ?></div>
                <?php endif; ?>
            </div>
            <div class="label">
                <label for="rating">Rating: </label>
            </div>
            <div>
                <input type="number" name="rating" min="1" max="5" value="<?php echo htmlspecialchars($rating); ?>">
                <?php if (isset($errors['rating'])): ?>
                    <div class="alert alert-danger"><?php echo $errors['rating']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <!-- Update Review -->
            <button type="submit" name="updateReview" class="btn btn-primary">Update Review</button>
            <!-- Delete Review -->
            <button type="submit" name="deleteReview" class="btn btn-danger">Delete</button>
            <hr>
        </div>
    </form>

    <?php if ($resultMessage): ?>
        <div class="alert alert-info"><?php echo $resultMessage; ?></div>
    <?php endif; ?>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include __DIR__ . '/../templates/footer.php'; ?>
