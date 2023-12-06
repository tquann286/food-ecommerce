<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Cập Nhật Đơn Hàng</h1>
    <br><br>

    <?php

    if (isset($_GET['id'])) {
      $id = $_GET['id'];

      // Lấy các chi tiết khác dựa trên id này
      $sql = "SELECT * FROM tbl_order WHERE id=$id";

      $res = mysqli_query($conn, $sql);

      $count = mysqli_num_rows($res);

      if ($count == 1) {
        $row = mysqli_fetch_assoc($res);

        $food = $row['food'];
        $price = $row['price'];
        $qty = $row['qty'];
        $status = $row['status'];
        $customer_name = $row['customer_name'];
        $customer_contact = $row['customer_contact'];
        $customer_email = $row['customer_email'];
        $customer_address = $row['customer_address'];
      } else {
        header('location:' . SITEURL . 'admin/manage-order.php');
      }
    } else {
      header('location:' . SITEURL . 'admin/manage-order.php');
    }

    ?>

    <form action="" method="POST">

      <table class="tbl-30">
        <tr>
          <td>Tên Món Ăn</td>
          <td><b>
              <?php echo $food; ?>
            </b></td>
        </tr>

        <tr>
          <td>Giá</td>
          <td>
            <b>
              <?php echo $price; ?>vnd
            </b>
          </td>
        </tr>

        <tr>
          <td>Số Lượng</td>
          <td>
            <input type="number" name="qty" value="<?php echo $qty; ?>">
          </td>
        </tr>

        <tr>
          <td>Trạng Thái</td>
          <td>
            <select name="status">
              <option <?php if ($status == "Đã đặt hàng") {
                echo "selected";
              } ?> value="Đã đặt hàng">Đã đặt hàng</option>
              <option <?php if ($status == "Đang giao hàng") {
                echo "selected";
              } ?> value="Đang giao hàng">Đang giao hàng
              </option>
              <option <?php if ($status == "Đã giao hàng") {
                echo "selected";
              } ?> value="Đã giao hàng">Đã giao hàng
              </option>
              <option <?php if ($status == "Đã huỷ") {
                echo "selected";
              } ?> value="Đã huỷ">Đã huỷ</option>
            </select>
          </td>
        </tr>

        <tr>
          <td>Tên Khách Hàng: </td>
          <td>
            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
          </td>
        </tr>

        <tr>
          <td>Thông tin liên hệ: </td>
          <td>
            <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
          </td>
        </tr>

        <tr>
          <td>Email Khách Hàng: </td>
          <td>
            <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
          </td>
        </tr>

        <tr>
          <td>Địa Chỉ Khách Hàng: </td>
          <td>
            <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">

            <input type="submit" name="submit" value="Cập Nhật Đơn Hàng" class="btn-secondary">
          </td>
        </tr>
      </table>

    </form>


    <?php
    if (isset($_POST['submit'])) {
      $id = $_POST['id'];
      $price = $_POST['price'];
      $qty = $_POST['qty'];

      $total = $price * $qty;

      $status = $_POST['status'];

      $customer_name = $_POST['customer_name'];
      $customer_contact = $_POST['customer_contact'];
      $customer_email = $_POST['customer_email'];
      $customer_address = $_POST['customer_address'];

      $sql2 = "UPDATE tbl_order SET 
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$id
                ";

      $res2 = mysqli_query($conn, $sql2);

      // Kiểm tra cập nhật thành công hay không
      if ($res2 == true) {
        $_SESSION['update'] = "<div class='success'>Đơn Hàng Đã Cập Nhật Thành Công.</div>";
        header('location:' . SITEURL . 'admin/manage-order.php');
      } else {
        $_SESSION['update'] = "<div class='error'>Không Thể Cập Nhật Đơn Hàng.</div>";
        header('location:' . SITEURL . 'admin/manage-order.php');
      }
    }
    ?>


  </div>
</div>

<?php include('partials/footer.php'); ?>
