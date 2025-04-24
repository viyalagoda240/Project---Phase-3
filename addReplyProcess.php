<?php
session_start();
require "connection.php";

$commentId = $_POST["c"];
$reply = $_POST["r"];

if (empty($reply)) {
    echo ("Please enter your Comment.");
}else if(empty($commentId)){
    echo ("Something went wrong.");
} else {
    Database::iud("INSERT INTO `reply` (`replycontent`,`comment_commentId`) VALUES ('".$reply."','".$commentId."')");
    echo ("success");
}
?>