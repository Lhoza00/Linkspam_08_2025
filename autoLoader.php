<?php 
    session_start();
    include('Database.php');
    include('Classes/LoginClass.php');
    include('Classes/ProfileClass.php');
    include('Classes/PostClass.php');
    include('Classes/ImageClass.php');
    include('Classes/SignupClass.php');
    include('Classes/updateProfileClass.php');
    $DB = new Database();
    $login = new Login($DB);
    $post = new Post($DB);
    $updateProfile = new UpdateProfile($DB);
    $profile = new Profile();
    
    //create an account
    $error = ""; // Add this
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['PHP_SELF'] == "/Linkspam/Signup.php") {
        $signup = new SignUp($DB);
        $error = $signup->evaluate($_POST); // store error
        
    }
    //login to account
    $logerror = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['PHP_SELF'] == "/Linkspam/Login.php") {
        $userName = $_POST['userName'];
        $userPassword = $_POST['userPassword'];
        $logerror = $login->evaluate($_POST);   
    }
    if(($_SERVER['PHP_SELF'] == "/Linkspam/Index.php" || $_SERVER['PHP_SELF'] == "/Linkspam/Login.php") && isset($_SESSION['myuserId'])){
        header("Location: Home.php");
        exit;
    }

    //check if logged in
    $page = ["/Linkspam/Home.php", "/Linkspam/Profile.php", "/Linkspam/EditProfile.php", "/Linkspam/search.php", "/Linkspam/Leaderboard.php", "/Linkspam/Engagement.php", "/Linkspam/Dashboard.php", "/Linkspam/Inbox.php"];
    foreach($page as $pages){
        if($_SERVER['PHP_SELF'] == $pages && !isset($_SESSION['myuserId'])){
            header("Location: Logout.php");
            exit;
        }
    }
    if($_SERVER['PHP_SELF'] === '/Linkspam/autoLoader.php'){
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
        
    //create user posts
    if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST["btnSavePost"]))){
        $userTags = !empty($_COOKIE['selectedUsers'])? $_COOKIE['selectedUsers'] : '';
        if(!empty($userTags)){
            $userTags = json_decode($userTags, true);
            $userTags = implode(', ',$userTags);
        }
        $hashTags = !empty($_COOKIE['hashtags'])? $_COOKIE['hashtags'] : '';
        if(!empty($hashTags)){
            $hashTags = json_decode($hashTags, true);
            $hashTags = implode(', ',$hashTags);
        }
        setcookie('selectedUsers','',time()-3600,'/');
        setcookie('hashTags','',time()-3600,'/');
        $post->createPost($_SESSION["myuserId"], array_map('htmlspecialchars' ,$_POST), $_FILES, $hashTags, $userTags);
    }
    
    $searchPage = ["/Linkspam/Home.php", "/Linkspam/Profile.php", "/Linkspam/search.php", "/Linkspam/sidebar.php", "/Linkspam/EditProfile.php", "/Linkspam/Leaderboard.php", "/Linkspam/Engagement.php", "/Linkspam/Dashboard.php", "/Linkspam/Feedback.php", "/Linkspam/Affiliate.php"];
    //echo $_SERVER['QUERY_STRING'];
    
    foreach($searchPage as $searchPages){
        if($_SERVER['PHP_SELF'] == $searchPages){
            $profile = new Profile();
            // Default to logged-in user
            
            $user_data = $login->checkLogin($_SESSION['myuserId']);
            
            $target_username = isset($_GET['userName']) ? htmlspecialchars($_GET['userName'], ENT_QUOTES) : htmlspecialchars($user_data['userName'], ENT_QUOTES);
            $get_profile = $profile->getProfile(htmlspecialchars($target_username, ENT_QUOTES));
            if ($get_profile && isset($get_profile[0]['userID'])) {
                $profile_data = $profile->xpLevel($get_profile[0]['userID']);
                $checkData = $login->checkData($profile_data['userID']);
                $user_data = $login->checkLogin($profile_data['userID']);
                // Fetch posts for this profile
                $post = new Post($DB);
                $user_post = $post->getPost($profile_data['userID']);
            } else {
                // Show error or fallback
                $profile_data = $profile->xpLevel($_SESSION['myuserId']);
                $profile_data['userName'] =  "User not found";
                $checkData['Gender'] = " ";
                $user_post = [];
            }
        }
    }
    
    
    //update profile
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['PHP_SELF'] == "/Linkspam/EditProfile.php"){
        $confirmUpdate = $updateProfile->updateInfo(array_map('htmlspecialchars', $_POST));
        if($confirmUpdate){
            header("Location: Profile.php");
            die;
        }else{
            header("Location: EditProfile.php");
            die;
        }
    }

   /* //search for user and display profile
    $profile = new Profile();
    $get_profile = $profile->getProfile($user_data['userName']);
    $profile_data = $profile->xpLevel($get_profile['userID']);

    //get user posts
    $post = new Post();
    $user_post = $post->getPost($get_profile['userID']);
    this is in javascript
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
   */
    //image class to crop images

    $imageClass= new Image();

    