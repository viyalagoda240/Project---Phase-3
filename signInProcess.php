<?php
session_start();
require "connection.php";

$username = $_POST["u"];
$password = $_POST["p"];
$rememberme = $_POST["r"];

if (empty($username)) {
    echo ("Please enter your Username");
} else if (empty($password)) {
    echo ("Please enter your Password");
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `username`='" . $username . "' AND `password`='" . $password . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        echo ("success");
        $d = $rs->fetch_assoc();
        $_SESSION["u"] = $d;

        if ($rememberme == "true") {
            setcookie("username", $username, time() + (60 * 60 * 24 * 365));
            setcookie("password", $password, time() + (60 * 60 * 24 * 365));
        } else {

            setcookie("username", "", -1);
            setcookie("password", "", -1);
        }
    } else {
        echo ("Invalid Username or Password");
    }
}

?>