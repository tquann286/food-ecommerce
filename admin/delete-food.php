<?php
include('../config/constants.php');
include('oop/Food.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];

  $food = new Food('', '', '', $image_name, '', '', '');

  if ($image_name != "") {
    // Đổi image
    $removeImage = $food->removeImage();

    if (!$removeImage) {
      $_SESSION['upload'] = "<div class='error'>Không thể xóa tệp hình ảnh.</div>";
      header('location:' . SITEURL . 'admin/manage-food.php');
      die();
    }
  }

  $food->setId($id);

  // Xóa food trong database
  $deleteFood = $food->deleteFood($conn);

  if ($deleteFood) {
    $_SESSION['delete'] = "<div class='success'>Xóa Món Ăn Thành Công.</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
  } else {
    $_SESSION['delete'] = "<div class='error'>Không Thể Xóa Món Ăn.</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
  }
} else {
  $_SESSION['unauthorize'] = "<div class='error'>Truy cập không được ủy quyền.</div>";
  header('location:' . SITEURL . 'admin/manage-food.php');
}
?>