window.onload = function () {
    var previousPage = document.referrer;

    if (previousPage.includes("submitRecipe.php")) {
        showSection('manage-recipes');
    } else {
        showSection('manage-accounts');
    }

};

function submitReply(commentId){
    var reply = document.getElementById("replyText");
    var form = new FormData();
    form.append("c", commentId);
    form.append("r", reply.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var responseText = request.responseText;
            if (responseText == "success") {
                window.location.reload();
            } else {
                alert(responseText);
            }
        } 
    };

    request.open("POST", "addReplyProcess.php", true);
    request.send(form);
}

function setCurrentRecipe(recipeId) {
    var r = new XMLHttpRequest();
    
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            document.getElementById('modalContent').innerHTML = r.responseText;

            var modal = new bootstrap.Modal(document.getElementById('replyModal'));
            modal.show();
        }
    };
    r.open('GET', 'loadReplyModelProcess.php?id=' + recipeId, true);
    r.send();
}

function showSection(sectionId) {
    document.querySelectorAll('.content-section').forEach(section => {
        section.classList.remove('active');
    });

    document.getElementById(sectionId).classList.add('active');

    document.querySelectorAll('.menu-item').forEach(item => {
        item.classList.remove('active');
    });
}

function toggleStatus(button, recipeId) {
    var currentText = button.innerText;
    var newStatus = (currentText === "Activate") ? "1" : "0";

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText;
            if (response === "success") {
                if (newStatus === "1") {
                    button.innerText = "Deactivate";
                    button.classList.remove("btn-active");
                    button.classList.add("btn-inactive");
                } else {
                    button.innerText = "Activate";
                    button.classList.remove("btn-inactive");
                    button.classList.add("btn-active");
                }
            } else {
                alert("Error: " + response);
            }
        }
    };

    r.open("GET", "changeStatus.php?id=" + recipeId + "&status=" + newStatus, true);
    r.send();
}


function addToWatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "removed") {
                document.getElementById("heart" + id).style.className = "text-dark";
                window.location.reload();
            } else if (t == "added") {
                document.getElementById("heart" + id).style.className = "text-danger";
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    r.send();
}

function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("phone");

    var f = new FormData();
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("m", mobile.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Successfully Updated the Profile");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);
}


function changeImage() {
    var view = document.getElementById("viewImg");
    var file = document.getElementById("profileimg");

    file.onchange = function () {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
        updateProfilePic();
    }
}


function updateProfilePic() {
    var image = document.getElementById("profileimg");

    var f = new FormData();
    f.append("image", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Successfully Updated the Profile Pic");
                window.location.reload();
                changeImage();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateprofilePicProcess.php", true);
    r.send(f);
}


function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "signInUp.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "signoutProcess.php", true);
    r.send();

}



