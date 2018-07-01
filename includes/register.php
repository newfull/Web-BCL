<?php
  require_once 'config.php';
  require_once 'functions.php';
  if($conn != "NULL")
    session_unset();

  $name = trim($_POST['name']);
  $user = trim($_POST['username']);
  $password = trim($_POST['password']);
  $email = trim($_POST['email']);
  $d = trim($_POST['date-day']);
  $m = trim($_POST['date-month']);
  $y = trim($_POST['date-year']);
  $sex = trim($_POST['gender']);
  $phone = trim($_POST['phonenumber']);
  $noti = trim($_POST['noti']);

  try
  {
  if($conn != "NULL"){
    $result = fn_call_vars($conn, "FN_REGISTER", $user.",".md5($password).",".$name.",".$email.",".$phone.",".$d."-".$m."-".$y.",".$sex.",".$noti);
    if($result == "-2")
      echo "Tên đăng nhập này đã được sử dụng rồi!";
    else
      if($result == "-1")
        echo "Email này đã dùng để đăng ký tài khoản khác!";
      else
        if($result == "0")
          echo "Đăng ký thành công";
  }
  else{
    echo "Không thể kết nối đến cơ sở dữ liệu!";
 }

  }
  catch(PDOException $e){
   echo $e->getMessage();
  }

?>
