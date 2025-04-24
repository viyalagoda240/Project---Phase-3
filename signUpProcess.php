<?php

require "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$username = $_POST["u"];
$email = $_POST["e"];
$password = $_POST["p"];
$confimation = $_POST["c"];


if(empty($fname)){
    echo ("Please enter your First Name !!!");
}else if(strlen($fname) > 50){
    echo ("First Name must have less than 50 characters");
}else if(empty($lname)){
    echo ("Please enter your Last Name !!!");
}else if(strlen($lname) > 50){
    echo ("Last Name must have less than 50 characters");
}else if(empty($username)){
    echo ("Please enter your Username !!!");
}else if(strlen($username) > 50){
    echo ("Username must have less than 50 characters");
}else if (empty($email)){
    echo ("Please enter your Email !!!");
}else if(strlen($email) >= 100){
    echo ("Email must have less than 100 characters");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Invalid Email !!!");
}else if (empty($password)){
    echo ("Please enter your Password !!!");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo ("Password must be between 5 - 20 charcters");
}else if (empty($confimation)){
    echo ("Please Re-enter your Password !!!");
}else if ($password != $confimation) {
    echo ("Passwords do not match!");
}else{

$rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' OR `username`='".$username."'");
$n = $rs->num_rows;

if($n > 0){
    echo ("User with the same Email or Username already exists.");
}else{

    Database::iud("INSERT INTO `user` (`username`,`firstname`,`lastname`,`password`,`email`,`status`) VALUES ('".$username."','".$fname."','".$lname."','".$password."','".$email."','1')");

    echo "success";

}
    
}

?>