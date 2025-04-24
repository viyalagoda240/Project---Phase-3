<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #495057;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar a {
                padding: 10px;
                text-align: center;
            }
        }

        .content-section {
            display: none;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h3 class="text-center">Admin Panel</h3>
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
        <div id="manage-accounts" class="content-section">
            <h2>Manage Accounts</h2>
            <p>Here you can add, edit, and delete user accounts.</p>
            <button class="btn btn-primary">Add Account</button>
            <button class="btn btn-warning">Edit Account</button>
            <button class="btn btn-danger">Delete Account</button>
        </div>

        <div id="manage-recipes" class="content-section">
            <h2>Manage Recipes</h2>
            <p>Here you can add, edit, and delete recipes.</p>
            <button class="btn btn-primary">Add Recipe</button>
            <button class="btn btn-warning">Edit Recipe</button>
            <button class="btn btn-danger">Delete Recipe</button>
        </div>

        <div id="settings" class="content-section">
            <h2>Settings</h2>
            <p>Customize your application settings here.</p>
            <button class="btn btn-secondary">Change Password</button>
            <button class="btn btn-secondary">Update Preferences</button>
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => section.style.display = 'none');

            const selectedSection = document.getElementById(sectionId);
            selectedSection.style.display = 'block';

            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => item.classList.remove('active'));
            document.querySelector(`[href="#${sectionId}"]`).classList.add('active');
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSection('manage-accounts');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
