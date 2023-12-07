<?php include('partials/menu.php');
include('oop/Admin.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1 class="mb-4">Cập Nhật Admin</h1>

    <?php
    $id = $_GET['id'];

    $sql = "SELECT * FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
      $count = mysqli_num_rows($res);
      if ($count == 1) {
        $row = mysqli_fetch_assoc($res);

        $admin = new Admin($row['full_name'], $row['username'], '');

        $admin->setId($id);

        $full_name = $admin->getFullName();
        $username = $admin->getUsername();
      } else {
        header('location:' . SITEURL . 'admin/manage-admin.php');
      }
    }
    ?>

    <form action="" method="POST">

      <div class="mb-3">
        <label for="full_name" class="form-label">Họ và Tên:</label>
        <input type="text" name="full_name" value="<?php echo $full_name; ?>" class="form-control">
      </div>

      <div class="mb-3">
        <label for="username" class="form-label">Tên Đăng Nhập:</label>
        <input type="text" name="username" value="<?php echo $username; ?>" class="form-control">
      </div>

      <input type="hidden" name="id" value="<?php echo $id; ?>">

      <button type="submit" name="submit" class="btn btn-primary">Cập Nhật Admin</button>

    </form>
  </div>
</div>

<?php

if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $full_name = $_POST['full_name'];
  $username = $_POST['username'];

  $admin = new Admin($full_name, $username, '');
  $admin->setId($id);

  $sql = "UPDATE tbl_admin SET
        full_name = '{$admin->getFullName()}',
        username = '{$admin->getUsername()}'
        WHERE id={$admin->getId()}
        ";

  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $_SESSION['update'] = "<div class=''>Cập Nhật Admin Thành Công.</div>";
  } else {
    $_SESSION['update'] = "<div class=''>Không Thể Cập Nhật Admin.</div>";
  }
  header('location:' . SITEURL . 'admin/manage-admin.php');
}

?>

<?php include('partials/footer.php'); ?>