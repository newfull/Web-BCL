<?php 
include_once 'CheckSession.php';
			if(isset($_GET['page'])){
				$page = $_GET['page'];
				if($page=='danhmuclon'){
					include_once 'danhmuclon.php';
				}else if($page=='danhmuccon'){
					include_once 'danhmuccon.php';
				}else if($page=='sanpham'){
                    include_once 'danhsachsp.php';
                }else if($page=='khachhang'){
                    include_once 'khachhang.php';
                }else if($page=='chitiethoadon'){
                    include_once 'chitiethoadon.php';
                }else if($page=='dathang'){
                    include_once 'dathang.php';
                }else if($page=='user'){
                    include_once 'user.php';
                }
			}else{
					include_once 'danhsachsp.php';
			}
?>