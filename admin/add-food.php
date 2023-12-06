<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Thêm Món Ăn</h1>

    <br><br>

    <?php
    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">

      <table class="tbl-30">

        <tr>
          <td>Tiêu Đề: </td>
          <td>
            <input type="text" name="title" placeholder="Tiêu đề món ăn">
          </td>
        </tr>

        <tr>
          <td>Mô Tả: </td>
          <td>
            <textarea name="description" cols="30" rows="5" placeholder="Mô tả món ăn"></textarea>
          </td>
        </tr>

        <tr>
          <td>Giá: </td>
          <td>
            <input type="number" name="price">
          </td>
        </tr>

        <tr>
          <td>Chọn Hình Ảnh: </td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>

        <tr>
          <td>Danh Mục: </td>
          <td>
            <select name="category">

              <?php
              $sql = "SELECT * FROM tbl_category WHERE active='Có'";

              $res = mysqli_query($conn, $sql);

              $count = mysqli_num_rows($res);

              if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                  $id = $row['id'];
                  $title = $row['title'];

                  ?>

                  <option value="<?php echo $id; ?>">
                    <?php echo $title; ?>
                  </option>

                  <?php
                }
              } else {
                ?>
                <option value="0">Không Tìm Thấy Danh Mục</option>
                <?php
              }
              ?>

            </select>
          </td>
        </tr>

        <?php include('forms/featured.php'); ?>

        <?php include('forms/active.php'); ?>

        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Thêm Món Ăn" class="btn-secondary">
          </td>
        </tr>

      </table>

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

      // Upload hình ảnh nếu được chọn
      if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        // Kiểm tra xem ảnh có được chọn hay không và chỉ tải lên ảnh nếu được chọn
        if ($image_name != "") {
          // Lấy phần mở rộng của ảnh được chọn (jpg, png, gif, v.v.) "vijay-thapa.jpg" vijay-thapa jpg
          $image_name_parts = explode('.', $image_name);
          $ext = end($image_name_parts);

          $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext; // Ví dụ: "Food-Name-657.jpg"
    
          // Đường dẫn nguồn là vị trí hiện tại của ảnh
          $src = $_FILES['image']['tmp_name'];

          // Đường dẫn Đích cho ảnh sẽ được tải lên
          $dst = "../images/food/" . $image_name;

          // Tải ảnh lên
          $upload = move_uploaded_file($src, $dst);

          // Kiểm tra xem ảnh có được tải lên không
          // Nếu ảnh không được tải lên, chúng ta sẽ dừng quá trình và chuyển hướng với thông báo lỗi
          if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Không thể tải lên ảnh.</div>";
            header('location:' . SITEURL . 'admin/add-food.php');
            die();
          }

        }

      } else {
        $image_name = "";
      }

      // Đối với giá trị số, chúng ta không cần đặt giá trị trong dấu ngoặc '' nhưng đối với giá trị chuỗi, việc thêm dấu ngoặc '' là bắt buộc ''
      $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

      $res2 = mysqli_query($conn, $sql2);

      if ($res2 == true) {
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
