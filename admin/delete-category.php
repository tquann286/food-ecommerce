<?php
include('../config/constants.php');
include('oop/Category.php');

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

  $category = new Category('', '', '', '');
  $category->setId($id);

  $id = $category->getId();

  $sqlDelete = "DELETE FROM tbl_category WHERE id=?";
  $stmt = mysqli_prepare($conn, $sqlDelete);

  mysqli_stmt_bind_param($stmt, "i", $id);

  $resDelete = mysqli_stmt_execute($stmt);

  if ($resDelete == true) {
    $_SESSION['delete'] = "<div class='success'>Xóa Danh Mục Thành Công.</div>";
  } else {
    $_SESSION['delete'] = "<div class='error'>Không Thể Xóa Danh Mục.</div>";
  }

  mysqli_stmt_close($stmt);
} else {
  header('location:' . SITEURL . 'admin/manage-category.php');
}

header('location:' . SITEURL . 'admin/manage-category.php');
?>