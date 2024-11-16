<?php

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $bookId = $_POST['updateBookId'];
    $newTitle = $_POST['updateBookTitle'];
    $newAuthor = $_POST['updateBookAuthor'];
    $newprice = $_POST['updateprice'];


    if (!empty($bookId)) {

        $checkSql = "SELECT * FROM books WHERE book_id = ?";
        if ($checkStmt = $conn->prepare($checkSql)) {
            $checkStmt->bind_param("i", $bookId);
            $checkStmt->execute();
            $result = $checkStmt->get_result();

            if ($result->num_rows > 0) {

                $sql = "UPDATE books SET book_title = ?, book_author = ?, price = ? WHERE book_id = ?";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("ssii", $newTitle, $newAuthor, $bookId, $newprice);

                    if ($stmt->execute()) {
                        echo "<script>alert('Book updated successfully!');
                        window.location = 'updatebook.php';</script>";
                    } else {
                        echo "<p class='alert alert-danger'>Error: " . $stmt->error . "</p>";
                    }

                    $stmt->close();
                } else {
                    echo "<script>alert('Error preparing update statement: " . $conn->error . "');
                    window.location = 'updatebook.php';</script>";
                }
            } else {
                echo "<script>alert('No book found with ID: $bookId');
                window.location = 'updatebook.php';</script>";
            }

            $checkStmt->close();
        } else {
            echo "<p class='alert alert-danger'>Error preparing check statement: " . $conn->error . "</p>";
        }
    } else {
        echo "<p class='alert alert-warning'>Please provide a valid Book ID.</p>";
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
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
            <h4>OUSL Book Store - Update Book</h4>
            <hr/>
            <form id="updateBookForm" method="POST" action="">
                <div class="mb-3">
                    <label for="updateBookId" class="form-label">Book ID</label>
                    <input type="text" class="form-control" name="updateBookId" id="updateBookId" required>
                </div>
                <div class="mb-3">
                    <label for="updateBookTitle" class="form-label">New Title</label>
                    <input type="text" class="form-control" name="updateBookTitle" id="updateBookTitle">
                </div>
                <div class="mb-3">
                    <label for="updateBookAuthor" class="form-label">New Author</label>
                    <input type="text" class="form-control" name="updateBookAuthor" id="updateBookAuthor">
                </div>
                <div class="mb-3">
                    <label for="updateprice" class="form-label">Price ($)</label>
                    <input type="text" class="form-control" name="updateprice" id="updateprice">
                </div>
                <button type="submit" class="btn btn-primary">Update Book</button>
            </form>
        </div>
    </div>

    <script src="bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>

</body>
</html>
