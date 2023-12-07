<?php include('partials/menu.php'); ?>

<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
  $res2 = mysqli_query($conn, $sql2);

  $row2 = mysqli_fetch_assoc($res2);

  $title = $row2['title'];
  $description = $row2['description'];
  $price = $row2['price'];
  $current_image = $row2['image_name'];
  $current_category = $row2['category_id'];
  $featured = $row2['featured'];
  $active = $row2['active'];

} else {
  header('location:' . SITEURL . 'admin/manage-food.php');
}
?>


<div class="main-content">
  <div class="wrapper">
    <h1>Cập Nhật Món Ăn</h1>
    <br><br>

    <form action="" method="POST" enctype="multipart/form-data" class="mt-3">

      <div class="form-group mb-2">
        <label for="title">Tiêu Đề:</label>
        <input type="text" name="title" id="title" class="form-control" value="<?php echo $title; ?>">
      </div>

      <div class="form-group mb-2">
        <label for="description">Mô Tả:</label>
        <textarea name="description" id="description" class="form-control"
          rows="5"><?php echo $description; ?></textarea>
      </div>

      <div class="form-group mb-2">
        <label for="price">Giá:</label>
        <input type="number" name="price" id="price" class="form-control" value="<?php echo $price; ?>">
      </div>

      <div class="form-group mb-2">
        <label for="image">Chọn Ảnh Mới:</label>
        <input type="file" name="image" id="image" class="form-control">
      </div>

      <div class="form-group mb-2">
        <label for="category">Danh Mục:</label>
        <select name="category" id="category" class="form-control">
        <?php
              $sql = "SELECT * FROM tbl_category WHERE active='Có'";
              $res = mysqli_query($conn, $sql);
              $count = mysqli_num_rows($res);

              if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                  $category_title = $row['title'];
                  $category_id = $row['id'];

                  ?>
                  <option <?php if ($current_category == $category_id) {
                    echo "selected";
                  } ?>
                    value="<?php echo $category_id; ?>">
                    <?php echo $category_title; ?>
                  </option>
                  <?php
                }
              } else {
                echo "<option value='0'>Danh Mục Không Khả Dụng.</option>";
              }

              ?>
        </select>
      </div>

      <?php include('forms/update-featured.php'); ?>

      <?php include('forms/update-active.php'); ?>

      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

      <br>
      <button type="submit" name="submit" class="btn btn-primary mt-2">Cập Nhật Món Ăn</button>

    </form>

    <?php

    if (isset($_POST['submit'])) {
      $id = $_POST['id'];
      $title = $_POST['title'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $current_image = $_POST['current_image'];
      $category = $_POST['category'];

      $featured = $_POST['featured'];
      $active = $_POST['active'];


      // Kiểm tra xem nút tải lên có được nhấn hay không
      if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        // Kiểm tra xem tệp có sẵn hay không
        if ($image_name != "") {
          $image_name_parts = explode('.', $image_name);
          $ext = end($image_name_parts);

          $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext;


          $src_path = $_FILES['image']['tmp_name'];
          $dest_path = "../images/food/" . $image_name;

          $upload = move_uploaded_file($src_path, $dest_path);

          if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Không Thể Tải Lên Ảnh Mới.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            die();
          }

          // Xóa ảnh nếu ảnh mới được tải lên và ảnh hiện tại tồn tại
          if ($current_image != "") {
            $remove_path = "../images/food/" . $current_image;

            $remove = unlink($remove_path);

            if ($remove == false) {
              $_SESSION['remove-failed'] = "<div class='error'>Không Thể Xóa Ảnh Hiện Tại.</div>";
              header('location:' . SITEURL . 'admin/manage-food.php');
              die();
            }
          }
        } else {
          $image_name = $current_image;
        }
      } else {
        $image_name = $current_image; //Ảnh mặc định khi nút không được nhấn
      }

      // Cập nhật Món ăn trong cơ sở dữ liệu
      $sql3 = "UPDATE tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

      $res3 = mysqli_query($conn, $sql3);

      if ($res3 == true) {
        $_SESSION['update'] = "<div class='success'>Cập Nhật Món Ăn Thành Công.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
      } else {
        $_SESSION['update'] = "<div class='error'>Không Thể Cập Nhật Món Ăn.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
      }

    }

    ?>

  </div>
</div>

<?php include('partials/footer.php'); ?>