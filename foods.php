<?php include('partials-front/menu.php'); ?>

<!-- Phần Tìm kiếm Món Ăn Bắt đầu Tại Đây -->
<section class="food-search text-center">
  <div class="container">

    <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
      <input type="search" name="search" placeholder="Tìm kiếm món ăn.." required>
      <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-primary">
    </form>

  </div>
</section>
<!-- Phần Tìm kiếm Món Ăn Kết thúc Tại Đây -->



<!-- Phần Danh sách Món Ăn Bắt đầu Tại Đây -->
<section class="food-menu">
  <div class="container">
    <h2 class="text-center">Thực đơn</h2>

    <?php
    // Hiển thị các món ăn đang hoạt động
    $sql = "SELECT * FROM tbl_food WHERE active='Có'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if($count > 0) {
      while($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image_name = $row['image_name'];
        ?>

        <div class="food-menu-box">
          <div class="food-menu-img">
            <?php
            if($image_name == "") {
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
            <h4>
              <?php echo $title; ?>
            </h4>
            <p class="food-price">vnd
              <?php echo $price; ?>
            </p>
            <p class="food-detail">
              <?php echo $description; ?>
            </p>
            <br>

            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Đặt Ngay</a>
          </div>
        </div>

        <?php
      }
    } else {
      echo "<div class='error'>Không tìm thấy món ăn.</div>";
    }
    ?>

    <div class="clearfix"></div>



  </div>

</section>
<!-- Phần Danh sách Món Ăn Kết thúc Tại Đây -->

<?php include('partials-front/footer.php'); ?>