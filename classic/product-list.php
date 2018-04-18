 <meta charset="utf-8">
<?php
  include_once '../class/Model.php';
  $data = new Model();
  $danhmuccon = "";
  if (isset($_GET['danhmuccon'])){
      $danhmuccon = " AND `category`=".$_GET['danhmuccon'];
  }
   $size = 6;
   $trang = 1;
   $name = isset($_GET['tukhoa'])?$_GET['tukhoa']:'';
   if(isset($_GET['trang'])){
       $trang = $_GET['trang'];
   }
   $start = ($trang-1) * $size + 1;
   if($start > 0){
       $start = $start - 1;
   }
   if (isset($name)){
       $query = $data->get_list("SELECT * FROM `products`WHERE (`name` LIKE '%$name%' OR `price` = '$name')".$danhmuccon." LIMIT $start,$size");
   }else{
      $query = $data->get_list("SELECT * FROM `products` WHERE 1".$danhmuccon."LIMIT $start,$size");
   }
   foreach ($query as $row){?>
       <div class="col-md-4 col-sm-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.php?id=<?php echo $row["id"]?>">
                                                <img src="img/<?php echo $row["image"];?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.php?id=<?php echo $row["id"]?>">
                                                <img src="img/<?php echo $row["image"];?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.php?id=<?php echo $row["id"]?>" class="invisible">
                                    <img src="img/product1.jpg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="detail.php?id=<?php echo $row["id"]?>"><?php echo $row["name"];?></a></h3>
                                    <p class="price"><?php echo number_format($row['price']) . " VNĐ";?></p>
                                    <p class="buttons">
                                        <a href="detail.php?id=<?php echo $row["id"]?>" class="btn btn-default">Chi Tiết</a>
                                        <a href="category.php?themgiohang=<?php echo $row['id']?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ</a>
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>
       
   <?php }

?>
                        