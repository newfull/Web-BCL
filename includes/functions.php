<?php
session_start();
require_once 'config.php';

function getday($ts){
  $ts = getdate($ts);
  return date("d",$ts);
}

function getmonth($ts){
  $ts = getdate($ts);
  return date("m",$ts);
}

function getyear($ts){
  $ts = getdate($ts);
  return date("y",$ts);
}

//redirecct
function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

//Kiểm tra mảng rỗng
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
  if(empty($vars))
    return "";

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
    return "\"".remove_bracket($vars)."\"";
}

//Chuyển chuỗi parameter về chuỗi bình thường
function para_to_vars($para){
  if(empty($para))
    return "";

  if(strpos($para,',') != false)
  {
    $str = "";
    $arr = explode(',',$para);
    $length = count($arr);
    for($i = 0; $i < $length - 1; $i++){
      $str .= remove_bracket($arr[$i]).",";
    }

    $str.= remove_bracket(end($arr));

    return $str;
  }
  else
    return remove_bracket($para);
}

//Kiểm tra biến có trong chuỗi biến không
function check_exists($vars, $var){
  return strpos(" ".vars_to_para($vars), "\"".$var."\"");
}

//Thêm biến vào chuỗi parameter
function appendToPara($para, $var){
  if(empty($para))
    return "\"".$var."\"";

  $para .= ",\"".$var."\"";
  return $para;
}

//Xoá biến khỏi chuỗi parameter
function deleteFromPara($para, $var){
  $var = "\"".remove_bracket($var)."\"";
  if($para == $var)
    return "";
  else
    if(strpos($para, $var) == 0){
      return str_replace($var.",", "", $para);
    }
    else
        return str_replace(",".$var, "", $para);
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
function sp_exec_vars($conn, $name, $vars){
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

function liked_items($conn, $accid){
  return sp_call_vars($conn, "SP_GET_LIKED_ITEMS", $accid);
}

function combo_list($conn){
  return sp_call($conn, "SP_GET_ALL_COMBOS");
}

function liked_combos($conn, $accid){
  return sp_call_vars($conn, "SP_GET_LIKED_COMBOS", $accid);
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

function cart_details_combo($conn, $cartid){
  return sp_call_vars($conn, "SP_GET_CART_DETAILS_COMBO",$cartid);
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

function user_address($conn, $accid){
  return sp_call_vars($conn, "SP_GET_ACCOUNT_ADDRESS", $accid);
}

function change_cart_details_quant($conn, $cartid, $itemid, $val){
  return fn_call_vars($conn, "FN_CHANGE_CART_DETAIL_QUANT", $cartid.",".$itemid.",".$val);
}

function change_cart_details_combo_quant($conn, $cartid, $comboid, $val){
  return fn_call_vars($conn, "FN_CHANGE_CART_DETAIL_COMBO_QUANT", $cartid.",".$comboid.",".$val);
}

function get_cart_details_val($cart_details){
  return $cart_details['Gia']*$cart_details['SoLuong'];
}

function delete_cart_detail($conn, $cartid, $itemid){
  return sp_exec_vars($conn, "SP_DEL_CART_DETAIL", $cartid.",".$itemid);
}

function delete_cart_detail_combo($conn, $cartid, $comboid){
  return sp_exec_vars($conn, "SP_DEL_CART_DETAIL_COMBO", $cartid.",".$comboid);
}

function delete_all_cart_detail($conn, $cartid){
  return sp_exec_vars($conn, "SP_DEL_ALL_CART_DETAIL", $cartid);
}

function like_goods($conn, $accid, $goodid, $type){
  if($type != "combo")
    $list = vars_to_para(user_info($conn, $accid)[0]["ACCOUNTLIKEDITEMS"]);
  else
    $list = vars_to_para(user_info($conn, $accid)[0]["ACCOUNTLIKEDCOMBOS"]);

  $liked = check_exists($list, $goodid);
  if($liked){
      $list = deleteFromPara($list, $goodid);
      $liked = 1;
  }
  else{
      $list = appendToPara($list, $goodid);
      $liked = 0;
  }

  if($type == "item")
    $query = "CALL SP_UPD_LIKED_ITEMS(".$accid.",\"".para_to_vars($list)."\");";
  else
    $query = "CALL SP_UPD_LIKED_COMBOS(".$accid.",\"".para_to_vars($list)."\");";

  $query .= "(".$accid.",\"".para_to_vars($list)."\");";
  $stmt = $conn->query($query);

  return $liked;
}

function add_cart_detail($conn, $cartid, $itemid){
  return sp_exec_vars($conn, "SP_ADD_CART_DETAIL", $cartid.",".$itemid);
}

function add_cart_detail_combo($conn, $cartid, $comboid){
  return sp_exec_vars($conn, "SP_ADD_CART_DETAIL_COMBO", $cartid.",".$comboid);
}

if(isset($_POST['funct'])) {
  switch($_POST['funct']){
    case 'change_cart_details_quant':
      change_cart_details_quant($conn, $_POST['cart'], $_POST['item'], $_POST['val']);
      break;
    case 'change_cart_details_combo_quant':
      change_cart_details_combo_quant($conn, $_POST['cart'], $_POST['combo'], $_POST['val']);
      break;
    case 'delete_cart_detail':
      delete_cart_detail($conn, $_POST['cart'], $_POST['item']);
      break;
    case 'delete_cart_detail_combo':
      delete_cart_detail_combo($conn, $_POST['cart'], $_POST['combo']);
      break;
    case 'delete_all_cart_detail':
      delete_all_cart_detail($conn, $_POST['cart']);
      break;
    case 'like_item':
      echo like_goods($conn, $_POST['account'], $_POST['item'], "item");
      break;
    case 'like_combo':
      echo like_goods($conn, $_POST['account'], $_POST['combo'], "combo");
      break;
    case 'add_item_to_cart':
      add_cart_detail($conn, $_POST['cart'], $_POST['item']);
      break;
    case 'add_combo_to_cart':
      add_cart_detail_combo($conn, $_POST['cart'], $_POST['combo']);
      break;
  }
}

if(isset($_GET['request'])){
  if($_GET['request'] == 'DOB')
    echo user_info($conn, $_SESSION['current'])[0]['ACCOUNTDOB'];

  if($_GET['request'] == 'add')
    echo json_encode(user_address($conn, $_SESSION['current'])[0]);
}

?>
