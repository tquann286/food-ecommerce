<?php

class Food
{
  private $id;
  private $title;
  private $description;
  private $price;
  private $image_name;
  private $category_id;
  private $featured;
  private $active;

  public function __construct($title, $description, $price, $image_name, $category_id, $featured, $active)
  {
    $this->title = $title;
    $this->description = $description;
    $this->price = $price;
    $this->image_name = $image_name;
    $this->category_id = $category_id;
    $this->featured = $featured;
    $this->active = $active;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function getPrice()
  {
    return $this->price;
  }

  public function getImageName()
  {
    return $this->image_name;
  }

  public function getCategoryId()
  {
    return $this->category_id;
  }

  public function getFeatured()
  {
    return $this->featured;
  }

  public function getActive()
  {
    return $this->active;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setImageName($image_name)
  {
    $this->image_name = $image_name;
  }

  public function uploadImage($input_name)
  {
    $image_name = $_FILES[$input_name]['name'];
    $image_temp_path = $_FILES[$input_name]['tmp_name'];

    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
    $new_image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;

    $destination_path = "../images/food/" . $new_image_name;

    if (move_uploaded_file($image_temp_path, $destination_path)) {
      $this->setImageName($new_image_name);
      return true;
    } else {
      return false;
    }
  }

  public function addFood($conn)
  {
    $title = mysqli_real_escape_string($conn, $this->getTitle());
    $description = mysqli_real_escape_string($conn, $this->getDescription());
    $price = mysqli_real_escape_string($conn, $this->getPrice());
    $image_name = mysqli_real_escape_string($conn, $this->getImageName());
    $category_id = mysqli_real_escape_string($conn, $this->getCategoryId());
    $featured = mysqli_real_escape_string($conn, $this->getFeatured());
    $active = mysqli_real_escape_string($conn, $this->getActive());

    $sql = "INSERT INTO tbl_food (title, description, price, image_name, category_id, featured, active)
                VALUES ('$title', '$description', '$price', '$image_name', '$category_id', '$featured', '$active')";

    return mysqli_query($conn, $sql);
  }
  public function getAllFood($conn)
  {
    $sql = "SELECT * FROM tbl_food";
    $res = mysqli_query($conn, $sql);
    $foodList = array();

    if ($res) {
      while ($row = mysqli_fetch_assoc($res)) {
        $foodList[] = $row;
      }
    }

    return $foodList;
  }

  public function displayMessages()
  {
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }

    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }

    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }

    if (isset($_SESSION['unauthorize'])) {
      echo $_SESSION['unauthorize'];
      unset($_SESSION['unauthorize']);
    }

    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
  }

  public function removeImage()
  {
    $path = "../images/food/" . $this->getImageName();
    return unlink($path);
  }

  public function deleteFood($conn)
  {
    $id = $this->getId();
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    return mysqli_query($conn, $sql);
  }

  public function getFoodById($conn, $id)
  {
    $sql = "SELECT * FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
      $row = mysqli_fetch_assoc($res);
      return $row;
    } else {
      return false;
    }
  }

  public function populateCategoriesDropdown($conn, $current_category)
  {
    $sql = "SELECT * FROM tbl_category WHERE active='Có'";
    $res = mysqli_query($conn, $sql);

    if ($res) {
      while ($row = mysqli_fetch_assoc($res)) {
        $category_title = $row['title'];
        $category_id = $row['id'];

        echo "<option " . (($current_category == $category_id) ? "selected" : "") . " value='$category_id'>
                        $category_title
                      </option>";
      }
    } else {
      echo "<option value='0'>Danh Mục Không Khả Dụng.</option>";
    }
  }

  public function updateFood($conn)
  {
    if (isset($_POST['submit'])) {
      $id = $_POST['id'];
      $title = $_POST['title'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $current_image = $_POST['current_image'];
      $category = $_POST['category'];

      $featured = isset($_POST['featured']) ? $_POST['featured'] : "Không";
      $active = isset($_POST['active']) ? $_POST['active'] : "Không";
      $image_name = $current_image;

      if (isset($_FILES['image']['name'])) {
        $new_image_name = $_FILES['image']['name'];

        if ($new_image_name != "") {
          $image_name_parts = explode('.', $new_image_name);
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

          if ($current_image != "") {
            $remove_path = "../images/food/" . $current_image;
            $remove = unlink($remove_path);

            if ($remove == false) {
              $_SESSION['remove-failed'] = "<div class='error'>Không Thể Xóa Ảnh Hiện Tại.</div>";
              header('location:' . SITEURL . 'admin/manage-food.php');
              die();
            }
          }
        }
      } else {
        $image_name = $current_image;
      }

      $sql = "UPDATE tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

      $res = mysqli_query($conn, $sql);

      if ($res == true) {
        $_SESSION['update'] = "<div class='success'>Cập Nhật Món Ăn Thành Công.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
      } else {
        $_SESSION['update'] = "<div class='error'>Không Thể Cập Nhật Món Ăn.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
      }
    }
  }

}

?>