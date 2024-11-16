<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['cus_id'])) {
    echo json_encode([]);
    exit();
}

$customer_id = $_SESSION['cus_id'];

$query = "SELECT * FROM cart_items WHERE cus_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $customer_id);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

echo json_encode($cartItems);
?>
