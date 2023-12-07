<?php
include('partials/menu.php');
include('oop/Order.php');

?>

<div class="main-content">
  <div class="container">
    <h1>Cập Nhật Đơn Hàng</h1>
    <br><br>

    <?php

    if (isset($_GET['id'])) {
      $id = $_GET['id'];

      // Create an instance of the Order class
      $order = new Order('','','','','','','','','','','');
      $orderDetails = $order->getOrderById($id);

      if ($orderDetails) {
        $food = $orderDetails['food'];
        $price = $orderDetails['price'];
        $qty = $orderDetails['qty'];
        $status = $orderDetails['status'];
        $customer_name = $orderDetails['customer_name'];
        $customer_contact = $orderDetails['customer_contact'];
        $customer_email = $orderDetails['customer_email'];
        $customer_address = $orderDetails['customer_address'];
      } else {
        header('location:' . SITEURL . 'admin/manage-order.php');
      }
    } else {
      header('location:' . SITEURL . 'admin/manage-order.php');
    }

    ?>

    <form action="" method="POST">

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="food">Tên Món Ăn</label>
            <input type="text" class="form-control" value="<?php echo $food; ?>" disabled>
          </div>

          <div class="form-group">
            <label for="price">Giá</label>
            <input type="text" class="form-control" value="<?php echo $price; ?>vnd" disabled>
          </div>

          <div class="form-group">
            <label for="qty">Số Lượng</label>
            <input type="number" class="form-control" name="qty" value="<?php echo $qty; ?>" required>
          </div>

          <div class="form-group">
            <label for="status">Trạng Thái</label>
            <select class="form-control" name="status">
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
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="customer_name">Tên Khách Hàng</label>
            <input type="text" class="form-control" name="customer_name" value="<?php echo $customer_name; ?>" required>
          </div>

          <div class="form-group">
            <label for="customer_contact">Thông tin liên hệ</label>
            <input type="text" class="form-control" name="customer_contact" value="<?php echo $customer_contact; ?>"
              required>
          </div>

          <div class="form-group">
            <label for="customer_email">Email Khách Hàng</label>
            <input type="text" class="form-control" name="customer_email" value="<?php echo $customer_email; ?>"
              required>
          </div>

          <div class="form-group">
            <label for="customer_address">Địa Chỉ Khách Hàng</label>
            <textarea class="form-control" name="customer_address" cols="30" rows="5"
              required><?php echo $customer_address; ?></textarea>
          </div>
        </div>
      </div>

      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="price" value="<?php echo $price; ?>">

      <div class="form-group">
        <input type="submit" name="submit" value="Cập Nhật Đơn Hàng" class="btn btn-primary">
      </div>

    </form>

    <?php
    if (isset($_POST['submit'])) {
      // Process and update data here
    
      $id = $_POST['id'];
      $price = $_POST['price'];
      $qty = $_POST['qty'];

      $total = $price * $qty;

      $status = $_POST['status'];

      $customer_name = $_POST['customer_name'];
      $customer_contact = $_POST['customer_contact'];
      $customer_email = $_POST['customer_email'];
      $customer_address = $_POST['customer_address'];

      // Update order using Order class method
      $updateResult = $order->updateOrder($id, $qty, $total, $status, $customer_name, $customer_contact, $customer_email, $customer_address);

      // Check if the update was successful
      if ($updateResult) {
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