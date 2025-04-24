<?php

require "connection.php";

if (isset($_GET["id"])) {

    $recipeId = $_GET["id"];
    $recipe_rs = Database::search("SELECT * FROM `recipe` INNER JOIN user ON user.username = recipe.user_username WHERE `recipeId`='" . $recipeId . "' ");

    $recipe_num = $recipe_rs->num_rows;

    if ($recipe_num == 1) {

        $recipe_data = $recipe_rs->fetch_assoc();

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Recipe Details</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
            <link rel="stylesheet" href="singleRecipe.css" />
        </head>

        <body>

            <div class="col-12 m-0" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 9999;">
                <?php include 'header01.php'; ?>
            </div>

            <section id="recipeDetails" class="py-5">
                <div class="container hero">
                    <h1 class="mb-4"><?php echo $recipe_data["recipeName"] ?></h1>

                    <div class="row">
                        <div class="col-md-6">
                            <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $pic_rs = Database::search("SELECT * FROM `recipepic` WHERE `recipe_recipeId` = '" . $recipeId . "'");
                                    $pic_num = $pic_rs->num_rows;
                                    $pic_data = $pic_rs->fetch_assoc();
                                    ?>
                                    <div class="carousel-item active">
                                        <img src="<?php echo $pic_data["recipePicture"] ?>" class="d-block w-100" style="height: 400px;" alt="Recipe Image">
                                    </div>
                                    <?php

                                    for ($x = 1; $x < $pic_num; $x++) {
                                        $pic_data = $pic_rs->fetch_assoc();
                                    ?>
                                        <div class="carousel-item">
                                            <img src="<?php echo $pic_data["recipePicture"] ?>" class="d-block w-100" style="height: 400px;" alt="Recipe Image">
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#recipeCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#recipeCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4 class="mb-3">Submitted By: <span class="text-success"><?php echo $recipe_data["firstname"] . " " . $recipe_data["lastname"]; ?>
                                </span></h4>
                            <h5 class="mb-3">Ingredients</h5>
                            <ul>
                                <?php
                                $ingredients_rs = Database::search("SELECT * FROM ingredients WHERE `recipe_recipeId` = '" . $recipeId . "'");
                                $ingredients_num = $ingredients_rs->num_rows;
                                for ($x = 0; $x < $ingredients_num; $x++) {
                                    $ingredients_data = $ingredients_rs->fetch_assoc();
                                ?>
                                    <li><?php echo $ingredients_data["ingredient"] ?></li>
                                <?php
                                }
                                ?>
                            </ul>

                            <h5 class="mb-3">Instructions</h5>
                            <ol>
                                <?php
                                $instructions_rs = Database::search("SELECT * FROM instruction WHERE `recipe_recipeId` = '" . $recipeId . "'");
                                $instructions_num = $instructions_rs->num_rows;
                                for ($x = 0; $x < $instructions_num; $x++) {
                                    $instructions_data = $instructions_rs->fetch_assoc();
                                ?>
                                    <li><?php echo $instructions_data["instruction"] ?></li>
                                <?php
                                }
                                ?>
                            </ol>

                            <h5 class="mb-3">Categories</h5>
                            <div class="recipe-categories">
                                <?php
                                $category_rs = Database::search("SELECT * FROM recipe_has_category INNER JOIN category ON recipe_has_category.category_categoryId=category.categoryId WHERE `recipe_recipeId` = '" . $recipeId . "'");
                                $category_num = $category_rs->num_rows;
                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <span><a href="recipies.php?category=<?php echo $category_data["categoryName"] ?>" style="text-decoration: none;"><?php echo $category_data["categoryName"] ?></a></span>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="comments-section">
                        <h3>Comments</h3>
                        <?php
                        $comment_rs = Database::search("SELECT * FROM `comment` WHERE `recipe_recipeId`= '" . $recipeId . "'");
                        $comment_num = $comment_rs->num_rows;
                        if ($comment_num == 0) {
                        ?>
                            <div class="comment">
                                <p>No Comments Yet.</p>
                            </div>
                        <?php
                        }
                        for ($x = 0; $x < $comment_num; $x++) {
                            $comment_data = $comment_rs->fetch_assoc();
                        ?>
                            <div class="comment">
                                <div class="comment-header"><?php echo $comment_data["user_username"] ?></div>
                                <p><?php echo $comment_data["comment"] ?></p>
                            </div>
                            <?php
                            $reply_rs = Database::search("SELECT * FROM `reply` WHERE `comment_commentId`= '" . $comment_data["commentId"] . "'");
                            $reply_num = $reply_rs->num_rows;
                            for ($y = 0; $y < $reply_num; $y++) {
                                $reply_data = $reply_rs->fetch_assoc();
                            ?>
                                <div class="reply">
                                    <div class="comment-header">Recipe Owner</div>
                                    <p><?php echo $reply_data["replycontent"] ?></p>
                                </div>
                        <?php
                            }
                        }
                        ?>

                        <div class="comment-form mt-4">
                            <h5>Add a Comment</h5>
                            <form autocomplete="off">
                                <div class="mb-3">
                                    <textarea class="form-control" name="comment" rows="3" placeholder="Write your comment..." id="commentContian"></textarea>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="submitComment(<?php echo $recipeId ?>);">Submit</button>
                            </form>
                        </div>
                    </div>

                    <div class="related-recipes">
                        <h3 class="mt-5">Related Recipes</h3>
                        <div class="row mt-4">
                            <?php
                            $recipies = Database::search("SELECT recipe.recipeId, recipe.recipeName, MAX(recipepic.recipePicture) AS recipePicture FROM recipe INNER JOIN recipepic ON recipepic.recipe_recipeId = recipe.recipeId GROUP BY recipe.recipeId, recipe.recipeName LIMIT 3;");
                            for ($x = 0; $x < 3; $x++) {
                                $recipies_data = $recipies->fetch_assoc();
                            ?>
                                <div class="col-md-4">
                                    <div class="card recipe-card">
                                        <?php
                                        if ($recipies_data["recipePicture"] == "") {
                                        ?>
                                            <img src="resource/recipeImg/image5.jpg" class="card-img-top" alt="Recipe">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $recipies_data["recipePicture"] ?>" class="card-img-top" alt="Recipe">
                                        <?php
                                        }
                                        ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $recipies_data["recipeName"] ?></h5>
                                            <p class="card-text">A classic Italian pasta dish with creamy sauce.</p>
                                            <a href='<?php echo "singleRecipe.php?id=" . $recipies_data["recipeId"]; ?>' class="btn btn-primary">View Recipe</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </section>

            <?php include 'footer01.php'; ?>

            <script src="singleRecipe.js"></script>
        </body>

        </html>
<?php

    } else {
        echo ("Sorry for the Inconvenience");
    }
} else {
    echo ("Something went wrong");
}

?>