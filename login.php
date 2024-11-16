<?php
include 'db_connection.php';

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT cus_id, customer_name, password FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        $stmt->bind_result($cus_id, $customer_name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {

            $_SESSION['cus_id'] = $cus_id;
            $_SESSION['customer_name'] = $customer_name;

            echo "<script>alert('Login successful! Welcome, " . htmlspecialchars($customer_name) . ".');
            window.location = 'customerDashboard.php';</script>";
        } 
        else {
            echo "<script>alert('Invalid email or password!');
            window.location = 'cusLogin.php';</script>";
        }
    } 
    else {
        echo "<script>alert('Invalid email or password!');
        window.location = 'cusLogin.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
