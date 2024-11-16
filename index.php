<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OUSL BookStore - Home</title>
    <link rel="stylesheet" href="bootstrap-5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="assets/font-awesome/css/all.min.css" rel="stylesheet">
    <style>

        html, body {
            overflow: hidden; 
            height: 100%;     
            margin: 0;     
            display: flex;
            flex-direction: column;
            min-height: 100vh;  
        }

        .main-section {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            background: url('bg_image1.jpg') no-repeat center center;
            background-size: cover;
            position: relative;
            overflow: hidden;
        }
        .main-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('bg_image1.jpg') no-repeat center center;
            background-size: cover;
            filter: blur(1px); 
            z-index: 1;
        }
        .main-section .content {
            position: relative;
            z-index: 2; 
            background: rgba(0, 0, 0, 0.6); 
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            text-align: center;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">OUSL BookStore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-section">
        <div class="container" align="center" style="margin-top: -275px; color: #ffffff;">
            <div class="content">
                <h1 class="mb-4">Welcome to OUSL BookStore</h1>
                <p class="lead">Your one-stop destination for browsing and purchasing books online!</p>
                <div class="d-flex justify-content-center mt-4">
                    <a href="cusLogin.php" class="btn btn-primary mx-2">Customer Login</a>
                    <a href="storeAdminLogin.php" class="btn btn-secondary mx-2">Admin Login</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-1">
        <p>&copy; 2024 OUSL BookStore. All Rights Reserved.</p>
    </footer>

    <script src="bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
