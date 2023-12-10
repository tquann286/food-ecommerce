<?php
include('partials/menu.php');
include('oop/Admin.php');
?>

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
          <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Nhập tên của bạn"
            required>
          <div class="invalid-feedback">
            Vui lòng nhập họ và tên.
          </div>
        </div>

        <div class="col-md-6">
          <label for="username" class="form-label">Tên người dùng:</label>
          <input type="text" name="username" class="form-control" id="username" placeholder="Tên người dùng của bạn"
            required>
          <div class="invalid-feedback">
            Vui lòng nhập tên người dùng.
          </div>
        </div>

        <div class="col-md-6">
          <label for="password" class="form-label">Mật khẩu:</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Mật khẩu của bạn"
            required>
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

<?php
  if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin = new Admin($full_name, $username, $password);
    $admin->insertAdmin($conn);
  } 
?>

<?php include('partials/footer.php'); ?>

