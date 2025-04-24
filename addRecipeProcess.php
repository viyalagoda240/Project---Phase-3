<?php
session_start();
require "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipeName = $_POST['recipeName'];
    $ingredients = isset($_POST['ingredients']) ? $_POST['ingredients'] : [];
    $instructions = isset($_POST['instructions']) ? $_POST['instructions'] : [];
    $categories = isset($_POST['categories']) ? $_POST['categories'] : [];

    if (empty($categories) || !is_array($categories)) {
        echo "At least one category must be selected.";
        exit();
    }

    $recipeCheck = Database::search("SELECT * FROM `recipe` WHERE `recipeName` = '" . $recipeName . "' AND `user_username` = '" . $_SESSION["u"]["username"] . "'");
    if ($recipeCheck->num_rows > 0) {
        echo "A recipe with this name already exists.";
        exit();
    }

    if (empty($recipeName)) {
        echo "Recipe name is required.";
        exit();
    }
    if (empty($ingredients) || !is_array($ingredients) || count($ingredients) === 0) {
        echo "At least one ingredient is required.";
        exit();
    }
    if (empty($instructions) || !is_array($instructions) || count($instructions) === 0) {
        echo "At least one instruction is required.";
        exit();
    }

    Database::iud("INSERT INTO `recipe` (`recipeName`, `user_username`, `status`) VALUES ('" . $recipeName . "', '" . $_SESSION["u"]["username"] . "', '1')");
    $recipeData = Database::search("SELECT * FROM `recipe` WHERE `recipeName` = '" . $recipeName . "' AND `user_username` = '" . $_SESSION["u"]["username"] . "'");
    $getRecipeData = $recipeData->fetch_assoc();
    $recipeId = $getRecipeData["recipeId"];

    foreach ($categories as $category) {
        $categoryId = trim($category);
        Database::iud("INSERT INTO `recipe_has_category` (`recipe_recipeId`, `category_categoryId`) VALUES ('" . $recipeId . "', '" . $categoryId . "')");
    }

    foreach ($ingredients as $ingredient) {
        $ingredient = trim($ingredient);
        $ingredient = $ingredient;
        if (!empty($ingredient)) {
            Database::iud("INSERT INTO `ingredients` (`ingredient`, `recipe_recipeId`) VALUES ('" . $ingredient . "', '" . $recipeId . "')");
        }
    }

    foreach ($instructions as $stepIndex => $instruction) {
        $instruction = trim($instruction);
        if (!empty($instruction)) {
            Database::iud("INSERT INTO `instruction` (`instruction`, `step`, `recipe_recipeId`) VALUES ('" . $instruction . "', '" . ($stepIndex + 1) . "', '" . $recipeId . "')");
        }
    }

    $imageCount = count($_FILES);
    if ($imageCount > 0 && $imageCount <= 3) {
        $allowedImageExtensions = ["image/jpg", "image/jpeg", "image/png", "image/svg+xml"];

        foreach ($_FILES as $imageKey => $imageFile) {
            $fileExtension = $imageFile['type'];

            if (in_array($fileExtension, $allowedImageExtensions)) {
                $newExtension = '';
                if ($fileExtension == "image/jpg") {
                    $newExtension = ".jpg";
                } elseif ($fileExtension == "image/jpeg") {
                    $newExtension = ".jpeg";
                } elseif ($fileExtension == "image/png") {
                    $newExtension = ".png";
                } elseif ($fileExtension == "image/svg+xml") {
                    $newExtension = ".svg";
                }

                $uniqueFilename = "resource/recipeImg/" . uniqid($recipeName . "_") . $newExtension;
                if (move_uploaded_file($imageFile['tmp_name'], $uniqueFilename)) {
                    Database::iud("INSERT INTO `recipepic` (`recipe_recipeId`, `recipePicture`) VALUES ('" . $recipeId . "', '" . $uniqueFilename . "')");
                } else {
                    echo "Failed to upload image: " . $imageFile['name'];
                    exit();
                }
            } else {
                echo "Invalid image type for: " . $imageFile['name'];
                exit();
            }
        }
    } elseif ($imageCount > 3) {
        echo "Too many images uploaded. Maximum is 3.";
        exit();
    }

    echo "Recipe submitted successfully!";
} else {
    echo "Invalid request method.";
}
?>
