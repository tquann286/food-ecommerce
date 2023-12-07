<?php include('../config/constants.php'); ?>

<html>

<head>
  <title>Đăng Nhập - Trang Quản lý Hệ Thống Đặt Món Ăn</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

  <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

  <div class="container">
    <div class="row justify-content-center align-content-center h-100">
      <div class="card col-md-6">
        <div class="card-header">
          <h1>Đăng Nhập</h1>
        </div>
        <div class="card-body">
          <?php
          if(isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
          }

          if(isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
          }
          ?>

          <form action="" method="POST">
            <div class="form-group row">
              <label for="username" class="col-sm-4 col-form-label">Tên Đăng Nhập:</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="username" name="username" placeholder="Nhập Tên Đăng Nhập">
              </div>
            </div>
            <div class="form-group row mt-2">
              <label for="password" class="col-sm-4 col-form-label">Mật Khẩu:</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập Mật Khẩu">
              </div>
            </div>
            <div class="form-group row mt-2">
              <div class="col-sm-10">
                <button type="submit" name="submit" class="btn btn-primary">Đăng Nhập</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


</body>

</html>

<?php

if(isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

  $res = mysqli_query($conn, $sql);

  // 4. Kiểm tra xem người dùng có tồn tại hay không
  $count = mysqli_num_rows($res);

  if($count == 1) {
    $_SESSION['login'] = "<div class='success'>Đăng Nhập Thành Công.</div>";
    $_SESSION['user'] = $username;

    header('location:'.SITEURL.'admin/');
  } else {
    $_SESSION['login'] = "<div class='error text-center'>Tên đăng nhập hoặc mật khẩu không khớp.</div>";
    header('location:'.SITEURL.'admin/login.php');
  }

}

?>