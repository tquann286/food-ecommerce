<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Thêm Danh Mục</h1>

    <br><br>

    <?php

    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }

    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }

    ?>

    <br><br>

    <!-- Bắt đầu Form Thêm Danh Mục -->
    <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>

      <div class="row g-3">
        <div class="col-md-6">
          <label for="title" class="form-label">Tiêu Đề:</label>
          <input type="text" name="title" class="form-control" id="title" placeholder="Tiêu đề danh mục" required>
          <div class="invalid-feedback">
            Vui lòng nhập tiêu đề.
          </div>
        </div>

        <div class="col-md-6">
          <label for="image" class="form-label">Chọn Hình Ảnh:</label>
          <input type="file" name="image" class="form-control" id="image">
        </div>

        <?php include('forms/featured.php'); ?>

        <?php include('forms/active.php'); ?>

        <div class="col-md-12">
          <button type="submit" name="submit" class="btn btn-secondary">Thêm Danh Mục</button>
        </div>
      </div>

    </form>
    <!-- Kết Thúc Form Thêm Danh Mục -->

    <?php

    if (isset($_POST['submit'])) {
      $title = $_POST['title'];

      // Đối với nút radio, chúng ta cần kiểm tra xem nó có được chọn hay không
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

      // print_r($_FILES['image']);
    
      // die();
    
      if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        // Tải ảnh lên chỉ khi ảnh được chọn
        if ($image_name != "") {
          // Lấy phần mở rộng của ảnh (jpg, png, gif, v.v.) ví dụ: "specialfood1.jpg"
          $image_name_parts = explode('.', $image_name);
          $ext = end($image_name_parts);

          // Đổi tên ảnh
          $image_name = "Food_Category_" . rand(0000, 9999) . '.' . $ext; // ví dụ: Food_Category_834.jpg

          $source_path = $_FILES['image']['tmp_name'];
          $destination_path = "../images/category/" . $image_name;

          // Tải ảnh lên
          $upload = move_uploaded_file($source_path, $destination_path);

          // Kiểm tra xem ảnh có được tải lên không
// Nếu ảnh không được tải lên, chúng ta sẽ dừng quá trình và chuyển hướng với thông báo lỗi
          if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Không thể tải lên ảnh. </div>";
            header('location:' . SITEURL . 'admin/add-category.php');
            die();
          }
        }

      } else {
        // Không tải ảnh lên và đặt giá trị $image_name thành chuỗi trống
        $image_name = "";
      }

      $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

      $res = mysqli_query($conn, $sql);

      if ($res == true) {
        $_SESSION['add'] = "<div class='success'>Danh mục đã được thêm thành công.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
      } else {
        $_SESSION['add'] = "<div class='error'>Không thể thêm danh mục.</div>";
        header('location:' . SITEURL . 'admin/add-category.php');
      }
    }

    ?>

  </div>
</div>

<?php include('partials/footer.php'); ?>