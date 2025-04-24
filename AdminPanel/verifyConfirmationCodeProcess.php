<?php
session_start();
require "connection.php";

$email = $_POST["u"];
$vcode = $_POST["p"];

if(empty($vcode)){
    echo ("Plese enter your Verification Code");
}else{
    
    $rs = Database::search("SELECT * FROM `admin` WHERE `password`='".$vcode."'");
    $n = $rs->num_rows;

    if($n == 1){
        $d = $rs->fetch_assoc();
        $_SESSION["admin"] = $d;
        echo ("success");
    }else {
        echo ("Invalid Verification Code!!!");
    }
}
?>