<?php
  require_once '../config.php';
  require_once 'functions.php';
  if($conn != "NULL")
    unset_cookies($conn);

  $user = trim($_POST['login-username']);
  $password = trim($_POST['login-password']);

//  $password = md5($user_password);

  try
  {
  if($conn != "NULL"){
   $stmt = $conn->prepare("SELECT * FROM ACCOUNT WHERE ACCOUNTUSER=:username");
   $stmt->execute(array(":username"=>$user));
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $count = $stmt->rowCount();

   if($row['ACCOUNTPASS']==$password){
     if(isset($_POST['save-user']))
       setcookie('username', $user, $cookielife, '/');
     else{
       unset($_COOKIE['username']);
       setcookie('username', null, time() - 3600, '/');
     }

     echo "Đăng nhập thành công";
     setcookie('current', $row['ACCOUNTID'], $cookielife, '/');
     $stmt = $conn->prepare('SELECT * FROM CUSTOMER WHERE CUSTOMERID = :id');
     $stmt->execute(array(":id"=>$row['CUSTOMERID']));
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
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
