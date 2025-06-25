<?php
session_start();
require './config/db.php';

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VnExpress Dashboard - Thời sự</title>
    <link rel="stylesheet" href="./css/dash_dsk.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <aside id="sidebar">
        <div class="logo">
            <img src="https://miaxlighting.com/wp-content/uploads/2025/03/Noi-dung-doan-van-ban-cua-ban-2.png"
                alt="Miax Logo">
        </div>
        <nav class="menu">
            <ul class="menu-list">
                <li><a href="#">Dashboard</a></li>
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
                    <?php
                    if (isset($_SESSION['image'])) {
                        echo '<img src="' . $_SESSION['image'] . '"
                        alt="Profile Picture" class="profile-pic">';
                    } else {
                        echo '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtRs_rWILOMx5-v3aXwJu7LWUhnPceiKvvDg&usqp=CAU"
                        alt="Profile Picture" class="profile-pic">';
                    } ?>
                    <div class="dropdown-menu">
                        <a href="./user.php">Thông Tin</a>
                        <a href="#">Đăng Xuất</a>
                    </div>
                </div>
            </div>
        </header>

        <div class="content-panel">
            <div class="panel-header">
                <h1>Đèn Sân Khấu</h1>
                <div class="panel-actions">
                    <a href="./add-item.php">
                        <button class="add-new-btn"><i class="fas fa-plus"></i>Add New</button>
                    </a>
                </div>
            </div>

            <table class="news-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Create At</th>
                        <th>Update At</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM tb_sanpham ORDER BY createdAt ASC LIMIT 5";
                $result = mysqli_query($conn, $sql);

                // Lưu các giá trị vào một mảng
                $rows = array();
                if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $rows[] = $row;
                    }
                }

                // Sắp xếp mảng từ mới đến cũ
                $rows = array_reverse($rows);

                foreach ($rows as $row) {
                    echo '<tbody>
                    <tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['createdAt'] . '</td>
                        <td>' . $row['updatedAt'] . '</td>
                        <td class="actions">
                            <a href="./sua-item.php?id=' . htmlspecialchars($row['id']) . '" class="settings-btn"><i class="fas fa-cog"></i></a>
                            <a href="./delete-item.php?id=' . htmlspecialchars($row['id']) . '" 
                                class="delete-btn" onclick="return confirm(\'Bạn có chắc chắn muốn xóa sản phẩm này không?\');">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </tr>
                    </tbody>
               ';
                } ?> </td>
            </table>

            <div class="pagination">
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
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

                // Close the dropdown if the user clicks outside of it
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