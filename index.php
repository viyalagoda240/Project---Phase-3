<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Recipe Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css" />
</head>

<body>

    <div class="col-12 m-0" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 9999;">
        <?php include 'header.php'; ?>
    </div>

    <section id="home" class="hero">
        <div class="container">
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="resource/sideImg/image1.jpg" class="d-block w-100" alt="Slide 1">
                        <div class="carousel-caption">
                            <h5>Fresh & Tasty Recipes</h5>
                            <p>Discover recipes that bring joy to your table.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="resource/sideImg/image2.jpg" class="d-block w-100" alt="Slide 2">
                        <div class="carousel-caption">
                            <h5>Global Cuisines</h5>
                            <p>Experience flavors from around the world.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="resource/sideImg/image3.jpg" class="d-block w-100" alt="Slide 3">
                        <div class="carousel-caption">
                            <h5>Healthy Eating</h5>
                            <p>Explore wholesome and nutritious recipes.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="resource/sideImg/image4.jpg" class="d-block w-100" alt="Slide 4">
                        <div class="carousel-caption">
                            <h5>Quick & Easy</h5>
                            <p>Perfect meals for busy days.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="resource/sideImg/image5.jpg" class="d-block w-100" alt="Slide 5">
                        <div class="carousel-caption">
                            <h5>Share Your Creations</h5>
                            <p>Join our community and share your favorite recipes.</p>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="hero-text text-center mt-4">
                <h1 class="display-4">Welcome to the Digital Recipe Book</h1>
                <p class="lead">Discover, share, and enjoy a collection of amazing recipes.</p>
                <a href="#recipes" class="btn btn-primary btn-lg">Browse Recipes</a>
            </div>
        </div>
    </section>

    <section id="recipes" class="py-5">
        <div class="container">
            <h2 class="mb-4">Our Recipes</h2>
            <div class="row">
                <?php
                $recipe = Database::search("SELECT recipe.recipeId, recipe.recipeName, MAX(recipepic.recipePicture) AS recipePicture FROM recipe INNER JOIN recipepic ON recipepic.recipe_recipeId = recipe.recipeId WHERE recipe.`status`='1' GROUP BY recipe.recipeId, recipe.recipeName LIMIT 6;");
                $recipe_num = $recipe->num_rows;
                if ($recipe_num > 6) {
                    for ($x = 0; $x < 6; $x++) {
                        $recipe_data = $recipe->fetch_assoc();
                ?>
                        <div class="col-md-4 mb-3">
                            <div class="card recipe-card">
                                <?php
                                if ($recipe_data["recipePicture"] == "") {
                                ?>
                                    <img src="resource/recipeImg/image5.jpg" class="card-img-top" alt="Recipe">
                                <?php
                                } else {
                                ?>
                                    <img src="<?php echo $recipe_data["recipePicture"] ?>" class="card-img-top" alt="Recipe">
                                <?php
                                }
                                ?>

                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $recipe_data["recipeName"] ?></h5>
                                    <p class="card-text">A classic Italian pasta dish with creamy sauce.</p>
                                    <a href='<?php echo "singleRecipe.php?id=" . $recipe_data["recipeId"]; ?>' class="btn btn-primary">View Recipe</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else if ($recipe_num == 0) {
                    ?>
                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            No recipes found.
                        </div>
                    </div>
                    <?php
                } else {
                    for ($x = 0; $x < $recipe_num; $x++) {
                        $recipe_data = $recipe->fetch_assoc();
                    ?>
                        <div class="col-md-4 mb-3">
                            <div class="card recipe-card">
                                <?php
                                if ($recipe_data["recipePicture"] == "") {
                                ?>
                                    <img src="resource/recipeImg/image5.jpg" class="card-img-top" alt="Recipe">
                                <?php
                                } else {
                                ?>
                                    <img src="<?php echo $recipe_data["recipePicture"] ?>" class="card-img-top" alt="Recipe">
                                <?php
                                }
                                ?>

                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $recipe_data["recipeName"] ?></h5>
                                    <p class="card-text">A classic Italian pasta dish with creamy sauce.</p>
                                    <a href='<?php echo "singleRecipe.php?id=" . $recipe_data["recipeId"]; ?>' class="btn btn-primary">View Recipe</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>

            <div class="text-end mt-4">
                <a href="recipies.php" class="more-btn">See More...</a>
            </div>
        </div>
    </section>

    <?php include "footer.php" ?>

</body>

</html>