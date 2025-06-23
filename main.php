<?php
session_start();
require './config/db.php';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Sản Phẩm - Miax Lighting</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="Logo" href="">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #fff;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            /* Thêm padding ngang để tránh nội dung dính sát vào cạnh màn hình */
        }

        .header {
            background-color: #124461;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            flex-wrap: wrap;
            /* Cho phép các mục xuống dòng trên màn hình nhỏ */
            gap: 10px;
            /* Thêm khoảng cách giữa các mục trong header */
        }

        .logo img {
            height: 50px;
            display: block;
        }

        .search-bar {
            display: flex;
            flex-grow: 1;
            /* Cho phép thanh tìm kiếm mở rộng */
            max-width: 400px;
            /* Giới hạn chiều rộng tối đa */
        }

        .search-bar input {
            padding: 8px;
            border: 1px solid #ccc;
            border-right: none;
            border-radius: 10px 0 0 10px;
            flex-grow: 1;
            /* Cho phép input mở rộng lấp đầy thanh search */
        }

        .search-bar button {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
            border-radius: 0 10px 10px 0;
            cursor: pointer;
        }

        .hotline,
        .cart {
            font-weight: bold;
            color: white;
            /* Đặt màu chữ cho dễ nhìn trên nền xanh */
        }

        .cart a {
            text-decoration: none;
            color: inherit;
        }

        .navigation {
            background-color: #ebf0f5;
            padding: 10px 0;
            border-top: 1px solid #e0e0e0;
            border-bottom: 1px solid #e0e0e0;
        }

        .navigation ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
            /* Cho phép menu xuống dòng */
            gap: 0 20px;
            /* Khoảng cách giữa các mục menu */
        }

        .navigation ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            padding: 5px 0;
            display: inline-block;
        }

        .navigation ul li a:hover {
            color: #007bff;
        }

        /* Đảm bảo main-content không có chiều cao cố định hoặc overflow hidden */
        .main-content {
            min-height: 100vh;
            /* Đảm bảo main-content đủ cao để chứa nội dung */
            display: flex;
            flex-direction: column;
            /* Sắp xếp nội dung theo cột */
        }

        .main-content>.container {
            display: flex;
            gap: 20px;
            padding-top: 20px;
            align-items: stretch;
            flex-wrap: wrap;
            /* Cho phép các phần tử con xuống dòng */
            flex-grow: 1;
            /* Cho phép phần này mở rộng để đẩy footer xuống */
        }


        .hero-section {
            flex: 3.35;
            padding: 0;
        }

        .hero-left {
            width: 100%;
        }

        .hero-left img {
            width: 100%;
            height: auto;
            display: block;
        }

        .sidebar {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .promo-block {
            border: 1px solid #eee;
            background-color: #fff;
        }

        .promo-block img {
            width: 100%;
            height: auto;
            display: block;
        }

        .features-banner {
            padding: 20px 0;
        }

        .feature-items {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            text-align: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .feature-item {
            flex: 1;
            min-width: 170px;
            padding: 10px;
            background-color: #fff;
        }

        .feature-item img {
            height: 150px;
            width: auto;
            margin: 0 auto;
        }

        .page-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        ul {
            list-style: none;
        }

        /* --- Header & Breadcrumbs --- */
        .page-header {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .page-header h1 {
            font-size: 1.8em;
            margin-bottom: 10px;
            color: #222;
            text-align: left;
        }

        .breadcrumbs ul {
            display: flex;
            flex-wrap: wrap;
            font-size: 0.9em;
            color: #777;
        }

        .breadcrumbs li {
            margin-right: 5px;
        }

        .breadcrumbs li:not(:last-child)::after {
            content: "/";
            margin-left: 5px;
            color: #aaa;
        }

        .breadcrumbs a:hover {
            color: #007bff;
        }

        /* --- Product Listing --- */
        .product-listing {
            padding-bottom: 30px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            /* 5 cột */
            gap: 20px;
        }

        .product-item {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
            text-align: center;
            background-color: #fff;
            transition: box-shadow 0.3s ease;
        }

        .product-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .product-item .product-link {
            display: flex;
            flex-direction: column;
            height: 100%;
            padding: 10px;
        }

        .product-item img {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .product-name {
            font-size: 0.9em;
            color: #333;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 2.6em;
            flex-grow: 1;
        }

        .product-name:hover {
            color: #007bff;
        }

        .product-price {
            font-size: 1em;
            font-weight: bold;
            color: #c00000;
            background-color: #fff;
            padding: 5px 10px;
            border-radius: 3px;
            margin-top: auto;
            display: inline-block;
        }

        /* --- Footer --- */
        .site-footer {
            color: #ccc;
            padding-top: 40px;
            background-image: url(https://miaxlighting.com/wp-content/uploads/2025/03/11111a-1.png);
            background-size: cover;
            /* Đảm bảo ảnh nền không bị lặp và phủ hết */
            background-position: center;
            /* Căn giữa ảnh nền */
            flex-shrink: 0;
            /* Ngăn footer bị co lại */
        }

        .container.footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .footer-column {
            flex: 1;
            min-width: 250px;
        }

        .footer-column h4 {
            font-size: 1.1em;
            color: #fff;
            margin-bottom: 15px;
            border-bottom: 1px solid #555;
            padding-bottom: 8px;
        }

        .footer-column p,
        .footer-column ul li {
            font-size: 0.9em;
            line-height: 1.7;
        }

        .footer-column ul li a {
            color: #ccc;
            transition: color 0.3s ease;
        }

        .footer-column ul li a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .footer-hotline {
            font-size: 0.9em;
            text-transform: uppercase;
            color: #aaa;
            margin-bottom: 5px;
        }

        .footer-phone-number {
            font-size: 1.5em;
            font-weight: bold;
            color: #e67e22;
        }

        .footer-copyright {
            text-align: center;
            padding: 20px 0;
            background-color: #0a0003;
            border-top: 1px solid #444;
            font-size: 0.85em;
            color: #aaa;
        }

        .icon-wrapper ion-icon {
            color: white;
            font-size: 24px;
        }

        .icon-wrapper ion-icon:hover {
            color: #007bff;
            transform: scale(1.1);
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .hotline_f {
            display: flex;
            align-items: center;
        }

        .hotline_f p {
            margin-left: 4px;
            font-size: 17px;
        }

        /* --- Media Queries for Responsiveness --- */
        @media (max-width: 992px) {
            .main-content>.container {
                flex-direction: column;
                align-items: stretch;
            }

            .hero-section,
            .sidebar {
                flex: none;
                width: 100%;
            }

            .sidebar {
                flex-direction: row;
                justify-content: space-around;
                margin-top: 20px;
            }

            .promo-block {
                flex: 1;
                margin-bottom: 0;
            }

            .promo-block img {
                height: auto;
                max-height: 150px;
                object-fit: cover;
            }

            .feature-items {
                gap: 10px;
            }

            .feature-item {
                flex-basis: calc(50% - 10px);
                min-width: unset;
            }

            .product-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 10px;
            }

            .search-bar {
                width: 100%;
                max-width: unset;
            }

            .navigation ul {
                justify-content: center;
                flex-wrap: wrap;
                gap: 5px 15px;
            }

            .sidebar {
                flex-direction: column;
                gap: 10px;
            }

            .promo-block {
                flex: none;
                width: 80%;
                max-width: 300px;
                margin: 0 auto;
            }

            .promo-block img {
                max-height: unset;
                object-fit: unset;
            }

            .feature-items {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .feature-item {
                width: 80%;
                max-width: 300px;
                flex-basis: unset;
            }

            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .container.footer-content {
                flex-direction: column;
            }

            .footer-column {
                min-width: 100%;
                margin-bottom: 20px;
            }

            .footer-column:last-child {
                margin-bottom: 0;
            }
        }

        @media (max-width: 480px) {
            .product-grid {
                grid-template-columns: 1fr;
            }

            .page-header h1 {
                font-size: 1.5em;
            }

            .footer-phone-number {
                font-size: 1.3em;
            }
        }

        /* --- Cart Sidebar --- */
        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -100%;
            /* Ban đầu ẩn ở bên ngoài màn hình */
            width: 350px;
            /* Chiều rộng mặc định */
            max-width: 90%;
            /* Chiều rộng tối đa trên màn hình nhỏ */
            height: 100%;
            background-color: #fff;
            box-shadow: -3px 0 10px rgba(0, 0, 0, 0.15);
            z-index: 1002;
            /* Nằm trên lớp phủ */
            transition: right 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            /* Hiệu ứng chuyển động mượt mà */
            display: flex;
            flex-direction: column;
        }

        .cart-sidebar.open {
            right: 0;
            /* Trượt vào trong màn hình */
        }

        .cart-sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            background-color: #124461;
            /* Giống màu header */
            color: white;
            border-bottom: 1px solid #0e364e;
            /* Viền đậm hơn */
        }

        .cart-sidebar-header h3 {
            margin: 0;
            font-size: 1.1em;
            font-weight: bold;
        }

        .close-cart-btn {
            background: none;
            border: none;
            font-size: 1.6em;
            cursor: pointer;
            color: white;
            padding: 5px;
            line-height: 1;
        }

        .close-cart-btn:hover {
            color: #f0f0f0;
        }

        .cart-sidebar-content {
            flex-grow: 1;
            padding: 20px 15px;
            overflow-y: auto;
        }

        .empty-cart-message {
            text-align: center;
            color: #777;
            margin-top: 20px;
            font-size: 0.95em;
        }

        .cart-sidebar-footer {
            padding: 15px;
            border-top: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        .cart-sidebar-footer .cart-total-line {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 1.1em;
            display: flex;
            justify-content: space-between;
        }

        .cart-sidebar-footer .checkout-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .cart-sidebar-footer .checkout-btn:hover {
            background-color: #c0392b;
        }

        .cart-sidebar-footer .view-cart-link {
            display: block;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            font-size: 0.9em;
        }

        .cart-sidebar-footer .view-cart-link:hover {
            text-decoration: underline;
        }

        .cart-sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            /* Lớp phủ đậm hơn */
            z-index: 1001;
            display: none;
            opacity: 0;
            transition: opacity 0.4s ease-in-out;
        }

        .cart-sidebar-overlay.active {
            display: block;
            opacity: 1;
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="container header-content">
            <div class="logo">
                <img src="https://miaxlighting.com/wp-content/uploads/2025/03/Noi-dung-doan-van-ban-cua-ban-2.png"
                    alt="Miax Logo">
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Nhập từ khóa tìm kiếm">
                <button type="submit">Tìm</button>
            </div>
            <div class="hotline">
                HOTLINE 24/7: 0986.689.999
            </div>

            <div class="icon-wrapper login-icon" title="Đăng nhập">
                <a href="./login.php">
                    <ion-icon name="person-outline"></ion-icon>
                </a>
            </div>
            <div class="icon-wrapper cart-icon" title="Giỏ hàng">
                <a href="">
                    <ion-icon name="bag-handle-outline"></ion-icon>
                </a>
            </div>

        </div>
    </header>

    <nav class="navigation">
        <div class="container">
            <ul>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="./gioithieu.html">Giới thiệu</a></li>
                <li><a href="./chinhsach.html">Chính sách</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <section class="hero-section">
                <div class="hero-left">
                    <img src="https://miaxlighting.com/wp-content/uploads/2025/03/11.png"
                        alt="Miax Lighting - Tiên phong giải pháp ánh sáng">
                </div>
            </section>

            <aside class="sidebar">
                <div class="promo-block">
                    <img src="https://miaxlighting.com/wp-content/uploads/2025/03/12.png"
                        alt="Cho Thuê Đèn Sân Khấu, Sự Kiện, Đám cưới">
                </div>
                <div class="promo-block">
                    <img src="https://miaxlighting.com/wp-content/uploads/2025/03/21.png"
                        alt="Setup Hệ Thống Ánh Sáng Phòng Karaoke Chuyên Nghiệp">
                </div>
                <div class="promo-block">
                    <img src="https://miaxlighting.com/wp-content/uploads/2025/03/31.png"
                        alt="Giải Pháp Ánh Sáng Đỉnh Cao Cho Công Trình Bar">
                </div>
            </aside>
        </div>

        <section class="features-banner">
            <div class="container feature-items">
                <div class="feature-item">
                    <img src="https://miaxlighting.com/wp-content/uploads/2025/03/a00021.png"
                        alt="Hàng nhập khẩu chính hãng 100%">
                </div>
                <div class="feature-item">
                    <img src="https://miaxlighting.com/wp-content/uploads/2025/03/a00022.png"
                        alt="Bảo hành 1 năm hỗ trợ trọn đời sản phẩm">
                </div>
                <div class="feature-item">
                    <img src="https://miaxlighting.com/wp-content/uploads/2025/03/a00024.png"
                        alt="Lỗi sản phẩm 1 đổi 1 trong 30 ngày">
                </div>
            </div>
        </section>

        <div class="page-container">
            <header class="page-header">
                <h1>TRANG SẢN PHẨM</h1>
                <nav aria-label="breadcrumb" class="breadcrumbs">
                    <ul>
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Miax Lighting</a></li>
                        <li><a href="#">LASER</a></li>
                        <li><a href="#">Đèn Sân Khấu Moving</a></li>
                    </ul>
                </nav>
            </header>

            <section class="product-listing">
                <div class="product-grid">
                    <?php
                    $sql = "SELECT * FROM tb_sanpham ORDER BY createAt DESC LIMIT 1";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                                <article class="product-item">
                                    <a href="id.php?id=' . $row['id'] . '" class="product-link">
                                        <img src="' . $row['imageMain'] . '"
                                            alt="' . $row['name'] . '">
                                        <h3 class="product-name">' . $row['name'] . '</h3>
                                        <p class="product-price">Giá KM: ' . $row['price'] . 'đ</p>
                                    </a>
                                </article>
                                ';
                        }
                    }
                    ?>
                    <?php
                    $sql = "SELECT * FROM tb_sanpham ORDER BY createAt DESC LIMIT 1,2";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                                <article class="product-item">
                                    <a href="id.php?id=' . $row['id'] . '" class="product-link">
                                        <img src="' . $row['imageMain'] . '"
                                            alt="' . $row['name'] . '">
                                        <h3 class="product-name">' . $row['name'] . '</h3>
                                        <p class="product-price">Giá KM: ' . $row['price'] . 'đ</p>
                                    </a>
                                </article>
                                ';
                        }
                    }
                    ?>

                </div>
            </section>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container footer-content">
            <div class="footer-column">
                <h4>THÔNG TIN LIÊN HỆ</h4>
                <p><strong>Miax Lighting</strong> - Đơn vị chuyên phân phối, cung cấp các thiết bị ánh sáng sân khấu,
                    tiệc cưới, karaoke toàn quốc.</p>
                <p>Số Hotline/Zalo: 0999.999.999</p>
                <p>Email: miaxstorevn@gmail.com</p>
                <p>Website: https://miaxlighting.com</p>
                <p>Người chịu trách nhiệm: Nguyễn Tuấn Điệp</p>
            </div>
            <div class="footer-column">
                <h4>CHÍNH SÁCH TẠI MIAX LIGHTING</h4>
                <ul>
                    <li><a href="./chinhsach.html">Chính sách thanh toán</a></li>
                    <li><a href="./chinhsach.html">Chính sách đổi sản phẩm</a></li>
                    <li><a href="./chinhsach.html">Chính sách bảo hành</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>TƯ VẤN & HỖ TRỢ KHÁCH HÀNG</h4>
                <p class="footer-hotline">HOTLINE TƯ VẤN</p>
                <div class="hotline_f">
                    <span aria-hidden="true">📞</span>
                    <p class="footer-phone-number">0999.999.999</p>
                </div>
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
            <a href="./giohang.html">
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
            };

        });
    </script>

</body>

</html>