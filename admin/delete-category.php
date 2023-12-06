<?php
include('../config/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];

  if ($image_name != "") {
    $path = "../images/category/" . $image_name;

    // Xóa ảnh
    $remove = unlink($path);

    // Nếu không thể xóa ảnh, thêm thông báo lỗi và dừng quá trình
    if ($remove == false) {
      $_SESSION['remove'] = "<div class='error'>Không thể xóa ảnh danh mục.</div>";
      header('location:' . SITEURL . 'admin/manage-category.php');
      die();
    }
  }

  $sql = "DELETE FROM tbl_category WHERE id=$id";

  $res = mysqli_query($conn, $sql);

  // Kiểm tra xem dữ liệu đã bị xóa từ cơ sở dữ liệu hay chưa
  if ($res == true) {
    $_SESSION['delete'] = "<div class='success'>Xóa Danh Mục Thành Công.</div>";
    header('location:' . SITEURL . 'admin/manage-category.php');
  } else {
    $_SESSION['delete'] = "<div class='error'>Không Thể Xóa Danh Mục.</div>";
    header('location:' . SITEURL . 'admin/manage-category.php');
  }

} else {
  header('location:' . SITEURL . 'admin/manage-category.php');
}
?>