<?php include('../config/constants.php'); ?>

<html>

<head>
  <title>Đăng Nhập - Trang Quản lý Hệ Thống Đặt Món Ăn</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

  <div class="login">
    <h1 class="text-center">Đăng Nhập</h1>
    <br><br>

    <?php
    if (isset($_SESSION['login'])) {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
    }

    if (isset($_SESSION['no-login-message'])) {
      echo $_SESSION['no-login-message'];
      unset($_SESSION['no-login-message']);
    }
    ?>
    <br><br>

    <!-- Biểu mẫu Đăng Nhập Bắt Đầu Tại Đây -->
    <form action="" method="POST" class="text-center">
      Tên Đăng Nhập: <br>
      <input type="text" name="username" placeholder="Nhập Tên Đăng Nhập"><br><br>

      Mật Khẩu: <br>
      <input type="password" name="password" placeholder="Nhập Mật Khẩu"><br><br>

      <input type="submit" name="submit" value="Đăng Nhập" class="btn-primary">
      <br><br>
    </form>
    <!-- Biểu mẫu Đăng Nhập Kết Thúc Tại Đây -->

  </div>

</body>

</html>

<?php

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

  $res = mysqli_query($conn, $sql);

  // 4. Kiểm tra xem người dùng có tồn tại hay không
  $count = mysqli_num_rows($res);

  if ($count == 1) {
    $_SESSION['login'] = "<div class='success'>Đăng Nhập Thành Công.</div>";
    $_SESSION['user'] = $username;

    header('location:' . SITEURL . 'admin/');
  } else {
    $_SESSION['login'] = "<div class='error text-center'>Tên đăng nhập hoặc mật khẩu không khớp.</div>";
    header('location:' . SITEURL . 'admin/login.php');
  }

}

?>
