toggleForm('signInForm');
function toggleForm(formToShow) {
    const signInForm = document.getElementById('signInForm');
    const signUpForm = document.getElementById('signUpForm');

    if (formToShow === 'signInForm') {
        signInForm.classList.remove('d-none');
        signUpForm.classList.add('d-none');
    } else {
        signUpForm.classList.remove('d-none');
        signInForm.classList.add('d-none');
    }
}

function toggleFormReset(formToShow) {
    const signInForm = document.getElementById('signInForm');
    const step1 = document.getElementById('step1Form');
    const step2 = document.getElementById('step2Form');
    const step3 = document.getElementById('step3Form');

    if (formToShow === 'signInForm') {
        signInForm.classList.remove('d-none');
        step1.classList.add('d-none');
        step2.classList.add('d-none');
        step3.classList.add('d-none');
    } else if (formToShow === 'step1Form') {
        signInForm.classList.add('d-none');
        step1.classList.remove('d-none');
        step2.classList.add('d-none');
        step3.classList.add('d-none');
    } else if (formToShow === 'step2Form') {
        signInForm.classList.add('d-none');
        step1.classList.add('d-none');
        step2.classList.remove('d-none');
        step3.classList.add('d-none');
    } else if (formToShow === 'step3Form') {
        signInForm.classList.add('d-none');
        step1.classList.add('d-none');
        step2.classList.add('d-none');
        step3.classList.remove('d-none');
    }
}

function togglePasswordVisibility(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const toggleIcon = passwordField.nextElementSibling.querySelector('i');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    }
}

function signIn() {

    var username = document.getElementById("signInUsername");
    var password = document.getElementById("signInPassword");
    var rememberme = document.getElementById("rememberMeCheckbox");

    var form = new FormData();
    form.append("u", username.value);
    form.append("p", password.value);
    form.append("r", rememberme.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var responseText = request.responseText;
            if (responseText == "success") {
                window.location = "index.php";
            } else {
                alert(responseText);
            }
        }
    };

    request.open("POST", "signInProcess.php", true);
    request.send(form);
}

function sendConfirmationCode() {

    const step1 = document.getElementById('step1Form');
    const step2 = document.getElementById('step2Form');
    var email = document.getElementById("resetPwEmail");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Verification code has sent to your email. Please check your inbox");
                step1.classList.add('d-none');
                step2.classList.remove('d-none');
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "sendConfirmationCodeProcess.php?e=" + email.value, true);
    r.send();

}

function verify() {

    var email = document.getElementById("resetPwEmail");
    var vcode = document.getElementById("confirmationCode");

    var f = new FormData();
    f.append("e", email.value);
    f.append("v", vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert('Confirmation is Success. Enter your New password.');
                const step2 = document.getElementById('step2Form');
                const step3 = document.getElementById('step3Form');
                step2.classList.add('d-none');
                step3.classList.remove('d-none');
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "verifyConfirmationCodeProcess.php", true);
    r.send(f);

}

function resetPassword() {

    var email = document.getElementById("resetPwEmail");
    var np = document.getElementById("newPassword");
    var rnp = document.getElementById("confirmNewPassword");

    var f = new FormData();
    f.append("e", email.value);
    f.append("n", np.value);
    f.append("r", rnp.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert('Password reset success');
                const signInForm = document.getElementById('signInForm');
                const step3 = document.getElementById('step3Form');
                signInForm.classList.remove('d-none');
                step3.classList.add('d-none');
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "resetPassword.php", true);
    r.send(f);

}

function signUp() {

    var f = document.getElementById("firstName");
    var l = document.getElementById("lastName");
    var u = document.getElementById("signUpUsername");
    var e = document.getElementById("signUpEmail");
    var p = document.getElementById("signUpPassword");
    var c = document.getElementById("confirmPassword");
    const signInForm = document.getElementById('signInForm');
    const signUpForm = document.getElementById('signUpForm');

    var form = new FormData;
    form.append("f", f.value);
    form.append("l", l.value);
    form.append("u", u.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("c", c.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "success") {
                alert("Sign-up successful! You can now sign in to your account.");
                signUpForm.classList.add('d-none');
                signInForm.classList.remove('d-none');
            } else {
                alert(text);
            }
        }
    }

    request.open("POST", "signUpProcess.php", true);
    request.send(form);

}