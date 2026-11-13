<?php 

    $email = $userEmail = htmlspecialchars(filter_input(INPUT_POST, "userEmail", FILTER_SANITIZE_EMAIL));
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);

    $expiry = date("Y-m-d H:i:s",time() + 60 * 5);
    $mysqli = require __DIR__ . "/databases.php";

    $sqlquery = "UPDATE userDetails SET reset_token_hash = ?, reset_token_expire = ? WHERE userEmail = ?";
    $stmt = $pdo->prepare($sqlquery);
    
    $stmt->execute([$token_hash, $expiry, $email]);

?>