<?php 
    require_once("autoLoader.php");
?>
<html lang="en" id="Dashboard_Page">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkSpam | Dashboard</title>
    <link rel="stylesheet" href="styles/client.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include('Components/header.php');?>
    <main>
        <?php include("Components/sidebar.php"); ?>
        <section class="WalletSection">
            <div class="container">
                <h1>Wallet</h1>
                <div class="wallet-content">
                    <div class="wallet-card">
                        <h2>Balance</h2>
                        <!--<p><?php echo htmlspecialchars($profile_data['balance'])?> USD</p>-->
                    </div>
                    <hr/>
                    <!--<div class="wallet-card">
                        <h2>Total Earnings</h2>
                        <p><?php echo htmlspecialchars($profile_data['totalEarnings'])?> USD</p>
                    </div>
                    <div class="wallet-card">
                        <h2>Withdrawn Amount</h2>
                        <p><?php echo htmlspecialchars($profile_data['withdrawnAmount'])?> USD</p>
                    </div>-->
                </div>
            </div>
        </section>
    </main>
    <?php include("Components/footer.php"); ?>
</body>
</html>