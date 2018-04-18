<?php
   session_start();
   $id = $_GET['id'];
   $mamang=0;   
   foreach ($_SESSION['giohang'] as $key => $value)
   {
       if ($value['id']==$id)
       {
           $mamang=$key;
       }
   }
    
  unset($_SESSION['giohang'][$mamang]);
  sort($_SESSION['giohang']);
  header("Location: basket.php");
   ?>