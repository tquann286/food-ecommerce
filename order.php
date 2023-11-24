<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH -->
<section class="food-search">
  <div class="container">

    <h2 class="text-center text-white">Điền thông tin giao hàng.</h2>

    <form action="#" class="order">
      <fieldset>
        <legend>Món đã chọn</legend>

        <div class="food-menu-img">
          <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
        </div>

        <div class="food-menu-desc">
          <h3>Food Title</h3>
          <p class="food-price">vnd2.3</p>

          <div class="order-label">Quantity</div>
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

  </div>
</section>
<!-- fOOD sEARCH -->

<?php include('partials-front/footer.php'); ?>