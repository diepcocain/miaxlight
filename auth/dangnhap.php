<?php
session_start();

// Database connection
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'miaxstore';

$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
    echo "Server is error!";
}

// Handle login form submission
if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check user credentials
    $sql = "SELECT * FROM tb_user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            // Người dùng đã đăng nhập thành công
            $_SESSION['loggedin'] = true;
            $_SESSION['image'] = $row['image'];  // Lưu URL hình ảnh vào phiên
            $_SESSION['name'] = $row['name'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['createAt'] = $row['createAt'];
            $_SESSION['id'] = $row['id'];
        }
        // Chuyển hướng người dùng về trang chủ
        header("Location: ../main.php");
        exit();
    } else {
        echo "<script>alert('Sai email hoặc mật khẩu!'); window.history.back();</script>";
    }
}
?>