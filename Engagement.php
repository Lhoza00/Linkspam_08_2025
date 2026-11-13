<?php 
    require_once("autoLoader.php");
    if(empty($data['link'])){
        header("Location: Index.php");
        exit();
    } else {
        $queryString = explode("?", $data['link']);
        $queryString = end($queryString);
        $queryString = explode("&", $queryString);
        $typeString = explode("=", $queryString[0]);
        $type = htmlspecialchars(end($typeString));
        $idString = explode("=", $queryString[1]);
        $postId = htmlspecialchars(end($idString));
        
        if(!empty($type) && !empty($postId)){
            if($type == "promote" || $type == "share"){
                $result = $post->engage_post($postId, $type, htmlspecialchars($_SESSION['myuserId']));
            }
        }
        $likes = $post->getLikes($postId, $type);
        $promoted = $post->isPromoted($postId, htmlspecialchars($_SESSION['myuserId']));
        $obj = (object)[];
        $obj->likes = count($likes);
        $obj->action = "promote";
        $obj->status = $promoted;
        
        
        echo json_encode($obj);
    }
    
    if($_SERVER['PHP_SELF'] === '/Linkspam/Engagement.php'){
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