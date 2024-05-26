<?php 

include __DIR__ . '/db.php'; 

function GetReviewsByGameId($game_id) {
    global $db;

    $results = [];

    $stmt = $db->prepare(
        "SELECT 
            games.game_title, 
            game_reviews.review_text, 
            game_reviews.rating, 
            game_reviews.date_posted, 
            users.username
        FROM 
            game_reviews
        JOIN 
            games ON game_reviews.game_id = games.game_id
        JOIN 
            users ON game_reviews.user_id = users.user_id
        WHERE 
            games.game_id = :game_id;"
    );

    $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $results;
}

//fucntion for getting review by id for update and deleting functionallity
function GetReview($review_id) {
    global $db;
    $stmt = $db->prepare('SELECT gr.*, g.game_title FROM game_reviews gr JOIN games g ON gr.game_id = g.game_id WHERE gr.review_id = :review_id');
    $stmt->bindParam(':review_id', $review_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



// Function to add a game review
function AddGameReview($game_id, $user_id, $review_text, $rating) {
    global $db;

    // Prepare the SQL statement to insert the review
    $stmt = $db->prepare(
        "INSERT INTO game_reviews (game_id, user_id, review_text, rating, date_posted) 
        VALUES (:game_id, :user_id, :review_text, :rating, NOW())"
    );

    // Bind the parameters
    $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':review_text', $review_text, PDO::PARAM_STR);
    $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);

    // Execute the statement and return the result
    return $stmt->execute();
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