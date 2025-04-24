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

        .profile-btn {
            color: rgb(146, 146, 146);
            font-size: 1.5rem;
            transition: transform 0.2s, color 0.2s;
        }

        .profile-btn:hover {
            color: #ffffff;
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        if($current_page == 'singleRecipe.php') {
            $current_page = 'recipies.php';
        }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Recipe Book</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'recipies.php') ? 'active' : ''; ?>" href="recipies.php">Recipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'submitRecipe.php') ? 'active' : ''; ?>" href="submitRecipe.php">Submit Recipe</a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link d-lg-none <?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
        <a class="navbar-brand justify-content-end d-none d-lg-block profile-btn" href="profile.php"><label><i class="bi bi-person-circle"></i></label></a>
    </nav>

</body>

</html>