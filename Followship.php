<?php 
    require_once("autoLoader.php");
    $queryString = explode("?", $data['link']);
    $queryString = end($queryString);
    $followId = explode("=", $queryString)[1];
    $followId = htmlspecialchars($followId);
    $myUserId = htmlspecialchars($_SESSION['myuserId']);
    if(!empty($followId)){
        $profile = new Profile();
        $profile->followUser($myUserId, $followId);
    }
    $follows = $profile->getFollow($myUserId, $followId);
    $obj = (object)[];
    $obj->status = "success";   
    $obj->follows = count($follows);
    echo json_encode($obj);
    
    if($_SERVER['PHP_SELF'] === '/Linkspam/Followship.php'){
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