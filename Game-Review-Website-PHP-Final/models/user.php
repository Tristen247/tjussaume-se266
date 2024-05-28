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

function GetAllUsers() {
    global $db;
    $stmt = $db->prepare('SELECT * FROM gaming_users');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function GetUser($user_id) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function UpdateUser($user_id, $username, $email, $password = null, $is_admin) {
    global $db;
    
    $sql = 'UPDATE gaming_users SET username = :username, email = :email';
    if ($password !== null) {
        $sql .= ', password = :password';
    }
    if ($is_admin !== null) {
        $sql .= ', is_admin = :is_admin';
    }
    $sql .= ' WHERE user_id = :user_id';
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    if ($password !== null) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    }
    if ($is_admin !== null) {
        $stmt->bindParam(':is_admin', $is_admin, PDO::PARAM_INT);
    }
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    return $stmt->execute();
}


function DeleteUser($user_id) {
    global $db;
    $stmt = $db->prepare('DELETE FROM gaming_users WHERE user_id = :user_id');
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    return $stmt->execute();
}

?>
