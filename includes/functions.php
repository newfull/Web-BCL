<?php
function sql_injection($str){
	if(!ereg('[\\\'\"<>:;,=&]', $str)) {
		return $str;
	} else {
		echo '<script>window.location="index.php";</script>';
	}
}

function lastpage($sqlstmt,$set_per_page) {
	global $db;
	$result = $db->query($sqlstmt);
	$rows = $db->numRows($result);
	$p=ceil($rows/$set_per_page);
	return $p;
}

function plpage($sqlstmt,$page,$set_per_page) {
	global $db;
	$result = $db->query($sqlstmt);
	$rows = $db->numRows($result);
	$p=ceil($rows/$set_per_page);

	$str='';
	if($p<=1) return $str;
	if ($p) $str='';//$str = " Page".$page."/".$p."&nbsp;&nbsp;";

	if ($p<10){
		$j=1; $k=$p;
	} else {
		if($page<10) {
			$j=1; $k=10;
		} else {
			$j=$page-5;
			$k= (($page+5)<$p) ? $page+5 : $p;
		}
	}

	$query_str = explode("&page=", $_SERVER['QUERY_STRING']);

	if ($page>1){
		$pageprev=$page-1;

		$str.="<a href=\"".$_SERVER['SCRIPT_NAME']."?".$query_str[0]."&page=1\"><img src='images/first.gif' border='0' align='absmiddle' /></a>&nbsp;";

		$str.="&nbsp;<a href=\"".$_SERVER['SCRIPT_NAME']."?".$query_str[0]."&page=$pageprev\"><img src='images/prev.gif' border='0' align='absmiddle' /></a>&nbsp;";
	} else {
		$str.="<img src='images/first_o.gif' border='0' align='absmiddle' />&nbsp;";

		$str.="&nbsp;<img src='images/prev_o.gif' border='0' align='absmiddle' />&nbsp;";
	}

	for($i=$j;$i<=$k;$i++){
		if ($i==$page)
			$str.="&nbsp;&nbsp;<span class='link_page'>[$i]</span>&nbsp;&nbsp;";
		else {
			$str.="&nbsp;&nbsp;<a href=\"".$_SERVER['SCRIPT_NAME']."?".$query_str[0]."&page=$i\" class='link_page'>[$i]</a>&nbsp;&nbsp;";
		}
	}

	if ($page<$p){
		$pagenext=$page+1;

		$str.="&nbsp;<a href=\"".$_SERVER['SCRIPT_NAME']."?".$query_str[0]."&page=$pagenext\"><img src='images/next.gif' border='0' align='absmiddle' /></a>&nbsp;";

		$str.="&nbsp;<a href=\"".$_SERVER['SCRIPT_NAME']."?".$query_str[0]."&page=$p\"><img src='images/last.gif' border='0' align='absmiddle' /></a>";
	}	else {
		$str.="&nbsp;<img src='images/next_o.gif' border='0' align='absmiddle' />&nbsp;";

		$str.="&nbsp;<img src='images/last_o.gif' border='0' align='absmiddle' />";
	}

	return $str;
}

function sqlmod($sqlstmt,$page,$set_per_page){ //modified sql query danh cho phan trang
	$from = ($page-1)*$set_per_page;
	return $sqlstmt." LIMIT ".$from." ,".$set_per_page;
}

function page_transfer2($page="index.php") {
	 $page_transfer = $page;
	 include("./templates/transfer2.tpl");
	 exit();
}

function page_transfer($msg,$page) {
	 $showtext = $msg;
	 $page_transfer = $page;
	 include("./templates/transfer.tpl");
	 exit();
}

function cut_string($str,$len,$more){
   if ($str=="" || $str==NULL) return $str;
   if (is_array($str)) return $str;
   $str = trim($str);
   if (strlen($str) <= $len) return $str;
   $str = substr($str,0,$len);
   if ($str != "") {
        if (!substr_count($str," ")) {
             if ($more) $str .= " ...";
             return $str;
            }
        while(strlen($str) && ($str[strlen($str)-1] != " ")) {
                $str = substr($str,0,-1);
            }
            $str = substr($str,0,-1);
            if ($more) $str .= " ...";
        }
        return $str;
}

function get_str($str){
	$vowels = array("<", ">");
	$str = str_replace($vowels, "", $str);
	return $str;
}

function RemoveExtension($fileName) {
	return substr($fileName, 0, strrpos($fileName, '.'));
}

function Extension($fileName) {
	return strtolower(substr($fileName, strrpos($fileName, '.')+1));
}

function get_price($products_price, $quantity=1){
	$price=number_format($products_price*$quantity, 0, '.', ',').' VNĐ';
	return $price;
}

function get_price1($products_price, $quantity=1){
	$price=number_format($products_price*$quantity, 0, '.', ',');
	return $price;
}

function set_price($products_price, $quantity=1){
	$vowels=array(",", '.', " ");
	$price=str_replace($vowels, "", $products_price)*$quantity;
	return $price;
}

?>
