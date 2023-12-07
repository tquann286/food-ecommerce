<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản Lý Món Ăn</h1>

        <br /><br />

        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Thêm Món Ăn</a>

        <br /><br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>

        <table class="tbl-full">
            <tr>
                <th>S.T.T</th>
                <th>Tiêu Đề</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th>Đề xuất</th>
                <th>Kích Hoạt</th>
                <th>Hành Động</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_food";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>

                    <tr>
                        <td>
                            <?php echo $sn++; ?>.
                        </td>
                        <td>
                            <?php echo $title; ?>
                        </td>
                        <td>
                            <?php echo $price; ?>vnd
                        </td>
                        <td>
                            <?php
                            if ($image_name == "") {
                                include('partials/no-image.php');
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $featured; ?>
                        </td>
                        <td>
                            <?php echo $active; ?>
                        </td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>"
                                class="btn-secondary">Cập Nhật Món Ăn</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                                class="btn-danger">Xóa Món Ăn</a>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                // Không có món ăn trong Cơ sở dữ liệu
                echo "<tr> <td colspan='7' class='error'> Chưa Thêm Món Ăn. </td> </tr>";
            }

            ?>


        </table>
    </div>

</div>

<?php include('partials/footer.php'); ?>