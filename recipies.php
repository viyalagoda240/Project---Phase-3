<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Recipe Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .recipe-card img {
            height: 200px;
            object-fit: cover;
        }

        .hero {
            padding-top: 120px;
        }
    </style>
</head>

<body>

    <div class="col-12 m-0" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 9999;">
        <?php include 'header.php'; ?>
    </div>

    <?php

    $pageno;

    if (isset($_GET["page"])) {
        $pageno = $_GET["page"];
    } else {
        $pageno = 1;
    }

    $showText = "Our Recipes";

    $query = "SELECT recipe.recipeId, recipe.recipeName, MAX(recipepic.recipePicture) AS recipePicture FROM recipe INNER JOIN recipepic ON recipepic.recipe_recipeId = recipe.recipeId";

    if (isset($_GET["category"])) {
        $category = $_GET["category"];
        $query .= " INNER JOIN recipe_has_category ON recipe_has_category.recipe_recipeId = recipe.recipeId INNER JOIN category ON category.categoryId = recipe_has_category.category_categoryId WHERE category.categoryName = '$category'";
        $showText = "Category By : " . $category;
    }

    if (isset($_GET["search"])) {
        $search = $_GET["search"];
        $query .= " WHERE recipe.recipeName LIKE '%$search%'";
        $showText = "Search By : " . $search;
    }

    $query .= " GROUP BY recipe.recipeId, recipe.recipeName";
    ?>

    <section id="recipes" class="py-5">
        <div class="container hero">
            <h2 class="mb-4"><?php echo $showText; ?></h2>
            <div class="row">
                <?php
                $recipe_rs = Database::search($query . " ORDER BY recipe.recipeId DESC LIMIT 7 OFFSET " . ($pageno - 1) * 6 . "");
                $recipe_num = $recipe_rs->num_rows;

                if ($recipe_num == 7) {
                    $have_more_pages = 1;
                    $recipe_num = 6;
                } else {
                    $have_more_pages = 0;
                }

                for ($x = 0; $x < $recipe_num; $x++) {
                    $recipe_data = $recipe_rs->fetch_assoc();
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
                ?>
            </div>

            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php
                    if ($pageno == 1 && $have_more_pages == 1) {
                    ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item">
                            <?php
                            if (isset($_GET["category"]) && !isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno + 1; ?>&category=<?php echo $category; ?>">Next</a>
                            <?php
                            }
                            if (!isset($_GET["category"]) && isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno + 1; ?>&search=<?php echo $search; ?>">Next</a>
                            <?php
                            }
                            if (isset($_GET["category"]) && isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno + 1; ?>&category=<?php echo $category; ?>&search=<?php echo $search; ?>">Next</a>
                            <?php
                            }
                            if (!isset($_GET["category"]) && !isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno + 1; ?>">Next</a>
                            <?php
                            }
                            ?>
                        </li>
                    <?php
                    } else if ($pageno == 1 && $have_more_pages == 0) {
                    ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a>
                        </li>
                    <?php
                    } else if ($pageno != 1 && $have_more_pages == 1) {
                    ?>
                        <li class="page-item">
                            <?php
                            if (isset($_GET["category"]) && !isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno - 1; ?>&category=<?php echo $category; ?>">Previous</a>
                            <?php
                            }
                            if (!isset($_GET["category"]) && isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno - 1; ?>&search=<?php echo $search; ?>">Previous</a>
                            <?php
                            }
                            if (isset($_GET["category"]) && isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno - 1; ?>&category=<?php echo $category; ?>&search=<?php echo $search; ?>">Previous</a>
                            <?php
                            }
                            if (!isset($_GET["category"]) && !isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno - 1; ?>">Previous</a>
                            <?php
                            }
                            ?>
                        </li>
                        <li class="page-item" aria-current="page">
                            <a class="page-link" href="#"><?php echo $pageno - 1 ?></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#"><?php echo $pageno ?></a></li>
                        <li class="page-item"><a class="page-link" href="#"><?php echo $pageno + 1 ?></a></li>
                        <li class="page-item">
                            <?php
                            if (isset($_GET["category"]) && !isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno + 1; ?>&category=<?php echo $category; ?>">Next</a>
                            <?php
                            }
                            if (!isset($_GET["category"]) && isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno + 1; ?>&search=<?php echo $search; ?>">Next</a>
                            <?php
                            }
                            if (isset($_GET["category"]) && isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno + 1; ?>&category=<?php echo $category; ?>&search=<?php echo $search; ?>">Next</a>
                            <?php
                            }
                            if (!isset($_GET["category"]) && !isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno + 1; ?>">Next</a>
                            <?php
                            }
                            ?>
                        </li>
                    <?php
                    } else if ($pageno != 1 && $have_more_pages == 0) {
                    ?>
                        <li class="page-item">
                            <?php
                            if (isset($_GET["category"]) && !isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno - 1; ?>&category=<?php echo $category; ?>">Previous</a>
                            <?php
                            }
                            if (!isset($_GET["category"]) && isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno - 1; ?>&search=<?php echo $search; ?>">Previous</a>
                            <?php
                            }
                            if (isset($_GET["category"]) && isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno - 1; ?>&category=<?php echo $category; ?>&search=<?php echo $search; ?>">Previous</a>
                            <?php
                            }
                            if (!isset($_GET["category"]) && !isset($_GET["search"])) {
                            ?>
                                <a class="page-link" href="recipies.php?page=<?php echo $pageno - 1; ?>">Previous</a>
                            <?php
                            }
                            ?>
                        </li>
                        <li class="page-item " aria-current="page">
                            <a class="page-link" href="#"><?php echo $pageno - 1 ?></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#"><?php echo $pageno ?></a></li>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            </nav>
        </div>
    </section>

    <?php include "footer01.php" ?>

</body>

</html>