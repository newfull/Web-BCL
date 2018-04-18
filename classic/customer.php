<?php
   @session_start();
   include_once '../class/Model.php';
   $data = new Model();
   $userinserver = $data->get_list("SELECT username FROM `customer`");
   $checkuser=0;
   

   if (count($_POST) > 0 && ($_POST['fullname']!='') && ($_POST['username']!='') && ($_POST['password']!='')){
      foreach ($userinserver as $value) {
      if ($_POST['username']==$value['username']) {
        $checkuser=1;
      }
      
      }  

      if ($checkuser==1) {
          header("Location: register.php?loi=2");
      }else
      {

         $fullname = $_POST['fullname'];
         $username = $_POST['username'];
         $passwword= md5($_POST['password']);
         $phone = $_POST['phone'];
         $email = $_POST['email'];
         $address  = $_POST['address'];

         $customer =  array('username' => ''.$username,
                            'password' => ''.$passwword,
                            'fullname' => ''.$fullname,
                            'phone' => ''.$phone,
                            'email' => ''.$email,
                            'address' => ''.$address);
         $query = $data->insert('customer',$customer);

         if($query){
             $id = 0;
             $row = $data->get_row("SELECT `id` FROM `customer` WHERE `username`='$username'");
             $id = $row['id'];
             $_SESSION['customer'] = $id;
             header("Location: index.php");
         }else
         {
            header("Location: register.php?loi=1");
         }
       }
   }else
   {
   header("Location: register.php?loi=1");
   }
?>