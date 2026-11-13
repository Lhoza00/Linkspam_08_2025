<?php 
    require_once("autoLoader.php");
    
?>
<html lang="en" id="Feedback_Page">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkSpam | Affiliate</title>
    <link rel="stylesheet" href="styles/client.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include('Components/header.php');?>
    <main>
        <?php include("Components/sidebar.php"); ?>
       <?php include('Components/postBox.php'); ?>
       <section>
            <div class="container"><h1 align="center">Must be level 6 to continue:</h1></div>
       </section>
    </main>
    <?php include("Components/footer.php");?>
</body>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    const btnPost = document.querySelector('.btnPost');
    const sectionPost = document.querySelector('.SectionPost');

    btnPost.addEventListener('click', () => {
        sectionPost.classList.toggle('active');
    });
    
</script>
</html>