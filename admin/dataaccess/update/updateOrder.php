 <?php
        require_once '../../../class/Model.php';
        $data = new Model();
        $id = $_GET['id'];
        $arrOrder = $data->get_row("SELECT `id`,`fullname`,`phone`,`address`,`email`,`shipping_fullname`,`shipping_address`,`shipping_phone`,`total`,`date`,`guest_id` FROM `order` WHERE `id`='$id'");
        if (isset($_POST['submit'])){
            $hoten    = $_POST['fullname'];
            $sdt      = $_POST['phone'];
            $diachi   = $_POST['address'];
            $email    = $_POST['email'];
            $nguoinhan     = $_POST['nguoinhan'];
            $diachinhan   = $_POST['diachinhan'];
            $sdtnguoinhan   = $_POST['sdtnguoinhan'];
            $tongtien  = $_POST['tongtien'];
            $ngaymua   = $_POST['ngaymua'];
            $khachhang   = $_POST['khachhang'];
            $update = $data->update('`order`',array('fullname' => $hoten,'phone' => $sdt,'address' => $diachi,'email' => $email,'shipping_fullname' => $nguoinhan,'shipping_address' => $diachinhan,'shipping_phone' => $sdt,'total' => $tongtien,'date' => $ngaymua,'guest_id' => $khachhang),"`id`='$id'");
            if(isset($update)){
                header("Location: ../../dathang.php");
            }else {
                echo "Sửa Thất Bại";
            }
        }
?>
<?php include_once '../general/header.php';?>
            <form id="form-update" action="" name="themdml" method="post">
                     <span class="title-table">Sửa Đơn hàng</span>
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
                                 <input style="width:300px" value="<?php echo $arrOrder['id'];?>" name="keyid" type="text" readonly="readonly" maxlength="255" id="txtname">
                               </td>
                               </tr>
                           <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Họ Tên</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arrOrder['fullname'];?>" name="fullname" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                                <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Số Điện Thoại</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arrOrder['phone'];?>" name="phone" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Địa Chỉ</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arrOrder['address'];?>" name="address" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Email</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arrOrder['email'];?>" name="email" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Tên Người Nhận</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arrOrder['shipping_fullname'];?>" name="nguoinhan" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Địa Chỉ Nhận</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arrOrder['shipping_address'];?>" name="diachinhan" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Số Điện Thoại Người Nhận</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arrOrder['shipping_phone']?>" name="sdtnguoinhan" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Tổng Tiền</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo number_format($arrOrder['total']);?>" name="tongtien" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Ngày Mua</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arrOrder['date']?>" name="ngaymua" type="date" maxlength="255" id="txtname">
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
                                                 if ($arrKH['id'] == $arrOrder['guest_id']) $selected ='selected=selected';else $selected = '';
                                                 echo '<option '.$selected.' value="'.$arrKH['id'].'">'.$arrKH['fullname'].'</option>';
                                             }
                                  ?>
                                  </select>
                                </td>
                               </tr>
                        </tbody></table>
                  </form>
 </body>
 </html>