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
    // $response = "";

    // $mail = new PHPMailer(true);

    // SMTP settings
    // $mail->isSMTP();
    // $mail->SMTPDebug = 2;
    // $mail->Host = "localhost";
    // $mail->SMTPAuth = true;
    // $mail->Username = "admin@skyreliance.org";
    // $mail->Password = "Greatedafe94.";
    // $mail->Port = 465;
    // $mail->SMTPOptions = array(
    //     'ssl' => array(
    //         'verify_peer' => false,
    //         'verify_peer_name' => false,
    //         'allow_self_signed' => true
    //     )
    // );
    // $mail->SMTPSecure = "tls";

    // SMTP settings
    // $mail->isSMTP();
    // $mail->Host = "smtp.gmail.com";
    // $mail->SMTPAuth = true;
    // $mail->Username = "greatedafeoke@gmail.com";
    // $mail->Password = "GreatEdafe94..";
    // $mail->Port = 587;
    // $mail->SMTPSecure = "tls";

    // Email settings
    // $mail->isHTML(true);
    // $mail->setFrom("admin@skyreliance.org", $name);
    // $mail->addAddress($email);
    // $mail->Subject = $subject;
    // $mail->Body = $body;

    // if ($mail->send()) {
    //     return "Success";
    // } else {
    //     return $mail->ErrorInfo;
    // }

    $to = $email;
    $subject = $subject;
    $txt = $body;
    $email = 'support@skyrelliance.org';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $message = "
        <html>
        <head>
        <title>" . $subject . "</title>
        </head>
        <body>
        <p>" . $name . ", this is your OTP: " . $txt . ", do not share it with anybody!</p>
        </body>
        </html>
        ";
    if ($body != null) {
        $message = $body;
    }

    $headers .= "From: " . $email . "\r\n";

    $res = mail($to, $subject, $message, $headers);
    if ($res) {
        return "Success";
    }else{
        return $res;
    }
}