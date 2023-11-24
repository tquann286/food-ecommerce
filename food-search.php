<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH -->
<section class="food-search text-center">
  <div class="container">
    <?php

    //Get the Search Keyword
    $search = $_POST['search'];
    ?>


    <h2>Món ăn bạn tìm kiếm <a href="#" class="text-white">"
        <?php echo $search; ?>"
      </a></h2>

  </div>
</section>
<!-- fOOD sEARCH -->



<!-- fOOD MEnu -->
<section class="food-menu">
  <div class="container">
    <h2 class="text-center">Danh sách món ăn</h2>

    <?php

    // Get foods based on search keyword
    $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count > 0) {
      while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $title = $row['title'];
        $price = $row['price'];
        $description = $row['description'];
        $image_name = $row['image_name'];
        ?>

        <div class="food-menu-box">
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
            <h4>
              <?php echo $title; ?>
            </h4>
            <p class="food-price">
              <?php echo $price; ?>vnd
            </p>
            <p class="food-detail">
              <?php echo $description; ?>
            </p>
            <br>

            <a href="#" class="btn btn-primary">Order Now</a>
          </div>
        </div>

        <?php
      }
    } else {
      echo "<div class='error'>Food not found.</div>";
    }

    ?>

    <div class="clearfix"></div>

  </div>

</section>
<!-- fOOD Menu -->

<?php include('partials-front/footer.php'); ?>