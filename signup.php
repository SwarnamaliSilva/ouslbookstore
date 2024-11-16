<?php

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        die(alert("Passwords do not match!"));
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO customers (customer_name, email,phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $customer_name, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Sign Up successful!');
        window.location = 'cusLogin.php';</script>";
    } 
    else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
