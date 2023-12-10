<?php
include('partials/menu.php');
include('oop/Food.php');

?>

<div class="main-content">
  <div class="container">
    <h1 class="mb-4">Thêm Món Ăn</h1>

    <?php
    if (isset($_SESSION['upload'])) {
      echo '<div class="alert alert-warning">' . $_SESSION['upload'] . '</div>';
      unset($_SESSION['upload']);
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="title" class="form-label">Tiêu Đề:</label>
            <input type="text" class="form-control" name="title" placeholder="Tiêu đề món ăn" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Mô Tả:</label>
            <textarea class="form-control" name="description" rows="5" placeholder="Mô tả món ăn" required></textarea>
          </div>

          <div class="mb-3">
            <label for="price" class="form-label">Giá:</label>
            <input type="number" class="form-control" name="price" required>
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Chọn Hình Ảnh:</label>
            <input type="file" class="form-control" name="image" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="mb-3">
            <label for="category" class="form-label">Danh Mục:</label>
            <select class="form-select" name="category" required>
              <?php
              $sql = "SELECT * FROM tbl_category WHERE active='Có'";
              $res = mysqli_query($conn, $sql);
              $count = mysqli_num_rows($res);

              if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                  $id = $row['id'];
                  $title = $row['title'];
                  echo '<option value="' . $id . '">' . $title . '</option>';
                }
              } else {
                echo '<option value="0">Không Tìm Thấy Danh Mục</option>';
              }
              ?>
            </select>
          </div>

          <?php include('forms/featured.php'); ?>

          <?php include('forms/active.php'); ?>
        </div>
      </div>

      <div class="mb-3">
        <input type="submit" name="submit" value="Thêm Món Ăn" class="btn btn-primary">
      </div>

    </form>

    <?php

    if (isset($_POST['submit'])) {
      $title = $_POST['title'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $category = $_POST['category'];

      if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
      } else {
        $featured = "Không";
      }

      if (isset($_POST['active'])) {
        $active = $_POST['active'];
      } else {
        $active = "Không";
      }

      $food = new Food($title, $description, $price, '', $category, $featured, $active);

      if (isset($_FILES['image']['name'])) {
        $food->uploadImage('image');
      }

      // Thêm vào database
      $result = $food->addFood($conn);

      if ($result) {
        $_SESSION['add'] = "<div class='success'>Món Ăn Đã Được Thêm Thành Công.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
      } else {
        $_SESSION['add'] = "<div class='error'>Không thể thêm món ăn.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
      }
    }
    ?>

  </div>
</div>

<?php include('partials/footer.php'); ?>