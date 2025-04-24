function showSection(event, sectionId) {
    event.preventDefault();

    document.querySelectorAll('.content-section').forEach(section => {
        section.classList.remove('active');
    });

    document.getElementById(sectionId).classList.add('active');

    document.querySelectorAll('.menu-item').forEach(item => {
        item.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
}

function signOut() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var responseText = request.responseText;
            if (responseText == "success") {
                window.location = "adminSignIn.php";
            } else {
                alert(responseText);
            }
        }
    };

    request.open("POST", "signOutProcess.php", true);
    request.send();
}

function changeUserStatus(button, userId) {
    
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

    r.open("GET", "changeUserStatus.php?id=" + userId + "&status=" + newStatus, true);
    r.send();
}

function searchUser() {
    var searchValue = document.getElementById('searchUser').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'searchUser.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.querySelector('tbody').innerHTML = xhr.responseText;
        }
    };
    xhr.send('query=' + encodeURIComponent(searchValue));
}

function changeRecipeStatus(button, recipeId) {
    
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

    r.open("GET", "changeRecipeStatus.php?id=" + recipeId + "&status=" + newStatus, true);
    r.send();
}

function searchRecipe() {
    var searchValue = document.getElementById('searchRecipe').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'searchRecipe.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.querySelector('#recipeTable tbody').innerHTML = xhr.responseText;
        }
    };
    xhr.send('query=' + encodeURIComponent(searchValue));
}

function viewMessage(messageId) {
    
    var r = new XMLHttpRequest();
    
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            document.getElementById('modalContent').innerHTML = r.responseText;

            var modal = new bootstrap.Modal(document.getElementById('replyModal'));
            modal.show();
        }
    };
    r.open('GET', 'loadReplyModelProcess.php?id=' + messageId, true);
    r.send();
}

function submitReply(messageId){
    alert("submitting reply");
    var reply = document.getElementById("replyText");
    var form = new FormData();
    form.append("c", messageId);
    form.append("r", reply.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var responseText = request.responseText;
            if (responseText == "Success") {
                alert("Successfully sent the reply!");
                window.location.reload();
            } else {
                alert(responseText);
            }
        }
    };

    request.open("POST", "addReplyProcess.php", true);
    request.send(form);
}

function showUserRecipe(username) {
    document.querySelectorAll('.content-section').forEach(section => {
        section.classList.remove('active');
    });

    document.getElementById('manage-recipes').classList.add('active');

    document.querySelectorAll('.menu-item').forEach(item => {
        item.classList.remove('active');
    });

    document.getElementById('aaa').classList.add('active');
    document.getElementById('searchRecipe').value = username;

    searchRecipe();
}


