<?php 
include_once("autoLoader.php");
$data = file_get_contents("php://input");
if($data != ""){
    $data = json_decode($data, true);
}
if(isset($data['action']) && $data['action'] == "promote"){
    include_once("Engagement.php");
}elseif(isset($data['action']) && $data['action'] == "follow"){
    include_once("Followship.php");
}

    if($_SERVER['PHP_SELF'] === '/Linkspam/ajax.php'){
        session_start();
        if(empty($_SESSION['myuserId'])){
            session_destroy();
            header('Location: /Linkspam/Index.php');
            exit;
        }else{
            header('Location: /Linkspam/Home.php');
            exit;
        }
    }
