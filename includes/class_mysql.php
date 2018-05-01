<?php
class class_mysql {
	var $host = "";
	var $user = "";
	var $pass = "";
	var $name = "";

function db_connect($sql_host, $sql_user, $sql_password) {
	return mysql_connect($sql_host, $sql_user, $sql_password);
}

function db_select_db($sql_db) {
	return mysql_select_db($sql_db) || die("Could not connect to SQL db");
}

function query($query) {
	$result = mysql_query($query);
	return $result;
}

function db_result($result, $offset) {
	return mysql_result($result, $offset);
}

function result($query, $row=0, $field) {
	$r = @mysql_result($query, $row, $field);
	return $r;
}

function db_fetch_row($result) {
	return mysql_fetch_row($result);
}

function getRow($query) {
	global $db;
	$result=$db->query($query);
	return @mysql_fetch_array($result);
}

function db_fetch_array($result, $flag=MYSQL_ASSOC) {
    return mysql_fetch_array($result, $flag);
}

function fetchRow($result, $flag=MYSQL_ASSOC) {
    return mysql_fetch_array($result, $flag);
}

function db_free_result($result) {
	@mysql_free_result($result);
}

function numRows($result) {
   return @mysql_num_rows($result);
}

function db_insert_id() {
   return mysql_insert_id();
}

function db_affected_rows() {
	return mysql_affected_rows();
}

function db_error($mysql_result, $query) {
	global $debug_mode, $error_file_size_limit, $error_file_path, $PHP_SELF;
	global $config, $login, $REMOTE_ADDR, $current_location;

	if ($mysql_result)
		return false;
	else {
		$mysql_error = mysql_errno()." : ".mysql_error();
			echo "<B><FONT COLOR=DARKRED>INVALID SQL: </FONT></B>$mysql_error<BR>";
			echo "<B><FONT COLOR=DARKRED>SQL QUERY FAILURE:</FONT></B> $query <BR>";
			flush();
	}
	return true;
}

#
# Execute mysql query adn store result into associative array with
# column names as keys...
#
function func_query($query) {
	global $db;
	$result = false;
	if ($p_result = $db->query($query)) {
	   while($arr = $db->db_fetch_array($p_result))
			$result[]=$arr;
			$db->db_free_result($p_result);
	}

	return $result;

}


function getAll($query) {
	global $db;
	$result = false;
	if ($p_result = $db->query($query)) {
	   while($arr = $db->db_fetch_array($p_result))
			$result[]=$arr;
			$db->db_free_result($p_result);
	}

	return $result;

}


#
# Execute mysql query and store result into associative array with
# column names as keys and then return first element of this array
# If array is empty return array().
#
function func_query_first($query) {
	global $db;
	if ($p_result = $db->query($query)) {
		$result = $db->db_fetch_array($p_result);
		$db->db_free_result($p_result);
	}
	return is_array($result)?$result:array();

}

#
# Execute mysql query and store result into associative array with
# column names as keys and then return first cell of first element of this array
# If array is empty return false.
#
function func_query_first_cell($query) {
	global $db;
	if ($p_result = $db->query($query)) {
		$result = $db->db_fetch_row($p_result);
		$db->db_free_result($p_result);
	}
	return is_array($result)?$result[0]:false;
}

//Add HTML character incoding to strings
function db_output($string) {
	return htmlspecialchars($string);
}
//Add slashes to incoming data
function db_input($string) {
	if (function_exists('mysql_real_escape_string')) {
	  return mysql_real_escape_string($string);
	} elseif (function_exists('mysql_escape_string')) {
	  return mysql_escape_string($string);
	}
	return addslashes($string);
}


}
?>
