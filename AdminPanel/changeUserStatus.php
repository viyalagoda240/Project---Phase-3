<?php
include "connection.php";
if (isset($_GET['id']) && isset($_GET['status'])) {
    $userId = $_GET['id'];
    $status = $_GET['status'];

    if ($status !== "1" && $status !== "0") {
        echo "Invalid status!";
        exit();
    }

    Database::iud("UPDATE `user` SET `status` = '" . $status . "' WHERE `username` = '" . $userId . "'");
    echo "success";
} else {
    echo "Missing parameters";
}
