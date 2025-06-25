<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('Location: ./main.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Tài Khoản - Miax Lighting</title>
    <link rel="stylesheet" href="./css/user.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>

<body>
    <header class="header">
        <div class="container header-content">
            <div class="logo">
                <img src="https://miaxlighting.com/wp-content/uploads/2025/03/Noi-dung-doan-van-ban-cua-ban-2.png" alt="Miax Logo">
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Nhập từ khóa tìm kiếm">
                <button type="submit">Tìm</button>
            </div>
            <div class="hotline">
                HOTLINE 24/7: 0986.689.999
            </div>
            <div class="icon-wrapper login-icon" title="Đăng nhập">
                <a href="">
                    <ion-icon name="person-outline"></ion-icon>
                </a>
            </div>
            <div class="icon-wrapper cart-icon" title="Giỏ hàng">
                <a href="#">
                    <ion-icon name="bag-handle-outline"></ion-icon>
                </a>
            </div>
        </div>
    </header>

    <nav class="navigation">
        <div class="container">
            <ul>
                <li><a href="./main.php">Trang chủ</a></li>
                <li><a href="./gioithieu.php">Giới thiệu</a></li>
                <li><a href="./chinhsach.php">Chính sách</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="container account-page-layout">
            <aside class="account-sidebar">
                <?php

                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

                    echo '
                    <div class="user-profile-card">';
                    if ($_SESSION['image'] == null) {
                        echo '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtRs_rWILOMx5-v3aXwJu7LWUhnPceiKvvDg&usqp=CAU" alt="User Avatar" class="avatar">';
                    } else {
                        echo '<img src="' . $_SESSION['image'] . '" alt="User Avatar" class="avatar">';
                    }
                    if ($_SESSION['name']  == null) {
                        echo '<p class="user-name"><strong>' .  $_SESSION['id'] . '</strong></p>';
                    } else {
                        echo '<p class="user-name"><strong>' .  $_SESSION['name'] . '</strong></p>';
                    }

                    echo '<p class="join-date">Tham gia từ: <br>' . $_SESSION['createAt'] . '</p>';
                    echo '
                    <div class="action-buttons">
                        <button class="btn logout-btn">Đăng xuất</button>';
                    if ($_SESSION['role'] == 1) {
                        echo '
                        <a href="./dash_dsk.php" class="btn dashboard-btn">Dashboard</a>';
                    }
                    echo '
                    </div>
                </div>
                <div class="support-info">
                    <p>Cần hỗ trợ, vui lòng liên hệ: <a href="#">miaxstorevn@gmail.com</a></p>
                </div>';
                }
                ?>

            </aside>

            <section class="account-main-content">
                <h1>Thông tin tài khoản</h1>
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo '<div class="info-item">';
                    echo '
                    <div class="info-details">
                        <p>Ảnh đại diện</p>';
                    if ($_SESSION['image'] == null) {
                        echo '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtRs_rWILOMx5-v3aXwJu7LWUhnPceiKvvDg&usqp=CAU" alt="Avatar Preview" class="info-avatar">';
                    } else {
                        echo '<img src="' . $_SESSION['image'] . '" alt="Avatar Preview" class="info-avatar">';
                    }
                    echo '
                            </div>
                            <a href="#" class="change-link">Thay đổi</a>';
                    echo '</div>';
                } ?>

                <div class="info-item">
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        echo '<div class="info-details">
                        <p>Họ tên</p>';
                        if ($_SESSION['name'] == null) {
                            echo '<span class="value">Chưa có thông tin</span>';
                        } else {
                            echo '<span class="value">' .  $_SESSION['name'] . '</span>';
                            echo '</div>';
                        }
                    } ?>
                    <a href="#" class="change-link">Thay đổi</a>
                </div>

                <div class="info-item">
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        echo '<div class="info-details">
                        <p>Email</p>';
                        if ($_SESSION['email'] == null) {
                            echo '<span class="value">Chưa có thông tin</span>';
                        } else {
                            echo '<span class="value">' .  $_SESSION['email'] . '</span>';
                            echo '</div>';
                        }
                    } ?>
                    <a href="#" class="change-link">Thay đổi</a>
                </div>

                <div class="info-item">
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        echo '
                    <div class="info-details">
                        <p>Mật khẩu</p>
                        <input type="password" value="' .  $_SESSION['password'] . '" readonly>
                    </div>
                    <a href="#" class="change-link">Thay đổi</a>';
                    } ?>
                </div>
            </section>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container footer-content">
            <div class="footer-column">
                <h4>THÔNG TIN LIÊN HỆ</h4>
                <p><strong>Miax Lighting</strong> - Đơn vị chuyên phân phối, cung cấp các thiết bị ánh sáng sân khấu, tiệc cưới, karaoke toàn quốc.</p>
                <p>Số Hotline/Zalo: 0986.689.999</p>
                <p>Email: miaxstorevn@gmail.com</p>
                <p>Website: https://miaxlighting.com</p>
                <p>Người chịu trách nhiệm: Nguyễn Tuấn Điệp</p>
            </div>
            <div class="footer-column">
                <h4>CHÍNH SÁCH TẠI MIAX LIGHTING</h4>
                <ul>
                    <li><a href="./chinhsach.php">Chính sách thanh toán</a></li>
                    <li><a href="./chinhsach.php">Chính sách đổi sản phẩm</a></li>
                    <li><a href="./chinhsach.php">Chính sách bảo hành</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>TƯ VẤN & HỖ TRỢ KHÁCH HÀNG</h4>
                <p>HOTLINE TƯ VẤN</p>
                <p style="font-size: 1.5em; font-weight: bold; color: #e67e22;">📞 0999.999.999</p>
            </div>
        </div>
        <div class="footer-copyright">
            <p>Copyright 2025 &copy; Miax Lighting</p>
        </div>
    </footer>

    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-sidebar-header">
            <h3>GIỎ HÀNG</h3>
            <button type="button" class="close-cart-btn" aria-label="Đóng giỏ hàng">&times;</button>
        </div>
        <div class="cart-sidebar-content">
            <p class="empty-cart-message">Chưa có sản phẩm trong giỏ hàng.</p>
        </div>
        <div class="cart-sidebar-footer">
            <div class="cart-total-line">
                <span>Tổng cộng:</span>
                <span id="cartTotal">0 ₫</span>
            </div>
            <a href="./giohang.php" style="text-decoration: none;">
                <button type="button" class="checkout-btn">THANH TOÁN</button>
            </a>
        </div>
    </div>
    <div class="cart-sidebar-overlay" id="cartOverlay"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Lấy các phần tử cần thiết từ DOM
            const cartSidebar = document.getElementById('cartSidebar');
            const cartOverlay = document.getElementById('cartOverlay');
            const closeCartBtn = document.querySelector('.close-cart-btn');
            const openCartIcons = document.querySelectorAll('.cart-icon'); // Lấy tất cả các icon giỏ hàng

            // Hàm để mở thanh giỏ hàng
            function openCart() {
                if (cartSidebar && cartOverlay) {
                    cartSidebar.classList.add('open');
                    cartOverlay.classList.add('active');
                }
            }

            // Hàm để đóng thanh giỏ hàng
            function closeCart() {
                if (cartSidebar && cartOverlay) {
                    cartSidebar.classList.remove('open');
                    cartOverlay.classList.remove('active');
                }
            }

            // Thêm sự kiện click cho tất cả các biểu tượng giỏ hàng để mở sidebar
            openCartIcons.forEach(icon => {
                icon.addEventListener('click', function(event) {
                    event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>
                    openCart();
                });
            });

            // Thêm sự kiện click cho nút đóng
            if (closeCartBtn) {
                closeCartBtn.addEventListener('click', closeCart);
            }

            // Thêm sự kiện click cho lớp phủ để đóng sidebar
            if (cartOverlay) {
                cartOverlay.addEventListener('click', closeCart);
            }

            // (Tùy chọn) Đóng giỏ hàng bằng phím 'Escape'
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && cartSidebar.classList.contains('open')) {
                    closeCart();
                }
            });

        });
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>