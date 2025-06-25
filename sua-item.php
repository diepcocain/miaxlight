<?php
session_start();
require './config/db.php'; // Make sure db.php correctly establishes $conn

// Redirect user if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('Location: ./main.php'); // Or your login page
    exit();
}

// Initialize variables
$product = null;
$categoryID = ''; // For selected option in dropdown

// Handle form submission for updating product
if (isset($_POST["xacnhan_sua"])) {
    $product_id = (int)$_POST['product_id']; // Hidden field for product ID
    $name = trim($_POST["name"]);
    $price = trim($_POST["price"]);
    $stock = (int)$_POST["stock"];
    $image_main = trim($_POST["image_main"]);
    $header_content = trim($_POST["header"]);
    $footer_content = trim($_POST["footer"]);
    $categoryID = (int)$_POST["categoryid"];

    // Validate that product_id is not empty
    if (empty($product_id)) {
        echo "<script>alert('Lỗi: Không tìm thấy ID sản phẩm để cập nhật.'); window.history.back();</script>";
        exit();
    }

    $sql = "UPDATE tb_sanpham SET name = ?, price = ?, stock = ?, image_main = ?, header = ?, footer = ?, categoryID = ?, 
        updatedAt = CURRENT_TIMESTAMP WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Corrected parameter types: s (string), s (string), i (integer), s (string), s (string), s (string), i (integer), i (integer)
        mysqli_stmt_bind_param(
            $stmt, "ssisssii", $name, $price, $stock, $image_main, $header_content, $footer_content, $categoryID, $product_id
        );

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Cập nhật sản phẩm thành công!'); window.location.href='./dash_dsk.php';</script>";
        } else {
            echo "<script>alert('Lỗi: Không thể cập nhật sản phẩm. " . mysqli_stmt_error($stmt) . "'); window.history.back();</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Lỗi: Không thể chuẩn bị câu lệnh cập nhật. " . mysqli_error($conn) . "'); window.history.back();</script>";
    }
} else { // Fetch product data if not a form submission
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $product_id = (int)$_GET['id'];

        $sql = "SELECT * FROM tb_sanpham WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $product_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $product = mysqli_fetch_assoc($result);
                $categoryID = $product['categoryID']; // Set categoryID for dropdown
            } else {
                echo "<script>alert('Không tìm thấy sản phẩm.'); window.location.href='./dash_dsk.php';</script>";
                exit();
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Lỗi: Không thể chuẩn bị câu lệnh truy vấn sản phẩm. " . mysqli_error($conn) . "'); window.location.href='./dash_dsk.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('ID sản phẩm không hợp lệ.'); window.location.href='./dash_dsk.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm</title>
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
                <li><a href="#">Dashboard</a></li>
                <li class="active"><a href="#"><i class="fas fa-plus"></i> Sửa Sản Phẩm</a></li>
                <li><a href="#"><i class="fas fa-boxes"></i> Quản Lý Sản Phẩm</a></li>
            </ul>
        </nav>
    </aside>

    <main id="main-content">
        <header class="main-header">
            <div class="header-right">
                <div class="user-profile">
                    <?php
                    if (isset($_SESSION['image'])) {
                        echo '<img src="' . htmlspecialchars($_SESSION['image']) . '"
                        alt="Profile Picture" class="profile-pic">';
                    } else {
                        echo '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtRs_rWILOMx5-v3aXwJu7LWUhnPceiKvvDg&usqp=CAU"
                        alt="Profile Picture" class="profile-pic">';
                    } ?>
                    <div class="dropdown-menu">
                        <a href="./user.php">Thông Tin</a>
                        <a href="./logout.php">Đăng Xuất</a>
                    </div>
                </div>
            </div>
        </header>

        <div class="content-panel">
            <div class="form-section">
                <?php if ($product): ?>
                <form method="POST" action="">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">

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
                        <textarea id="title" rows="2" name="name" required><?php echo htmlspecialchars($product['name']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Giá sản phẩm</label>
                        <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="stock">Số lượng tồn kho</label>
                        <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($product['stock']); ?>" required min="0">
                    </div>

                    <div class="form-group">
                        <label for="header">Mô tả (Header)</label>
                        <textarea id="header" rows="8" name="header"><?php echo htmlspecialchars($product['header']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image-src">Nguồn ảnh (URL)</label>
                        <input type="text" id="image-src" name="image_main" value="<?php echo htmlspecialchars($product['image_main']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="footer">Thông số kỹ thuật (Footer)</label>
                        <textarea id="footer" rows="8" name="footer"><?php echo htmlspecialchars($product['footer']); ?></textarea>
                    </div>

                    <button class="submit-btn" type="submit" name="xacnhan_sua">Cập Nhật</button>
                </form>
                <?php else: ?>
                    <p>Không tìm thấy sản phẩm để chỉnh sửa.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userProfile = document.querySelector('.user-profile');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            if (userProfile && dropdownMenu) {
                userProfile.addEventListener('click', function () {
                    dropdownMenu.classList.toggle('show');
                });

                window.addEventListener('click', function (event) {
                    if (!userProfile.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.remove('show');
                    }
                });
            }
        });
    </script>
</body>
</html>