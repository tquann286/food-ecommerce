<?php include('partials-front/menu.php'); ?>

<!-- Phần Tìm kiếm Món ăn Bắt đầu Tại Đây -->
<section class="food-search text-center">
  <div class="container">

    <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
      <input type="search" name="search" placeholder="Tìm kiếm món ăn.." required>
      <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-primary">
    </form>

  </div>
</section>
<!-- Phần Tìm kiếm Món ăn Kết thúc Tại Đây -->

<?php
if(isset($_SESSION['order'])) {
  echo $_SESSION['order'];
  unset($_SESSION['order']);
}
?>

<!-- Phần Danh mục Bắt đầu Tại Đây -->
<section class="categories">
  <div class="container">
    <h2 class="text-center">Danh mục</h2>

    <?php
    // Hiển thị các Danh mục từ Cơ sở dữ liệu
    $sql = "SELECT * FROM tbl_category WHERE active='Có' AND featured='Có' LIMIT 3";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if($count > 0) {
      while($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];
        ?>

        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
          <div class="box-3 float-container">
            <?php
            if($image_name == "") {
              include('partials-front/no-image.php');
            } else {
              ?>
              <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                class="img-responsive img-curve">
              <?php
            }
            ?>


            <h3 class="float-text text-white text-shadow">
              <?php echo $title; ?>
            </h3>
          </div>
        </a>

        <?php
      }
    } else {
      echo "<div class='error'>Danh mục chưa được thêm.</div>";
    }
    ?>


    <div class="clearfix"></div>
  </div>
</section>
<!-- Phần Danh mục Kết thúc Tại Đây -->



<!-- Phần Danh sách Món ăn Bắt đầu Tại Đây -->
<section class="food-menu">
  <div class="container">
    <h2 class="text-center">Thực đơn</h2>

    <?php

    // Lấy Món ăn từ Cơ sở dữ liệu có trạng thái hoạt động và là nổi bật
    $sql2 = "SELECT * FROM tbl_food WHERE active='Có' AND featured='Có' LIMIT 6";

    $res2 = mysqli_query($conn, $sql2);

    $count2 = mysqli_num_rows($res2);

    if($count2 > 0) {
      while($row = mysqli_fetch_assoc($res2)) {
        $id = $row['id'];
        $title = $row['title'];
        $price = $row['price'];
        $description = $row['description'];
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
      echo "<div class='error'>Món ăn không khả dụng.</div>";
    }

    ?>

    <div class="clearfix"></div>

  </div>

  <p class="text-center">
    <a href="#">Xem tất cả món ăn</a>
  </p>
</section>
<!-- Phần Danh sách Món ăn Kết thúc Tại Đây -->


<?php include('partials-front/footer.php'); ?>