<?php

include('../config/constants.php');

$id = $_GET['id'];

$sql = "DELETE FROM tbl_admin WHERE id=$id";

$res = mysqli_query($conn, $sql);

if ($res == true) {
  $_SESSION['delete'] = "<div class='success'>Xóa Admin Thành Công.</div>";
} else {
  $_SESSION['delete'] = "<div class='error'>Không Thể Xóa Admin. Thử Lại Sau.</div>";
}

header('location:' . SITEURL . 'admin/manage-admin.php');

?>
