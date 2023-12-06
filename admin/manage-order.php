<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản Lý Đơn Hàng</h1>

        <br />

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br />

        <table class="tbl-full">
            <tr>
                <th>Stt</th>
                <th>Món Ăn</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th>Tổng Cộng</th>
                <th>Ngày Đặt Hàng</th>
                <th>Trạng Thái</th>
                <th>Tên Khách Hàng</th>
                <th>Liên Hệ</th>
                <th>Email</th>
                <th>Địa Chỉ</th>
                <th>Hành Động</th>
            </tr>

            <?php
            // Lấy tất cả đơn hàng từ cơ sở dữ liệu
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

                    ?>

                    <tr>
                        <td>
                            <?php echo $sn++; ?>.
                        </td>
                        <td>
                            <?php echo $food; ?>
                        </td>
                        <td>
                            <?php echo $price; ?>
                        </td>
                        <td>
                            <?php echo $qty; ?>
                        </td>
                        <td>
                            <?php echo $total; ?>
                        </td>
                        <td>
                            <?php echo $order_date; ?>
                        </td>

                        <td>
                            <?php
                            if ($status == "Đã đặt hàng") {
                                echo "<label>$status</label>";
                            } elseif ($status == "Đang giao hàng") {
                                echo "<label style='color: orange;'>$status</label>";
                            } elseif ($status == "Đã giao hàng") {
                                echo "<label style='color: green;'>$status</label>";
                            } elseif ($status == "Đã huỷ") {
                                echo "<label style='color: red;'>$status</label>";
                            }
                            ?>
                        </td>

                        <td>
                            <?php echo $customer_name; ?>
                        </td>
                        <td>
                            <?php echo $customer_contact; ?>
                        </td>
                        <td>
                            <?php echo $customer_email; ?>
                        </td>
                        <td>
                            <?php echo $customer_address; ?>
                        </td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>"
                                class="btn-secondary">Cập Nhật Đơn Hàng</a>
                        </td>
                    </tr>

                    <?php

                }
            } else {
                echo "<tr><td colspan='12' class='error'>Không có đơn hàng</td></tr>";
            }
            ?>


        </table>
    </div>

</div>

<?php include('partials/footer.php'); ?>
