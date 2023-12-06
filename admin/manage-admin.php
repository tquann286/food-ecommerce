<?php include('partials/menu.php'); ?>

<!-- Phần Nội dung chính Bắt đầu -->
<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý Admin</h1>
        <br />

        <?php
        // Hiển thị Thông báo từ Session
        
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        ?>

        <br />

        <a href="add-admin.php" class="btn-primary">Thêm Admin</a>

        <br /><br /><br />


        <table class="tbl-full">
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Tên người dùng</th>
                <th>Hành động</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                // Đếm số dòng để kiểm tra liệu có dữ liệu trong cơ sở dữ liệu hay không
                $count = mysqli_num_rows($res);

                $sn = 1;

                // Kiểm tra số lượng dòng
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        ?>

                        <tr>
                            <td>
                                <?php echo $sn++; ?>.
                            </td>
                            <td>
                                <?php echo $full_name; ?>
                            </td>
                            <td>
                                <?php echo $username; ?>
                            </td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>"
                                    class="btn-primary">Đổi Mật khẩu</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"
                                    class="btn-secondary">Cập nhật Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                                    class="btn-danger">Xóa Admin</a>
                            </td>
                        </tr>

                        <?php

                    }
                } else {
                    // Nếu không có dữ liệu trong cơ sở dữ liệu
                }
            }

            ?>

        </table>

    </div>
</div>
<!-- Phần Nội dung chính Kết thúc -->

<?php include('partials/footer.php'); ?>