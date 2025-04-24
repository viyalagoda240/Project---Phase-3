<?php

session_start();

require "connection.php";

$username = $_SESSION["u"]["username"];
$fname = $_POST["fn"];
$lname = $_POST["ln"];
$mobile = $_POST["m"];

if (!isset($username)) {
    echo ("Plese login frist");
} else if (empty($fname)) {
    echo ("Please enter your First Name !!!");
} else if (strlen($fname) > 50) {
    echo ("First Name must have less than 50 characters");
} else if (empty($lname)) {
    echo ("Please enter your Last Name !!!");
} else if (strlen($lname) > 50) {
    echo ("Last Name must have less than 50 characters");
} else if (!empty($mobile)) {
    if (strlen($mobile) != 10) {
        echo ("Mobile must have 10 characters");
    } else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
        echo ("Invalid Mobile !!!");
    } else {
        Database::iud("UPDATE `user` SET `firstname` = '" . $fname . "', `lastname`='" . $lname . "', `mobile`='" . $mobile . "' WHERE `username`='".$username."' ");
        echo ("success");
    }
} else {
    Database::iud("UPDATE `user` SET `firstname` = '" . $fname . "', `lastname`='" . $lname . "' WHERE `username`='".$username."'");
    echo ("success");
}
