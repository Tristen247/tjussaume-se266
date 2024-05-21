<?php 

include __DIR__ . '/db.php'; 

// Function to get reviews for a specific game
function GetReviewsByGameId($game_id) {
    global $db;

    $results = [];

    $stmt = $db->prepare(
        "SELECT 
            games.game_title, 
            game_reviews.review_text, 
            game_reviews.rating, 
            game_reviews.date_posted, 
            gaming_users.username
        FROM 
            game_reviews
        JOIN 
            games ON game_reviews.game_id = games.game_id
        JOIN 
            gaming_users ON game_reviews.user_id = gaming_users.user_id
        WHERE 
            games.game_id = :game_id;"
    );

    $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return ($results);
}

//Admin Capabilty
function AddReview($title, $genre, $releaseDate) {
    global $db;

    $stmt = $db->prepare("INSERT INTO games (game_title, genre, release_date) VALUES (:title, :genre, :releaseDate)");

    $binds = array(
        ":title" => $title,
        ":genre" => $genre,
        ":releaseDate" => $releaseDate
    );
    if ($stmt->execute($binds) && $stmt->rowCount() > 0){
        $results = "Game Added!";
    } else {
        $results = "Error adding a new game. Please review your entry.";
    }

    return ($results);

}



?>