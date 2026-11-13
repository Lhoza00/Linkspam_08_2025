<?php
class Post{
    private $error = "";
    private $DB;
    
    public function __construct($DB) {
        $this->DB = $DB;
    }
    public function createPost($userID, $data, $files, $hashTags, $userTags){
        $login = new Login($this->DB);
        $userTemp = $login->checkLogin($userID);
        $userName = $userTemp["userName"];
        $post = $data['post'];
        $postid = $this->createPostID();
        if(!empty($data['post']) || !empty($files['file']['name'])){
            $hasImage = 0;
            $myImage = "";
            if(!empty($files['file']['name'])){
                $folder = "uploads/" . $userName . "/";
                //create folder
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                    file_put_contents($folder . "index.php", '
                        <?php 
                            session_start();
                            if(empty($_SESSION[""myuserId"])){
                                session_destroy();
                                header("Location: /Linkspam/Index.php");
                                exit;
                            }else{
                                header("Location: /Linkspam/Home.php");
                                exit;
                            }
                        ?>
                    ');
                }
                $image_class = new Image();
                $myImage = $folder . $image_class->generatePost($postid, $userName);
                if($files['file']['type'] == "image/png"){
                    $myImage = $myImage . ".png";
                }elseif($files['file']['type'] == "image/jpeg"){
                    $myImage = $myImage . ".jpeg";
                }elseif($files['file']['type'] == "image/jpg"){
                     $myImage = $myImage . ".jpg";
                }
                
                move_uploaded_file($files['file']['tmp_name'], $myImage);
                $image_class->cropImage($myImage, $myImage, 800, 800, $files['file']['type']);


                $hasImage = 1;
            }
            
            $sqlPost = "INSERT INTO userposts(userId, userName, hashTags, userTags, postid, post, image, hasImage) 
                        VALUES(?,?,?,?,?,?,?,?)";
            $this->DB->save($sqlPost, [$userID, $userName, $hashTags, $userTags, $postid, $post, $myImage, $hasImage]);
        }else{
            $this->error = "Insert into the input to post";
            return $this->error;
        }
    }

    public function createPostID(){
        return 'post_' . bin2hex(random_bytes(8));
    }

    public function getTime($pasttime, $today = 0, $differentFormat = '%y') {
    $today = date("Y-m-d H:i:s");
    $past = date_create($pasttime);
    $dateTime2 = date_create($today);

    $interval = date_diff($past, $dateTime2);
    if ($interval->invert) {
        // If the past date is in the future, return an error or a specific message
        return "Invalid date";
    }

    switch (true) {
        case ($interval->y >= 1):
            return $past->format("F jS, Y");

        case ($interval->m >= 1):
            return $past->format("jS F");

        case ($interval->d > 2):
            return $past->format("jS F");

        case ($interval->d == 2):
            return "2 days ago";

        case ($interval->d == 1):
            return "A day ago";

        case ($interval->h >= 2):
            return $interval->h . " hours ago";

        case ($interval->h == 1):
            return "1 hour ago";

        case ($interval->i >= 2):
            return $interval->i . " minutes ago";

        case ($interval->i == 1):
            return "1 minute ago";

        case ($interval->s >= 2):
            return $interval->s . " seconds ago";

        default:
            return "just now";
        }
}


    public function getPost($userID){
        if(!empty($userID)){
            $sqlretrieve = "SELECT * FROM userposts ORDER BY dateUpload DESC LIMIT 5";
            $user_post = $this->DB->read($sqlretrieve);
            if($user_post){
                return $user_post;
            }else{
                return false;
            }
        }
    }
    public function get_deletePost($postId){
        $sqlretrieve = "SELECT * FROM userposts WHERE postID = ? LIMIT 1";
        $delete_post = $this->DB->read($sqlretrieve, [$postId]);
        if($delete_post){
            return $delete_post[0];
        }else{
            return false;
        }
    }

    public function deletePost($postId){
        $this->DB->save("DELETE FROM userposts WHERE postID = ?", [$postId]);
        $this->DB->save("DELETE FROM engagement WHERE postID = ?", [$postId]);
    }

    public function getUser($userId){
        $userId = addslashes($userId);
        $sqlGetUser = "SELECT * FROM userPosts WHERE userId = ? Limit 1";
        $gotUser = $this->DB->read($sqlGetUser, [$userId]);
        if($gotUser){
            return $gotUser[0];
        }else{
            return false;
        }
    }
     public function isPromoted($postId, $userId) {
        $promote = "promote";
        $result = $this->DB->read(
            "SELECT * FROM engagement WHERE types= 'promote' AND postID = ? LIMIT 1",
            [$postId]
        );
        if (isset($result[0]['users'])) {
            $userArray = json_decode($result[0]['users'], true) ?? [];
            if (in_array($userId, $userArray)) {
                // User is promoted
                return true;
            } else {
                // User is not promoted
                return false;
            }
        }
    }
   public function engage_post($postId, $postType, $userId) {
    $column = $postType . 's';

    $result = $this->DB->read(
        "SELECT users FROM engagement WHERE types = ? AND postID = ? LIMIT 1",
        [$postType, $postId]
    );

    $userArray = [];
    $engaged = false;

    if (isset($result[0]['users'])) {
        $userArray = json_decode($result[0]['users'], true) ?? [];

        if (in_array($userId, $userArray)) {
            // User already engaged - remove
            $userArray = array_values(array_diff($userArray, [$userId]));
            $engaged = false;
        } else {
            // User not engaged - add
            $userArray[] = $userId;
            $engaged = true;
        }

        $userJson = json_encode($userArray);
        $this->DB->save(
            "UPDATE engagement SET users = ? WHERE types = ? AND postID = ? LIMIT 1",
            [$userJson, $postType, $postId]
        );
    } else {
        // No existing engagement record - create new
        $userArray = [$userId];
        $userJson = json_encode($userArray);
        $this->DB->save(
            "INSERT INTO engagement (types, postID, users) VALUES (?, ?, ?)",
            [$postType, $postId, $userJson]
        );
        $engaged = true;
    }

    // Update engagement count
    $sql = $engaged
        ? "UPDATE userposts SET $column = $column + 1 WHERE postID = ?"
        : "UPDATE userposts SET $column = $column - 1 WHERE postID = ?";

    $this->DB->save($sql, [$postId]);
}
    public function getLikes($postId, $type) {
        $sql = "SELECT * FROM engagement WHERE postID = ? AND types = ? LIMIT 1";
        $result = $this->DB->read($sql, [$postId, $type]);

        if(is_array($result) && isset($result[0]['users'])) {
            return json_decode($result[0]['users'], true) ?? [];
        }
        
        return [];
    }
}