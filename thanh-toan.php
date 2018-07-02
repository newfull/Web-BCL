<head>
  <title>Thanh toán | Gà Rán BCL</title>
</head>
<?php include_once("header.php");?>

<?php
if(!empty($_SESSION['current'])){
  ?>
<div class="container container-sect cart-sect col-xs-12 col-lg-12" id="checkout-sect">
  <div class="row sect-title">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-10">
      <h2><i class="glyphicon glyphicon-usd"></i> THANH TOÁN</h2>
    </div>
  </div>
  <div class="wrapper-receipt sect-content">
    <div class="wrapper-receipt-content">
      <hr>
      <div class="row">
        <div class="hidden-xs col-sm-2">
        </div>
      <div class="col-xs-12 col-sm-8 text-centered">
      <div id="receipt_title">
        <h3>THÔNG TIN ĐƠN HÀNG</h3>
        <br>
        <h6><i class="glyphicon glyphicon-time"></i> <? echo date("d-m-Y h:i") ?></h6>
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
    <h5>Tên khách hàng: <b><?php echo $current_user->getName(); ?></b></h5>
</div>
<div class="col-xs-1 hidden-sm hidden-sm hidden-lg">
</div>
<div class="col-xs-11 col-sm-5 col-md-5 col-lg-4">
  <h5>Số điện thoại: <b><?php echo $current_user->getPhone(); ?></b></h5>
</div>
</div>
<div class="row">
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
</div>
<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
  <h5>Địa chỉ giao hàng: <b><?php echo $current_user->getAdd(); ?></b></h5>
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
      </tr>

  <?php
  $data1 = cart_details_combo($conn, $current_user->getCart());
  $data2 = cart_details($conn, $current_user->getCart());
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

  foreach($data as $item) {?>

  <tr>
       <td align='center'><?php echo $item['Ten']; ?></td>
       <td align='center'><?php echo number_format($item['Gia'],0).'₫'; ?></td>
       <td align='center'><?php echo $item['SoLuong'];?></td>
       <td align='center'><?php echo number_format($item['Gia']*$item['SoLuong'],0).'₫';?></td>

   </tr>

  <?php  }
?>

  </table>
</div>
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
</div>
</div>
<div class="row">
<div class="col-xs-4 col-sm-5 col-md-6 col-lg-7">
</div>
<div class="col-xs-8 col-sm-7 col-md-6 col-lg-5">
  <h6><div class="col-xs-5">
    Khuyến mãi:
  </div>
  <div class="col-xs-4 text-right">
  <span class="discount-receipt-val">
    <?php
      echo number_format(cart_value($conn, $current_user->getCart())-receipt_value($conn, $current_user->getCart(),0)).'₫';
      ?>
      (
      <?php
      echo
      discount_value($conn, $current_user->getCart()).'%';
      ?>
      )</span>
</div>
<div class="col-xs-1">
</div>
    </h6>
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
  <span class="total-receipt-val"><b>
    <?php
    echo number_format(receipt_value($conn, $current_user->getCart(),0)).'₫';
    ?>
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
  <div class="col-xs-4 col-md-5 col-lg-5">
  </div>
  <div class="col-xs-4 col-md-4 col-lg-4">
    <div class="form-group">
      <a href="/thuc-don"><button class="btn btn-default">Xem thêm thực đơn</button></a>
    </div>
  </div>
  <div class="col-xs-3 col-md-3 col-lg-3">
    <div class="form-group">
      <button class="btn btn-danger submit-receipt" type="button">Xác nhận</button>
    </div>
  </div>
</div>
    </div>
  </div>
  </div>
  <?
}
else{ ?>
  <script type="text/javascript">location.href = './dang-nhap';</script>
  <? } ?>
  <?php include_once("footer.php");?>

  <?php if($current_user->getAdd() == ""){ ?>
  <script>requireAdd();</script>
<?php } ?>
