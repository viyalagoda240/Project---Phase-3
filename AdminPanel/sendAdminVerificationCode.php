<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `admin` WHERE `username`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){
        $code = uniqid();

        Database::iud("UPDATE `admin` SET `password`='".$code."' WHERE `username`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'example@gmail.com';//I didn’t provide my email here for security reasons.
            $mail->Password = 'password';//I didn’t provide password here for security reasons.
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('example@gmail.com', 'Admin Verification Code');//I didn’t provide my email here for security reasons.
            $mail->addReplyTo('example@gmail.com', 'Admin Verification Code');//I didn’t provide my email here for security reasons.
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Admin Email Verification Code';
            $bodyContent = '<h1 style="color:green">Your Verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }

    }else{
        echo ("Invalid Email address");
    }

}

?>