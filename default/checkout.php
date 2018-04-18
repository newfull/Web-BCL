<?php 
    include_once '../class/Model.php';
    $data = new Model();
   @session_start();

        $fullname = isset($_POST['fullname'])?$_POST['fullname']:"Khách Hàng";
        $address = isset($_POST['address'])?$_POST['address']:'';
        $email = isset($_POST['email'])?$_POST['email']:'';
        $phone = isset($_POST['phone'])?$_POST['phone']:'';
        $shipping_fullname = isset($_POST['shipping_fullname'])?$_POST['shipping_fullname']:'';
        $shipping_phone = isset($_POST['shipping_phone'])?$_POST['shipping_phone']:'';    
        $shipping_address = isset($_POST['shipping_address'])?$_POST['shipping_address']:'';
       	
       	$customer_id=isset($_SESSION['customer'])?$_SESSION['customer']:0;
        
        
     
		//thêm khách hàng mới vào csdl
		 $max_guest_id = $data->get_row("SELECT max(`id`) as `id` FROM `guest`");	  
		 $guest_id=(++$max_guest_id['id']);    
		 insert_guest($guest_id,$fullname,$phone,$address,$email,$_customer_id);
		  
			  
		//thêm hóa đơn mới vào csdl
		
		$max_order_id = $data->get_row("SELECT max(`id`) as `id` FROM `order`");	  
		$order_id=(++$max_order_id['id']); 
		$total = get_total();
		$rs=insert_order($order_id,$fullname,$phone,$address,$email,$shipping_fullname,$shipping_address,$shipping_phone,$total,$guest_id);
		
		if($rs)
		  {
			inser_cart_detail($order_id);
		   unset($_SESSION['giohang']);  
		   header("Location: Complete.php");
		  }else{
			  echo "Lổi";
			  //header("Location: 404.php");
			  }
	
	//hàm lấy tổng giá trong giỏ hàng
	function get_total()
		{
			GLOBAL $data;
			$total=1;
			for($i = 0; $i < count($_SESSION['giohang']); $i++){
					   $product_id = $_SESSION['giohang'][$i]['id'];
					   $quantity = $_SESSION['giohang'][$i]['soluong'];
				   	   $row = $data->get_row("SELECT `price` FROM `products` WHERE `id`=".$product_id);
					   $price = $row['price'];
					   $total+=($price*$quantity);
			}
			return $total;
		}
		
	//hàmg thêm hóa đơn vào csdl
	function insert_order($_order_id,$_fullname,$_phone,$_address,$_email,$_shipping_fullname,$_shipping_address,$_shipping_phone,$_total,$_guest_id)
		{
			GLOBAL $data;
			$date = date("d/m/Y h:i:s a");
			$NewOrder = array('id' => $_order_id, 
				'fullname' => ''.$_fullname, 
				'phone' => ''.$_phone, 
				'address' =>''.$_address , 
				'email' => ''.$_email, 
				'shipping_fullname' => ''.$_shipping_fullname, 
				'shipping_address' => ''.$_shipping_address, 
				'shipping_phone' =>''.$_shipping_phone , 
				'total' => ''.$_total,
				'date' => ''.$date,
				'guest_id' => ''.$_guest_id);
		$query_insert_order = $data->insert('`order`',$NewOrder);
		
			return $query_insert_order;
		}
	
	//hàm thêm giỏ hàng vào csdl
	function inser_cart_detail($_order_id)
		{
			GLOBAL $data;

			for($i = 0; $i < count($_SESSION['giohang']);$i++){
				   $product_id = $_SESSION['giohang'][$i]['id'];
				   $row = $data->get_row("SELECT `price` FROM `products` WHERE `id`=".$product_id);

				   $detail = array('order_id'=>''.$_order_id,
				   				   'product_id'=>''.$product_id ,
				  				   'quantity' => ''.$_SESSION['giohang'][$i]['soluong'],
				                   'price' => ''.$row['price']);
				   $data->insert('cart_detail',$detail);

				}
		}
	
	//hàm thêm khách hàng mới vào csdl
	function insert_guest($_guest_id,$_fullname,$_phone,$_address,$_email,$_customer_id)
		{
		GLOBAL $data;
		$NewGuest = array('id' => ''.$_guest_id,
							'fullname' => ''.$_fullname,
							'phone' => ''.$_phone,
							'address' => ''.$_address,
							'email' => ''.$_email,
							'customer_id' => ''.$_customer_id);
		$query_insert_guest = $data->insert('guest',$NewGuest);

		return $query_insert_guest;
		}
?>