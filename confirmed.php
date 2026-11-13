<?php 
    require_once('autoLoader.php');
    if(!empty($_GET['deleteId'])){
        $deleteId = $_GET['deleteId'];
        $delete_post = $post->get_deletePost($deleteId);
         //echo "<pre>";
        //print_r($delete_post);
        //echo "</pre>";
        if ($delete_post && $_SESSION['myuserId'] == $delete_post['userID']) {
            $post->deletePost($deleteId);
            header("Location: " . $_SERVER['PHP_SELF']);
            die;
        }
    }
?>