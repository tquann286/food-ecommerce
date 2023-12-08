<?php
include('../config/constants.php');
include('login-check.php');
?>

<html>

<head>
    <title>Trang quản lý nhà hàng BatOn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- Menu Section Starts -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="/admin/index.php">Trang chủ</a></li>
                <li><a href="/admin/manage-admin.php">Admin</a></li>
                <li><a href="/admin/manage-category.php">Danh mục</a></li>
                <li><a href="/admin/manage-food.php">Món ăn</a></li>
                <li><a href="/admin/manage-order.php">Đơn hàng</a></li>
                <li><a href="/admin/logout.php">Đăng xuất</a></li>
            </ul>
        </div>
    </div>
    <!-- Menu Section Ends -->
