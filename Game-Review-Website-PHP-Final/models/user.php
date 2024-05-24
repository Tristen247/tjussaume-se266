<?php
include __DIR__ . '/db.php'; 

function login($user, $pass){
    global $db;
    $salt = "school-salt"; // salt used during password entry in the DB
    $hashedPass = sha1($salt . $pass); // Apply the salt before hashing

    $stmt = $db->prepare("SELECT * FROM gaming_users WHERE username=:user AND password=:pass");
    $stmt->bindValue(':user', $user);
    $stmt->bindValue(':pass', $hashedPass);
   
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result; // Login successful
    }
    
    return []; // Login failed
}



// Function to get reviews for a specific user

function GetReviewsByUserId($user_id) {
    global $db;

    $results = [];

    $stmt = $db->prepare(
        "SELECT 
            games.game_title, 
            game_reviews.review_text, 
            game_reviews.rating, 
            game_reviews.date_posted,
            game_reviews.review_id  
        FROM 
            game_reviews
        JOIN 
            games ON game_reviews.game_id = games.game_id
        WHERE 
            game_reviews.user_id = :user_id;"
    );

    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $results;
}

?>
