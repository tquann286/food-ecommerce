<?php

class Order
{
  private $id;
  private $food;
  private $price;
  private $qty;
  private $total;
  private $order_date;
  private $status;
  private $customer_name;
  private $customer_contact;
  private $customer_email;
  private $customer_address;

  public function __construct(
    $id,
    $food,
    $price,
    $qty,
    $total,
    $order_date,
    $status,
    $customer_name,
    $customer_contact,
    $customer_email,
    $customer_address
  ) {
    $this->id = $id;
    $this->food = $food;
    $this->price = $price;
    $this->qty = $qty;
    $this->total = $total;
    $this->order_date = $order_date;
    $this->status = $status;
    $this->customer_name = $customer_name;
    $this->customer_contact = $customer_contact;
    $this->customer_email = $customer_email;
    $this->customer_address = $customer_address;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getFood()
  {
    return $this->food;
  }

  public function setFood($food)
  {
    $this->food = $food;
  }

  public function getPrice()
  {
    return $this->price;
  }

  public function setPrice($price)
  {
    $this->price = $price;
  }

  public function getQty()
  {
    return $this->qty;
  }

  public function setQty($qty)
  {
    $this->qty = $qty;
  }

  public function getTotal()
  {
    return $this->total;
  }

  public function setTotal($total)
  {
    $this->total = $total;
  }

  public function getOrderDate()
  {
    return $this->order_date;
  }

  public function setOrderDate($order_date)
  {
    $this->order_date = $order_date;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }

  public function getCustomerName()
  {
    return $this->customer_name;
  }

  public function setCustomerName($customer_name)
  {
    $this->customer_name = $customer_name;
  }

  public function getCustomerContact()
  {
    return $this->customer_contact;
  }

  public function setCustomerContact($customer_contact)
  {
    $this->customer_contact = $customer_contact;
  }

  public function getCustomerEmail()
  {
    return $this->customer_email;
  }

  public function setCustomerEmail($customer_email)
  {
    $this->customer_email = $customer_email;
  }

  public function getCustomerAddress()
  {
    return $this->customer_address;
  }

  public function setCustomerAddress($customer_address)
  {
    $this->customer_address = $customer_address;
  }

  public static function getAllOrders()
  {
    global $conn;

    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
    $res = mysqli_query($conn, $sql);
    $orders = [];

    if ($res) {
      while ($row = mysqli_fetch_assoc($res)) {
        $order = new Order(
          $row['id'],
          $row['food'],
          $row['price'],
          $row['qty'],
          $row['total'],
          $row['order_date'],
          $row['status'],
          $row['customer_name'],
          $row['customer_contact'],
          $row['customer_email'],
          $row['customer_address']
        );

        $orders[] = $order;
      }
    }

    return $orders;
  }

  public function getOrderById($id)
  {
    global $conn;

    $sql = "SELECT * FROM tbl_order WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $orderDetails = mysqli_fetch_assoc($result);
      return $orderDetails;
    } else {
      return false;
    }
  }

  public function updateOrder($id, $qty, $total, $status, $customer_name, $customer_contact, $customer_email, $customer_address)
  {
    global $conn;

    $sql = "UPDATE tbl_order SET 
            qty = $qty,
            total = $total,
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'
            WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    return $result;
  }
}

?>