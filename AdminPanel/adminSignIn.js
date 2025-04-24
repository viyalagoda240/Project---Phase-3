toggleForm('step1Form');
function toggleForm(formToShow) {
    const signInForm = document.getElementById('step1Form');
    const signUpForm = document.getElementById('step2Form');
    if (formToShow === 'step1Form') {
        step1Form.classList.remove('d-none');
        step2Form.classList.add('d-none');
    } else {
        step2Form.classList.remove('d-none');
        step1Form.classList.add('d-none');
    }
}

function signIn() {

    var username = document.getElementById("adminEmail");
    var password = document.getElementById("confirmationCode");

    var form = new FormData();
    form.append("u", username.value);
    form.append("p", password.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var responseText = request.responseText;
            if (responseText == "success") {
                window.location = "adminDashboard.php";
            } else {
                alert(responseText);
            }
        }
    };

    request.open("POST", "verifyConfirmationCodeProcess.php", true);
    request.send(form);
}

function sendConfirmationCode() {

    const step1 = document.getElementById('step1Form');
    const step2 = document.getElementById('step2Form');
    var email = document.getElementById("adminEmail");

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

    r.open("GET", "sendAdminVerificationCode.php?e=" + email.value, true);
    r.send();

}