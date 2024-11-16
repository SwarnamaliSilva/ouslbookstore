<?php

    include 'db_connection.php';

    session_start(); 

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = []; 
    }

    if (isset($_POST['add_to_cart'])) {
        $book_title = $_POST['book_title'];
        $_SESSION['cart'][] = $book_title; 
    }

    if (isset($_POST['remove_from_cart'])) {
        $index = $_POST['book_index'];
        array_splice($_SESSION['cart'], $index, 1); 
    }

    $cartCount = count($_SESSION['cart']); 
    $conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - OUSLBookStore</title>
    <link rel="stylesheet" href="bootstrap-5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="assets/font-awesome/css/all.min.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="customerDashboard.php">OUSLBookStore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="customerDashboard.php">Home</a></li>
                </ul>

                <button class="btn btn-outline-light position-relative me-3" style="border:none;" data-bs-toggle="modal" data-bs-target="#cartModal">
                    <i class="fas fa-shopping-cart"></i> 
                    <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo $cartCount; ?>
                    </span>
                </button>

                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                        <span><i class="fa-solid fa-circle-user" style="font-size:20px;"></i></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="logout2.php" onclick="return confirm('Are you sure you want to log out?')">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="d-flex justify-content-center my-4">
        <div class="container" style="max-width: 600px;">
            <form method="GET" action="" class="input-group">
                <input type="text" class="form-control" placeholder="Search for books" name="query" style="box-shadow: none;">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </form>
        </div>
    </div>

   
    <div class="container mt-4" style="max-width: 600px;">
        <div id="searchResults">
            <?php

            include 'db_connection.php';

            if (isset($_GET['query']) && $_GET['query'] !== '') {
                $searchQuery = $_GET['query'];

                $stmt = $conn->prepare("SELECT book_title FROM books WHERE book_title LIKE ?");
                $likeQuery = "%" . $searchQuery . "%";
                $stmt->bind_param("s", $likeQuery);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    echo "<h5>Search Results:</h5><ul class='list-group'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<li class='list-group-item'>" . htmlspecialchars($row['book_title']) . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No books found.</p>";
                }

                $stmt->close();
            }
            ?>
   
        </div>
    </div>



    <div class="container">
        <div class="row" id="bookList">
        
        <?php

        $sql = "SELECT book_id, book_title, book_author, book_image FROM books";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>

                <div class="col-md-3 mb-4">
                    <a href="bookDetails.php?id=<?php echo urlencode($row['book_id']); ?>" class="text-decoration-none">
                        <div class="card book">
                            <img src="data:image/png;base64,<?php echo base64_encode($row['book_image']); ?>" class="card-img-top" alt="Book Image">

                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['book_title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($row['book_author']); ?></p>
                                
                                <form method="POST" action="">
                                        <input type="hidden" name="book_title" value="<?php echo htmlspecialchars($row['book_title']); ?>">
                                        <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                                </form>

                            </div>
                        </div>
                    </a>
                </div>

                <?php
            }
        } 
        else {
            echo "<p class='text-center'>No books available</p>";
        }
        ?>

        </div>
    </div>

    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Your Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <?php
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $index => $book_title) {
                            echo "<p>" . ($index + 1) . ". " . htmlspecialchars($book_title);
                            echo "<form method='post' style='display:inline;'>
                                    <input type='hidden' name='book_index' value='{$index}'>
                                    <button type='submit' name='remove_from_cart' style='background: none; border: none; color: red;'>
                                        <i class='fas fa-trash'></i>
                                    </button>
                                  </form>";
                            echo "</p>";
                        }
                    } else {
                        echo "<p>No items in cart.</p>";
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continue Shopping</button>
                    <button type="button" class="btn btn-primary" onclick="checkOut()">Checkout (<?php echo $cartCount; ?>)</button>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
    <script>

        function searchBooks() {
            const searchQuery = document.getElementById('searchBar').value.toLowerCase();
            const books = document.querySelectorAll('#bookList .book');

            books.forEach(book => {
                if (book.textContent.toLowerCase().includes(searchQuery)) {
                    book.style.display = 'block';  
                } else {
                    book.style.display = 'none';   
                }
            });
        }

        function checkOut() {
            echo "<script>alert('Proceeding to checkout with <?php echo count($_SESSION['cart']); ?> item(s) in the cart.');
            window.location = 'payment.php';</script>";
        }

    </script>
</body>
</html>
