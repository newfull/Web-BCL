<?php 
       require_once '../../../class/Model.php';
      $data = new Model();
      $id = $_GET['id'];
      $arrdm = $data->get_row("SELECT `id`,`name`,`category_id` FROM `category_detail` WHERE `id`='$id'");
      if (isset($_POST['submit'])){
          $tendanhmuc = $_POST['danhmuccon'];
          $danhmuc = $_POST['danhmuc'];
          $update = $data->update('category_detail',array('name' => $tendanhmuc,'category_id' => $danhmuc),"`id`='$id'");
          if(isset($update)){
              header("Location: ../../danhmuccon.php");
          }else {
              echo "Sửa Thất Bại";
          }
      }
      
?>
 <?php include_once '../general/header.php';?>
            <form id="form-update" action="" name="themdml" method="post">
                     <span class="title-table">Sửa Danh Mục Con</span>
                     <input type="hidden" name="textPage" value="1" id="textPageUpdate">
                     <input type="hidden" name="textAction" id="textAction" value="">
                     <span id="labelmessageForm" class="labelmessageForm"></span>
                     <div class="pnlUpdateAction">
                        <input type="submit" class="btn btn-default"  name="submit" value="Lưu" > | 
						<a href="../../danhmuccon.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Trở Về</a>
                        <input style="display: none" type="submit" id="btnUpdateAction">
                     </div>   
                     <br>
                                          
                     <table class="update-table" cellspacing="0" cellpadding="0"><tbody>
                           <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Tên Danh Mục Con</span>
                           </td>
                              <td class="update-td">
                                 <input style="width:300px" value="<?php echo $arrdm['name'];?>" name="danhmuccon" type="text" maxlength="255" id="txtname">
                               </td>
                               </tr>
                                <tr>
                           <td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Danh Mục Lớn</span>
                           </td>
                              <td class="update-td">
                                  <select name="danhmuc" style="width: 304px;">
                                  <?php 
                                         $DML = $data->get_list("SELECT * FROM `category`");
                                             foreach ($DML as $arrDML){
                                                 if ($arrDML['id'] == $arrdm['category_id']) $selected ='selected=selected';else $selected = '';
                                                 echo '<option '.$selected.' value="'.$arrDML['id'].'">'.$arrDML['name'].'</option>';
                                             }
                                  ?>
                                  </select>
                                </td>
                               </tr>
                        </tbody></table>
                  </form>
 </body>
 </html>