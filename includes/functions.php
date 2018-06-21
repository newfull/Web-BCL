<?php
//Kiểm tra chuỗi rỗng
function isEmpty($array){
  $row = $array[0];
  if($row[0].$row[1] == "")
    return true;

  return false;
}

//Thu gọn chuỗi
function shorten_string($str){
  if(strlen($str) > 13)
    return substr($str,0,10)."...";
  else
    return $str;
}

//Xoá ngoặc kép
function remove_bracket($str){
  return str_replace('"', '', $str);
}

//Chuyển chuỗi biến sang chuỗi parameter
//vd: a,b,c sang "a","b","c" để đưa vào gọi SP và FN
function vars_to_para($vars){
  if(strpos($vars,',') != false)
  {
    $str = "";
    $arr = explode(',',$vars);
    $length = count($arr);
    for($i = 0; $i < $length - 1; $i++){
      $str .= "\"".remove_bracket($arr[$i])."\",";
    }

    $str.= "\"".end($arr)."\"";

    return $str;
  }
  else
    return $vars;
}

//Kiểm tra biến có trong chuỗi biến không
function check_exists($vars, $var){
  return strpos(" ".vars_to_para($vars), $var);
}

//Hàm gọi function không có biến
function fn_call($conn, $name){
  if($conn == "NULL")
    return null;

  $query = "SELECT ".$name."();";
  $result = $conn->query($query);

  return $result->fetch()[0];
}

//Hàm gọi function với biến vào
function fn_call_vars($conn, $name, $vars){
  if($conn == "NULL")
    return null;

  $query = "SELECT ".$name."(".vars_to_para($vars).");";
  $result = $conn->query($query);

  return $result->fetch()[0];
}

//Hàm gọi procedure select không có biến
function sp_call($conn, $name){
  if($conn == "NULL")
    return null;

  $query = "CALL ".$name."();";
  $stmt = $conn->query($query);

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

//Hàm gọi procedure select có biến
function sp_call_vars($conn, $name, $vars){
  if($conn == "NULL")
    return null;

  $query = "CALL ".$name."(".vars_to_para($vars).");";
  $stmt = $conn->query($query);

  $result[] = $stmt->fetch();

  while($row = $stmt->fetch()) {
      $result[] = $row;
  }

  return $result;
}

//Hàm gọi procedure thực thi không có biến
//Các procedure Insert, delete, update, ....
function sp_exec($conn, $name){
  if($conn == "NULL")
    return null;

  $query = "CALL ".$name."();";
  $stmt = $conn->query($query);
}

//Hàm gọi procedure thực thi có biến
//Các procedure Insert, delete, update, ....
function sp_exec_vars($conn, $name){
  if($conn == "NULL")
    return null;

  $query = "CALL ".$name."(".vars_to_para($vars).");";
  $stmt = $conn->query($query);
}

function item_category_list($conn){
  return sp_call($conn, "SP_GET_ALL_ITEM_CAT");
}

function all_item($conn){
  return sp_call($conn, "SP_GET_ALL_ITEMS");
}

function item_list($conn, $item_cat){
  return sp_call_vars($conn, "SP_GET_LIST_ITEM_OF_CAT",$item_cat);
}

function combo_list($conn){
  return sp_call($conn, "SP_GET_ALL_COMBOS");
}

function combo_details($conn, $comboid){
  return sp_call_vars($conn, "SP_GET_COMBO_DETAILS",$comboid);
}

function item_type_list($conn){
  return sp_call($conn, "SP_GET_ALL_ITEM_TYPES");
}

function blog_list($conn){
  return sp_call($conn, "SP_GET_ALL_BLOGS");
}

function cart_details($conn, $cartid){
  return sp_call_vars($conn, "SP_GET_CART_DETAILS",$cartid);
}

function cart_value($conn, $cartid){
  return fn_call_vars($conn, "FN_GET_CART_VALUE", $cartid);
}

function init_cart($conn, $accid){
  $cartid = fn_call_vars($conn, "FN_GET_CARTID", $accid);
  if($cartid == -1)
    sp_exec_vars($conn, "SP_CART_INSERT", $accid);

  return fn_call_vars($conn, "FN_GET_CARTID", $accid);
}

function user_info($conn, $accid){
  return sp_call_vars($conn, "SP_GET_ACCOUNT_INFO", $accid);
}
?>
