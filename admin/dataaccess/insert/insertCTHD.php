<?php 
    require_once '../../../class/Model.php';
    $data = new Model();
?>
<?php
          $sanphamid = isset($_POST['sanpham'])?$_POST['sanpham']:'';
          $soluong = isset($_POST['soluong'])?$_POST['soluong']:'';
          $gia     = isset($_POST['gia'])?$_POST['gia']:'';
          $dathang = isset($_POST['order'])?$_POST['order']:'';
          if(is_numeric($soluong) && is_numeric($gia)){
             $insert = $data->insert('cart_detail',array('product_id' => ''.$sanphamid,'quantity' => ''.$soluong,'price' => ''.$gia,'order_id' => ''.$dathang));
              if (isset($insert)){
                  header("Location: ../../chitiethoadon.php");
              }else {
                 echo "Thêm Thất Bại";
              }
          }else{
              echo "Các Ô Bên Dưới Không Được Rỗng";
          }
?>
       <?php include_once '../general/header.php';?>
            <form id="form-update" action="" name="themdml" method="post">
                     <span class="title-table">Thêm Chi Tiết Hóa Đơn</span>
                     <input type="hidden" name="textPage" value="1" id="textPageUpdate">
                     <input type="hidden" name="textAction" id="textAction" value="">
                     <span id="labelmessageForm" class="labelmessageForm"></span>
                     <div class="pnlUpdateAction">
                        <input type="submit" class="btn btn-default"  name="submit" value="Lưu" > | 
						<a href="../../chitiethoadon.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Trở Về</a>
                        <input style="display: none" type="submit" id="btnUpdateAction">
                     </div>   
                     <br>
                                          
                     <table class="update-table" cellspacing="0" cellpadding="0"><tbody>
                           <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Sản Phẩm</span>
                           </td>
                              <td class="update-td">
                                  <select name="sanpham" style="width: 304px;">
                                  <?php 
                                         $sp = $data->get_list("SELECT * FROM `products`");
                                             foreach ($sp as $arrSp ){
                                                 echo '<option value="'.$arrSp['id'].'">'.$arrSp['name'].'</option>';
                                             }
                                  ?>
                                  </select>
                                </td>
                               </tr>
                                <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Số Lượng</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="soluong" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Giá</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="" name="gia" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Người Đặt</span>
                           </td>
                              <td class="update-td">
                                  <select name="order" style="width: 304px;">
                                  <?php 
                                         $order = $data->get_list("SELECT * FROM `order`");
                                             foreach ($order as $arrOrder){
                                                 echo '<option value="'.$arrOrder['id'].'">'.$arrOrder['fullname'].'</option>';
                                             }
                                  ?>
                                  </select>
                                </td>
                               </tr>
                        </tbody></table>
                  </form>
 </body>
 </html>