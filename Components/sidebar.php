<?php
    require_once("autoLoader.php");
    $profile = new Profile();
    $profile_data = $profile->xpLevel($_SESSION['myuserId']);
    if(!empty($_GET['userName'])){
        $target_username = isset($_GET['userName']) ? htmlspecialchars($_GET['userName'], ENT_QUOTES) : NULL;
        $get_profile = $profile->getProfile(htmlspecialchars($target_username, ENT_QUOTES));
        if ($get_profile && isset($get_profile[0]['userID'])) {
            header("Location: Profile.php?userName=" . htmlspecialchars($get_profile[0]['userName'], ENT_QUOTES));
            exit();
        }
    }
    
    
    
?>
<aside id="sidebar">
    <ul>
        <li><a onclick="collapseSidebar()"><i id="toggleBtn" class="fa-solid fa-angle-right"></i><p>Close</p></a></li>
        <li title="Inbox"><a href="Inbox.php"><i class="fa fa-inbox"></i> <p>Inbox</p></a></li>
        <li title="Leaderboard"><a href="Leaderboard.php"><i class="fa fa-trophy"></i><p>Leaderboard</p></a></li>
        <li title="Dashboard"><a href="Dashboard.php"><i class="fa-solid fa-chart-simple"></i><p>Dashboard</p></a></li>
        <li title="Affiliate"><a href="Affiliate.php"><i class="fa-solid fa-star"></i><p>Affiliates</p></a></li> 
        <li id="outblock" title="Profile"><a href="Profile.php?username=<?php echo $profile_data['userName']?>"><i class="fa fa-user"></i><p>Profile</p></a></li>
        <li title="Feedback"><a href="Feedback.php"><i class="fa-solid fa-circle-info"></i><p>Feedback</p></a></li>
        <li title="Logout"><a href="Logout.php"><i class="fa-solid fa-right-from-bracket"></i><p>Log out</p></a></li> 
    </ul> 
</aside>
    
<script>
    let isCollapsed = true;

    function collapseSidebar() {
        const sidebar = document.getElementById("sidebar");
        const paragraphs = sidebar.querySelectorAll("aside p");
        const toggleIcon = document.getElementById("toggleBtn");

        if (!isCollapsed) {
            sidebar.style.width = "3.2rem"; // collapsed size
            paragraphs.forEach(p => p.style.display = "none");
            toggleIcon.classList.remove("fa-angle-left");
            toggleIcon.classList.add("fa-angle-right");
        } else {
            sidebar.style.width = "12.2rem"; // original size
            paragraphs.forEach(p => p.style.display = "block");
            toggleIcon.classList.remove("fa-angle-right");
            toggleIcon.classList.add("fa-angle-left");
        }

        isCollapsed = !isCollapsed;
    }
</script>
<?php 
    if($_SERVER['PHP_SELF'] === '/Linkspam/sidebar.php'){
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
?>
