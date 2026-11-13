<?php
    require_once("autoLoader.php");
?>
<html lang="en" id="LoginPage">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Linkspam | Login</title>
</head>
<body class="SignBg">
    <?php include('Components/header.php'); ?>
    <main >
        <section class="LoginSection">
            <div class="container">
                <div class="card">   
                    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <p class="LoginHeader">Sign in to your Account</p>
                        <div class="password">
                            <label>Username</label>
                            <!--<label class="forgot"><a href="#" class="forgot">Forget username</a></label>-->
                        </div>
                        <input class="input" name="userName" required value="<?php echo htmlspecialchars($userName ?? ''); ?>" maxlength="25">
                        <div class="password">
                            <label>Password</label>
                            <label class="forgot"><a href="forgotpage.php" class="forgot">Forget password</a></label>
                        </div>
                        <input type="password" class="input" name="userPassword" required minlength="8">
                        <?php if (!empty($logerror)): ?>
                            <p class="error"> 
                                <?php echo $logerror; ?>
                            </p>  
                        <?php endif; ?>
                        <!--<div class="device">
                            <input type="checkbox" class="RememberCheckBox">
                            <p>Remember me on this device</p>
                        </div>-->
                        <div class="divButton">
                            <button type="submit" class="SignButton" name="loggin">Log in</button>
                        </div>
                        <p id="createAccount">Create an account? <a href="Signup.php">Sign in</a></p>
                    </form> 
                </div>
            </div>
        </section>
    </main>
    <?php include('Components/footer.php'); ?>
</body>
</html>
