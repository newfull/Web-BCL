<?php 
  include_once '../class/Model.php';
  $data = new Model();
  session_start();
  if(isset($_SESSION['giohang'])){
      if(isset($_GET['xoagiohang'])){
          $id = $_GET['xoagiohang'];
          for ($i = 0;$i < count($_SESSION['giohang']);$i++){
              if($_SESSION['giohang'][$i]['id'] == $id && $_SESSION['giohang'][$i]['soluong'] > 0){
                  $_SESSION['giohang'][$i]['soluong'] = $_SESSION['giohang'][$i]['soluong'] - 1;
              }
          }
      }
      if(isset($_GET['conggiohang'])){
        $id = $_GET['conggiohang'];
        for ($i = 0;$i < count($_SESSION['giohang']);$i++){
            if($_SESSION['giohang'][$i]['id'] == $id){
                $_SESSION['giohang'][$i]['soluong'] = $_SESSION['giohang'][$i]['soluong'] + 1;
            }
        }
      }
  }
  
?>
<?php include_once 'general/header.php';?>
        <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Trang Chủ</a>
                        </li>
                        <li>Giỏ Hàng</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">

                        <form method="post" action="checkout1.php">

                            <h1>Giỏ Hàng</h1>
                            <p class="text-muted">Bạn có<?php
                            if(isset($_SESSION['giohang'])){
                                echo " ". count($_SESSION['giohang']);
                            }else {
                                echo " 0";
                            }
                            
                            ?> sản phẩm trong trong giỏ</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                                <tr>
                                                    <th colspan="2">Sản Phẩm</th>
                                                    <th>Số Lượng</th>
                                                    <th>Đơn Giá</th>
                                                    <th>Giảm Giá</th>
                                                    <th colspan="2">Tổng Giá</th>
                                                </tr>
                                            </thead>
                                <?php 
                                $tongtien1 = 0;
                                
                                   if(isset($_SESSION['giohang'])){  
                                       for ($i = 0; $i < count($_SESSION['giohang']); $i++){
                                           if(isset($_SESSION['giohang'][$i])){
                                          $row1 = $data->get_row("SELECT * FROM `products` WHERE `id`=".$_SESSION['giohang'][$i]['id']);
                                          $price1 = $row1['price'] * $_SESSION['giohang'][$i]['soluong'];
                                          $tongtien1 = $tongtien1 + ($row1['price'] * $_SESSION['giohang'][$i]['soluong']);
                                           }
                                           
                                  ?>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                <a href="detail.php?id=<?php echo $row1["id"]?>">
                                                <img src="img/<?php echo $row1['image'];?>" alt="">
                                                </a>
                                            </td>
                                            <td><a href="detail.php?id=<?php echo $row1["id"]?>"><?php echo $row1['name'];?></a>
                                            </td>
                                            <td>
                                           		

                                              <a href="basket.php?xoagiohang=<?php echo $row1['id'];?>"><i class="fa fa-minus-circle"></i></a>
                                                <input type="text" value="<?php echo $_SESSION['giohang'][$i]['soluong'];?>" class="form-control">
                                                <a href="basket.php?conggiohang=<?php echo $row1['id'];?>"><i class="fa fa-plus-circle"></i></a>
                                                
                                            
                                            </td>
                                            <td><?php echo number_format($row1['price']);?> VNĐ</td>
                                            <td style="text-align: center"><?php echo $row1['saleoff']?> %</td>
                                            <td><?php echo number_format($price1); ?> VNĐ</td>
                                            <td>
                                                
    
                                                 <a href="deletecart.php?id=<?php echo $row1["id"];?>"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                       <?php }
                                   }
                                ?>
                                     <tfoot>
                                        <tr>
                                            <th colspan="5">Tổng Giá</th>
                                            <th colspan="2"><?php echo number_format($tongtien);?> VNĐ</th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <!-- /.table-responsive -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="category.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Tiếp Tục Mua Hàng</a>
                                </div>
                                <div class="pull-right">
                                 <button type="submit" class="btn btn-primary">Thanh Toán<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md-9 -->

                <div class="col-md-3">

                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Tổng Tiền Hóa Đơn</h3>
                        </div>
                        <p class="text-muted">Chi Tiết</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Hóa Đơn</td>
                                        <th><?php echo number_format($tongtien1);?> VNĐ</th>
                                    </tr>
                                    <tr>
                                        <td>Phí Vận Chuyển</td>
                                        <th>0,000 VNĐ</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Tổng</td>
                                        <th><?php echo number_format($tongtien)?> VNĐ</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>

            </div>
        <!-- /#content -->

       <?php include_once 'general/footer.php';?>
        <?php include_once 'general/script.php';?>
 


</body>

</html>