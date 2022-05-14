<?php 
    
    
    function sendMessage($customerMail, $name){

        require 'PHPMailerAutoload.php';
        require 'class.smtp.php';
        require '../../bankConfig.php';
        $mail  = new PHPMailer;
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        $mail->Username = $bank_mail;
        $mail->Password= $bank_password;

        $content = file_get_contents('../mail/congraTemp.php');
        $mail->setFrom($bank_mail, $bank_name);
        $mail->addAddress($customerMail);
        $mail->addReplyTo($bank_mail);

        $mail->isHTML(true);
        $mail->Subject="Account Created Successfully!";

        $swap_var = array(

            "{Name}"=> "$name"

        );

        foreach(array_keys($swap_var) as $key){
            if(strlen($key) > 2 && trim($key) !=""){
                $content = str_replace($key, $swap_var[$key], $content);
            }

        }
         
        $mail->Body="$content";
        

        if(!$mail->send()){
            echo"mail not sent";
        }
        
    }  
?>