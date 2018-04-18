<?php 
   @session_start();
   include_once '../class/Model.php';
   $data = new Model();
    
   if(isset($_GET['themgiohang'])){
       $id = $_GET['themgiohang'];
       if (isset($_SESSION['giohang']) && is_array($_SESSION['giohang'])){
           $count = count($_SESSION['giohang']);
           $flag = false;
           for ($i = 0; $i < $count;$i++){
               if ($_SESSION['giohang'][$i]['id'] == $id){
                   $_SESSION['giohang'][$i]['soluong'] += 1;
                   $flag = true;
                   break;
               }
           }
           if ($flag == false){
               $_SESSION['giohang'][$count]['id'] = $id;
               $_SESSION['giohang'][$count]['soluong'] = 1;
           }
       }else {
           $_SESSION['giohang'] = array();
           $_SESSION['giohang'][0]['id'] = $id;
           $_SESSION['giohang'][0]['soluong'] = 1;
       }
       header("Location: category.php");
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <title>
        Shop 3PH
    </title>

    <meta name="keywords" content="">

    <!-- styles -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>



</head>

<body>

    <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top">
        <div class="container">
          <div style="float:right" class="col-md-6" data-animate="fadeInDown">
              <ul class="menu" style="color: yellow;">
                    <li>
                    <?php 
                         $fullname = "";
                        if (isset($_SESSION['customer'])){
                            $row1 = $data->get_row("SELECT * FROM `customer` WHERE `id`=".$_SESSION['customer']);
                            $fullname = $row1['fullname'];
                            if($row1['username'] == 'admin'){
                                echo '<a href="../admin">Control Panel</a>' ." | ";
                                echo "Hello Admin" ." | " ;
                                echo "<a href='logout.php'>Logout</a>";
                            }else {
                                echo "Hello". " " .$fullname. " | " ;
                                echo "<a href='logout.php'>Logout</a>";
                            }
                        }else {?>
                            <a href="#" data-toggle="modal" data-target="#login-modal">Đăng Nhập</a>
                                    </li>
                                    <li><a href="register.php">Đăng Ký</a>
                                    </li>
                                </ul>
                       <?php }
                    ?>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Đăng Nhập Khách Hàng</h4>
                    </div>
                    <?php 
                        if (isset($_SESSION['error'])){
                                echo '<p style="text-align: center;color: #d9534f;">'.$_SESSION['error'].'</p>';
                                unset($_SESSION['error']);
                            }
                    ?>
                    <div class="modal-body">
                        <form action="checklogin.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email-modal" placeholder="your username" name="username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password-modal" placeholder="enter password" name="password">
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Đăng Nhập</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">Chưa Có Tài Khoảng?</p>
                        <p class="text-center text-muted"><a href="register.php"><strong>Đăng Ký Ngay </strong></a>!Rất nhanh và thực hiện trong&nbsp;1 phút để được hưởng những ưu đãi đặc biệt!</p>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                    <img src="img/logo.png" alt="Obaju logo" class="hidden-xs">
                    <img src="img/logo-small.png" alt="Obaju logo" class="visible-xs"><span class="sr-only">Shop 3PH</span>
                </a>
                </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">        
                    <li ><a href="index.php">Trang Chủ</a>
                    </li> 
                	<li class="dropdown yamm-fw">
                        <a href="#"  class="active dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Danh Mục <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                    <?php 
                                         $sql = $data->get_list("SELECT * FROM `category`");
                                         foreach ($sql as $row5){?>
                                                 <div class="col-sm-3">
                                                    <h5><?php echo $row5['name'];?></h5>
                                                    <ul>
                                                    <?php 
                                                    	$sql2 = $data->get_list("SELECT * FROM `category_detail` WHERE `category_id`=".$row5['id']);
                                                    	foreach ($sql2 as $row6){?>
                                                    	    <li><a href="category.php?danhmuccon=<?php echo $row6['id'];?>"><?php echo $row6['name'];?></a></li>
                                                    	<?php }
                                                    	?>	
                                                    </ul>
                                                </div>
                                            <?php }                               
                                       ?>
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>

                    <li ><a href="contact.php">Liên Hệ</a>
                    </li>             
                </ul>
            </div>
            <!--/.nav-collapse -->
            <div class="navbar-buttons">

                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">Giỏ hàng:
                     <?php
                     $tongtien = 0;
                     if (isset($_SESSION['giohang'])){
                        echo count($_SESSION['giohang']);
                        for($i = 0; $i < count($_SESSION['giohang']); $i++){
                            if(isset($_SESSION['giohang'][$i])){
                            $row = $data->get_row("SELECT * FROM `products` WHERE `id`=".$_SESSION['giohang'][$i]['id']);
                            $tongtien = $tongtien + ($row['price'] * $_SESSION['giohang'][$i]['soluong']);
                            }
                        }
                     }else{
                         echo "0";
                    }?></span></a>
                    <a href="#" class="btn btn-primary navbar-btn"><span class="hidden-sm">Tổng Tiền: <?php echo number_format($tongtien);?> VNĐ</span></a>
                </div>
                <!--/.nav-collapse -->

                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Tìm Kiếm</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>

            <div class="collapse clearfix" id="search">

                <form class="navbar-form" role="search" method="get" action="category.php">
                    <div class="input-group">
                        <input type="text" name="tukhoa" class="form-control" placeholder="Search">
                        <span class="input-group-btn">

			<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

		    </span>
                    </div>
                </form>

            </div>
            <!--/.nav-collapse -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->
