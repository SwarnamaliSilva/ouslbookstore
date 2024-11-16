<?php

include 'db_connection.php';

$book_id = isset($_GET['book_id']) ? filter_var($_GET['book_id']) : null;


$query = "SELECT * FROM books WHERE book_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    echo "<script>alert('Book not found!');
    window.location = 'bookDetails.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $book['book_title']; ?> - OUSL BookStore</title>
    <link rel="stylesheet" href="bootstrap-5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="assets/font-awesome/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <img src="data:image/png;base64,<?php echo $book['book_image']; ?>" alt="<?php echo $book['book_title']; ?>" class="card-img-top img-fluid" alt="Book Image">

            </div>

            <div class="col-md-6">
                <h2><?php echo $book['book_title']; ?></h2>
                <p><strong>Description:</strong> <?php echo $book['book_description']; ?></p>
                <p><strong>Unit Price:</strong> $<?php echo number_format($book['price'], 2); ?></p>

                <form action="#" method="POST">
                    <label for="quantity">Quantity:</label>
                    <select name="quantity" id="quantity" class="form-select" required>
                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>">

                    <button type="submit" name="action" value="add_to_cart" class="btn btn-primary mt-2">Add to Cart</button>
                    <button type="submit" name="action" value="remove_from_cart" class="btn btn-danger mt-2">Remove from Cart</button>

                    <button type="button" class="btn btn-success mt-2" onclick="window.location.href='#'">Pay</button>
                </form>
            </div>
        </div>
    </div>
    <script src="bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php

$conn->close();
?>
