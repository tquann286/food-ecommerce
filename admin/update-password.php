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

      <table class="tbl-30">
        <tr>
          <td>Mật Khẩu Hiện Tại: </td>
          <td>
            <input type="password" name="current_password" placeholder="Mật Khẩu Hiện Tại">
          </td>
        </tr>

        <tr>
          <td>Mật Khẩu Mới:</td>
          <td>
            <input type="password" name="new_password" placeholder="Mật Khẩu Mới">
          </td>
        </tr>

        <tr>
          <td>Xác Nhận Mật Khẩu: </td>
          <td>
            <input type="password" name="confirm_password" placeholder="Xác Nhận Mật Khẩu">
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Thay Đổi Mật Khẩu" class="btn-secondary">
          </td>
        </tr>

      </table>

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
        $sql2 = "UPDATE tbl_admin SET 
                                password='$new_password' 
                                WHERE id=$id
                            ";

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
