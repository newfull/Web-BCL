
<?php 
    require_once '../../../class/Model.php';
    require_once '../../../class/ResizeImage.php';
    $data = new Model();
    $ResizeImage = new ResizeImage();
    ob_start();
?>
<?php
          $TenSP = isset($_POST['TenSP'])?$_POST['TenSP']:'';
          $GiaBan = isset($_POST['GiaBan'])?$_POST['GiaBan']:'';
          $GiaGiam = isset($_POST['GiaGiam'])?$_POST['GiaGiam']:'';
          $SoLuong = isset($_POST['SoLuong'])?$_POST['SoLuong']:'';
          $Size = isset($_POST['Size'])?$_POST['Size']:'';
          $Mau = isset($_POST['Mau'])?$_POST['Mau']:'';
          $DanhMuc = isset($_POST['DanhMuc'])?$_POST['DanhMuc']:'';
          $ChiTiet = isset($_POST['ChiTiet'])?$_POST['ChiTiet']:'';
          
?>

<?php include_once '../general/navigation.php';?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thêm Sản Phẩm</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

<?php
  if(isset($_POST['ok'])){ // Người dùng đã ấn submit
     if($_FILES['HinhAnh']['name'] != NULL){ // Đã chọn file
        // thực hiện công việc upload
        if($_FILES['HinhAnh']['type'] == "image/jpeg"
            || $_FILES['HinhAnh']['type'] == "image/png"
            || $_FILES['HinhAnh']['type'] == "image/gif"){ 
                if($_FILES['HinhAnh']['size'] > 1048576){
                     echo "File không được lớn hơn 1mb";
                  }else{
                     // file hợp lệ, tiến hành upload
                     $path = "../../../default/img/"; // file lưu vào thư mục img
                     $tmp_name = $_FILES['HinhAnh']['tmp_name'];
                     $name = $_FILES['HinhAnh']['name'];
                     $type = $_FILES['HinhAnh']['type']; 
                     $size = $_FILES['HinhAnh']['size']; 
                     // Upload file
                     move_uploaded_file($tmp_name,$path.$name);
                     $ResizeImage->resize_image('force',$path.$name,$path.$name,450,600);
                     $TenAnh = $name;
                    //tiến hành insert dữ liệu
                     $San_Pham = array('name' => ''.$TenSP,
                                    'price' => ''.$GiaBan,
                                    'saleoff' => ''.$GiaGiam,
                                    'avaibility' => ''.$SoLuong,
                                    'size' => ''.$Size,
                                    'image' => ''.$TenAnh,
                                    'color' => ''.$Mau,
                                    'category' => ''.$DanhMuc,
                                    'description' => ''.$ChiTiet);
                     if(is_numeric($SoLuong) && is_numeric($GiaBan) && $TenSP!=''){
                       @$insert = $data->insert('products',$San_Pham);
                        if (isset($insert)){
                           header("Location: ../../danhsachsp.php");
                        }else{
                            echo "Thêm Thất Bại";
                            }
                     }else{
                        echo "Các Ô Bên Dưới Không Được Rỗng";
                        if(is_numeric($SoLuong)==0) echo "<br>Số Lượng Không Được Rỗng";
                        if(is_numeric($GiaBan)==0) echo "<br>Giá Không Được Rỗng";
                        if($TenSP=='') echo "<br>Tên Không Được Rỗng";

                        }
                    //kết thúc insert dữ liệu
                     }
          }else{
              // không phải file ảnh
              echo "Kiểu file không hợp lệ";
          }
     }else{
        echo "Vui lòng chọn file Ảnh";
     }
  }
?>

            <form id="form-insert" action="" name="themsp" method="post" enctype = "multipart/form-data">
    <div class="form-horizontal">
        
        <div class="form-group">
            <label for="TenSP" class = "control-label col-md-2">Tên Sản Phẩm	</label>
            <div class="col-md-10">
                <input type="text" name="TenSP" class = "form-control" placeholder="Tên Sản Phẩm">
            </div>
        </div>

        <div class="form-group">
            <label for="GiaBan" class="control-label col-md-2" min="1000">Giá Bán	</label>
            <div class="col-md-10">
                <input type="number" name="GiaBan" value=0 class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="GiaGiam" class="control-label col-md-2" min="0">Giá Giảm	</label>
            <div class="col-md-10">
                <input type="number" name="GiamGiam" value=0 class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="SoLuong" class="control-label col-md-2">Số Lượng    </label>
            <div class="col-md-10">
                <input type="number" name="SoLuong" value=1 class="form-control" min="1">
            </div>
        </div>

        <div class="form-group">
            <label for="Size" class="control-label col-md-2">Size    </label>
            <div class="col-md-10">
                <input type="text" name="Size" class="form-control" placeholder="Các Size Của Sản Phẩm">
            </div>
        </div>



        <div class="form-group">
            <label for="Mau" class="control-label col-md-2">Color    </label>
            <div class="col-md-10">
                <input type="text" name="Mau" class="form-control" placeholder="Màu Sản Phẩm">
            </div>
        </div>

        <div class="form-group">
             <label for="DanhMuc" class="control-label col-md-2">Danh Mục    </label>
            <div class="col-md-3">
                <select name="DanhMuc" class="form-control">
                //load danh mục
        <?php 
          $sql = $data->get_list("SELECT `a`.`id`,`a`.`name` FROM `category_detail` AS `a`, `category` WHERE `a`.`category_id` = `category`.`id`");
                foreach ($sql as $row){
                 echo "<option value=".$row['id'].">".$row['name']."</option>";
                }                                                          
        ?>
                </select>

            </div>
        </div>

        <div class="form-group">
            <label for="HinhAnh" class="control-label col-md-2">Hình Ảnh    </label>
            <div class="col-md-3">
                <input type="file" name="HinhAnh" class="form-control" />
            </div>
        </div>

        <div class="form-group">
            <label for="ChiTiet" class="control-label col-md-2">Chi Tiết    </label>
            <div class="col-md-10">
            <textarea name="ChiTiet" class="form-control" rows="10" cols="30" placeholder="Chi Tiết Sản Phẩm"></textarea>
            </div>
        </div>
<p>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="submit" value="Create" class="btn btn-success" name="ok" />
                    <input type="reset" value="Reset" class="btn btn-warning">
                    <a href="../../danhsachsp.php" class="btn btn-primary">Quay Lại</a>

                </div>
            </div>
        </div>
<p>

</form>

</div>
<?php include_once '../general/footer.php';?>

</body>

</html>

<?php 
ob_end_flush();
?>