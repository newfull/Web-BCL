<?php
  require_once '../config.php';
  require_once 'functions.php';
  unset_cookies($conn);

  $user = trim($_POST['login-username']);
  $password = trim($_POST['login-password']);

  //$password = md5($user_password);

  try
  {

   $stmt = $conn->prepare("SELECT * FROM ACCOUNT WHERE ACCOUNTUSER=:username");
   $stmt->execute(array(":username"=>$user));
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $count = $stmt->rowCount();

   if($row['ACCOUNTPASS']==$password){
     echo "Đăng nhập thành công";
     setcookie('current', $row['ACCOUNTID'], time() + $cookiedeadtime, '/');
     $stmt = $conn->prepare('SELECT * FROM CUSTOMER WHERE CUSTOMERID = :id');
     $stmt->execute(array(":id"=>$row['CUSTOMERID']));
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
   }
   else{
     echo "Tên đăng nhập hoặc mật khẩu sai!";
   }

  }
  catch(PDOException $e){
   echo $e->getMessage();
  }

?>
