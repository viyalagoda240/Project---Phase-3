<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Book - Sign In/Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="signInUp.css" />
</head>

<body>

    <?php
    require "connection.php";
    $username = "";
    $password = "";

    if (isset($_COOKIE["username"])) {
        $username = $_COOKIE["username"];
    }

    if (isset($_COOKIE["password"])) {
        $password = $_COOKIE["password"];
    }
    ?>

    <div class="auth-container">
        <!-- Sign In Form -->
        <form id="signInForm">
            <h3 class="text-center">Sign In</h3>
            <div class="mb-3">
                <label for="signInUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="signInUsername" value="<?php echo $username ?>" placeholder="Enter your username" required>
            </div>
            <div class="mb-3 position-relative">
                <label for="signInPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="signInPassword" value="<?php echo $password ?>" placeholder="Enter your password" required>
                <span class="password-toggle" onclick="togglePasswordVisibility('signInPassword')"><i class="bi bi-eye"></i></span>
            </div>
            <div class="row align-items-center mb-3">
                <div class="col text-start">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMeCheckbox">
                        <label class="form-check-label" for="rememberMeCheckbox">
                            Remember Me
                        </label>
                    </div>
                </div>
                <div class="col text-end">
                    <a href="#" class="text-decoration-none" onclick="toggleFormReset('step1Form')">Reset Password?</a>
                </div>
            </div>
            <button type="button" class="btn btn-primary w-100" onclick="signIn();">Sign In</button>
            <div class="text-center mt-3">
                Don’t have an account? <span class="form-toggle" onclick="toggleForm('signUpForm')">Sign Up</span>
            </div>
        </form>

        <!-- Sign Up Form -->
        <form id="signUpForm" class="d-none">
            <h3 class="text-center">Sign Up</h3>
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" placeholder="Enter your first name" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" placeholder="Enter your last name" required>
            </div>
            <div class="mb-3">
                <label for="signUpUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="signUpUsername" placeholder="Choose a username" required>
            </div>
            <div class="mb-3">
                <label for="signUpEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="signUpEmail" placeholder="Enter your email" required>
            </div>
            <div class="mb-3 position-relative">
                <label for="signUpPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="signUpPassword" placeholder="Create a password" required>
                <span class="password-toggle" onclick="togglePasswordVisibility('signUpPassword')"><i class="bi bi-eye"></i></span>
            </div>
            <div class="mb-3 position-relative">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password" required>
                <span class="password-toggle" onclick="togglePasswordVisibility('confirmPassword')"><i class="bi bi-eye"></i></span>
            </div>
            <button type="button" class="btn btn-primary w-100" onclick="signUp()">Sign Up</button>
            <div class="text-center mt-3">
                Already have an account? <span class="form-toggle" onclick="toggleForm('signInForm')">Sign In</span>
            </div>
        </form>

        <form id="step1Form" class="d-none">
            <h3 class="text-center mb-4">Forgot Password</h3>
            <p>Enter your username or email address to receive a confirmation code.</p>
            <div class="mb-3">
                <label for="usernameOrEmail" class="form-label">Username or Email</label>
                <input type="text" id="resetPwEmail" class="form-control" placeholder="Enter username or email" required>
            </div>
            <div class="row align-items-center">
                <div class="col-auto">
                    <button class="btn btn-secondary w-100" onclick="toggleFormReset('signInForm')">Back</button>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-primary w-100" onclick="sendConfirmationCode()">Send Confirmation Code</button>
                </div>
            </div>
        </form>


        <form id="step2Form" class="d-none">
            <h3 class="text-center mb-4">Forgot Password</h3>
            <p>A confirmation code has been sent to your email. Please enter it below:</p>
            <form id="step2Form">
                <div class="mb-3">
                    <label for="confirmationCode" class="form-label">Confirmation Code</label>
                    <input type="text" id="confirmationCode" class="form-control" placeholder="Enter confirmation code" required>
                    <div class="text-end mt-2">
                        <a href="#" class="text-decoration-none" onclick="sendConfirmationCode()">Didn't receive it? Resend the confirmation code</a>
                    </div>
                </div>
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <button type="button" class="btn btn-primary w-100" onclick="verify()">Verify Code</button>
                    </div>
                </div>
                <div class="row g-2 justify-content-end mt-3">
                    <div class="col-6 col-md-auto">
                        <button class="btn btn-secondary w-100" onclick="toggleFormReset('step1Form')">Back</button>
                    </div>
                    <div class="col-6 col-md-auto">
                        <button class="btn btn-danger w-100" onclick="toggleFormReset('signInForm')">Cancel</button>
                    </div>
                </div>
            </form>

            <form id="step3Form" class="d-none">
                <h3 class="text-center mb-4">Forgot Password</h3>
                <p>Enter your new password below:</p>
                <div class="mb-3 position-relative">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" id="newPassword" class="form-control" placeholder="Enter new password" required>
                    <span class="password-toggle" onclick="togglePasswordVisibility('newPassword')"><i class="bi bi-eye"></i></span>
                </div>
                <div class="mb-3 position-relative">
                    <label for="confirmNewPassword" class="form-label">Confirm Password</label>
                    <input type="password" id="confirmNewPassword" class="form-control" placeholder="Confirm new password" required>
                    <span class="password-toggle" onclick="togglePasswordVisibility('confirmNewPassword')"><i class="bi bi-eye"></i></span>
                </div>
                <button type="button" class="btn btn-primary w-100" onclick="resetPassword()">Reset Password</button>
                <div class="offset-lg-6 col-lg-6 col-12 offset-0 mt-3">
                    <button class="btn btn-danger w-100" onclick="toggleFormReset('signInForm')">Cancel</button>
                </div>

            </form>

    </div>

    <script src="signInUp.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>