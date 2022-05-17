<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;

require_once "PHPMailer.php";
require_once "SMTP.php";
require_once "Exception.php";

// $email = "greatedafeoke@gmail.com";
// $name = "National Bank PLC";
// $body = "This is an email!";

function sendMail($name, $email, $subject, $body)
{
    $response = "";

    $mail = new PHPMailer(true);
    
    // SMTP settings
    $mail->isSMTP();
    $mail->Host = "skyreliance.org";
    $mail->SMTPAuth = true;
    $mail->Username = "admin@skyreliance.org";
    $mail->Password = "Greatedafe94.";
    $mail->Port = 465;
    $mail->SMTPSecure = "tls";

    // SMTP settings
    // $mail->isSMTP();
    // $mail->Host = "smtp.gmail.com";
    // $mail->SMTPAuth = true;
    // $mail->Username = "greatedafeoke@gmail.com";
    // $mail->Password = "GreatEdafe94..";
    // $mail->Port = 587;
    // $mail->SMTPSecure = "tls";

    // Email settings
    $mail->isHTML(true);
    $mail->setFrom("greatedafeoke@gmail.com", $name);
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->Body = $body;

    if ($mail->send()) {
        return "Success";
    } else {
        return $mail->ErrorInfo;
    }
}


// sendMail("Edafe","greatedafeoke@gmail.com","Subject","This is the email body");