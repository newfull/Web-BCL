 <?php 
    require_once '../../../class/Model.php';
    $data = new Model();
?>
 <?php
          $danhmuclon = isset($_POST['danhmuc'])?$_POST['danhmuc']:'';
          if(!empty($danhmuclon)){
             $insert = $data->insert('category',array('name' => ''.$danhmuclon));
              if (isset($insert)){
                  header("Location: ../../danhmuclon.php");
              }else {
                 echo "Thêm Thất Bại";
              }
          }else{
              echo "Vui lòng nhập vào ô bên dưới";
          }
?>
<?php include_once '../general/header.php';?>
            <form id="form-update" action="" name="themdml" method="post">
                     <span class="title-table">Thêm Danh Mục Lớn</span>
                     <input type="hidden" name="textPage" value="1" id="textPageUpdate">
                     <input type="hidden" name="textAction" id="textAction" value="">
                     <span id="labelmessageForm" class="labelmessageForm"></span>
                     <div class="pnlUpdateAction">
                        <input type="submit" class="btn btn-default"  name="submit" value="Lưu" > | 
						<a href="../../danhmuclon.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Trở Về</a>
                        <input style="display: none" type="submit" id="btnUpdateAction">
                     </div>   
                     <br>
                                          
                     <table class="update-table" cellspacing="0" cellpadding="0"><tbody>
                           <tr style="display: none;"><td class="update-td">
                              <td class="update-td"><input value="" readonly="" name="txtid" type="text" id="txtid">
                                 <span id="error-id" class="label-validate"></span></td></tr>
                           <tr><td class="update-td" style="width:150px;">
                                 <span class="update-header-td">Tên Danh Mục:</span></td>
                              <td class="update-td"><input style="width:300px" value="" name="danhmuc" type="text" maxlength="255" id="txtname"><span id="error-name" class="label-validate"></span></td></tr>
                        </tbody></table>
                  </form>
 </body>
 </html>