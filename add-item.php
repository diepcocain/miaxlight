<?php
session_start();

// Database connection
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'miaxstore';

$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
    die("Lỗi kết nối máy chủ: " . mysqli_connect_error());
}

// Redirect user if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('Location: ./main.php');
    exit();
}

// Get the userID from the session
// Assuming 'id' is stored in the session when the user logs in
$userID = $_SESSION['id'] ?? null;

// Khởi tạo biến để tránh lỗi khi tải trang lần đầu
$categoryID = '';

// --- Xử lý khi form được gửi đi ---
if (isset($_POST["xacnhan"])) {
    // Lấy dữ liệu từ form và làm sạch
    $name = trim($_POST["name"]);
    $price = trim($_POST["price"]);
    $stock = (int)$_POST["stock"]; // Lấy giá trị số lượng
    $image_main = trim($_POST["image_main"]);
    $header_content = trim($_POST["header"]);
    $footer_content = trim($_POST["footer"]);
    $categoryID = (int)$_POST["categoryid"];

    // Check if userID is valid before proceeding
    if ($userID === null) {
        echo "<script>alert('Lỗi: Không tìm thấy ID người dùng. Vui lòng đăng nhập lại.'); window.history.back();</script>";
        exit();
    }

    // --- Chuẩn bị và thực thi câu lệnh INSERT ---
    // Câu lệnh SQL để chèn dữ liệu vào bảng tb_sanpham
    $sql = "INSERT INTO tb_sanpham (name, price, stock, image_main, header, footer, categoryID, userID)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Gắn các biến vào câu lệnh đã chuẩn bị như là tham số
        // "ssisssii" now correctly defines 8 parameters: s=string, i=integer
        mysqli_stmt_bind_param(
            $stmt,
            "ssisssii",
            $name,
            $price,
            $stock,
            $image_main,
            $header_content,
            $footer_content,
            $categoryID,
            $userID
        );

        // Thực thi câu lệnh
        if (mysqli_stmt_execute($stmt)) {
            // Thông báo thành công và tải lại trang để xóa form
            echo "<script>alert('Thêm sản phẩm thành công!'); window.history.back();</script>";
        } else {
            // Thông báo lỗi nếu không thể thực thi
            echo "<script>alert('Lỗi: Không thể thêm sản phẩm. " . mysqli_stmt_error($stmt) . "'); window.history.back();</script>";
        }

        // Đóng câu lệnh
        mysqli_stmt_close($stmt);
    } else {
        // Thông báo lỗi nếu không thể chuẩn bị câu lệnh
        echo "<script>alert('Lỗi: Không thể chuẩn bị câu lệnh. " . mysqli_error($conn) . "'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm Mới</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./css/add_item.css">
</head>

<body>
    <aside id="sidebar">
        <div class="logo">
            <img src="https://miaxlighting.com/wp-content/uploads/2025/03/Noi-dung-doan-van-ban-cua-ban-2.png" alt="MIAX Logo">
        </div>
        <nav class="menu">
            <ul class="menu-list">
                <li><a href="./dash_dsk.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="active"><a href="#"><i class="fas fa-globe"></i></i>Đèn sân khấu</a></li>
                <li><a href="#"><i class="fas fa-globe"></i>Đèn LASER</a></li>
                <li><a href="#"><i class="fas fa-home-alt"></i>Đèn gia đình</a></li>
                <li><a href="#"><i class="fas fa-home-alt"></i>Máy khói</a></li>
            </ul>
        </nav>
    </aside>

    <main id="main-content">
        <header class="main-header">
            <div class="header-right">
                <div class="user-profile">
                    <img src="https://miaxlighting.com/wp-content/uploads/2025/03/Noi-dung-doan-van-ban-cua-ban-2.png" alt="Profile Picture" class="profile-pic">
                    <div class="dropdown-menu">
                        <a href="#">Thông Tin</a>
                        <a href="#">Đăng Xuất</a>
                    </div>
                </div>
            </div>
        </header>

        <div class="content-panel">
            <div class="form-section">

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="select-table">Chọn danh mục</label>
                        <div class="custom-select">
                            <select id="select-table" name="categoryid" required>
                                <option value="">-- Chọn danh mục --</option>
                                <option value="1" <?php echo ($categoryID == '1') ? 'selected' : ''; ?>>Đèn Sân Khấu</option>
                                <option value="2" <?php echo ($categoryID == '2') ? 'selected' : ''; ?>>Đèn Laser</option>
                                <option value="3" <?php echo ($categoryID == '3') ? 'selected' : ''; ?>>Đèn Gia Đình</option>
                                <option value="4" <?php echo ($categoryID == '4') ? 'selected' : ''; ?>>Máy Khói</option>
                            </select>
                            <i class="fas fa-chevron-down select-arrow"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title">Tên sản phẩm</label>
                        <textarea id="title" rows="2" name="name" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" id="price" name="price" required>
                    </div>

                    <div class="form-group">
                        <label for="stock">Số lượng tồn kho</label>
                        <input type="number" id="stock" name="stock" required min="0">
                    </div>

                    <div class="form-group">
                        <label for="header">Mô tả (Header)</label>
                        <textarea id="header" rows="8" name="header"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image-src">Nguồn ảnh (URL)</label>
                        <input type="text" id="image-src" name="image_main">
                    </div>

                    <div class="form-group">
                        <label for="footer">Thông số kỹ thuật (Footer)</label>
                        <textarea id="footer" rows="8" name="footer"></textarea>
                    </div>

                    <button class="submit-btn" type="submit" name="xacnhan">Xác Nhận</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userProfile = document.querySelector('.user-profile');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            if (userProfile && dropdownMenu) {
                userProfile.addEventListener('click', function() {
                    dropdownMenu.classList.toggle('show');
                });

                window.addEventListener('click', function(event) {
                    if (!userProfile.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.remove('show');
                    }
                });
            }
        });
    </script>
</body>

</html>