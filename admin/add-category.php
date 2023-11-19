<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Category</h1>

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

    <!-- Add Category Form Starts -->
    <form action="" method="POST" enctype="multipart/form-data">

      <table class="tbl-30">
        <tr>
          <td>Title: </td>
          <td>
            <input type="text" name="title" placeholder="Category Title">
          </td>
        </tr>

        <tr>
          <td>Select Image: </td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>

        <?php include('forms/featured.php'); ?>

        <?php include('forms/active.php'); ?>

        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
          </td>
        </tr>

      </table>

    </form>
    <!-- Add CAtegory Form Ends -->

    <?php

    if (isset($_POST['submit'])) {
      $title = $_POST['title'];

      //For radio, we need to check whether the button is selected or not
      if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
      } else {
        $featured = "No";
      }

      if (isset($_POST['active'])) {
        $active = $_POST['active'];
      } else {
        $active = "No";
      }

      // print_r($_FILES['image']);
    
      // die();
    
      if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        // Upload the Image only if image is selected
        if ($image_name != "") {
          //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
          $image_name_parts = explode('.', $image_name);
          $ext = end($image_name_parts);

          // Rename the Image
          $image_name = "Food_Category_" . rand(0000, 9999) . '.' . $ext; // e.g. Food_Category_834.jpg
    
          $source_path = $_FILES['image']['tmp_name'];

          $destination_path = "../images/category/" . $image_name;

          // Upload the Image
          $upload = move_uploaded_file($source_path, $destination_path);

          // Check whether the image is uploaded or not
// If the image is not uploaded then we will stop the process and redirect with error message
          if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
            header('location:' . SITEURL . 'admin/add-category.php');
            die();
          }
        }

      } else {
        // Don't Upload Image and set the image_name value as blank
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
        $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
      } else {
        $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
        header('location:' . SITEURL . 'admin/add-category.php');
      }
    }

    ?>

  </div>
</div>

<?php include('partials/footer.php'); ?>