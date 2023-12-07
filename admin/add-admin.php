<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Thêm Admin</h1>

    <br><br>

    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    ?>

    <form action="" method="POST" class="needs-validation" novalidate>

      <div class="row g-3">
        <div class="col-md-6">
          <label for="full_name" class="form-label">Họ và tên:</label>
          <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Nhập tên của bạn" required>
          <div class="invalid-feedback">
            Vui lòng nhập họ và tên.
          </div>
        </div>

        <div class="col-md-6">
          <label for="username" class="form-label">Tên người dùng:</label>
          <input type="text" name="username" class="form-control" id="username" placeholder="Tên người dùng của bạn" required>
          <div class="invalid-feedback">
            Vui lòng nhập tên người dùng.
          </div>
        </div>

        <div class="col-md-6">
          <label for="password" class="form-label">Mật khẩu:</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Mật khẩu của bạn" required>
          <div class="invalid-feedback">
            Vui lòng nhập mật khẩu.
          </div>
        </div>

        <div class="col-md-12">
          <button type="submit" name="submit" class="btn btn-secondary">Thêm Admin</button>
        </div>
      </div>

    </form>

  </div>
</div>

<?php include('partials/footer.php'); ?>

<?php

if (isset($_POST['submit'])) {
  // echo "Button Clicked";

  $full_name = $_POST['full_name'];
  $username = $_POST['username'];
  $password = md5($_POST['password']); // Mã hóa mật khẩu bằng MD5

  $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

  $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

  if ($res == TRUE) {
    // echo "Data Inserted";
    $_SESSION['add'] = "<div class='success'>Admin được thêm thành công.</div>";
    header("location:" . SITEURL . 'admin/manage-admin.php');
  } else {
    // echo "Fail to Insert Data";
    $_SESSION['add'] = "<div class='error'>Thêm Admin không thành công.</div>";
    header("location:" . SITEURL . 'admin/add-admin.php');
  }

}

?>