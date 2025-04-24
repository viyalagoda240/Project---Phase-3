function sendMassage(){
    var email = document.getElementById("senderEmail").value;
    var message = document.getElementById("senderMessage").value;
    
    var f = new FormData();
    f.append("email",email);
    f.append("message",message);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "success"){
                alert("Thank you for your message. We will get back to you soon.");
                document.getElementById("senderEmail").value = "";
                document.getElementById("senderMessage").value = ""; 
            } else {
                alert(t);
            } 
        }
    }

    r.open("POST","contactUs.php",true);
    r.send(f);
}