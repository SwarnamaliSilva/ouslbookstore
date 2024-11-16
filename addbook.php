<?php

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $book_title = isset($_POST['book_title']) ? $_POST['book_title'] : null;
    $book_author = isset($_POST['book_author']) ? $_POST['book_author'] : null;
    $book_description = isset($_POST['book_description']) ? $_POST['book_description'] : null;

    $book_image = null; 
    if (isset($_FILES['book_image']) && $_FILES['book_image']['error'] == 0) {
        $allowedFileType = "image/png";
        if ($_FILES['book_image']['type'] == $allowedFileType) 
        {
            $book_image = file_get_contents($_FILES['book_image']['tmp_name']);
        } 
        else 
        {
            echo "Only PNG images are allowed.";
            exit();
        }
    }

    $book_pdf = null; 
    if (isset($_FILES['book_pdf']) && $_FILES['book_pdf']['error'] == 0) {
        $allowedPdfType = "application/pdf";
        if ($_FILES['book_pdf']['type'] == $allowedPdfType) 
        {
            $book_pdf = file_get_contents($_FILES['book_pdf']['tmp_name']);
        } 
        else 
        {
            echo "Only PDF files are allowed for the book PDF.";
            exit();
        }
    }

    $price = isset($_POST['price']) ? $_POST['price'] : null;

    $stmt = $conn->prepare("INSERT INTO books (book_title, book_author, book_description, book_image, book_pdf,price) VALUES (?, ?, ?, ?, ?,?)");
    $stmt->bind_param("sssssi", $book_title, $book_author, $book_description, $book_image, $book_pdf,$price);

    if ($stmt->execute()) {
        echo "<script>alert('Book added successfully!');
        window.location = 'addbook.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="bootstrap-5.3.3/css/bootstrap.min.css">
    <style>
        .content-center {
            display: flex;
            justify-content: center;
            align-items: flex-start; 
            min-height: 80vh;
            margin-top: 50px;
            margin-bottom:50px; 
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="storeAdminDashboard.php">OUSLBookStore Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="storeAdminDashboard.php">Display Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addbook.php">Add Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="updatebook.php">Update Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="removebook.php">Remove Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="salesreport.php">Sales Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" onclick="return confirm('Are you sure you want to log out?')">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="content-center">
        <div class="tab-content w-50 mx-auto p-4 bg-white shadow rounded">
            <h4>OUSL Book Store - Add Book</h4>
            <hr/>
            <form id="addBookForm" method="POST" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="book_title" class="form-label">Book Title</label>
                    <input type="text" class="form-control" name="book_title" id="book_title" required>
                </div>
                <div class="mb-3">
                    <label for="book_author" class="form-label">Author</label>
                    <input type="text" class="form-control" name="book_author" id="book_author" required>
                </div>
                <div class="mb-3">
                    <label for="book_description" class="form-label">Book Description</label>
                    <textarea class="form-control" name="book_description" id="book_description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="book_image" class="form-label">Book Image (PNG only)</label>
                    <input type="file" class="form-control" name="book_image" id="book_image" accept="image/png" required>
                </div>
                <div class="mb-3">
                    <label for="book_pdf" class="form-label">Book PDF (PDF only)</label>
                    <input type="file" class="form-control" name="book_pdf" id="book_pdf" accept="application/pdf" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="text" class="form-control" name="price" id="price" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Book</button>
            </form>
        </div>
    </div>

    <script src="bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
