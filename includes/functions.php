<?php

function item_category_list($conn){
  if($conn == "NULL")
    return null;

  $stmt = $conn->query('SELECT * from item_category');

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

function all_item($conn){
  if($conn == "NULL")
    return null;

  $stmt = $conn->query('SELECT * from item');

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}


function item_list($conn, $item_cat){
  if($conn == "NULL")
    return null;

  $query = "SELECT item.* from item, item_type type, item_category cat
    where cat.ITEM_CATEGORYID = ".$item_cat." and type.ITEM_CATEGORYID = cat.ITEM_CATEGORYID
    and item.ITEM_TYPEID = type.ITEM_TYPEID and item.ITEMSTATUS = 1";
  $stmt = $conn->query($query);
  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

function combo_list($conn){
  if($conn == "NULL")
    return null;


  $stmt = $conn->query('SELECT * from combo');

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

function combo_details($conn, $comboid){
  if($conn == "NULL")
    return null;

  $query = "SELECT item.*, cd.QUANTITY, type.UNIT_NAME from combo cb, combo_detail cd, item, item_type type
      where cb.COMBOID = $comboid AND cd.COMBOID = cb.COMBOID
      AND cd.ITEMID = item.ITEMID AND item.ITEM_TYPEID = type.ITEM_TYPEID";

  $stmt = $conn->query($query);

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

function isEmpty($array){
  $row = $array[0];
  if($row[0].$row[1] == "")
    return true;

  return false;
}

function item_type_list($conn){
  if($conn == "NULL")
    return null;


  $stmt = $conn->query('SELECT * from item_type');

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

function user_list($conn){
  if($conn == "NULL")
    return null;


  $stmt = $conn->query('SELECT * from item_category');

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

function account_list($conn){
  if($conn == "NULL")
    return null;


  $stmt = $conn->query('SELECT * from item_category');

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

function blog_list($conn){
  if($conn == "NULL")
    return null;


  $stmt = $conn->query('SELECT * from item_category');

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

function cart_details($conn, $cartID){
  if($conn == "NULL")
    return null;

  $stmt = $conn->prepare('SELECT item.*, cd.QUANTITY from cart_detail cd, item
    where cd.CARTID = :cart and cd.ITEMID = item.ITEMID');
  $stmt->execute(array(":cart"=>$cartID));

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}


function init_cart($conn, $accID){
  if($conn == "NULL")
    return null;


  $stmt = $conn->prepare('SELECT * from cart where ACCOUNTID =:acc');
  $stmt->execute(array(":acc"=>$accID));

  while($stmt->rowCount() < 1)
  {
    $stmt1 = $conn->prepare("INSERT INTO cart(ACCOUNTID, CARTTIME)
      VALUES(:acc, :carttime)");
    $stmt1->execute(array(
    "acc" => $accID,
    "carttime" => date('Y-m-d H:i:s')
    ));

    $stmt->execute(array(":acc"=>$accID));
  }

  return $stmt->fetch()['CARTID'];
}

function user_info($conn, $accID){
  if($conn == "NULL")
    return null;

  $stmt = $conn->prepare('SELECT C.* from CUSTOMER C, ACCOUNT A
      where A.ACCOUNTID =:id and A.CUSTOMERID = C.CUSTOMERID');
  $stmt->execute(array(":id"=>$accID));

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  return $result;
}

function Logout($conn){
  if($conn != "NULL")
    session_unset();
}

class bclUser{
  private $conn;
  private $iAccountId;
  private $sCustomerName;
  private $sCustomerEmail;
  private $sCustomerPhone;
  private $sCustomerSex;
  private $sCustomerAdd;
  private $sCustomerDOB;
  private $sCustomerNoti;
  private $sLikedItems;
  private $iCartId;

  public function bclUser($conn){
    $this->conn = $conn;
    $this->iAccountId = "";
    $this->sCustomerName = 'none';
  }

  public function init_info($id){
    $row = user_info($this->conn, $id);
    $this->iAccountId = $id;
    $this->sCustomerName = $row['CUSTOMERNAME']?$row['CUSTOMERNAME']:'Admin';
    $this->sLikedItems = $row['LIKEDITEMS'];
    $this->sCustomerEmail = $row['CUSTOMEREMAIL'];
    $this->sCustomerPhone = $row['CUSTOMERPHONE'];
    $this->sCustomerSex = $row['CUSTOMERSEX'];
    $this->sCustomerAdd = $row['CUSTOMERADD'];
    $this->sCustomerDOB = $row['CUSTOMERDOB'];
    $this->sCustomerNoti = $row['CUSTOMERNOTI'];
    $this->iCartId = init_cart($this->conn, $id);
  }

    private function setID($val) {
      $this->iAccountId = $val;
    }
    private function setName($val) {
      $this->sCustomerName = $val;
    }
    private function setEmail($val) {
      $this->sCustomerEmail = $val;
    }
    private function setPhone($val) {
      $this->sCustomerPhone = $val;
    }
    private function setSex($val) {
      $this->sCustomerSex = $val;
    }
    private function setAdd($val) {
      $this->sCustomerAdd = $val;
    }
    private function setNoti($val) {
      $this->sCustomerNoti = $val;
    }
    private function setLiked($val) {
      $this->sLikedItems = $val;
    }
    private function setCart($val) {
      $this->iCartId = $val;
    }


    private function getID() {
      return $this->iAccountId;
    }
    private function getName() {
      return $this->sCustomerName;
    }
    private function getEmail() {
      return $this->sCustomerEmail;
    }
    private function getPhone() {
      return $this->sCustomerPhone;
    }
    private function getSex() {
      return $this->sCustomerSex;
    }
    private function getAdd() {
      return $this->sCustomerAdd;
    }
    private function getNoti() {
      return $this->sCustomerNoti;
    }
    private function getLiked() {
      return $this->sLikedItems;
    }
    private function getCart() {
      return $this->iCartId;
    }


  public function __set($name,$value) {
    switch($name) {
      case 'iAccountId':
        return $this->setID($value);
      case 'sCustomerName':
        return $this->setName($value);
      case 'sCustomerEmail':
        return $this->setEmail($value);
      case 'sCustomerPhone':
        return $this->setPhone($value);
      case 'sCustomerSex':
        return $this->setSex($value);
      case 'sCustomerAdd':
        return $this->setAdd($value);
      case 'sCustomerNoti':
        return $this->setNoti($value);
      case 'sLikedItems':
        return $this->setLiked($value);
      case 'iCartId':
        return $this->setCart($value);
    }
  }

  public function __get($name) {
    switch($name) {
      case 'iAccountId':
        return $this->getID();
      case 'sCustomerName':
        return $this->getName();
      case 'sCustomerEmail':
        return $this->getEmail();
      case 'sCustomerPhone':
        return $this->getPhone();
      case 'sCustomerSex':
        return $this->getSex();
      case 'sCustomerAdd':
        return $this->getAdd();
      case 'sCustomerNoti':
        return $this->getNoti();
      case 'sLikedItems':
        return $this->getLiked();
      case 'iCartId':
        return $this->getCart();
    }
  }

};

?>
