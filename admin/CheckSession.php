<?php
   include_once '../class/Model.php';
   $data = new Model();
@session_start();
	if(!isset($_SESSION['customer']))
	{
		header("Location: login.php");
	}else
	{
		 $row = $data->get_row("SELECT * FROM `customer` WHERE `id`=".$_SESSION['customer']);
		 if(!($row['username'] == 'admin'))
		 {
           header("Location: ../index.php");
         }                                       
	}
?>