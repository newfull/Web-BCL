  <li class="active">
<?php 
         include_once '../class/Model.php';
         $data = new Model();
         $sql = $data->get_list("SELECT * FROM `category`");
         foreach ($sql as $row){?>
            	<h4><?php echo $row['name'];?></h4>
            	<ul>
            	<?php 
            	$sql2 = $data->get_list("SELECT * FROM `category_detail` WHERE `category_id`=".$row['id']);
            	foreach ($sql2 as $row2){
            	        $tongsoluong = 0;
            	        $sql3 = $data->get_row("SELECT COUNT(*) FROM `products` WHERE `category`=".$row2['id']);
            	        $tongsoluong = $sql3['COUNT(*)'];
            	    ?>
            	    <li><a href="category.php?danhmuccon=<?php echo $row2['id'];?>"><?php echo $row2['name']. " (" . $tongsoluong. ")";?></a></li>
            	<?php }
            	?>	
         <?php }
?>
     	</ul>
			</li>



