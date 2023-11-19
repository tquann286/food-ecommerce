<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Category</h1>

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
        $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
      }

    } else {
      header('location:' . SITEURL . 'admin/manage-category.php');
    }

    ?>

    <form action="" method="POST" enctype="multipart/form-data">

      <table class="tbl-30">
        <tr>
          <td>Title: </td>
          <td>
            <input type="text" name="title" value="<?php echo $title; ?>">
          </td>
        </tr>

        <tr>
          <td>Current Image: </td>
          <td>
            <?php
            if ($current_image != "") {
              //Display the Image
              ?>
              <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
              <?php
            } else {
              //Display Message
              echo "<div class='error'>Image Not Added.</div>";
            }
            ?>
          </td>
        </tr>

        <tr>
          <td>New Image: </td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>

        <tr>
          <td>Featured: </td>
          <td>
            <input id="featured-yes" <?php if ($featured == "Có") {
              echo "checked";
            } ?> type="radio" name="featured"
              value="Có">
            <label for="featured-yes">Có</label>

            <input id="featured-No" <?php if ($featured == "Không") {
              echo "checked";
            } ?> type="radio" name="featured"
              value="Không">
            <label for="featured-No">Không</label>
          </td>
        </tr>

        <tr>
          <td>Active: </td>
          <td>
            <input id="active-yes" <?php if ($active == "Có") {
              echo "checked";
            } ?> type="radio" name="active"
              value="Có">
            <label for="active-yes">Có</label>

            <input id="active-No" <?php if ($active == "Không") {
              echo "checked";
            } ?> type="radio" name="active" value="Không">
            <label for="active-No">Không</label>
          </td>
        </tr>

        <tr>
          <td>
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
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

      //Check whether the image is selected or not
      if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
          //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
          $image_name_parts = explode('.', $image_name);
          $ext = end($image_name_parts);

          $image_name = "Food_Category_" . rand(0000, 9999) . '.' . $ext; // e.g. Food_Category_834.jpg
    

          $source_path = $_FILES['image']['tmp_name'];

          $destination_path = "../images/category/" . $image_name;

          // Upload the Image
          $upload = move_uploaded_file($source_path, $destination_path);

          // Check whether the image is uploaded or not
          // If the image is not uploaded then we will stop the process and redirect with error message
          if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
            die();
          }

          // Remove the Current Image if available
          if ($current_image != "") {
            $remove_path = "../images/category/" . $current_image;

            $remove = unlink($remove_path);

            // Check whether the image is removed or not
            // If failed to remove then display message and stop the process
            if ($remove == false) {
              $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
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

      //3. Update the Database
      $sql2 = "UPDATE tbl_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

      //Execute the Query
      $res2 = mysqli_query($conn, $sql2);

      //4. REdirect to Manage Category with MEssage
      //CHeck whether executed or not
      if ($res2 == true) {
        //Category Updated
        $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
      } else {
        //failed to update category
        $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
      }

    }

    ?>

  </div>
</div>

<?php include('partials/footer.php'); ?>