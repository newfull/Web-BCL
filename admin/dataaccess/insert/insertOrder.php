<?php 
    require_once '../../../class/Model.php';
    $data = new Model();
?>
<?php
          $id = isset($_POST['keyid'])?$_POST['keyid']:'';
          $hoten = isset($_POST['fullname'])?$_POST['fullname']:'';
          $sodienthoai  = isset($_POST['phone'])?$_POST['phone']:'';
          $diachi       = isset($_POST['address'])?$_POST['address']:'';
          $email        = isset($_POST['email'])?$_POST['email']:'';
          $nguoinhan    = isset($_POST['nguoinhan'])?$_POST['nguoinhan']:'';
          $diachinhan   = isset($_POST['diachinhan'])?$_POST['diachinhan']:'';
          $sdtnguoinhan = isset($_POST['sdtnguoinhan'])?$_POST['sdtnguoinhan']:'';
          $tongtien     = isset($_POST['tongtien'])?$_POST['tongtien']:'';
          $ngaymua      = isset($_POST['ngaymua'])?$_POST['ngaymua']:'';
          $khachhang    = isset($_POST['id'])?$_POST['id']:'';
          if(is_numeric($sodienthoai) && !empty($hoten) && !empty($diachi) && !empty($email) && !empty($tongtien) && !empty($ngaymua) && is_numeric($khachhang)){
             $insert = $data->insert('`order`',array('id' => ''.$id,'fullname' => ''.$hoten,'phone' => ''.$sodienthoai,'address' => ''.$diachi,'email' => ''.$email,'shipping_fullname' => ''.$nguoinhan,'shipping_address' => ''.$diachinhan,'shipping_phone' => ''.$sdtnguoinhan,'total' => ''.$tongtien,'date' => ''.$ngaymua,'guest_id' => ''.$khachhang));
              if (isset($insert)){
                  header("Location: ../../dathang.php");
              }else {
                 echo "Thêm Thất Bại";
              }
          }else{
              echo "Vui lòng nhập lại và Số Điện Thoại và Khách Hàng ID Phải Là Số";
          }
?>
<?php include_once '../general/header.php';?>
            <form id="form-update" action="" name="themdml" method="post">
                     <span class="title-table">Thêm Đơn Hàng</span>
                     <input type="hidden" name="textPage" value="1" id="textPageUpdate">
                     <input type="hidden" name="textAction" id="textAction" value="">
                     <span id="labelmessageForm" class="labelmessageForm"></span>
                     <div class="pnlUpdateAction">
                        <input type="submit" class="btn btn-default"  name="submit" value="Lưu" > | 
						<a href="../../dathang.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Trở Về</a>
                        <input style="display: none" type="submit" id="btnUpdateAction">
                     </div>   
                     <br>
                                          
                     <table class="update-table" cellspacing="0" cellpadding="0"><tbody>
                     <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">ID</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="keyid" type="text" maxlength="255" id="txtname">
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
                                 <input style="width:300px" value="" name="phone" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Địa Chỉ</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="address" type="text" maxlength="255" id="txtname">
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
                                 <span class="update-header-td">Tên Người Nhận</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="nguoinhan" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Địa Chỉ Nhận</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="diachinhan" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Số Điện Thoại Người Nhận</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="sdtnguoinhan" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Tổng Tiền</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="tongtien" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Ngày Mua</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="ngaymua" type="date" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Khách Hàng</span>
                           </td>
                              <td class="update-td">
                                  <select name="khachhang" style="width: 304px;">
                                  <?php 
                                         $khachhang = $data->get_list("SELECT * FROM `guest`");
                                             foreach ($khachhang as $arrKH ){
                                                 echo '<option value="'.$arrKH['id'].'">'.$arrKH['fullname'].'</option>';
                                             }
                                  ?>
                                  </select>
                                </td>
                               </tr>
                        </tbody></table>
                  </form>
 </body>
 </html>