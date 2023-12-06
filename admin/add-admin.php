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

    <form action="" method="POST">

      <table class="tbl-30">
        <tr>
          <td>Họ và tên: </td>
          <td>
            <input type="text" name="full_name" placeholder="Nhập tên của bạn">
          </td>
        </tr>

        <tr>
          <td>Tên người dùng: </td>
          <td>
            <input type="text" name="username" placeholder="Tên người dùng của bạn">
          </td>
        </tr>

        <tr>
          <td>Mật khẩu: </td>
          <td>
            <input type="password" name="password" placeholder="Mật khẩu của bạn">
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Thêm Admin" class="btn-secondary">
          </td>
        </tr>

      </table>

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