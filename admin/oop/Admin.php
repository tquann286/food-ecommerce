<?php

class Admin
{
  private $id;
  private $full_name;
  private $username;
  private $password;

  public function __construct($full_name, $username, $password)
  {
    $this->full_name = $full_name;
    $this->username = $username;
    $this->password = md5($password);
  }

  // Getter methods
  public function getId()
  {
    return $this->id;
  }

  public function getFullName()
  {
    return $this->full_name;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getPassword()
  {
    return $this->password;
  }

  // Setter methods
  public function setId($id)
  {
    $this->id = $id;
  }

  public function setFullName($full_name)
  {
    $this->full_name = $full_name;
  }

  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function setPassword($password)
  {
    $this->password = md5($password);
  }

  public function insertAdmin($conn)
  {
    $sql = "INSERT INTO tbl_admin SET 
                    full_name='{$this->full_name}',
                    username='{$this->username}',
                    password='{$this->password}'";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == TRUE) {
      $_SESSION['add'] = "<div class='success'>Admin được thêm thành công.</div>";
      header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
      $_SESSION['add'] = "<div class='error'>Thêm Admin không thành công.</div>";
      header("location:" . SITEURL . 'admin/add-admin.php');
    }
  }
}
?>