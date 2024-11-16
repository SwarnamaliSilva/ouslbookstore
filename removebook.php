<?php

    include 'db_connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $bookId = $_POST['removeBookId'];

        $stmt = $conn->prepare("DELETE FROM books WHERE book_id = ?");
        $stmt->bind_param("i", $bookId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Book with ID $bookId has been removed successfully!');
            window.location = 'removebook.php';</script>";
        } 
        else {
            echo "<script>alert('No book found with ID $bookId. Please check the ID and try again');
            window.location = 'removebook.php';</script>";
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
    <title>Remove Book</title>
    <link rel="stylesheet" href="bootstrap-5.3.3/css/bootstrap.min.css">
    <style>
        .content-center {
            display: flex;
            justify-content: center;
            align-items: flex-start; 
            min-height: 80vh;
            margin-top: 50px; 
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
            <h4>OUSL Book Store - Remove Book</h4>
            <hr/>
            <form id="removeBookForm" action="removebook.php" method="POST">
                <div class="mb-3">
                    <label for="removeBookId" class="form-label">Book ID</label>
                    <input type="text" class="form-control" name="removeBookId" id="removeBookId" required>
                </div>
                <button type="submit" class="btn btn-danger">Remove Book</button>
            </form>
        </div>
    </div>

    <script src="bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
