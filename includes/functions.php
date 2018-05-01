<?php
function item_category_list($conn){

  $stmt = $conn->query('SELECT * from item_category');

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

function item_list($conn, $item_cat){
  $query = "SELECT item.* from item, item_type type, item_category cat
    where cat.ITEM_CATEGORYID = ".$item_cat." and type.ITEM_CATEGORYID = cat.ITEM_CATEGORYID
    and item.ITEM_TYPEID = type.ITEM_TYPEID";
  $stmt = $conn->query($query);
  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

function combo_list($conn){

  $stmt = $conn->query('SELECT * from combo');

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

  $stmt = $conn->query('SELECT * from item_type');

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

function user_list($conn){

  $stmt = $conn->query('SELECT * from item_category');

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

function account_list($conn){

  $stmt = $conn->query('SELECT * from item_category');

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

function blog_list($conn){

  $stmt = $conn->query('SELECT * from item_category');

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

?>
