<head>
  <title>Giỏ hàng | Gà Rán BCL</title>
</head>
<?php include_once("header.php");?>

<div class="wrapper-cart">
<?php
$create_content = '';
if(isEmpty($cart_details)){
  $create_content .= '
  <div class="container text-center">
    <div class="content-404">
      <img src="/images/empty-cart-icon-2.png" class="img-responsive" alt="" />
      <p><h2>Chưa có sản phẩm nào trong giỏ</h2></p>
      <a href="/thuc-don"><button type="button" class="btn btn-info btn-xem-menu">Xem thực đơn</button></a><br>
    </div>
  </div>';

  echo $create_content;
}
else
{
?>
<div class="c_container">
  <div class="c_container left-c_container">
    <div class="list-header">
      <span class="list-header-left">Tổng số sản phẩm: <? echo count($cart_details); ?> </span>
      <span class="list-header-middle">GIÁ</span>
      <span class="list-header-right">SỐ LƯỢNG</span>
    </div>
    <?
    for($i = 0; $i < count($cart_details); $i++)
      $create_content .= '
        <div class="cart-item">
          <div class="cart-item-inner">
            <div class="cart-item-left">
              <div class="img-wrap">
                <img src="./images/items/'.($cart_details[$i]['DuongDan']).'"
                onerror="this.src=\'../images/not-found.png\'"
                class="disp img-responsive" alt="" />
              </div>

              <div class="content">
                <p class="title">'.$cart_details[$i]['Ten'].'</p>
                <span class="automation-btn-delete">
                  <i class="glyphicon glyphicon-usd"></i>
                </span>
                <span class="unit-price">Đơn giá: '.number_format($cart_details[$i]['Gia'],0).'₫</span>
              </div>

            </div>

            <div class="cart-item-middle">
              <p class="current-price" id="price'.($cart_details[$i]['Ma']).'">'.number_format(get_cart_details_val($cart_details[$i]),0).'₫</p>
            </div>

            <div class="cart-item-right">
              <div class="input-group spinner">
                <input type="text" id="val'.($cart_details[$i]['Ma']).'" class="form-control" value="'.($cart_details[$i]['SoLuong']).'" disabled>
                <div class="input-group-btn-vertical" id="'.($cart_details[$i]['Ma']).'">
                  <button class="btn btn-default" type="button" onclick=\'change_quant('.json_encode($cart_details[$i]).',1)\'><i class="fa fa-caret-up"></i></button>
                  <button class="btn btn-default" type="button" onclick=\'change_quant('.json_encode($cart_details[$i]).',-1)\'><i class="fa fa-caret-down"></i></button>
                </div>
              </div>
              <span class="btn-delete" onclick=\'delete_cart_detail('.json_encode($cart_details[$i]).')\'>
                <i class="glyphicon glyphicon-trash"></i>
              </span>
            </div>
          </div>
        </div>';
        echo $create_content;
        ?>
  </div>


  <div class="c_container right-c_container">
    <div class="info-sect">
      <div class="info-sect-content">
        <div class="location">
            <div class="location-label">Địa chỉ giao hàng</div>
            <div class="location-content">
              <i class="glyphicon glyphicon-map-marker"></i>
              <div class="current-address"><? echo $current_user->getAdd(); ?></div>
              <div class="location-change">
                <a class="location-link">THAY ĐỔI</a>
              </div>
            </div>
        </div>
      </div>
    </div>

    <div class="info-sect">
      <div class="info-sect-heading">Thông tin đơn hàng</div>
      <div class="info-sect-content">
        <div class=" checkout-summary">
          <div class="checkout-summary-rows">
            <div class="checkout-summary-row">
              <div class="checkout-summary-label">Tạm tính (<? echo count($cart_details); ?> sản phẩm)</div>
              <div class="checkout-summary-value"><? echo number_format(cart_value($conn, $current_user->getCart()),0); ?> ₫</div>
            </div><div class="checkout-summary-row">
              <div class="checkout-summary-label">Phí giao hàng
              </div>
              <div class="checkout-summary-value">miễn phí
              </div>
            </div>
          </div>

          <div class=" checkout-order-total">
            <div class="checkout-order-total-row">
              <div class="checkout-order-total-title">Tổng cộng
              </div>
              <div class="checkout-order-total-fee"><? echo number_format(cart_value($conn, $current_user->getCart()),0); ?> ₫
              </div>
            </div>
            <button type="button" class="next-btn next-btn-primary next-btn-large checkout-order-total-button">ĐẶT HÀNG</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?}
?>
</div>

<?php include_once("footer.php");?>
