<?php include_once 'general/header.php';
    $loi = isset($_GET['loi'])?$_GET['loi']:0;
    $thongbaoloi='class="alert alert-warning">'.'(*) Là bắt buộc';

    switch ($loi) {
        case 1:
            $thongbaoloi='class="alert alert-danger">'.'Đăng Ký Lổi! Vui lòng xác nhận lại thông tin';
            break;
        case 2:
            $thongbaoloi='class="alert alert-danger">'.'Tài Khoảng Đã Được Đăng Ký';
            break;
        default:
            # code...
            break;
    }
?>
    <div id="all">
        <div id="content">
            <div class="container">
                <div class="col-md-12">
                    <div class="box">
                        <h1>Tạo Tài Khoản Mới</h1>

                        <p class="lead">Bạn chưa có tài khoản ?</p>
                        <p>Hãy tạo một tài khoản để có thể nhận được nhiều ưu đãi và cập nhật những thông tin về sản phẩm mới nhất từ chúng tôi ! </p>

                        <hr>

                        <form action="customer.php" method="post">
                        <div class="row">
                        <div role="alert" <?php echo $thongbaoloi; ?></div>
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label for="name">Họ và Tên <i style="color: #d9534f">*</i></label>
                                    <input type="text" class="form-control" id="fullname" name="fullname">
                                </div>
                                <div class="form-group">
                                    <label for="email">Tài Khoản <i style="color: #d9534f">*</i></label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật Khẩu <i style="color: #d9534f">*</i></label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>

                            <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="phone">Số Điện Thoại</label>
                                    <input type="phone" class="form-control" id="phone" name="phone">
                                </div>   
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="address">Địa Chỉ</label>
                                    <textarea class="form-control" id="address" name="address"></textarea>
                                </div>                              
                            </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Đăng Ký</button>
                        </div> 

                        </div>   
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


      <?php include_once 'general/footer.php';?>
      <?php include_once 'general/script.php';?>
</body>
</html>
