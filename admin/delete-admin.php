<?php

include('../config/constants.php');
include('oop/Admin.php');

$id = $_GET['id'];

$sql = "SELECT * FROM tbl_admin WHERE id=$id";
$res = mysqli_query($conn, $sql);

if ($res == true) {
  $rows = mysqli_fetch_assoc($res);

  if ($rows) {
    $admin = new Admin($rows['full_name'], $rows['username'], '');

    $admin->setId($id);

    $sqlDelete = "DELETE FROM tbl_admin WHERE id=?";
    $stmt = mysqli_prepare($conn, $sqlDelete);

    mysqli_stmt_bind_param($stmt, "i", $id);

    $resDelete = mysqli_stmt_execute($stmt);

    if ($resDelete == true) {
      $_SESSION['delete'] = "<div class='success'>Xóa Admin Thành Công.</div>";
    } else {
      $_SESSION['delete'] = "<div class='error'>Không Thể Xóa Admin. Thử Lại Sau.</div>";
    }

    mysqli_stmt_close($stmt);
  } else {
    $_SESSION['delete'] = "<div class='error'>Admin không tồn tại.</div>";
  }
} else {
  $_SESSION['delete'] = "<div class='error'>Không Thể Xóa Admin. Thử Lại Sau.</div>";
}

header('location:' . SITEURL . 'admin/manage-admin.php');

?>