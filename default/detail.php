<?php 
   include_once '../class/Model.php';
   $data = new Model();
   $id = isset($_GET["id"])?$_GET["id"]:'';
   $result = $data->get_row("SELECT * FROM `products` WHERE `id`= ".$id);
   $result_danhmuc = $result['category'];
   $result_cungloai = $data->get_list("SELECT * FROM `products` WHERE `category`=".$result_danhmuc." LIMIT 0,3");
?>
<?php include_once 'general/header.php';?>

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="./">Trang Chủ</a>
                        </li>
                        <li><a href=category.php?danhmuccon=<?php echo $result_danhmuc;?> >Áo Thun</a>
                        </li>
                        <li><?php echo $result['name'];?></li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Danh Mục Sản Phẩm</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                <?php include_once 'category_full.php';?>
                            </ul>

                        </div>
                    </div>
                    <!-- *** MENUS AND FILTERS END *** -->
                </div>

                <div class="col-md-9">

                    <div class="row" id="productMain">
                        <div class="col-sm-6">
                            <div id="mainImage">
                                <img src="img/<?php echo $result["image"]?>" alt="" class="img-responsive">
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="box">
                                <h1 class="text-center"><?php echo $result["name"];?></h1>
                                <p class="price"><?php echo number_format($result["price"]). " VNĐ";?></p>

                                <p class="text-center buttons">
                                    <a href="category.php?themgiohang=<?php echo $result['id']?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a> 
                                    <a href="checkout1.php" class="btn btn-default"><i class="fa fa-heart"></i> Mua Hàng</a>
                                </p>


                            </div>
                        </div>

                    </div>


                    <div class="box" id="details">
                        <p>
                            <h4>Chi Tiết Sản Phẩm</h4>
                            <p><?php echo $result["description"];?></p>
                            <h4>Kích thước vầ màu sắc</h4>
                            <ul>
                                <li>Size: <?php echo $result["size"];?></li>
                                <li>Màu Sắc: <?php echo $result["color"];?></li>
                            </ul>
                            <h4>Hàng Có Sẵn</h4>
                            <p><?php if($result["avaibility"]== 1) echo "Còn Hàng";else echo "Hết hàng";?></p>
                            <hr>
                    </div>
                    <?php  ?>

                    <div class="row same-height-row">
                        <div class="col-md-3 col-sm-6">
                            <div class="box same-height">
                                <h3>Sản Phẩm Cùng Loại</h3>
                            </div>
                        </div>
                        <?php foreach ($result_cungloai as $value): ?>
                            
                        
                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.php?id=<?php echo $value['id']; ?>">
                                                <img src="img/<?php echo $value["image"]; ?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.php?id=<?php echo $value['id']; ?>">
                                                <img src="img/<?php echo $value["image"]; ?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.php?id=<?php echo $value['id']; ?>" class="invisible">
                                    <img src="img/<?php echo $value["image"]; ?>" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><?php echo $value['name']; ?></h3>
                                    <p class="price"><?php echo number_format($value["price"])." VNĐ";?></p>
                                </div>
                            </div>
                            <!-- /.product -->
                        </div>

                        <?php endforeach ?>

                    </div>

                    

                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
       <?php include_once 'general/footer.php';?>
    </div>
    <!-- /#all -->
        <?php include_once 'general/script.php';?>





</body>

</html>