<?php 
    require_once("autoLoader.php");
    
    $_SESSION['postId'] = $_GET['deleteId'];
    if(!empty($_GET['deleteId'])){
        $deleteId = $_GET['deleteId'];
        $delete_post = $post->get_deletePost($deleteId);
        if($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['myuserId'] == $delete_post['userID']) {
            $post->deletePost($deleteId);
            exit(header('Location: ' . $_SERVER['PHP_SELF']));
        }
    }
?>

    <section id="sectionDelete">
        <form method="POST" id="formDelete">
            <div class="DeleteCard">
                <h2>Are you sure you want to delete post?</h2>
                <div class="deleteButtons">
                     <input type="hidden" name="deleteId" 
                     value="<?php echo isset($_SESSION['postId']) ? htmlspecialchars($_SESSION['postId']) : ''; ?>">
            
                    <button type="submit" name="yesDelete" id="Delete">Delete</button>
                    <a href="Profile.php"><input type="button" class="cancelDelete" value="Cancel"></a>
                </div> 
            </div>
            <?php 
                if(empty($delete_post)){
                    echo "<h1 align=center>Post not found</h1>";
                }else{
                    if(isset($delete_post)){
                        $row_post = $delete_post;
                        if(!empty($deleteId)){
                            if(htmlspecialchars($deleteId) == htmlspecialchars($row_post['postID'])){
                                if(htmlspecialchars($_SESSION['myuserId']) == htmlspecialchars($row_post['userID'])){
                                    include('Post.php');  
                                }
                            }
                        }else{
                            echo "<h1 align=center>Post not found</h1>";
                        }
                    }
                }
               
            ?>
        </form>           
    </section>   