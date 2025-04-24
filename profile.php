<?php
session_start();
if (isset($_SESSION["u"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Responsive Admin Dashboard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="profile.css" />
        <style>

        </style>
    </head>

    <body>
        <?php
        include "connection.php";
        
        $username = $_SESSION["u"]["username"];
        $details_rs = Database::search("SELECT * FROM `user` WHERE `username`='" . $username . "'");
        $data = $details_rs->fetch_assoc();
        ?>
        <div class="position-fixed top-0 start-0 w-100" style="z-index: 9999;">
            <?php include "header01.php"; ?>
        </div>

        <div class="sidebar">
            <div class="profile-card">

                <input type="file" class="d-none" id="profileimg" accept="image/*" />
                <?php
                if (empty($data["profilePic"])) {
                ?>
                    <label for="profileimg">
                        <img src="resource/profilePic/pic1.jpg" class="profile-pic" alt="Profile Picture" onclick="changeImage();" id="viewImg" />
                    </label>
                <?php
                } else {
                ?>
                    <label for="profileimg">
                        <img src="<?php echo htmlspecialchars($data["profilePic"]); ?>" class="profile-pic" alt="Profile Picture" onclick="changeImage();" id="viewImg" />
                    </label>
                <?php
                }
                ?>
            </div>
            <h5 class="text-center"><?php echo $data["firstname"] . " " . $data["lastname"] ?></h5>
            <hr />
            <a href="#manage-accounts" class="menu-item active" onclick="showSection('manage-accounts')">
                <i class="bi bi-person"></i> Manage Accounts
            </a>
            <a href="#manage-recipes" class="menu-item" onclick="showSection('manage-recipes')">
                <i class="bi bi-book"></i> Manage Recipes
            </a>
            <a href="#settings" class="menu-item" onclick="showSection('settings')">
                <i class="bi bi-gear"></i> Settings
            </a>
        </div>


        <div class="main-content">
            <div id="manage-accounts" class="content-section active">
                <div class="profile-update-container">
                    <h2 class="form-title">Update Profile</h2>
                    <form>
                        <div class="mb-3">
                            <label for="fName" class="form-label">User Name</label>
                            <input type="text" value="<?php echo $data["username"] ?>" class="form-control" id="username" placeholder="Enter your full name" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="fName" class="form-label">First Name</label>
                            <input type="text" value="<?php echo $data["firstname"] ?>" class="form-control" id="fname" placeholder="Enter your First name">
                        </div>

                        <div class="mb-3">
                            <label for="lName" class="form-label">Last Name</label>
                            <input type="text" value="<?php echo $data["lastname"] ?>" class="form-control" id="lname" placeholder="Enter your Last name">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" value="<?php echo $data["email"] ?>" class="form-control" id="email" placeholder="Enter your Email" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" value="<?php echo $data["mobile"] ?>" class="form-control" id="phone" placeholder="Enter your Phone number">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" value="<?php echo $data["password"] ?>" class="form-control" id="password" readonly>
                        </div>

                        <button type="button" class="btn btn-primary w-100" onclick="updateProfile()">Update Profile</button>
                    </form>
                </div>
            </div>

            <div id="manage-recipes" class="content-section">
                <div class="container-recipe">
                    <h1>Recipe Management</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Rating</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $recipeData = Database::search("SELECT * FROM `recipe` WHERE `user_username`='" . $username . "'");
                            $recipe_num = $recipeData->num_rows;
                            for ($x = 0; $x < $recipe_num; $x++) {
                                $recipe = $recipeData->fetch_assoc();
                            ?>
                                <tr>
                                    <td data-label="Name"><?php echo $recipe['recipeName']; ?></td>
                                    <td data-label="Rating">2</td>
                                    <td data-label="Actions">
                                        <button class="btn-action btn-view" onclick="window.location.href='<?php echo 'singleRecipe.php?id=' . $recipe['recipeId']; ?>'">View</button>
                                        <?php
                                        if ($recipe['status'] == 1) {
                                        ?>
                                            <button class="btn-action btn-inactive" onclick="toggleStatus(this, <?php echo $recipe['recipeId']; ?>)">Deactivate</button>
                                        <?php
                                        } else {
                                        ?>
                                            <button class="btn-action btn-active" onclick="toggleStatus(this, <?php echo $recipe['recipeId']; ?>)">Activate</button>
                                        <?php
                                        }
                                        ?>
                                        <button class="btn-action btn-reply" onclick="setCurrentRecipe(<?php echo $recipe['recipeId']; ?>)">Reply to Comments</button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>

            <div id="settings" class="content-section">
                <h2>Settings</h2>
                <p>Customize your application settings here.</p>
                <button class="btn btn-secondary">Change Password</button>
                <button class="btn btn-danger" onclick="signout();">Sign Out</button>
            </div>
        </div>

        <div class="d-block d-md-none">
            <?php include "footer01.php" ?>
        </div>

        <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="replyModalLabel">Reply to Comment</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modalContent" class="container mt-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="profile.js"></script>
    </body>

    </html>
<?php
} else {
    echo "Please sign in first.";
    header("Location: signInUp.php");
    exit();
}
?>