<?php
  session_start();
  require_once '../config.php';
  require_once 'functions.php';
  unset($_SESSION['current']);

  try
  {
    echo "Đăng xuất thành công!";
  } catch(PDOException $e){
   echo $e->getMessage();
  }
?>
