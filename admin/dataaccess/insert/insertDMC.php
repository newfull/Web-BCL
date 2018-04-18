<?php 
    require_once '../../../class/Model.php';
    $data = new Model();
?>
<?php
          $danhmuccon = isset($_POST['danhmuccon'])?$_POST['danhmuccon']:'';
          $danhmuclon = isset($_POST['danhmuc'])?$_POST['danhmuc']:'';
          if(!empty($danhmuccon) && is_numeric($danhmuclon)){
             $insert = $data->insert('category_detail',array('name' => ''.$danhmuccon,'category_id' => ''.$danhmuclon));
              if (isset($insert)){
                  header("Location: ../../danhmuccon.php");
              }else {
                 echo "Thêm Thất Bại";
              }
          }
?>
<?php include_once '../general/header.php';?>
            <form id="form-update" action="" name="themdml" method="post">
                     <span class="title-table">Thêm Danh Mục Con</span>
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
                                 <input style="width:300px" value="" name="danhmuccon" type="text" maxlength="255" id="txtname">
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
                                                 echo '<option value="'.$arrDML['id'].'">'.$arrDML['name'].'</option>';
                                             }
                                  ?>
                                  </select>
                                </td>
                               </tr>
                        </tbody></table>
                  </form>
 </body>
 </html>