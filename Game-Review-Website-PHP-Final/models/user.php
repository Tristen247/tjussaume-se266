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

?>