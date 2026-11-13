<html lang="en" id="ForgotPage">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Linkspam | Forgot</title>
</head>
<body>
    <?php include("header.php"); ?>
    <main>
        <section class="sectionForgotPassword">
            <div class="container">
                <form action="sendForgotMail.php" method="POST">
                    <h1>Forgot Password</h1>
                    <label>Email</label>
                    <input id="forgotEmail" placeholder="" name="userEmail">
                    <a href="sendForgotMail.php"><button>Send</button></a>
                </form>
            </div>
        </section>
    </main>
    <?php include("footer.php"); ?>
</body>
</html>