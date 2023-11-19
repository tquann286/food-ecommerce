<?php
include('../config/constants.php');

if (isset($_GET['id']) and isset($_GET['image_name'])) {
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];

  if ($image_name != "") {
    $path = "../images/category/" . $image_name;

    //Remove the Image
    $remove = unlink($path);

    //IF failed to remove image then add an error message and stop the process
    if ($remove == false) {
      $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
      header('location:' . SITEURL . 'admin/manage-category.php');
      die();
    }
  }

  $sql = "DELETE FROM tbl_category WHERE id=$id";

  $res = mysqli_query($conn, $sql);

  //Check whether the data is delete from database or not
  if ($res == true) {
    $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
    header('location:' . SITEURL . 'admin/manage-category.php');
  } else {
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
    header('location:' . SITEURL . 'admin/manage-category.php');
  }

} else {
  header('location:' . SITEURL . 'admin/manage-category.php');
}
?>