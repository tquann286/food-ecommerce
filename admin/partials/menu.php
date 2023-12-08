<?php
include('../config/constants.php');
include('login-check.php');
ob_start();
function isCurrentPage($pageName)
{
    $currentPage = basename($_SERVER['PHP_SELF']);
    return ($currentPage === $pageName) ? 'active' : '';
}
?>

<html>

<head>
    <title>Trang quản lý nhà hàng BatOn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/admin/index.php">Trang chủ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item <?php echo isCurrentPage('manage-admin.php'); ?>"><a class="nav-link"
                            href="/admin/manage-admin.php">Admin</a></li>
                    <li class="nav-item <?php echo isCurrentPage('manage-category.php'); ?>"><a class="nav-link"
                            href="/admin/manage-category.php">Danh mục</a></li>
                    <li class="nav-item <?php echo isCurrentPage('manage-food.php'); ?>"><a class="nav-link"
                            href="/admin/manage-food.php">Món ăn</a></li>
                    <li class="nav-item <?php echo isCurrentPage('manage-order.php'); ?>"><a class="nav-link"
                            href="/admin/manage-order.php">Đơn hàng</a></li>
                    <li class="nav-item <?php echo isCurrentPage('logout.php'); ?>"><a class="nav-link"
                            href="/admin/logout.php">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </nav>