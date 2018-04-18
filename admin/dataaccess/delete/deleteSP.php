
<?php 
    require_once '../../../class/Model.php';
    $data = new Model();
    ob_start();
?>
<?php
        if(!isset($_GET['id'])){header("Location: ../../danhsachsp.php");}
        
        $id = $_GET['id'];
        $ListSP = $data->get_row("SELECT * FROM `products` WHERE `id`='$id'"); 
        $category_detail = $data->get_list("SELECT `a`.`id`,`a`.`name` FROM `category_detail` AS `a`, `category` WHERE `a`.`category_id` = `category`.`id`");
        if (isset($_POST['ok'])){
            $delete = $data->remove('products',"`id`='$id'");
            if(isset($delete)){
                header("Location: ../../danhsachsp.php");
            }else {
                echo "Xóa Thất Bại";
            }
        }
        

          
?>

<?php include_once '../general/navigation.php';?>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Xóa Sản Phẩm</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="panel panel-default">
            <div class="panel-heading">Thông tin Sản Phẩm</div>
    <div class="row">
        
        <div class="col-lg-3">
          <img class="img-responsive" src="../../../default/img/<?php echo $ListSP['image'];?>">  
        </div>

        <div class="col-lg-9">
            <label>Tên Sản Phẩm:</label><?php echo " ".$ListSP['name'];?><br>
            <label>Giá Bán:</label><?php echo " ".$ListSP['price'];?><br>
            <label >Danh Mục:</label>
        <?php foreach ($category_detail as $row){
                  if($row['id']==$ListSP['category'])
                    {
                      echo $row['name'];
                    }
                }                                                          
        ?><br>
            <label>Giá Giảm:</label><?php echo " ".$ListSP['saleoff'];?><br>
            
            <label>Số Lượng:</label><?php echo " ".$ListSP['avaibility'];?><br>
            
            <label>Size:</label><?php echo " ".$ListSP['size'];?><br>
            
            <label>Color:</label><?php echo " ".$ListSP['color'];?><br>

            <label>Chi Tiết:</label><?php echo " ".$ListSP['description'];?><br>
            <form id="form-update" action="" name="xoasp" method="post">
             <p><input type="submit" value="Xóa" class="btn btn-danger" name="ok" />
             <a href="../../danhsachsp.php" class="btn btn-primary">Quay Lại</a></p>
             </form>     
        </div>

</div> 
</div>
</div>
<?php include_once '../general/footer.php';?>

</body>

</html>

<?php 
ob_end_flush();
?>