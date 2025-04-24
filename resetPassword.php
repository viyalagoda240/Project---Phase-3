<?php

require "connection.php";

$email = $_POST["e"];
$np = $_POST["n"];
$rnp = $_POST["r"];

if (empty($np)) {
    echo ("plese insert a New Password");
} else if (empty($rnp)) {
    echo ("plese Re-type your New Password");
} else if ($np != $rnp) {
    echo ("Password Does Not Matched");
} else {
    Database::iud("UPDATE `user` SET `password`='" . $np . "' WHERE `email`='" . $email . "'");
    echo ("success");
}
