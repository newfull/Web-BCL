 <?php 
    require_once '../../../class/Model.php';
    $data = new Model();
?>
<?php
          $username    = isset($_POST['username'])?$_POST['username']:'';
          $password    = md5(isset($_POST['password'])?$_POST['password']:'');
          $hoten       = isset($_POST['fullname'])?$_POST['fullname']:'';
          $sodienthoai = isset($_POST['sodienthoai'])?$_POST['sodienthoai']:'';
          $diachi      = isset($_POST['diachi'])?$_POST['diachi']:'';
          $email       = isset($_POST['email'])?$_POST['email']:'';
          if(!empty($username) && !empty($password) && !empty($hoten) && !empty($diachi) && !empty($email) && is_numeric($sodienthoai) ){
             $insert = $data->insert('customer',array('username' => ''.$username,'password' => ''.$password,'fullname' =>''.$hoten,'phone' => ''.$sodienthoai,'address' => ''.$diachi,'email' => ''.$email));
              if (isset($insert)){
                  header("Location: ../../user.php");
              }else {
                 echo "Thêm Thất Bại";
              }
          }else{
              echo "Các Ô Bên Dưới Không Được Rỗng và Số Điện Thoại là Số";
          }
?>
 <?php include_once '../general/header.php';?>
            <form id="form-update" action="" name="themdml" method="post">
                     <span class="title-table">Thêm User</span>
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
                                 <input style="width:300px" value="" name="username" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                                <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Password</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="password" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Họ Tên</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="fullname" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Số Điện Thoại</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="sodienthoai" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Địa Chỉ</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="diachi" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Email</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="email" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                        </tbody>
                      </table>
                  </form>
 </body>
 </html>