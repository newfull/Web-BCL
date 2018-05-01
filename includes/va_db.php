<?php
$table_prefix='';

function vaUpdate($table, $arr, $where=""){
	global $db,$table_prefix;

	if (count($arr) <= 0)

	return false;

	$keys = array_keys($arr);

	$sql = "UPDATE ".$table_prefix.$table." SET ";
	$sql .= "`".$keys[0]."`='".$arr[$keys[0]]."' ";
	for ($i = 1; $i < count($keys); $i++) {
		$sql .= ", `".$keys[$i]."`='".$arr[$keys[$i]]."' ";
	}
	if ($where) $sql .= " WHERE ".$where;
	//echo $sql;
	$db->query($sql);
}

function vaInsert($table, $arr){
	global $db,$table_prefix;

	if (count($arr) <= 0)	return false;

	$keys = array_keys($arr);

	$sql = "INSERT INTO ".$table_prefix.$table." ( ";
	$sql .= "`".$keys[0]."`";
	for ($i = 1; $i < count($keys); $i++) {
		$sql .= ",`".$keys[$i]."`";
	}

	$sql .= ") VALUES (";
	$sql .= "'".$arr[$keys[0]]."'";
	for ($i = 1; $i < count($keys); $i++) {
		$sql .= ",'".$arr[$keys[$i]]."'";
	}
	$sql .= ");";
	//echo $sql;
	$db->query($sql);
	$post_id = mysql_insert_id();
	return $post_id;
}

function vaDelete($tbl, $where){
	global $db,$table_prefix;
	$sql = "DELETE FROM `".$table_prefix.$tbl."` WHERE $where";
	$db->query($sql);
}

function deletecate($table,$id=0,$img='false') {
	global $db;
	$sql="select id from ".$table."cate where pid=".$id." order by id";
	$re=$db->getAll($sql);
	if ($re) {
		for ($i=0;$i<count($re);$i++) {
			if ($img=='true') {
				$sqlstmt="select img from ".$table."cate where id=".$re[$i]['id'];
				//echo $sqlstmt;
				$r = $db->getRow($sqlstmt);
				$img_old=$r['img'];
				$delfile = "./upload/".$table."cate/".$img_old;
				if(file_exists($delfile) && $img_old!="") unlink($delfile);
			}

			$sqldel="delete from ".$table."cate where id=".$re[$i]['id'];
			$db->query($sqldel);

			$sqlstmt="select img from ".$table." where cate=".$re[$i]['id'];
			$r = $db->getAll($sqlstmt);
			for($j=0;$j<count($r);$j++) {
				$img_old=$r[$j]['img'];
				$delfile = "./upload/".$table."/".$img_old;
				if(file_exists($delfile) && $img_old!="") unlink($delfile);
			}
			$sqldel="delete from ".$table." where cate=".$re[$i]['id'];
			$db->query($sqldel);

			$sql="select id from ".$table."cate where pid=".$re[$i]['id'];
			$r=$db->query($sql);
			$num1=$db->numRows($r);
			if ($num1>0) {
				deletecate($table,$re[$i]['id'],$img);
			}
		}
	}
}

?>
