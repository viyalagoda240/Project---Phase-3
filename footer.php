<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Recipe Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="footer.css">
</head>

<body>
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-content-center">
                    <h5>About Us</h5>
                    <p>Digital Recipe Book is your go-to platform for discovering and sharing amazing recipes from
                        around the world.</p>
                </div>
                <div class="col-md-6">
                    <div class="contact-us">
                        <h5>Contact Us</h5>
                        <form>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email" id="senderEmail">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="3" placeholder="Message" id="senderMessage"></textarea>
                            </div>
                            <button type="button" class="btn w-100" onclick="sendMassage()">Send</button>
                        </form>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row mt-4">
                <div class="col-12 text-center social-icons">
                    <a href="#" class="bi bi-facebook"></a>
                    <a href="#" class="bi bi-twitter"></a>
                    <a href="#" class="bi bi-instagram"></a>
                    <a href="#" class="bi bi-youtube"></a>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-12 text-center">
                    <p>&copy; 2024 Digital Recipe Book. All Rights Reserved.</p>
                </div>
            </div>

        </div>
    </footer>

    <script src="footer.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>