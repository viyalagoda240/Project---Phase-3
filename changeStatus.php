<?php
include "connection.php";
if (isset($_GET['id']) && isset($_GET['status'])) {
    $recipeId = $_GET['id'];
    $status = $_GET['status'];

    if ($status !== "1" && $status !== "0") {
        echo "Invalid status!";
        exit();
    }

    Database::iud("UPDATE `recipe` SET `status` = '" . $status . "' WHERE `recipeId` = '" . $recipeId . "'");
    echo "success";
} else {
    echo "Missing parameters";
}
