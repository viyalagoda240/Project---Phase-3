<?php
session_start();
if (isset($_SESSION["admin"])) {
    require "connection.php";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="adminDashboard.css" />
    </head>

    <body>

        <header class="admin-header py-3">
            <div class="col-12">
                <div class="row m-2">
                    <div class="col-8 col-md-4">
                        <p class="m-2">Admin Name: Dilshan Udesh</p>
                    </div>
                    <div class="col-md-4 d-none d-md-block text-center">
                        <h2 class="m-0">Admin Dashboard</h2>
                    </div>
                    <div class="col-4 col-md-4 text-end">
                        <button class="btn btn-danger" onclick="signOut();">Logout</button>
                    </div>
                </div>
            </div>
        </header>

        <div class="sidebar">
            <a href="#manage-accounts" class="menu-item active" onclick="showSection(event, 'manage-accounts')">
                <i class="bi bi-person"></i> Manage Accounts
            </a>
            <a id="aaa" href="#manage-recipes" class="menu-item" onclick="showSection(event, 'manage-recipes')">
                <i class="bi bi-book"></i> Manage Recipes
            </a>
            <a href="#reply" class="menu-item" onclick="showSection(event, 'reply')">
                <i class="bi bi-gear"></i> Reply Area
            </a>
            <a href="#settings" class="menu-item" onclick="showSection(event, 'settings')">
                <i class="bi bi-gear"></i> Settings
            </a>
        </div>

        <div class="main-content">
            <div id="manage-accounts" class="content-section active">
                <div class="container-recipe">
                    <h1>Users Management</h1>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search Username or Email" id="searchUser" onchange="searchUser()" oninput="searchUser()">
                        <button class="btn btn-outline-secondary" type="button" onclick="searchUser();">Search</button>
                    </div>

                    <table id="userTable">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rs = Database::search("SELECT * FROM `user`");
                            $nun = $rs->num_rows;
                            for ($x = 0; $x < $nun; $x++) {
                                $d = $rs->fetch_assoc();
                            ?>
                                <tr>
                                    <td data-label="Name"><?php echo $d["firstname"] . " " . $d["lastname"]; ?></td>
                                    <td data-label="Rating"><?php echo $d["email"]; ?></td>
                                    <td data-label="Actions">
                                        <a href="#manage-recipes" class="btn-action btn-view" onclick="showUserRecipe('<?php echo $d['username'] ?>')">Recipies</a>
                                        <?php
                                        if ($d["status"] == 1) {
                                        ?>
                                            <button class="btn-action btn-inactive" onclick="changeUserStatus(this, '<?php echo $d['username']; ?>')">Deactivate</button>
                                        <?php
                                        } else {
                                        ?>
                                            <button class="btn-action btn-active" onclick="changeUserStatus(this, '<?php echo $d['username']; ?>')">Activate</button>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="manage-recipes" class="content-section">
                <div class="container-recipe">
                    <h1>Recipe Management</h1>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search recipe name or recipe owner's username" id="searchRecipe" onchange="searchRecipe()" oninput="searchRecipe()">
                        <button class="btn btn-outline-secondary" type="button" onclick="searchRecipe()">Search</button>
                    </div>

                    <table id="recipeTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Rating</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rs = Database::search("SELECT * FROM `recipe`");
                            $nun = $rs->num_rows;
                            for ($x = 0; $x < $nun; $x++) {
                                $d = $rs->fetch_assoc();
                            ?>
                                <tr>
                                    <td data-label="Name"><?php echo $d["recipeName"]; ?></td>
                                    <td data-label="Rating">4.2</td>
                                    <td data-label="Actions">
                                        <a href="../Project---Phase-3/singleRecipe.php?id=<?php echo $d['recipeId']; ?>" class="btn-action btn-view">View</a>
                                        <?php
                                        if ($d["status"] == 1) {
                                        ?>
                                            <button class="btn-action btn-inactive" onclick="changeRecipeStatus(this, '<?php echo $d['recipeId']; ?>')">Deactivate</button>
                                        <?php
                                        } else {
                                        ?>
                                            <button class="btn-action btn-active" onclick="changeRecipeStatus(this, '<?php echo $d['recipeId']; ?>')">Activate</button>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="reply" class="content-section">
                <div class="container-recipe">
                    <h1>Reply Area</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Actions</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rs = Database::search("SELECT * FROM `contactus`");
                            $nun = $rs->num_rows;
                            for ($x = 0; $x < $nun; $x++) {
                                $d = $rs->fetch_assoc();
                            ?>
                                <tr>
                                    <td data-label="Email"><?php echo $d["senderEmail"] ?></td>
                                    <td data-label="Actions">
                                        <button class="btn-action btn-view" onclick="viewMessage('<?php echo $d['massageId']; ?>')">View</button>
                                    </td>
                                    <?php
                                    if ($d["status"] == 1) {
                                    ?>
                                        <td data-label="status">Not Viewed</td>
                                    <?php
                                    } else {
                                    ?>
                                        <td data-label="status">Viewed</td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="settings" class="content-section">
                <div class="container-recipe">
                    <h1>Settings</h1>
                    <p>Customize your application settings here.</p>
                    <button onclick="signOut();" class="btn btn-secondary">Sign Out</button>
                </div>
            </div>

        </div>

        <div class="d-block d-md-none">
            <?php include "footer.php" ?>
        </div>


        <!-- Reply Modal -->
        <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="replyModalLabel">Reply to Message</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modalContent" class="container mt-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="adminDashboard.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: adminSignIn.php");
    exit();
}
?>