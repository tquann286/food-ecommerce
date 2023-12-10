<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Thay Đổi Mật Khẩu</h1>
    <br />

    <?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
    }

    if (isset($_SESSION['user-not-found'])) {
      echo $_SESSION['user-not-found'];
      unset($_SESSION['user-not-found']);
    }

    if (isset($_SESSION['pwd-not-match'])) {
      echo $_SESSION['pwd-not-match'];
      unset($_SESSION['pwd-not-match']);
    }
    ?>

    <br />

    <form action="" method="POST">

      <div class="form-group">
        <label for="current_password">Mật Khẩu Hiện Tại:</label>
        <input type="password" name="current_password" id="current_password" class="form-control"
          placeholder="Mật Khẩu Hiện Tại">
      </div>

      <div class="form-group">
        <label for="new_password">Mật Khẩu Mới:</label>
        <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Mật Khẩu Mới">
      </div>

      <div class="form-group">
        <label for="confirm_password">Xác Nhận Mật Khẩu:</label>
        <input type="password" name="confirm_password" id="confirm_password" class="form-control"
          placeholder="Xác Nhận Mật Khẩu">
      </div>

      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="submit" name="submit" value="Thay Đổi Mật Khẩu" class="btn-secondary mt-4">
      </td>
      </tr>
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      </td>
      </tr>


    </form>

  </div>
</div>

<?php

if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $current_password = md5($_POST['current_password']);
  $new_password = md5($_POST['new_password']);
  $confirm_password = md5($_POST['confirm_password']);

  $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {
      if ($new_password == $confirm_password) {
        $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";

        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == true) {
          $_SESSION['change-pwd'] = "<div class='success'>Đổi Mật Khẩu Thành Công. </div>";
          header('location:' . SITEURL . 'admin/manage-admin.php');
        } else {
          $_SESSION['change-pwd'] = "<div class='error'>Không Thể Đổi Mật Khẩu. </div>";
          header('location:' . SITEURL . 'admin/manage-admin.php');
        }
      } else {
        $_SESSION['pwd-not-match'] = "<div class='error'>Mật Khẩu Không Khớp.</div>";
        header('location:' . SITEURL . 'admin/update-password.php?id=' . $id);
      }
    } else {
      $_SESSION['user-not-found'] = "<div class='error'>Mật Khẩu Hiện Tại Không Chính Xác.</div>";
      header('location:' . SITEURL . 'admin/update-password.php?id=' . $id);
    }
  }

}

?>


<?php include('partials/footer.php'); ?>