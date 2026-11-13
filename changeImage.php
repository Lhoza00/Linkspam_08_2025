<?php 
    require_once("autoLoader.php");
    $user_data = $login->checkLogin($_SESSION["myuserId"]);
    $userId = $_SESSION["myuserId"];
    //echo '<pre>';
    //print_r($_FILES);
    //echo '</pre>';
    //profile class
    $profile = new Profile();
    $profile_data = $profile->xpLevel($userId);
    $error = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_FILES["file"]["name"])){
            if(($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png")){
                $allowSize = (1024 * 1024) * 4;
                if($_FILES["file"]["size"] < $allowSize){
                    //everything is fine
                    $folder = "uploads/" . $user_data['userName'] . "/";
                    //create folder
                    if(!file_exists($folder)){
                        mkdir($folder, 0755, true);

                        // Create index.php inside the new folder
                        $indexContent = <<<PHP
                            <?php 
                                session_start();
                                if(empty(\$_SESSION['myuserId'])){
                                    session_destroy();
                                    header('Location: /Linkspam/Index.php');
                                    die;
                                }else{
                                    header('Location: /Linkspam/Home.php');
                                    die;
                                }
                            ?>
                            PHP;

                                file_put_contents($folder . "index.php", $indexContent);
                            }


                    $image= new Image();
                    if($_FILES["file"]["type"] == "image/png"){
                        $typeImage = ".png";
                    }elseif($_FILES["file"]["type"] == "image/jpeg"){
                        $typeImage = ".jpeg";
                    }
                    $fileName =$folder . $image->generateName($profile_data['userName']) . $typeImage;
                    move_uploaded_file($_FILES["file"]["tmp_name"], $fileName);
                    
                    $change = "profile";
                    if(isset($_GET["change"]) && $_GET["change"] == "cover"){
                        $change = "cover";
                    }


                    if($change == "cover"){
                        if(file_exists($profile_data["userCover"])){
                            unlink($profile_data["userCover"]);
                        }
                        $image->resizeImage($fileName, $fileName, 1500, 1500, $_FILES["file"]["type"]);
                    }elseif($change == "profile"){
                        if(file_exists($profile_data["userPfp"])){
                            unlink($profile_data["userPfp"]);
                        }
                        $image->cropImage($fileName, $fileName, 1000, 1000, $_FILES["file"]["type"]);
                    }elseif($change == "post"){
                        $image->cropImage($fileName, $fileName, 1000, 1000, $_FILES["file"]["type"]);
                    }

                    if(file_exists($fileName)){
                        $userId = $user_data["userID"];
                        //check for mode for GET parameters
                        
                        if($change == "profile"){
                            $sqlUpdate = "UPDATE userstats set userPfp = '$fileName' WHERE userId = '$userId' LIMIT 1;";
                             
                        }elseif($change == "cover"){
                            $sqlUpdate = "UPDATE userstats set userCover = '$fileName' WHERE userId = '$userId' LIMIT 1;";
                        }
                        $DB = new Database();
                        $DB->save($sqlUpdate);

                        header("Location: Profile.php");
                        die;
                    }
                }else{
                     $error = "File to large, please insert smaller size";
                }
            }else{
                $error =  "Only image type images";
            }
        }else{
            $error = "Add a valid image";   
        }
    }

?>
<html lang="en" id="Changepfp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkSpam | User Profile</title>
    <link rel="stylesheet" href="styles/client.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include('Components/header.php')?>
    <main>
        <section class="changeSection">
            <div class="container">
                <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="file" name="file">
                    <button name="submit">Submit</button>
                </form>
                <h3><?php if(!empty($error)){echo $error;} ?></h3>
            </div>
        </section>
    </main>
    <?php include('Components/footer.php')?>
</body>
</html>