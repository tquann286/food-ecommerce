<?php
include('partials/menu.php');
include('oop/Food.php');
?>

<?php
$food = new Food('', '', '', '', '', '', '');

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $foodData = $food->getFoodById($conn, $id);

  if ($foodData) {
    extract($foodData);

  } else {
    header('location:' . SITEURL . 'admin/manage-food.php');
  }
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
          $food->populateCategoriesDropdown($conn, $current_category);
          ?>
        </select>
      </div>

      <?php include('forms/update-featured.php'); ?>

      <?php include('forms/update-active.php'); ?>

      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="current_image" value="<?php echo $image_name; ?>">

      <br>
      <button type="submit" name="submit" class="btn btn-primary mt-2">Cập Nhật Món Ăn</button>

    </form>

    <?php
    $food->updateFood($conn);
    ?>

  </div>
</div>

<?php include('partials/footer.php'); ?>