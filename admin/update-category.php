<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Cập Nhật Danh Mục</h1>

    <br><br>


    <?php

    if (isset($_GET['id'])) {
      $id = $_GET['id'];

      $sql = "SELECT * FROM tbl_category WHERE id=$id";

      $res = mysqli_query($conn, $sql);

      $count = mysqli_num_rows($res);

      if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
      } else {
        $_SESSION['no-category-found'] = "<div class='error'>Không Tìm Thấy Danh Mục.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
      }

    } else {
      header('location:' . SITEURL . 'admin/manage-category.php');
    }

    ?>

    <form action="" method="POST" enctype="multipart/form-data">

      <table class="tbl-30">
        <tr>
          <td>Tiêu Đề: </td>
          <td>
            <input type="text" name="title" value="<?php echo $title; ?>">
          </td>
        </tr>

        <tr>
          <td>Ảnh Hiện Tại: </td>
          <td>
            <?php
            if ($current_image != "") {
              //Hiển thị ảnh
              ?>
              <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
              <?php
            } else {
              //Hiển thị thông báo
              echo "<div class='error'>Ảnh Không Được Thêm.</div>";
            }
            ?>
          </td>
        </tr>

        <tr>
          <td>Ảnh Mới: </td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>

        <?php include('forms/update-featured.php'); ?>

        <?php include('forms/update-active.php'); ?>

        <tr>
          <td>
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Cập Nhật Danh Mục" class="btn-secondary">
          </td>
        </tr>

      </table>

    </form>

    <?php

    if (isset($_POST['submit'])) {
      $id = $_POST['id'];
      $title = $_POST['title'];
      $current_image = $_POST['current_image'];
      $featured = $_POST['featured'];
      $active = $_POST['active'];

      // Kiểm tra xem ảnh có được chọn hay không
      if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
          // Lấy phần mở rộng của ảnh (jpg, png, gif, v.v.) từ tên tệp ảnh
          $image_name_parts = explode('.', $image_name);
          $ext = end($image_name_parts);

          $image_name = "Food_Category_" . rand(0000, 9999) . '.' . $ext; // Ví dụ: Food_Category_834.jpg
    

          $source_path = $_FILES['image']['tmp_name'];

          $destination_path = "../images/category/" . $image_name;

          // Tải ảnh lên
          $upload = move_uploaded_file($source_path, $destination_path);

          // Kiểm tra xem ảnh có được tải lên hay không
          // Nếu không tải lên được, chúng ta sẽ dừng quá trình và chuyển hướng với thông báo lỗi
          if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Không Thể Tải Ảnh Lên. </div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
            die();
          }

          // Xóa ảnh hiện tại nếu có
          if ($current_image != "") {
            $remove_path = "../images/category/" . $current_image;

            $remove = unlink($remove_path);

            // Kiểm tra xem ảnh có được xóa hay không
            // Nếu xóa không thành công, hiển thị thông báo và dừng quá trình
            if ($remove == false) {
              $_SESSION['failed-remove'] = "<div class='error'>Không Thể Xóa Ảnh Hiện Tại.</div>";
              header('location:' . SITEURL . 'admin/manage-category.php');
              die();
            }
          }


        } else {
          $image_name = $current_image;
        }
      } else {
        $image_name = $current_image;
      }

      // Cập nhật vào cơ sở dữ liệu
      $sql2 = "UPDATE tbl_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

      // Thực thi truy vấn
      $res2 = mysqli_query($conn, $sql2);

      // Chuyển hướng về trang Quản lý Danh mục với thông báo
      // Kiểm tra xem có thực hiện thành công hay không
      if ($res2 == true) {
        // Cập nhật danh mục thành công
        $_SESSION['update'] = "<div class='success'>Cập Nhật Danh Mục Thành Công.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
      } else {
        // Không thể cập nhật danh mục
        $_SESSION['update'] = "<div class='error'>Không Thể Cập Nhật Danh Mục.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
      }

    }

    ?>

  </div>
</div>

<?php include('partials/footer.php'); ?>
