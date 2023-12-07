<?php
include('partials/menu.php');
include('oop/Category.php');

$category = new Category('', '', '', '');

?>

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
      $category->setTitle($_POST['title']);
      $category->setFeatured(isset($_POST['featured']) ? $_POST['featured'] : "Không");
      $category->setActive(isset($_POST['active']) ? $_POST['active'] : "Không");

      if (isset($_FILES['image']['name'])) {
        $category->setImageName($_FILES['image']['name']);
      }

      $uploadResult = $category->uploadImage();

      if ($uploadResult['success']) {
        $addResult = $category->addCategory($conn);

        if ($addResult) {
          $_SESSION['add'] = "<div class='success'>Danh mục đã được thêm thành công.</div>";
          header('location:' . SITEURL . 'admin/manage-category.php');
        } else {
          $_SESSION['add'] = "<div class='error'>Không thể thêm danh mục.</div>";
          header('location:' . SITEURL . 'admin/add-category.php');
        }
      } else {
        $_SESSION['upload'] = "<div class='error'>{$uploadResult['message']}</div>";
        header('location:' . SITEURL . 'admin/add-category.php');
      }
    }

    ?>

  </div>
</div>

<?php include('partials/footer.php'); ?>