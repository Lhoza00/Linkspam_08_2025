<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'Classes/ProfileClass.php'; 
require_once 'Database.php';
if (isset($_GET['term'])) {
    $userName = $_GET['term'];
    $userObj = new Profile();
    $results = $userObj->getUserTag($userName);

    header('Content-Type: application/json');

    if ($results && is_array($results)) {
        // Extract only userName values
        $usernames = array_map(function ($user) {
            return ['userName' => $user['userName']];
        }, $results);

        echo json_encode($usernames);
    } else {
        echo json_encode([]);
    }
}
?>
