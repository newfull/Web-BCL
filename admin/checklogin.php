<?php 
    include_once '../class/Model.php';
    $data = new Model();
    @session_start();
   if (count($_POST) > 0){
       $username = $_POST['username'];
       $password = md5($_POST['password']);
       $password =md5($_POST['password']); 
       $result = $data->get_row("SELECT `id` FROM `customer` WHERE `username`='$username' and `password`='$password'");;
       if ($result){
           $_SESSION['customer'] = $result['id'];
       }else {
           $_SESSION['error']  = 'Đăng nhập thất bại!';
           
       }
       header("Location: index.php");
   }