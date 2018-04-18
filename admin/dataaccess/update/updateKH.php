 <?php
        require_once '../../../class/Model.php';
        $data = new Model();
        $id = $_GET['id'];
        $arrkh = $data->get_row("SELECT `id`,`fullname`,`phone`,`address`,`email`,`customer_id` FROM `guest` WHERE `id`='$id'");
        if (isset($_POST['submit'])){
            $hoten    = $_POST['hoten'];
            $sdt      = $_POST['sodienthoai'];
            $diachi   = $_POST['diachi'];
            $email    = $_POST['email'];
            $user     = $_POST['user'];
            $update = $data->update('guest',array('fullname' => $hoten,'phone' => $sdt,'address' => $diachi,'email' => $email,'customer_id' => $user),"`id`='$id'");
            if(isset($update)){
                header("Location: ../../khachhang.php");
            }else {
                echo "Sửa Thất Bại";
            }
        }
        
?>
 <?php include_once '../general/header.php';?>
            <form id="form-update" action="" name="themdml" method="post">
                     <span class="title-table">Sủa Khách Hàng</span>
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
                                 <input style="width:300px" value="<?php echo $arrkh['id'];?>" name="id" type="text" readonly="readonly" maxlength="255" id="txtname">
                               </td>
                               </tr>
                           <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Họ Tên</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arrkh['fullname'];?>" name="hoten" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                                <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Số Điện Thoại</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arrkh['phone'];?>" name="sodienthoai" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Địa Chỉ</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arrkh['address'];?>" name="diachi" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Email</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arrkh['email']?>" name="email" type="text" maxlength="255" id="txtname">
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
                                                 if ($arrUser['id'] == $arrkh['customer_id']) $selected ='selected=selected';else $selected = '';
                                                 echo '<option '.$selected.' value="'.$arrUser['id'].'">'.$arrUser['fullname'].'</option>';
                                             }
                                  ?>
                                  </select>
                                </td>
                               </tr>
                        </tbody></table>
                  </form>
 </body>
 </html>