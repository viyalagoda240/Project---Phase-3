<?php
require "connection.php";

$email = $_POST["email"];
$message = $_POST["message"];

if(empty($message)) {
    echo "Message cannot be empty";
}else if(empty($email)) {
    echo "Email cannot be empty";
}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format";
} else {
    $dateTime = date("Y-m-d H:i:s");
    $stmt = Database::iud("INSERT INTO `contactus` (`senderEmail`,`contain`,`dateTime`,`status`) VALUES ('".$email."','".$message."','".$dateTime."','1')");
    echo ("success");
}
?>
