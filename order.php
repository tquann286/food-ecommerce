<?php include('partials-front/menu.php'); ?>

<?php
if (isset($_GET['food_id'])) {
  // Lấy id và chi tiết của món ăn được chọn
  $food_id = $_GET['food_id'];

  $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

  $res = mysqli_query($conn, $sql);

  $count = mysqli_num_rows($res);

  if ($count == 1) {
    $row = mysqli_fetch_assoc($res);

    $title = $row['title'];
    $price = $row['price'];
    $image_name = $row['image_name'];
  } else {
    header('location:' . SITEURL);
  }
} else {
  header('location:' . SITEURL);
}
?>

<!-- Phần Tìm kiếm Món ăn -->
<section class="food-search">
  <div class="container">

    <h2 class="text-center text-white">Điền thông tin giao hàng.</h2>

    <form action="" method="POST" class="order">
      <fieldset>
        <legend>Món đã chọn</legend>

        <div class="food-menu-img">
          <?php

          if ($image_name == "") {
            include('partials-front/no-image.php');
          } else {
            ?>
            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
              class="img-responsive img-curve">
            <?php
          }

          ?>
        </div>

        <div class="food-menu-desc">
          <h3>
            <?php echo $title; ?>
          </h3>
          <input type="hidden" name="food" value="<?php echo $title; ?>">

          <p class="food-price">
            <?php echo $price; ?>vnd
          </p>
          <input type="hidden" name="price" value="<?php echo $price; ?>">

          <div class="order-label">Số lượng</div>
          <input type="number" name="qty" class="input-responsive" value="1" required>

        </div>

      </fieldset>

      <fieldset>
        <legend>Chi tiết giao hàng</legend>
        <div class="order-label">Họ và tên</div>
        <input type="text" name="full-name" placeholder="Họ và tên" class="input-responsive" required>

        <div class="order-label">Số điện thoại</div>
        <input type="tel" name="contact" placeholder="Số điện thoại" class="input-responsive" required>

        <div class="order-label">Email</div>
        <input type="email" name="email" placeholder="Email" class="input-responsive" required>

        <div class="order-label">Địa chỉ</div>
        <textarea name="address" rows="10" placeholder="Địa chỉ" class="input-responsive" required></textarea>

        <input type="submit" name="submit" value="Xác nhận" class="btn btn-primary">
      </fieldset>

    </form>

    <?php

    if (isset($_POST['submit'])) {
      $food = $_POST['food'];
      $price = $_POST['price'];
      $qty = $_POST['qty'];

      $total = $price * $qty; // Tổng cộng = giá x số lượng 
    
      $order_date = date("Y-m-d h:i:sa");

      $status = "Đã đặt hàng";

      $customer_name = $_POST['full-name'];
      $customer_contact = $_POST['contact'];
      $customer_email = $_POST['email'];
      $customer_address = $_POST['address'];


      // Lưu Đơn đặt hàng vào Cơ sở dữ liệu
      $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

      $res2 = mysqli_query($conn, $sql2);

      if ($res2 == true) {
        $_SESSION['order'] = "<div class='success text-center'>Đặt món thành công.</div>";
        header('location:' . SITEURL);
      } else {
        $_SESSION['order'] = "<div class='error text-center'>Đặt món thất bại.</div>";
        header('location:' . SITEURL);
      }

    }

    ?>

  </div>
</section>
<!-- Phần Tìm kiếm Món ăn -->

<?php include('partials-front/footer.php'); ?>
