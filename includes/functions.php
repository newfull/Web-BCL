<?php
function item_category_list($conn){
  //Tạo Prepared Statement
  $stmt = $conn->query('SELECT * from item_category');

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

?>
