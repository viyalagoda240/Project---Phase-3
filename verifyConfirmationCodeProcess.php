<?php

require "connection.php";

$email = $_POST["e"];
$vcode = $_POST["v"];

if(empty($vcode)){
    echo ("Plese enter your Verification Code");
}else{
    
    $rs = Database::search("SELECT * FROM `user` WHERE `verificationCode`='".$vcode."'");
    $n = $rs->num_rows;

    if($n == 1){
        echo ("success");
    }else {
        echo ("Invalid Verification Code!!!");
    }
}

?>