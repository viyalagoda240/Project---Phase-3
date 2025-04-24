<?php
session_start();
if(isset($_SESSION["u"])){
require "connection.php";

$recipeId = $_POST["i"];
$comment = $_POST["c"];
$username = $_SESSION["u"]["username"];

if (empty($username)) {
    echo ("Please Sign In.");
} else if (empty($comment)) {
    echo ("Please enter your Comment.");
} else {
    Database::iud("INSERT INTO `comment` (`comment`,`recipe_recipeId`,`user_username`) VALUES ('".$comment."','".$recipeId."','".$username."')");
    echo ("success");
}
} else {
    echo ("Please Sign In.");
}
?>