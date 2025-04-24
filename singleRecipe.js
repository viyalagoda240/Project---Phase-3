function submitComment(recipeId) {
    var comment = document.getElementById("commentContian");

    var form = new FormData();
    form.append("i", recipeId);
    form.append("c", comment.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var responseText = request.responseText;
            if (responseText == "success") {
                window.location.reload();
            } else if (responseText == "Please Sign In.") {
                alert(responseText);
                window.location = "signInUp.php";
            } else {
                alert(responseText);
            }
        }
    };

    request.open("POST", "addCommentProcess.php", true);
    request.send(form);
}