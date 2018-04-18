 <?php 
    require_once '../../../class/Model.php';
    $data = new Model();
?>
 <?php
          $id = isset($_POST['id'])?$_POST['id']:'';
          $hoten = isset($_POST['hoten'])?$_POST['hoten']:'';
          $sodienthoai = isset($_POST['sodienthoai'])?$_POST['sodienthoai']:'';
          $diachi = isset($_POST['diachi'])?$_POST['diachi']:'';
          $email = isset($_POST['email'])?$_POST['email']:'';
          $user = isset($_POST['user'])?$_POST['user']:'';
          if(!empty($hoten) && !empty($id) && is_numeric($sodienthoai)&& !empty($diachi) && !empty($email) && is_numeric($user)){
             $insert = $data->insert('guest',array('id' => ''.$id,'fullname' => ''.$hoten,'phone' => ''.$sodienthoai,'address' => ''.$diachi,'email' => ''.$email,'customer_id' => ''.$user));
              if (isset($insert)){
                  header("Location: ../../khachhang.php");
              }else {
                 echo "Thêm Thất Bại";
              }
          }else{
              echo "Các Ô Bên Dưới Không Được Rỗng Và Số Điện Thoại và User Phải Là Số";
          }
?>
           <?php include_once '../general/header.php';?>
            <form id="form-update" action="" name="themdml" method="post">
                     <span class="title-table">Thêm Khách Hàng</span>
                     <input type="hidden" name="textPage" value="1" id="textPageUpdate">
                     <input type="hidden" name="textAction" id="textAction" value="">
                     <span id="labelmessageForm" class="labelmessageForm"></span>
                     <div class="pnlUpdateAction">
                        <input type="submit" class="btn btn-default"  name="submit" value="Lưu" > | 
						<a href="../../khachhang.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Trở Về</a>
                        <input style="display: none" type="submit" id="btnUpdateAction">
                     </div>   
                     <br>
                                          
                     <table class="update-table" cellspacing="0" cellpadding="0"><tbody>
                     <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">ID</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="id" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                           <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Họ Tên</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="hoten" type="text" maxlength="255" id="txtname">
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
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">User</span>
                           </td>
                              <td class="update-td">
                                  <select name="user" style="width: 304px;">
                                  <?php 
                                         $user = $data->get_list("SELECT * FROM `customer`");
                                             foreach ($user as $arrUser){
                                                 echo '<option value="'.$arrUser['id'].'">'.$arrUser['fullname'].'</option>';
                                             }
                                  ?>
                                  </select>
                                </td>
                               </tr>
                        </tbody></table>
                  </form>
 </body>
 </html>