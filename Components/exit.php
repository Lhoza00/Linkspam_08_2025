<?php 
    if($_SERVER['PHP_SELF'] === $_SERVER['PHP_SELF']){
        
        if(empty($_SESSION['myuserId'])){
            session_destroy();
            header('Location: /Linkspam/Index.php');
            exit;
        }else{
            
            header('Location: /Linkspam/Home.php');
            exit;
        }
    }
?>