<?php include('partials/menu.php');
include('oop/Food.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản Lý Món Ăn</h1>

        <br /><br />

        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Thêm Món Ăn</a>

        <br /><br /><br />

        <?php
        // Display messages
        $food = new Food('', '', '', '', '', '', '');
        $food->displayMessages();

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
            // Fetch and display food items
            $foodList = $food->getAllFood($conn);

            if ($foodList) {
                foreach ($foodList as $key => $value) {
                    ?>

                    <tr>
                        <td>
                            <?php echo $key + 1; ?>.
                        </td>
                        <td>
                            <?php echo $value['title']; ?>
                        </td>
                        <td>
                            <?php echo $value['price']; ?>vnd
                        </td>
                        <td>
                            <?php
                            if (empty($value['image_name'])) {
                                include('partials/no-image.php');
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $value['image_name']; ?>" width="100px">
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $value['featured']; ?>
                        </td>
                        <td>
                            <?php echo $value['active']; ?>
                        </td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $value['id']; ?>"
                                class="btn-secondary">Cập Nhật Món Ăn</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $value['id']; ?>&image_name=<?php echo $value['image_name']; ?>"
                                class="btn-danger">Xóa Món Ăn</a>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                // No food items in the database
                echo "<tr> <td colspan='7' class='error'> Chưa Thêm Món Ăn. </td> </tr>";
            }

            ?>


        </table>
    </div>

</div>

<?php include('partials/footer.php'); ?>