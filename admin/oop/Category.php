<?php

class Category
{
  private $id;
  private $title;
  private $image_name;
  private $featured;
  private $active;

  public function __construct($title, $image_name, $featured, $active)
  {
    $this->title = $title;
    $this->image_name = $image_name;
    $this->featured = $featured;
    $this->active = $active;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getImageName()
  {
    return $this->image_name;
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

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function setImageName($image_name)
  {
    $this->image_name = $image_name;
  }

  public function setFeatured($featured)
  {
    $this->featured = $featured;
  }

  public function setActive($active)
  {
    $this->active = $active;
  }

  public function getCategoryById($conn)
  {
    $id = $this->getId();
    $sql = "SELECT * FROM tbl_category WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
      $count = mysqli_num_rows($res);
      if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $this->setTitle($row['title']);
        $this->setImageName($row['image_name']);
        $this->setFeatured($row['featured']);
        $this->setActive($row['active']);
        return true;
      }
    }
    return false;
  }

  public function addCategory($conn)
  {
    $title = $this->getTitle();
    $featured = $this->getFeatured();
    $active = $this->getActive();

    $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='{$this->getImageName()}',
                    featured='$featured',
                    active='$active'
                ";

    $res = mysqli_query($conn, $sql);

    return $res;
  }

  public function updateCategory($conn)
  {
    $id = $this->getId();
    $title = $this->getTitle();
    $image_name = $this->getImageName();
    $featured = $this->getFeatured();
    $active = $this->getActive();

    $sql = "UPDATE tbl_category SET 
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active' 
            WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    return $res;
  }

  public function uploadImage()
  {
    $source_path = $_FILES['image']['tmp_name'];
    $destination_path = "../images/category/" . $this->getImageName();

    $upload = move_uploaded_file($source_path, $destination_path);

    if ($upload == false) {
      return [
        'success' => false,
        'message' => 'Không thể tải lên ảnh.'
      ];
    }

    return [
      'success' => true,
      'message' => 'Tải ảnh lên thành công.'
    ];
  }
}

?>