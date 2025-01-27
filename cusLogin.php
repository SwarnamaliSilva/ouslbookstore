<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OUSLBookStore - Login</title>
    <link rel="stylesheet" href="bootstrap-5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="assets/font-awesome/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="bodyContainer">
        <div class="bodyContent">

            <div class="form">
                <div class="formContent">
                    <h2 class="fw-bold">Welcome to OUSLBookStore</h2>
                    <p class="text-muted">Please login to your account.</p>

                    <form action="login.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <p class="mt-3 textsignup">New to BookStore? <a class="textsignup2" href="cusSignup.php">Sign Up</a></p>
                    <p class="mt-3 textsignup"><a class="textsignup2" href="index.php">Click to go <i class="fa-solid fa-house"></i> Home</a></p>
                </div>
            </div>
            
            <div class="formImage">
                <div class="formImageSection">
                    <img class="img-fluid " alt="Responsive Image" src="login1.png">
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
