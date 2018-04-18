<?php include_once './general/navigation.php';?>
<?php 
    require_once '../class/Model.php';
    $data = new Model();
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Chi Tiết Hóa Đơn</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Thông tin Chi Tiết
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                     <td class="table-body-r"><div>
               <div id="update">
                  <div id="pnlTable">
                     <form method="post" id="form-table" name="form-table">
                        <span class="title-table">Danh Sách</span>
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

                              <a id="lbnAddNew" title="Add new" href="dataaccess/insert/insertCTHD.php" class="addnew-btn-action">Add new</a>&nbsp;&nbsp;|
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
                                    <th scope="col" style="width:150px;"><a id="sort-id" href="#">Chi Tiết ID</a></th>
                                    <th scope="col"><a id="sort-name" href="#" >Tên Sản Phẩm</a></th>
                                    <th scope="col"><a id="sort-url" href="#" >Số Lượng</a>
                                    <th scope="col"><a id="sort-url" href="#" >Giá</a></th>
                                    <th scope="col"><a id="sort-url" href="#" >Người Đặt</a></th><th scope="col">Action</th>
                                 </tr>
                                 <tr class="table-search-one">
                                    <th></th>
                                    <th scope="col"><input placeholder="Tìm Kiếm Theo ID" type="text"  id="search_id" value=""></th>
                                    <th scope="col"><input placeholder="Tìm Kiếm Theo Tên" type="text"  id="search_name" value=""></th>
                                    <th scope="col"><input placeholder="Tìm Kiếm Theo Số Lượng" type="text" id="search_url" value=""></th>
                                    <th scope="col"><input placeholder="Tìm Kiếm Theo Giá" type="text" id="search_url" value=""></th>
                                    <th scope="col"><input placeholder="Tìm Kiếm Theo Đặt Hàng" type="text" id="search_url" value=""></th>
                                    <th></th>
                                 </tr>
                                 <?php 
                                    $sql = $data->get_list("SELECT `a`.`id`,`c`.`name`,`a`.`quantity`,`a`.`price`,`b`.`fullname` FROM `cart_detail` AS `a`, `order` AS `b`,`products` AS `c` WHERE `a`.`order_id` = `b`.`id` AND `a`.`product_id` = `c`.`id`");
                                        foreach ($sql as $row){
                                            echo '<tr class="table-row-one">
                                                   <td>
                                                   <span class="cbxSelectOne"><input value="1" type="checkbox" name="cbxSelectOne[]"></span>
                                                </td>
                                                <td><span class="table-row-primary">'.$row['id'].'</span></td>
                                                <td>'.$row['name'].'</td>
                                                <td>'.$row['quantity'].'</td>
                                                <td>'.number_format($row['price']).'</td>
                                                 <td>'.$row['fullname'].'</td>
                                                <td><a href="dataaccess/update/updateCTHD.php?id='.$row['id'].'">Edit</a> |
                                                   <a href="dataaccess/delete/deleteCTHD.php?id='.$row['id'].'">Delete</a>
                                                </td>
                                                  </tr>';
                                        }
                                    
                                 
                                 ?>
                              </tbody></table>
                        </div>
                        <div id="pnlpaging" class="pnlpaging">

                           <div id="pnlNumber" class="pnlNumber">
                              <input class="paging-btn-primary" type="button" value="1">   </div>
                              <div id="pnlPrevNext" class="pnlPrevNext">
                              <input class="input-paging" type="image" name="imgbtnPrev" id="imgbtnPrev" >
                              <input class="input-paging"  type="image" name="imgbtnNext" id="imgbtnNext">
                           </div>
                           <div id="pnlinputNumber">
                              <div class="divRefresh">
                                 <input type="image" name="imgbtnRefresh" id="imgbtnRefresh" src="http://www.vilise.com/img/refresh.png" class="input-paging">
                              </div>
                              <span id="labelTotalpage" class="labelTotalpage">Total pages: 1</span>
                              <input name="textPage" type="text" value="1" id="textPage" class="textPage">
                           </div>
                          </div>   
                        </form>
                  </div>   
               </div>
            </div>
         </td>
       </table>
                            
    </div>
<?php include_once 'general/footer.php';?>

</body>

</html>
