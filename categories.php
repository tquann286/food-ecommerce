<?php include('partials-front/menu.php'); ?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
  <div class="container">
    <h2 class="text-center">Danh mục</h2>

    <?php

    //Display all the categories that are active
    $sql = "SELECT * FROM tbl_category WHERE active='Có'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count > 0) {
      while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];
        ?>

        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
          <div class="box-3 float-container">
            <?php
            if ($image_name == "") {
              include('partials-front/no-image.php');
            } else {
              ?>
              <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Ảnh món"
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
      echo "<div class='error'>Category not found.</div>";
    }

    ?>


    <div class="clearfix"></div>
  </div>
</section>
<!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>