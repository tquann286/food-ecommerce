<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nhà hàng BatOn</title>

  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!-- Phần Navbar Bắt đầu Tại Đây -->
  <section class="navbar">
    <div class="container">
      <div class="logo">
        <a href="/" title="BatOn Logo">
          <img src="images/logo.jpg" alt="Logo Nhà hàng" class="img-responsive">
        </a>
      </div>

      <div class="menu text-right">
        <ul>
          <li>
            <a href="<?php echo SITEURL; ?>">Trang chủ</a>
          </li>
          <li>
            <a href="<?php echo SITEURL; ?>categories.php">Danh mục</a>
          </li>
          <li>
            <a href="<?php echo SITEURL; ?>foods.php">Món ăn</a>
          </li>
          <!-- <li>
            <a href="#">Liên hệ</a>
          </li> -->
        </ul>
      </div>

      <div class="clearfix"></div>
    </div>
  </section>
  <!-- Phần Navbar Kết thúc Tại Đây -->