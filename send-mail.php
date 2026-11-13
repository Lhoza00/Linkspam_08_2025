<?php 
    $userName = htmlspecialchars(filter_input(INPUT_POST, "userName", FILTER_SANITIZE_SPECIAL_CHARS));;
    $userEmail = htmlspecialchars(filter_input(INPUT_POST, "userEmail", FILTER_SANITIZE_EMAIL));
    $subject = htmlspecialchars(filter_input(INPUT_POST, "mainsubject", FILTER_SANITIZE_SPECIAL_CHARS));
    $message = htmlspecialchars(filter_input(INPUT_POST, "mainmessage", FILTER_SANITIZE_SPECIAL_CHARS));
    //have to use cmd line to install files 
    require "vendor/autoload.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "stmp.example.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = "infolinkspam@gmail.com";
    $mail->Password = "@Angelina00";

    $mail->setFrom($userEmail, $userName);
    $mail->addAddress("lolwethudamane07@gmail.com", "Lolwethu");

    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();

    header("Location: Contact.php");

?>