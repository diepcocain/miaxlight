<?php
// DB
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'miaxstore';

$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
    die("Server is error!");
}

if (isset($_POST['signUp'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists
    $select_email = "SELECT * FROM tb_user WHERE email = '$email'";
    $result = mysqli_query($conn, $select_email);

    if (mysqli_num_rows($result) > 0) {
        echo "Email da ton tai";
    } else {
        // Insert new user
        $sql = "INSERT INTO tb_user (name, email, password) VALUES ('$name', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Đăng ký thành công!'); window.location='../main.php';</script>";
        } else {
            echo "<script>alert('Đăng ký thất bại: " . mysqli_error($conn) . "'); window.history.back();</script>";
        }
    }
}
