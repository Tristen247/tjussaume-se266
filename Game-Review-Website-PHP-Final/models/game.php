<?php 

include __DIR__ . '/db.php'; 

function GetGames() {
    global $db;

    $results = [];

    $stmt = $db->prepare("SELECT game_id, game_title, genre, release_date FROM games ORDER BY game_id");

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results  = $stmt-> fetchAll(PDO::FETCH_ASSOC);
    }

    return ($results);
}

//Admin Capabilty
function AddGame($title, $genre, $releaseDate) {
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

function SearchGames($title, $genre, $orderby = 'game_title') {
    global $db;
    $sql = "SELECT * FROM games WHERE 1=1"; 
    $binds = [];

    if (!empty($title)) {
        $sql .= " AND game_title LIKE :title";
        $binds[':title'] = '%' . $title . '%';
    }

    if (!empty($genre)) {
        $sql .= " AND genre LIKE :genre";
        $binds[':genre'] = '%' . $genre . '%';
    }

    if (!empty($orderby)) {
        // Sanitize $orderby to prevent SQL injection
        $valid_columns = ['game_title', 'genre', 'release_date'];
        if (in_array($orderby, $valid_columns)) {
            $sql .= " ORDER BY " . $orderby;
        } else {
            $sql .= " ORDER BY game_title"; // Default to game_title if invalid column is provided.
        }
    }

    $stmt = $db->prepare($sql);
    $results = [];
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $results;
}



?>