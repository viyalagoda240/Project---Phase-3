<?php
session_start();
if (isset($_SESSION["u"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Digital Recipe Book</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="submitRecipe.css" />

    </head>

    <body>

        <div class="col-12 m-0" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 9999;">
            <?php include 'header01.php'; ?>
        </div>

        <section id="submit" class="py-5 bg-light">
            <div class="container hero">
                <h2 class="mb-4">Submit Your Recipe</h2>
                <form id="recipeForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="submitterName" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="submitterName" name="submitterName" value="<?php echo $_SESSION["u"]["firstname"] . " " . $_SESSION["u"]["lastname"] ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="recipeName" class="form-label">Recipe Name</label>
                        <input type="text" class="form-control" id="recipeName" name="recipeName" required>
                    </div>

                    <div class="mb-3">
                        <label for="ingredients" class="form-label">Ingredients</label>
                        <div id="ingredientsContainer">
                            <div class="input-group mb-2">
                                <span class="input-group-text ingredient-number">1</span>
                                <input type="text" class="form-control ingredient-input" name="ingredients[]" placeholder="Enter ingredient" required>
                                <button type="button" class="btn btn-outline-danger remove-ingredient">Remove</button>
                            </div>
                        </div>
                        <button type="button" id="addIngredient" class="btn btn-outline-primary">Add Ingredient</button>
                    </div>

                    <div class="mb-3">
                        <label for="instructions" class="form-label">Instructions</label>
                        <div id="instructionsContainer">
                            <div class="input-group mb-2">
                                <span class="input-group-text instruction-number">1</span>
                                <input type="text" class="form-control instruction-input" name="instructions[]" placeholder="Enter instruction" required>
                                <button type="button" class="btn btn-outline-danger remove-instruction">Remove</button>
                            </div>
                        </div>
                        <button type="button" id="addInstruction" class="btn btn-outline-primary">Add Instruction</button>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categories</label>
                        <div class="categories-container">
                            <?php
                            require "connection.php";

                            $rs = Database::search("SELECT * FROM `category`");
                            $n = $rs->num_rows;

                            for ($x = 0; $x < $n; $x++) {
                                $d = $rs->fetch_assoc();

                            ?>
                                <div class="form-check category-item">
                                    <input class="form-check-input " type="checkbox" name="categories[]" id="category_<?php echo $x + 1; ?>" value="<?php echo $d["categoryId"] ?>">
                                    <label class="form-check-label" for="category1"><?php echo $d["categoryName"]; ?></label>
                                </div>
                            <?php

                            }
                            ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="recipeImages" class="form-label">Upload Images</label>
                        <input type="file" class="form-control" id="recipeImages" name="recipeImages[]" multiple accept="image/*">
                        <ul id="selectedImages"></ul>
                    </div>

                    <button type="button" class="btn btn-success" onclick="submitRecipe()">Submit Recipe</button>
                </form>
            </div>
        </section>

        <?php include "footer.php" ?>

        <script src="submitRecipe.js"></script>
    </body>

    </html>
<?php
} else {
    echo "Please sign in first.";
    header("Location: signInUp.php");
    exit();
}
?>