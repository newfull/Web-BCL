<?php include_once 'general/header.php';
include_once '../class/Model.php';
?>
    <div id="all">
        <div id="content">
            <?php include_once 'general/slider.php';?>               
               <?php     
					
                    $data = new Model();
                    $query = $data->get_list("select * FROM `category`");
              
   foreach ($query as $value){?>
            <div id="hot">

                <div class="box">
                    <div class="container">
                        <div class="col-md-12">
                            <h2><?php echo $value["name"]?></h2>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="product-slider">
                             <!-- *** Load Sản Phẩm Trong Danh Mục *** -->   
                    <?php
    

    

                    $query2 = $data->get_list("SELECT products.id, products.name, products.image, products.price FROM `products` INNER JOIN `category_detail` ON products.category = category_detail.id  WHERE `category_id`=".$value["id"]." LIMIT 0,10");
					
					
               
				foreach ($query2 as $value1){?>
                    
                        <div class="item">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.php?id=<?php echo $value["id"]?>">
                                                <img src="img/<?php echo $value1["image"];?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.php?id=<?php echo $value1["id"]?>">
                                                <img src="img/<?php echo $value1["image"];?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <a href="detail.php?id=<?php echo $value1["id"]?>" class="invisible">
                                    <img src="img/<?php echo $value1["image"];?>" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="detail.php?id=<?php echo $value1["id"]?>"><?php echo $value1["name"];?></a></h3>
                                    <p class="price"><?php echo number_format($value1['price']) . " VNĐ";?></p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>

                         <?php } ?>

                    </div>
                    <!-- /.product-slider -->
                </div>
                <!-- /.container -->

            </div>
            <!-- *** Kết Thúc Load 1 Danh Mục *** -->

                    <!-- /.product-slider -->
             <?php } ?>        
                  </div>
                </div>
            </div>
        <!-- /#content -->
        <?php include_once 'general/footer.php';?>
       <?php include_once 'general/script.php';?>
</body>
</html>