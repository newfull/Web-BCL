<?php 
   include_once '../class/Model.php';
   include_once './Province.php';
   $data = new Model();
?>
<?php include_once 'general/header.php';?>
<?php 
$tongtien1 = 0;
if(isset($_SESSION['giohang'])){  
for ($i = 0; $i < count($_SESSION['giohang']); $i++){
$row1 = $data->get_row("SELECT * FROM `products` WHERE `id`=".$_SESSION['giohang'][$i]['id']);
$price1 = $row1['price'] * $_SESSION['giohang'][$i]['soluong'];
$tongtien1 = $tongtien1 + ($row1['price'] * $_SESSION['giohang'][$i]['soluong']);
}}
?>
<?php 
   @session_start();
           $fullname = "";
           $address = "";
           $phone = "";
           $email = "";
   if(isset($_SESSION['customer'])){
           $row2 = $data->get_row("SELECT * FROM `customer` WHERE `id`=".$_SESSION['customer']);
           $fullname = $row2['fullname'];
           $address = $row2['address'];
           $phone = $row2['phone'];
           $email = $row2['email'];
           }
?>    

        <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="./">Trang Chủ</a>
                        </li>
                        <li>Thanh Toán</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="checkout2.php">
                            <h1>Thanh Toán</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Thông Tin</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Xem Trước</a>
                                </li>
                            </ul>

                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="firstname">Tên</label>
                                            <input type="text" class="form-control" id="firstname" name="fullname"
                                             value="<?php echo $fullname; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="phone">Số Điện Thoại</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                             value="<?php echo $phone; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                             value="<?php echo $email; ?>">
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <!-- /.row -->

                                <div class="row">
                                
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label for="state">Tỉnh</label>
                                            <select class="form-control" id="state" name="state">
                                                <?php foreach ($ListProvince as $key => $value): ?>
                                                   <option value="<?php echo $value; ?>"><?php echo $key; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                     <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="address">Địa Chỉ</label>
                                            <textarea class="form-control" id="address" name="address" ><?php echo $address; ?></textarea>
                                        </div>
                                    </div>  
                                </div>
                                <!-- /.row -->
                                
                                <div class="panel panel-default">
                                  <div class="panel-heading"><input type="checkbox" id="CheckBoxShipping">
                                   Thông tin Giao hàng Khác
                                   </div>
                                  <div id="anhien" class="panel-body">
                                    
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="firstname">Tên</label>
                                            <input type="text" class="form-control" id="firstname" name="shipping_fullname">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="phone">Số Điện Thoại</label>
                                            <input type="text" class="form-control" id="phone" name="shipping_phone">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="shipping_email">
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <!-- /.row -->

                                <div class="row">
                                
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label for="state">Tỉnh</label>
                                            <select class="form-control" id="state" name="shipping_state">
                                                <?php foreach ($ListProvince as $key => $value): ?>
                                                   <option value="<?php echo $value; ?>"><?php echo $key; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                     <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="address">Địa Chỉ</label>
                                            <textarea class="form-control" id="address" name="shipping_address" ></textarea>
                                        </div>
                                    </div>  
                                </div>
                                
                                  </div>
                                </div>
                                 <!-- /.panel -->
                            </div>

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="basket.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Quay Lại</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Tiếp Theo<i class="fa fa-chevron-right"></i>
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



        </div>
        <!-- /#content -->

        <!-- *** FOOTER ***
 _________________________________________________________ -->
       <?php include_once 'general/footer.php';?>
        <?php include_once 'general/script.php';?>
   <script type="text/javascript">
$(document).ready(function(){
 
        $("#anhien").hide();
        $('#CheckBoxShipping').click(function(){
 $("#anhien").slideToggle();
});
 
});
 
</script>


</body>

</html>