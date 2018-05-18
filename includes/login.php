<?php
  session_start();
  require_once '../config.php';
  require_once 'functions.php';
  if($conn != "NULL")
    session_unset();

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
       $_SESSION["username"] = $user;
     else{
       unset($_SESSION['username']);
     }

     echo "Đăng nhập thành công";
     $_SESSION["current"] = $row['ACCOUNTID'];
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
