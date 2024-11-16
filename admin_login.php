<?php
include 'db_connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    $stmt = $conn->prepare("SELECT admin_email FROM admin WHERE admin_email = ? AND admin_password = ?");
    $stmt->bind_param("ss", $admin_email, $admin_password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['admin_logged_in'] = true;
        echo "<script>alert('Admin login successful!');
        window.location = 'storeAdminDashboard.php';</script>";
    } 
    else {
        echo "<script>alert('Invalid email or password!');
        window.location = 'storeAdminLogin.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
