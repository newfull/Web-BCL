<?php
  require_once 'config.php';
  require_once 'functions.php';
  require_once 'userinfo.php';

  $receiptid = trim($_GET['receipt']);
  $current_user = new bclUser($conn);
  if(!empty($_SESSION['current'])){
    $current_user->init_info($_SESSION['current']);
  }

  try
  {
    $receipt = get_receipt_info($conn, $receiptid);

    $create_tab_content = "";
    $create_tab_content .= '
<div class="wrapper-receipt-content">
  <hr>
  <div class="row">
    <div class="hidden-xs col-sm-2">
    </div>
  <div class="col-xs-12 col-sm-8 text-centered">
  <div id="receipt_title">
    <h3>THÔNG TIN ĐƠN HÀNG #PO'.$_GET['receipt'].'</h3>
    <br>
    <h6><i class="glyphicon glyphicon-time"></i> '.$receipt['ThoiGian'].'</h6>
  </div>
</div>
<div class="hidden-xs col-sm-2">
</div>
</div>
<hr>
<div class="row">
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
</div>
<div class="col-xs-11 col-sm-5 col-md-5 col-lg-7 text-centered">
<h5>Tên khách hàng: <b>'.$current_user->getName().'</b></h5>
</div>
<div class="col-xs-1 hidden-sm hidden-sm hidden-lg">
</div>
<div class="col-xs-11 col-sm-5 col-md-5 col-lg-4">
<h5>Số điện thoại: <b>'.$current_user->getPhone().'</b></h5>
</div>
</div>
<div class="row">
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
</div>
<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
<h5>Địa chỉ giao hàng: <b>'.$receipt['DiaChi'].'</b></h5>
</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
</div>
</div>
<div class="row">
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
</div>
<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
<h5>Danh sách sản phẩm:</h5>
</div>
</div>
<div class="row">
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
</div>
<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
<table border="2px"; width=100%>

<tr style="border:2px solid black; background-color: #B6AFAE">
  <th style="text-align:center">Tên sản phẩm</th>
  <th style="text-align:center">Đơn giá</th>
  <th style="text-align:center">Số lượng</th>
  <th style="text-align:center">Thành tiền</th>
  </tr>';

$data1 = receipt_details_combo($conn, $receiptid);
$data2 = receipt_details($conn, $receiptid);
if(isEmpty($data1) && !isEmpty($data2))
$data = $data2;
else
if(isEmpty($data2) && !isEmpty($data1))
  $data = $data1;
else
  if(!isEmpty($data2) && !isEmpty($data1))
  {
    $data = array_merge($data1, $data2);
  }

foreach($data as $item) {
  $create_tab_content .= "<tr>
   <td align='center'>".$item['Ten']."</td>
   <td align='center'>".number_format($item['Gia'],0)."₫</td>
   <td align='center'>".$item['SoLuong']."</td>
   <td align='center'>".number_format($item['Gia']*$item['SoLuong'],0)."₫</td></tr>";
}

  $create_tab_content .= '</table>
</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
</div>
</div>
<div class="row">
<div class="col-xs-4 col-sm-5 col-md-6 col-lg-7">
</div>
<div class="col-xs-8 col-sm-7 col-md-6 col-lg-5">
<h5><div class="col-xs-5">
Tổng hoá đơn:
</div>
<div class="col-xs-4 text-right">
<span class="total-receipt-val"><b>'.number_format($receipt['GiaTri'],0).'₫
</b>
</span>
</div>
<div class="col-xs-1">
</div>
<div class="col-xs-2">
</div>
</h5>
</div>
</div>
<br>
<div class="row">
<div class="col-xs-5 col-md-5 col-lg-5">
</div>
<div class="col-xs-7 col-md-7 col-lg-7">
<div class="form-group">
  <a href="/quan-ly?sec=his"><button class="btn btn-danger submit-receipt" type="button">Trở lại lịch sử</button></a>
</div>
</div>
</div>
</div>';

echo $create_tab_content;
}
catch(PDOException $e){
echo $e->getMessage();
}

?>
