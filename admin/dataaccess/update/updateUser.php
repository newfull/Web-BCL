<?php 
    require_once '../../../class/Model.php';
    $data = new Model();
      $id = $_GET['id'];
      $arruser = $data->get_row("SELECT `id`,`username`,`password`,`fullname`,`phone`,`address`,`email` FROM `customer` WHERE `id`='$id'");
      if (isset($_POST['submit'])){
          $username = isset($_POST['username'])?$_POST['username']:'';
          $password = isset($_POST['password'])?$_POST['password']:'';
          $hoten    = isset($_POST['fullname'])?$_POST['fullname']:'';
          $sdt      = isset($_POST['sodienthoai'])?$_POST['sodienthoai']:'';
          $diachi   = isset($_POST['diachi'])?$_POST['diachi']:'';
          $email    = isset($_POST['email'])?$_POST['email']:'';
          $update = $data->update('customer',array('username' => $username,'password' => md5($password),'fullname' => $hoten,'phone' => $sdt,'address' => $diachi,'email' => $email),"`id`= '$id'");
          if(isset($update)){
              header("Location: ../../user.php");
          }else {
              echo "Sửa Thất Bại";
          }
      }
      
?>
 <?php include_once '../general/header.php';?>
            <form id="form-update" action="" name="themdml" method="post">
                     <span class="title-table">Sửa User</span>
                     <input type="hidden" name="textPage" value="1" id="textPageUpdate">
                     <input type="hidden" name="textAction" id="textAction" value="">
                     <span id="labelmessageForm" class="labelmessageForm"></span>
                     <div class="pnlUpdateAction">
                        <input type="submit" class="btn btn-default"  name="submit" value="Lưu" > | 
						<a href="../../user.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Trở Về</a>
                        <input style="display: none" type="submit" id="btnUpdateAction">
                     </div>   
                     <br>
                                          
                     <table class="update-table" cellspacing="0" cellpadding="0"><tbody>
                           <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Username</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arruser['username'];?>" name="username" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                                <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Password</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arruser['password'];?>" name="password" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Họ Tên</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arruser['fullname']?>" name="fullname" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Số Điện Thoại</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arruser['phone'];?>" name="sodienthoai" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Địa Chỉ</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arruser['address']?>" name="diachi" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Email</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arruser['email'];?>" name="email" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                        </tbody>
                      </table>
                  </form>
 </body>
 </html>