<?php  require_once("autoLoader.php"); ?>
<?php if(empty($_SESSION['myuserId'])): ?>
    <header class="header">
        <div class="container">
            <?php if(empty($_SESSION['myuserId'])): ?>
                <a href="Index.php" class="Logo">LinkSpam</a> 
            <?php else: ?>
                <a href="Home.php" class="Logo">LinkSpam</a> 
            <?php endif;?>
            <nav class="navbar">
                <a href="About.php">About</a>
                <a href="Contact.php">Contact</a>
                <?php if(empty($_SESSION['myuserId'])): ?>
                    <a href="index.php #News">News</a> 
                <?php else: ?>
                    <a href="About.php #sectionAboutContact">News</a>
                <?php endif; ?>
                <?php if(empty($_SESSION['myuserId'])): ?>
                    <a href="Login.php">Sign-in</a>
                <?php endif; ?>   
            </nav>
            <div id="menu-btn" class="fas fa-bars">
                <ul class="mini-navbar" id="mini-navbar">
                    <li><a href="About.php">About</a></li>
                    <li><a href="Contact.php">Contact</a></li>
                    <?php if(empty($_SESSION['myuserId'])): ?>
                        <li><a href="index.php #News">News</a></li> 
                    <?php else: ?>
                        <li><a href="About.php #sectionAboutContact">News</a></li>
                    <?php endif; ?>
                    <?php if(empty($_SESSION['myuserId'])): ?>
                        <li><a href="Login.php">Sign-in</a></li>
                    <?php endif; ?>   
                </ul>
            </div> 
        </div>
    </header>

    <script>
        document.getElementById("menu-btn").addEventListener("click", function () {
            const menu = this.querySelector(".mini-navbar");
            if (menu.style.display === "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        });
    </script>
<?php elseif(!empty($_SESSION['myuserId'] && ($_SERVER['PHP_SELF'] != '/Linkspam/Profile.php')
                                         && ($_SERVER['PHP_SELF'] != '/Linkspam/Dashboard.php')
                                         && ($_SERVER['PHP_SELF'] != '/Linkspam/Feedback.php'))
                                         &&($_SERVER['PHP_SELF'] != '/Linkspam/EditProfile.php')
                                         &&($_SERVER['PHP_SELF'] != '/Linkspam/changeImage.php')
                                         &&($_SERVER['PHP_SELF'] != '/Linkspam/Leaderboard.php')): ?>
   
    <header class="clientHeader">
        <div class="container">
            <div class="sidebar-container">
                <a href="Home.php" class="Logo">Linkspam</a>
            </div>
            <form method="GET" action="search.php">
                <input class="hmSearch" type="search" name="search" placeholder="Search username..." list="searchUserName">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <datalist id="searchUserName">
                            <!-- Optional: Fill dynamically with known usernames -->
            </datalist>
            <div class="btnPost">
                <i class="fa-solid fa-plus"></i>
                <p>Post</p>
            </div>     
        </div>
    </header>
    
<?php else: ?>
    <header>
            <div class="container">
                <a href="Home.php" class="Logo">LinkSpam</a> 
                <div class="LevelStats">
                    <p>Level <?php echo htmlspecialchars($profile_data['userLevel']);?></p>
                    <?php if($_SESSION["myuserId"] == $profile_data['userID']):?>
                        <progress min="0" max="100" value=<?php
                        echo htmlspecialchars(ceil(($profile_data['xpLevel'] * 100))) / htmlspecialchars($profile_data['quota']);
                        ?>>
                        Xp Level</progress>
                        <p id="quota"><?php echo htmlspecialchars($profile_data['xpLevel']);?>/<?php echo htmlspecialchars($profile_data['quota']);?> xp</p>
                    <?php endif;?>
                </div>
            </div>
        </header>
<?php endif; ?>