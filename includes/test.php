<?php require_once("functions.php");
require_once("config.php")?>
<body>
<table border="2px"; width=100%>

<tr>
    <th>Tên sản phẩm</th>
    <th>Đơn giá</th>
    <th>Số lượng</th>
    <th>Thành tiền</th>
    </tr>

<?php
$data1 = cart_details_combo($conn, '7');
$data2 = cart_details($conn, '7');
$data = array_merge($data1, $data2);

foreach($data as $item) {?>

<tr>
     <td align='center'><?php echo $item['Ten']; ?></td>
     <td align='center'><?php echo number_format($item['Gia'],0).'₫'; ?></td>
     <td align='center'><?php echo $item['SoLuong'];?></td>
     <td align='center'><?php echo number_format($item['Gia']*$item['SoLuong'],0).'₫';?></td>

 </tr>

<?php  }?>

</table>
</body>
