<?php 
    require_once("autoLoader.php");
    $profile = new Profile();
    $leaderboard = $profile->getLeaderboard();
    echo "<pre>";
    //rint_r($leaderboard);
    echo "</pre>";
    foreach($leaderboard as $user){
        $pos =0;
    }
?>
<html lang="en" id="Home_Page">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkSpam | Leaderboard</title>
    <link rel="stylesheet" href="styles/client.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include('Components/header.php');?>
    <main>
        <?php include("Components/sidebar.php"); ?>
        <section class="LeaderboardSection">
            <div class="container">
                <h1>Leaderboard:</h1>
                <div class="leaderboard-content">
                    <?php 
                        foreach($leaderboard as $user): 
                            $pos++;
                            $image = "Images/default.png";
                            if(file_exists($user["userPfp"])){
                                $image = $imageClass->getThumbProfile($user["userPfp"]);
                            }
                            $userName = htmlspecialchars($user['userName']);
                            $userLevel = htmlspecialchars($user['userLevel']);
                        ?>
                        <div id="leaderboardUser">
                            <div class="UserInfo">
                                <h2><?php echo $pos?></h2>
                                <div class="leaderboardPic">
                                    <img src="<?php echo htmlspecialchars($image); ?>" alt="ProfilePicture">
                                </div>
                                <div class="leaderboardUserInfo">
                                    <p class=""><?php echo $userName; ?></p>
                                    <p class="">Level: <?php echo $userLevel; ?></p>
                                </div>
                            </div>
                            <div class="leaderboardBtn">
                                <a href="Profile.php?search=<?php echo urlencode($userName); ?>">
                                    <button class="btnViewProfile">View Profile</button>
                                </a>
                            </div>
                        </div>
                        
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>
    <?php require_once("Components/footer.php"); ?>
</body>
<script>
        const btnPost = document.querySelector('.btnPost');
        const sectionPost = document.querySelector('.SectionPost');

        btnPost.addEventListener('click', () => {
            sectionPost.classList.toggle('active');
        });
</script>
</html>