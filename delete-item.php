<?php
session_start();
require './config/db.php'; // Make sure db.php correctly establishes $conn

// Redirect if not logged in or if no ID is provided
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('Location: ./main.php'); // Or your login page
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID sản phẩm không hợp lệ.'); window.location.href='./dash_dsk.php';</script>";
    exit();
}

$product_id = (int)$_GET['id'];

// Prepare and execute the DELETE statement
$sql = "DELETE FROM tb_sanpham WHERE id = ?";

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $product_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Xóa sản phẩm thành công!'); window.location.href='./dash_dsk.php';</script>";
    } else {
        echo "<script>alert('Lỗi: Không thể xóa sản phẩm. " . mysqli_stmt_error($stmt) . "'); window.location.href='./dash_dsk.php';</script>";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('Lỗi: Không thể chuẩn bị câu lệnh xóa. " . mysqli_error($conn) . "'); window.location.href='./dash_dsk.php';</script>";
}

mysqli_close($conn);
?>