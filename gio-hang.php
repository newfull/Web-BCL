<head>
  <title>Giỏ hàng | Gà Rán BCL</title>
</head>
<?php include_once("header.php");?>

<div class="container container-sect cart-sect col-xs-12 col-lg-12" id="cart-sect">
  <div class="row sect-title">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-10">
      <h2><i class="glyphicon glyphicon-shopping-cart"></i> GIỎ HÀNG</h2>
    </div>
  </div>
  <div class="wrapper-cart sect-content">
    <div class="wrapper-cart-content">
    <?php
    $create_content = '';
    if((isEmpty($cart_details))&&(isEmpty($cart_details_combo))){
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
      <div class="col-xs-12 col-sm-12 col-md-8">
      <div class="c_container">
        <div class="c_container left-c_container">
          <div class="list-header">
            <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <span class="list-header-left">Tổng số sản phẩm:
              <?
              if(isEmpty($cart_details_combo))
                 echo count($cart_details);
              else
                if(isEmpty($cart_details))
                   echo count($cart_details_combo);
                else{
                  $cart_length = count($cart_details_combo)+count($cart_details);
                  echo $cart_length;
                }
             ?>
              <span class="btn-delete">
                <i class="glyphicon glyphicon-trash" onclick="delete_all_cart_detail(
                <?
                if(isEmpty($cart_details_combo))
                  echo $cart_details[0]['Gio'];
                else
                  echo $cart_details_combo[0]['Gio'];
                ?>)"></i>
              </span>
            </span>
          </div>
          <div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
            <label class="list-header-middle">GIÁ</label>
          </div>
          <div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
            <label class="list-header-right">SỐ LƯỢNG</label>
          </div>
          </div>
        </div>
          <?
          if(!isEmpty($cart_details_combo)){
            for($i = 0; $i < count($cart_details_combo); $i++)
            $create_content .= '
            <div class="cart-item">
            <div class="cart-item-inner">
            <div class="row item-name">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="cart-item-left">
            <div class="img-wrap">
            <img src="./images/items/'.($cart_details_combo[$i]['DuongDan']).'"
            onerror="this.src=\'../images/not-found.png\'"
            class="disp img-responsive" alt="" />
            </div>

            <div class="content text-nowrap">
            <p class="title">'.$cart_details_combo[$i]['Ten'].'</p>
            <span class="automation-btn-delete">
            <i class="glyphicon glyphicon-usd"></i>
            </span>
            <span class="unit-price">Đơn giá: '.number_format($cart_details_combo[$i]['Gia'],0).'₫</span>
            </div>
            </div>
            </div>

            <div class="col-xs-2 hidden-sm hidden-md hidden-lg">
            </div>

            <div class="col-xs-5 col-sm-3 col-md-3 col-lg-3">
            <div class="cart-item-middle">
            <p class="current-price">'.number_format(get_cart_details_val($cart_details_combo[$i]),0).'₫</p>
            </div>
            </div>

            <div class="col-xs-5 col-sm-3 col-md-3 col-lg-3">
            <div class="cart-item-right">
            <div class="input-group spinner">
            <input type="text" id="comboval'.($cart_details_combo[$i]['Ma']).'" class="form-control" value="'.($cart_details_combo[$i]['SoLuong']).'" readonly>
            <div class="input-group-btn-vertical" id="'.($cart_details_combo[$i]['Ma']).'">
            <button class="btn btn-default" type="button" onclick=\'change_combo_quant('.json_encode($cart_details_combo[$i]).',1)\'><i class="fa fa-caret-up"></i></button>
            <button class="btn btn-default" type="button" onclick=\'change_combo_quant('.json_encode($cart_details_combo[$i]).',-1)\'><i class="fa fa-caret-down"></i></button>
            </div>
            </div>
            <span class="btn-delete">
            <i class="glyphicon glyphicon-trash" onclick=\'delete_cart_detail_combo('.json_encode($cart_details_combo[$i]).')\'></i>
            </span>
            </div>
            </div>
            </div>
            </div>
            </div>';
          }

          if(!isEmpty($cart_details)){
            for($i = 0; $i < count($cart_details); $i++)
            $create_content .= '
            <div class="cart-item">
            <div class="cart-item-inner">
            <div class="row item-name">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
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
            </div>

            <div class="col-xs-2 hidden-sm hidden-md hidden-lg">
            </div>

            <div class="col-xs-5 col-sm-3 col-md-3 col-lg-3">
            <div class="cart-item-middle">
            <p class="current-price">'.number_format(get_cart_details_val($cart_details[$i]),0).'₫</p>
            </div>
            </div>

            <div class="col-xs-5 col-sm-3 col-md-3 col-lg-3">
            <div class="cart-item-right">
            <div class="input-group spinner">
            <input type="text" id="val'.($cart_details[$i]['Ma']).'" class="form-control" value="'.($cart_details[$i]['SoLuong']).'" readonly>
            <div class="input-group-btn-vertical" id="'.($cart_details[$i]['Ma']).'">
            <button class="btn btn-default" type="button" onclick=\'change_quant('.json_encode($cart_details[$i]).',1)\'><i class="fa fa-caret-up"></i></button>
            <button class="btn btn-default" type="button" onclick=\'change_quant('.json_encode($cart_details[$i]).',-1)\'><i class="fa fa-caret-down"></i></button>
            </div>
            </div>
            <span class="btn-delete">
            <i class="glyphicon glyphicon-trash" onclick=\'delete_cart_detail('.json_encode($cart_details[$i]).')\'></i>
            </span>
            </div>
            </div>
            </div>
            </div>
            </div>';
          }

          echo $create_content;
          ?>
        </div>


      </div>
    </div>

          <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="c_container right-c_container">
              <div class="info-sect">
                <div class="info-sect-content">
                  <div class="location">
                    <div class="location-label">Địa chỉ giao hàng</div>
                    <div class="location-content">
                      <i class="glyphicon glyphicon-map-marker"></i>
                      <div class="current-address"><? echo $current_user->getAdd(); ?></div>
                      <div class="location-change">
                        <a href='/quan-ly?sec=eadd' class="location-link">THAY ĐỔI</a>
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
                        <div class="checkout-summary-label">Tạm tính (
                          <?
                        if(isEmpty($cart_details_combo))
                           echo count($cart_details);
                        else
                          if(isEmpty($cart_details))
                             echo count($cart_details_combo);
                          else{
                            $cart_length = count($cart_details_combo)+count($cart_details);
                            echo $cart_length;
                          }
                       ?> sản phẩm)</div>
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
                      <button type="button" class="next-btn next-btn-primary next-btn-large checkout-order-total-button" data-target='#checkout' data-toggle='modal' data-dismiss='modal'>ĐẶT HÀNG</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</div>
      <?}
      ?>
    </div>
  </div>
  </div>
  <?php include_once("footer.php");?>
