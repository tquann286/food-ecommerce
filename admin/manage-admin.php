<?php
include('partials/menu.php');
include('oop/Admin.php');

?>

<!-- Phần Nội dung chính Bắt đầu -->
<div class="main-content">
    <div class="container">
        <h1 class="mb-4">Quản lý Admin</h1>

        <?php
        // Hiển thị Thông báo từ Session
        if (isset($_SESSION['add'])) {
            echo '<div class="alert alert-success">' . $_SESSION['add'] . '</div>';
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['delete'] . '</div>';
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo '<div class="alert alert-info">' . $_SESSION['update'] . '</div>';
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['change-pwd'])) {
            echo '<div class="alert alert-warning">' . $_SESSION['change-pwd'] . '</div>';
            unset($_SESSION['change-pwd']);
        }
        ?>

        <a href="add-admin.php" class="btn btn-primary mb-3">Thêm Admin</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Tên người dùng</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT * FROM tbl_admin";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $admin = new Admin($rows['full_name'], $rows['username'], '');
                            ?>

                            <tr>
                                <td>
                                    <?php echo $sn++; ?>.
                                </td>
                                <td>
                                    <?php echo $admin->getFullName(); ?>
                                </td>
                                <td>
                                    <?php echo $admin->getUsername(); ?>
                                </td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $rows['id']; ?>"
                                        class="btn btn-primary">Đổi Mật khẩu</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $rows['id']; ?>"
                                        class="btn btn-secondary">Cập nhật Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $rows['id']; ?>"
                                        class="btn btn-danger">Xóa Admin</a>
                                </td>
                            </tr>

                            <?php
                        }
                    } else {
                        // Nếu không có dữ liệu trong cơ sở dữ liệu
                        echo '<tr><td colspan="4">Không có dữ liệu</td></tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Phần Nội dung chính Kết thúc -->

<?php include('partials/footer.php'); ?>