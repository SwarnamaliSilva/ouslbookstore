<?php
include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Admin Dashboard</title>
    <link rel="stylesheet" href="bootstrap-5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="assets/font-awesome/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

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
    <div class="container">
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
                    <a class="nav-link" href="salesreport.php">Sales Report &nbsp; &nbsp;</a>
                </li>
                
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                        <span><i class="fa-solid fa-user-tie" style="font-size:20px; margin-top:5px;"></i></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="logout.php" onclick="return confirm('Are you sure you want to log out?')">Logout</a></li>
                    </ul>
                </div>
            </ul>
        </div>
    </div>
</nav>


        <div class="content-center">
            <div class="tab-content w-75 mx-auto p-4 bg-white shadow rounded">
                <h4>OUSL Book Store - Display Books</h4><hr/>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Description</th>
                            <th>Price ($)</th>
                        </tr>
                    </thead>

                    <?php
                    
                        $sql = "SELECT * FROM books";

                        $result = mysqli_query($conn, $sql);

                        $resultcheck = mysqli_num_rows($result);

                        if($resultcheck > 0){

                            while($row = mysqli_fetch_assoc($result)){

                    ?>

                    <tbody id="bookList">
                        <tr>
                            <td><?php echo $row['book_id']; ?></td>
                            <td><?php echo $row['book_title']; ?></td>
                            <td><?php echo $row['book_author']; ?></td>
                            <td><?php echo $row['book_description']; ?></td>
                            <td><?php echo $row['price']; ?></td>

                        </tr>
                    </tbody>
         
                    <?php
                            } 
                        }
                    ?>
                        
                </table>
            </div>
        </div>
    
        <script src="bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
