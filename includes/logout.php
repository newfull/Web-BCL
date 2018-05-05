<?php
  require_once '../config.php';
  require_once 'functions.php';
  unset_cookies($conn);
  
  try
  {
    echo "Đăng xuất thành công!";
  } catch(PDOException $e){
   echo $e->getMessage();
  }
?>
