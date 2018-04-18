<?php 
    include_once '../class/Model.php';
    $data = new Model();
?>
<?php include_once 'general/header.php';?>
<?php 

        $fullname = isset($_POST['fullname'])?$_POST['fullname']:"Khách Hàng";
        $state = $_POST['state'];
        $address = isset($_POST['address'])?$_POST['address']:'';
        $email = isset($_POST['email'])?$_POST['email']:'';
        $phone = isset($_POST['phone'])?$_POST['phone']:'';
        $shipping_fullname = (isset($_POST['shipping_fullname'])
                                && $_POST['shipping_fullname']!='')?$_POST['shipping_fullname']:$fullname;
        $shipping_state = $_POST['shipping_state'];
        $shipping_address = (isset($_POST['shipping_address'])
                            && $_POST['shipping_address']!='')?$_POST['shipping_address']:$address;
        $shipping_phone = (isset($_POST['shipping_phone'])
                            && $_POST['shipping_phone']!='')?$_POST['shipping_phone']:$phone;
        $shipping_email = (isset($_POST['shipping_email'])
                            && $_POST['shipping_email']!='')?$_POST['shipping_email']:$email;     

?>

    

        <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="./">Trang Chủ</a>
                        </li>
                        <li>Xem Trước</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="checkout.php">
                            <h1>Thanh Toán</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="checkout1.php"><i class="fa fa-map-marker"></i><br>Thông Tin</a>
                                </li>
                                
                                <li class="active"><a href="#"><i class="fa fa-eye"></i><br>Xem Trước</a>
                                </li>
                            </ul>

                            <div class="content">
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
                                          $row1 = $data->get_row("SELECT * FROM `products` WHERE `id`=".$_SESSION['giohang'][$i]['id']);
                                          $price1 = $row1['price'] * $_SESSION['giohang'][$i]['soluong'];
                                          $tongtien1 = $tongtien1 + ($row1['price'] * $_SESSION['giohang'][$i]['soluong']);
                                           
                                  ?>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                <a href="detail.php?id=<?php echo $row1["id"]?>"><img src="img/<?php echo $row1['image'];?>" alt=""></a>
                                            </td>
                                            <td><a href="detail.php?id=<?php echo $row1["id"]?>"><?php echo $row1['name'];?></a>
                                            </td>
                                            <td>
                                                <input type="text" value="<?php echo $_SESSION['giohang'][$i]['soluong'];?>" class="form-control">
                                            </td>
                                            <td><?php echo number_format($row1['price']);?> VNĐ</td>
                                            <td style="text-align: center"><?php echo $row1['saleoff']?> %</td>
                                            <td><?php echo number_format($price1); ?> VNĐ</td>
                                            <td><a href="#"><i class="fa fa-trash-o"></i></a>
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
                            
                             <div class="panel panel-default">
                                  <div class="panel-heading">
                                   Thông Tin Khách Hàng
                                   </div>
                                  <div class="panel-body">
                             <div class="row addresses">
                            <div class="col-md-6">
                                <h2>Thông Tin Khách Hàng</h2>
                                <h4> Tên Khách Hàng: <input type="hidden" name="fullname" value="<?php echo $fullname; ?>" />
                                 	<?php echo $fullname; ?><br/> </h4>
                                <h4>    Số Điện Thoại: <input type="hidden" name="phone" value="<?php echo $phone; ?>" /> 
									<?php echo $phone; ?><br/> </h4>
                                <h4>    Email: <input type="hidden" name="email" value=" <?php echo $email; ?>" /> 
									<?php echo $email; ?><br/> </h4>
                               <h4>     Địa Chỉ: <input type="hidden" name="address" value="<?php echo $address; ?>" />
									<?php echo $address; ?> </h4>
                                
                            </div>
                            <div class="col-md-6">
                             <h2>Thông Tin Giao Hàng</h2>
                              	<h4>Tên Khách Hàng: 
                                <input type="hidden" name="shipping_fullname" value="<?php echo $shipping_fullname; ?>" />
                                 	<?php echo $shipping_fullname; ?><br/> </h4>
                                <h4>Số Điện Thoại: 
                                <input type="hidden" name="shipping_phone" value="<?php echo $shipping_phone; ?>" /> 
									<?php echo $shipping_phone; ?><br/> </h4>
                                <h4>Email: 
                                <input type="hidden" name="shipping_email" value=" <?php echo $shipping_email; ?>" /> 
									<?php echo $shipping_email; ?><br/> </h4>
                               <h4>Địa Chỉ: 
                               <input type="hidden" name="shipping_address" value="<?php echo $shipping_address; ?>" />
									<?php echo $shipping_address; ?> </h4>
                            </div>
                        </div>
                        
                        </div>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.content -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="checkout1.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Quay Lại</a>
                                </div>
                                <div class="pull-right">
                                   <button type="submit" class="btn btn-primary">Đặt Hàng<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>

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
                                        <th><?php echo number_format($state*10000) ?> VNĐ</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Tổng</td>
                                        <th><?php echo number_format($tongtien + $state*10000)?> VNĐ</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
 </div>
        <!-- *** FOOTER ***
 _________________________________________________________ -->
       <?php include_once 'general/footer.php';?>
       <?php include_once 'general/script.php';?>
   
</body>
</html>