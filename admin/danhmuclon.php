<?php include_once './general/navigation.php';?>
<?php
  require_once '../class/Model.php';
  $data = new Model();
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh Mục Lớn</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Thông tin Danh Mục
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                     <td class="table-body-r"><div>
               <div id="update">
                  <div id="pnlTable">
                     <form method="post" id="form-table" name="form-table">
                        <span class="title-table">Danh Sách Danh Mục Lớn</span>
                        <div id="pnlAction" class="pnlAction">

                           <div id="pnlSearch" class="pnlSearch">

                              <div id="pnlimgbtnSearch" class="pnlimgbtnSearch">

                                 <input type="submit" name="imgbtnSearch" id="imgbtnSearch">

                              </div>
                              <div id="pnltxtSearch" class="pnltxtSearch">
                                <input name="textSearch" class="textSearch" value="" type="text" id="textSearch" placeholder="keyword">

                              </div>

                           </div>
                           <div id="pnlActionLeft" class="pnlActionLeft">

                              <a id="lbnAddNew"  title="Add new" href="./dataaccess/insert/insertDML.php" class="addnew-btn-action">Thêm Mới</a>&nbsp;&nbsp;|
                              <a id="lbnDelete" title="Delete" href="#" class="delete-btn-action">Delete</a>&nbsp;&nbsp;|
                              <a id="lbnRefresh" title="Refresh" href="#" class="refresh-btn-action">Refresh</a>
                              <input type="hidden" name="isDeleteMultiple" id="isDeleteMultiple" value="">
                           </div>
                        </div>
                           <table cellspacing="0" cellpadding="3" rules="cols" id="gvwcategory" class="table-display">
                              <tbody><tr class="table-header">
                                    <th scope="col" class="cbxSelectAll">
                                       <input id="cbxSelectAll" type="checkbox" name="cbxSelectAll">
                                    </th>
                                    <th scope="col" style="width:150px;"><a id="sort-id" href="#" >Danh Mục ID</a></th>
                                    <th scope="col"><a id="sort-name" href="#" >Tên Danh Mục</a></th>
                                    <th scope="col">Action</th>
                                 </tr>
                                 <tr class="table-search-one">
                                    <th></th>
                                    <th scope="col"><input placeholder="Tìm Kiếm Theo Id" type="text" onchange="return search(this.value, this.id);" id="search_id" value=""></th>
                                    <th scope="col"><input placeholder="Tìm Kiếm Theo Tên" type="text" onchange="return search(this.value, this.id);" id="search_name" value=""></th>
                                    <th></th>
                                 </tr>
                                 <?php 
                                    $sql = $data->get_list("SELECT * FROM `category`");
                                        foreach ($sql as $row){
                                            echo '<tr class="table-row-one">
                                                   <td>
                                                   <span class="cbxSelectOne"><input value="1" type="checkbox" name="cbxSelectOne[]"></span>
                                                </td>
                                                <td><span class="table-row-primary">'.$row['id'].'</span></td>
                                                <td>'.$row['name'].'</td>
                                                <td><a href="./dataaccess/update/updateDML.php?id='.$row['id'].'">Edit</a> |
                                                    <a href="./dataaccess/delete/deleteDML.php?id='.$row['id'].'">Delete</a>
                                                </td>
                                                  </tr>';
                                        }
                                    
                                 
                                 ?>
                              </tbody>
                              </table>
                        </div>
                  </div>   
               </div>
         </td>
       </table>
                            
    </div>
<?php include_once 'general/footer.php';?>

</body>

</html>
