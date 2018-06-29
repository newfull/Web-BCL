<?php
  require_once 'config.php';
  require_once 'functions.php';
  if($conn != "NULL")
    session_unset();

  $user = trim($_POST['login-username']);
  $password = trim($_POST['login-password']);

  try
  {
  if($conn != "NULL"){
    $accid = fn_call_vars($conn, "FN_LOGIN", $user.",".md5($password));

   if($accid != 0){
     if(isset($_POST['save-user']))
       $_SESSION["username"] = $user;
     else{
       unset($_SESSION['username']);
    }

    echo "Đăng nhập thành công";

   $_SESSION['current'] = $accid;
   }
   else{
     echo "Tên đăng nhập hoặc mật khẩu sai!";
   }
  }
  else{
    echo "Không thể kết nối đến cơ sở dữ liệu!";
 }

  }
  catch(PDOException $e){
   echo $e->getMessage();
  }

?>
