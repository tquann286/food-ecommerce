<?php include('partials/menu.php'); ?>
<?php include('oop/Category.php'); ?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-4">Quản lý Danh mục</h1>

        <?php
        if (isset($_SESSION['add'])) {
            echo '<div class="alert alert-success">' . $_SESSION['add'] . '</div>';
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove'])) {
            echo '<div class="alert alert-success">' . $_SESSION['remove'] . '</div>';
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['delete'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['delete'] . '</div>';
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['no-category-found'])) {
            echo '<div class="alert alert-warning">' . $_SESSION['no-category-found'] . '</div>';
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['update'])) {
            echo '<div class="alert alert-info">' . $_SESSION['update'] . '</div>';
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['upload'])) {
            echo '<div class="alert alert-success">' . $_SESSION['upload'] . '</div>';
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['failed-remove'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['failed-remove'] . '</div>';
            unset($_SESSION['failed-remove']);
        }
        ?>
        <br /><br />

        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn btn-primary">Thêm Danh mục</a>

        <br /><br /><br />

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.T.T.</th>
                    <th>Tiêu đề</th>
                    <th>Hình ảnh</th>
                    <th>Đề xuất</th>
                    <th>Hoạt động</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        // Tạo danh mục
                        $category = new Category($row['title'], $row['image_name'], $row['featured'], $row['active']);
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $category->getTitle(); ?></td>
                            <td>
                                <?php
                                $image_name = $category->getImageName();
                                if ($image_name != "") {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" alt="<?php echo $image_name; ?>">
                                <?php
                                } else {
                                    include('partials/no-image.php');
                                }
                                ?>
                            </td>
                            <td><?php echo $category->getFeatured(); ?></td>
                            <td><?php echo $category->getActive(); ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Cập nhật Danh mục</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $row['id']; ?>&image_name=<?php echo $image_name; ?>" class="btn btn-danger">Xóa Danh mục</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="6">
                            <div class="alert alert-warning">Chưa có Danh mục.</div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
