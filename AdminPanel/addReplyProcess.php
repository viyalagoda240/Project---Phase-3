<?php
session_start();
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

    $messageId = $_POST["c"];
    $reply = $_POST["r"];

if (!isset($_POST["c"])) {
    echo ("Something wrong with message ID.");
} else if (empty($reply)) {
    echo ("Please enter your reply message.");
} else {
    $rs = Database::search("SELECT * FROM `contactus` WHERE `massageId`='" . $messageId . "'");
    $n = $rs->num_rows;

    if ($n == 1) {
        $email = $rs->fetch_assoc()["senderEmail"];

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'example@gmail.com'; //I didn’t provide my email here for security reasons.
        $mail->Password = 'password';//I didn’t provide this here for security reasons.
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('example@gmail.com', 'Reply Message');//I didn’t provide my email here for security reasons.
        $mail->addReplyTo('example@gmail.com', 'Reply Message');//I didn’t provide my email here for security reasons.
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Reply Message';
        $bodyContent = '<h3 style="color:green">' . $reply . '</h3>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Reply sending failed';
        } else {
            $datetime = date("Y-m-d H:i:s");
            Database::iud("INSERT INTO `contactusreply` (`contain`,`dateTime`,`contactUs_massageId`) VALUES ('" . $reply . "','" . $datetime . "','" . $messageId . "')");
            echo ("Success");
        }
    } else {
        echo ("Something wrong with message ID.");
    }
}

?>