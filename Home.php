<?php 
    require_once("autoLoader.php");
    
?>
<html lang="en" id="Home_Page">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkSpam | Home</title>
    <link rel="stylesheet" href="styles/client.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include('Components/header.php');?>
    <main>
        <?php include("Components/sidebar.php"); ?>
        <?php include('Components/postBox.php'); ?>
        <section class="Section-userHome">
            <div class="container">
                <?php 
                if(!empty($user_post)){
                    foreach ($user_post as $row_post) {
                        if($profile_data['userID'] != $row_post['userID']){
                            include('Post.php');
                        }
                    }
                }?>
            </div>
        </section>
    </main>
    <?php include("Components/footer.php");?>
</body>
<script>
    const btnPost = document.querySelector('.btnPost');
    const sectionPost = document.querySelector('.SectionPost');

    btnPost.addEventListener('click', () => {
        sectionPost.classList.toggle('active');
        });

    
    </script>
</html>

