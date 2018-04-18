<?php 
        require_once '../../../class/Model.php';
        $data = new Model();
        $id = $_GET['id'];
        $arrcthd = $data->get_row("SELECT `id`,`product_id`,`quantity`,`price`,`order_id` FROM `cart_detail` WHERE `id`='$id'");
        if (isset($_POST['submit'])){
            $delete = $data->remove('cart_detail',"`id`='$id'");
            if(isset($delete)){
                header("Location: ../../chitiethoadon.php");
            }else {
                echo "Xóa Thất Bại";
            }
        }
?>
<?php include_once '../general/header.php';?>
            <form id="form-update" action="" name="themdml" method="post">
                     <span class="title-table">Xóa Chi Tiết Hóa Đơn</span>
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
                                             foreach ($sp as $arrSp){
                                                 if ($arrSp['id'] == $arrcthd['product_id']) $selected ='selected=selected';else $selected = '';
                                                 echo '<option '.$selected.' value="'.$arrSp['id'].'">'.$arrSp['name'].'</option>';
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
                                 <input style="width:300px" value="<?php echo $arrcthd['quantity'];?>" name="soluong" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                               <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Giá</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo number_format($arrcthd['price']);?>" name="gia" type="text" maxlength="255" id="txtname">
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
                                             foreach ($order as $arrOrder ){
                                                 if ($arrOrder['id'] == $arrcthd['order_id']) $selected ='selected=selected';else $selected = '';
                                                 echo '<option '.$selected.' value="'.$arrOrder['id'].'">'.$arrOrder['fullname'].'</option>';
                                             }
                                  ?>
                                  </select>
                                </td>
                               </tr>
                        </tbody></table>
                  </form>
 </body>
 </html>