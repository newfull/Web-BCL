<?php
require_once("./includes/config.php");
require_once("./includes/functions.php");
require_once("./includes/userinfo.php");

$cart_details = null;
$cart_details_combo = null;
$current_user = new bclUser($conn);
if(!empty($_SESSION['current'])){
  $current_user->init_info($_SESSION['current']);
  $cart_details = cart_details($conn, $current_user->getCart());
  $cart_details_combo = cart_details_combo($conn, $current_user->getCart());
}
?>


<!--head-->
<head>
  <meta charset="utf-8" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <meta name="description" content="Website bán gà rán BCL">
  <meta name="author" content="BCL">

  <link rel="icon" href="/favicon.ico">
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="icon" type="image/png" href="/favicon.png" />

  <link href="/css/main.css" rel="stylesheet" type="text/css">
  <link href="/css/style.css" rel="stylesheet" type="text/css">

  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>
<!--/head-->

<body>

  <!-- Preloader-->
  <div class="preloader display-none">
    <div class="row">
      <div class="col-md-12">
        <div class="loader">
          <div class="loader-inner"></div>
          <div class="loader-inner box"></div>
          <div class="box-1"></div>
          <div class="box-2"></div>
          <div class="box-3"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Preloader-->

  <!-- Header-->
  <header id="header">
    <div class="header-top"><!-- Header Top-->
      <nav class="nav-header navbar navbar-default clearfix"><!-- Navbar Header Top-->
        <div class="container clearfix">
          <div class="navbar-top clearfix">
            <div class="cover" onclick="toggleSidenav();"></div>
            <div class="hamburger" id="hamburger" onclick="toggleSidenav();">
              <div></div>
              <div></div>
              <div></div>
            </div>
            <nav class="sidenav">
              <div class="logo">
                <img src="../images/logo.png"/>
              </div>
              <div class="links">
                <a href="/trang-chu" onclick="toggleSidenav();" class="active">Trang chủ</a>
                <a href="/thuc-don" onclick="toggleSidenav();">Thực đơn</a>
                <a href="/khuyen-mai" onclick="toggleSidenav();">Tin tức</a>
                <a href=<?php
                  $create_content = "";
                  if(!empty($_SESSION['current'])) $create_content = '/quan-ly';
                  else $create_content = '"#popup-login" data-toggle="modal"';
                  echo $create_content;
                  ?> onclick="toggleSidenav();">Tài khoản</a>
                <a href="/gioi-thieu" onclick="toggleSidenav();">Giới thiệu</a>
              </div>
            </nav>

            <div class="flip-container">
              <div class="flipper brand">
                <a href="/trang-chu">
                  <div class="front">
                    <img src="/images/logo.png" class="img-responsive"/>
                  </div>
                  <div class="back">
                    <img src="/images/logo-flipped.png" class="img-responsive"/>
                  </div>
                </a>
              </div>
            </div>

            <div class="navbar-top-wap" id="#func">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 userbox userbox-mobile">
                    <?php
                      $create_content = "";
                    if(!isset($_SESSION['current'])){
                    $create_content = "<a href='#popup-login' data-toggle='modal' id='btnLogIn' class='inline-block'>
                    <i class='fa fa-lock'></i> Đăng nhập</a>
                    <a href='#popup-reg' data-toggle='modal' id='btnReg' class='inline-block' ><i class='fa fa-plus'></i> Đăng ký</a>";
                  } else {
                    $create_content = "<a href='/quan-ly' class='username inline-block'><i class='glyphicon glyphicon-user'></i> ".shorten_string($current_user->getName())."</a>
                    <a href='#' class='inline-block btn-logout fn-logout'>Đăng xuất</a>";
                   }
                    echo $create_content;
                  ?>

                    <div id="user-info" class="display-none">
                      <div class="list-group">
                        <a href="/quan-ly" class="list-group-item"><i class="glyphicon glyphicon-user"></i> Thông tin tài khoản</a>
                        <a href="/quan-ly?sec=his" class="list-group-item"><i class="glyphicon glyphicon-repeat"></i> Lịch sử mua hàng</a>
                        <a href="/quan-ly?sec=liked" class="list-group-item"><i class="glyphicon glyphicon-thumbs-up"></i> Món ăn yêu thích</a>
                        <a href="#" class="list-group-item fn-logout"><i class="glyphicon glyphicon-log-out"></i> Đăng xuất</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div id="carousel-header" class="carousel slide clearfix" data-ride="carousel" data-interval="3000">
              <div class="carousel-inner vertical clearfix">
                <div class="active item"><img src="/images/promotions/header1.png" class="img-responsive"></div>
                <div class="item"><img src="/images/promotions/header2.png" class="img-responsive"></div>
                <div class="item"><img src="/images/promotions/header3.png" class="img-responsive"></div>
                <div class="item"><img src="/images/promotions/header4.png" class="img-responsive"></div>
                <div class="item"><img src="/images/promotions/header5.png" class="img-responsive"></div>
              </div>
            </div>
          </div>
        </div>

      </nav>
      <!-- /Navbar Header Top-->
    </div>
    <!-- /Header Top-->

    <!-- Header Body-->
    <div class="header-middle">
      <nav id="navbar" class="navbar navbar-default navbar-bcl"><!-- Navbar Header Body -->
        <div class="row">
          <div class="hidden-xs hidden-sm col-md-1 col-lg-1">
          </div>
          <div class="col-xs-5 col-sm-3 col-md-1 col-lg-1 logo-block">
              <div class="logo clearfix">
                <img src="/images/name.png" class="logo-bcl" onclick="toggleSidenav();"/>
                <span class="glyphicon glyphicon-chevron-left control carousel-bcl-control-left"></span>
            </div>
          </div>

          <div class="hidden-xs hidden-sm col-md-8 col-lg-8 list-block">
                      <div class="danh-muc">
                        <ul class="menu">
                          <li><a href="/thuc-don" class="active">Thực đơn</a></li>
                          <li><a href="/khuyen-mai">Tin tức</a></li>
                          <li><a href="/quan-ly">Tài khoản</a></li>
                          <li><a href="/gioi-thieu">Giới thiệu</a></li>
                        </ul>
                      </div>
                    </div>

            <div class="col-xs-5 col-sm-7 hidden-md hidden-lg">
            <div class="carousel-bcl">
                <!-- Wrapper for slides -->
                            <div class="item active">
                             <div class="carousel-content"> <a href="/thuc-don" class="active">Thực đơn</a></div>
                            </div>
                            <div class="item">
                              <a href="/khuyen-mai">Tin tức</a>
                            </div>
                            <div class="item">
                              <a>Tài khoản</a>
                            </div>
                            <div class="item">
                              <a href="/gioi-thieu">Giới thiệu</a>
                            </div>
            </div>
          </div>

          <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1 cart-block">
            <div class="cartbox" id="cart_box">
              <span class="glyphicon glyphicon-chevron-right control carousel-bcl-control-right"></span>
              <a href="/gio-hang">
                <i class="fa fa-shopping-cart"></i>
                <span class="text-cart"> Giỏ hàng</span>
                <span id="cart_number">
                  <?php
                  if((isEmpty($cart_details))&&(isEmpty($cart_details_combo)))
                    echo '(0)';
                  else{
                    if(isEmpty($cart_details_combo))
                       echo '('.count($cart_details).')';
                    else
                      if(isEmpty($cart_details))
                         echo '('.count($cart_details_combo).')';
                      else{
                        $cart_length = count($cart_details_combo)+count($cart_details);
                        echo '('.$cart_length.')';
                      }
                  }
                  ?></span>
              </a>
            </div>
          </div>
            <div class="hidden-xs hidden-sm col-md-1 col-lg-1">
            </div>
        </div>
      </nav>
      <!-- /Navbar Header Body -->

      <div class='cart-details display-none'>
        <button class='btn btn-xs btn-danger pull-right close-cart-box'>X</button>
        <a href='./gio-hang' data-toggle='tooltip' title='Đi tới giỏ hàng'><h1>Giỏ hàng</h1></a>
        <ul class='list-unstyled'>
      <?php
      $create_content = "";

      if((isEmpty($cart_details))&&(isEmpty($cart_details_combo))){
        $create_content .= '<img src="./images/empty-cart-icon.png" class="empty-cart img-responsive"/>';
        $create_content .= '<h2>Chưa có sản phẩm nào</h2>';
      }
      else
      {
        if(!isEmpty($cart_details_combo)){
        for($i = 0; $i < count($cart_details_combo); $i++)
          $create_content .= '
                <li>
                  <span class="item" data-toggle="tooltip" title="'.$cart_details_combo[$i]['Ten'].'">
                    <span class="item-left">
                        <img src="./images/items/'.($cart_details_combo[$i]['DuongDan']).'"
                        onerror="this.src=\'../images/not-found.png\'"
                        class="disp img-responsive" alt="" />
                        <span class="item-info">
                             <span class="item-name">'.($cart_details_combo[$i]['Ten']).'</span>
                             <span class="item-quant">Số lượng: '.($cart_details_combo[$i]['SoLuong']).'</span>
                             <span class="item-price">₫'.number_format($cart_details_combo[$i]['SoLuong']*$cart_details_combo[$i]['Gia'],0).'</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs btn-danger pull-right" onclick=\'delete_cart_detail_combo('.json_encode($cart_details_combo[$i]).')\'>X</button>
                    </span>
                </span>
              </li>';
        }
        if(!isEmpty($cart_details)){
        for($i = 0; $i < count($cart_details); $i++)
          $create_content .= '
                <li>
                  <span class="item" data-toggle="tooltip" title="'.$cart_details[$i]['Ten'].'">
                    <span class="item-left">
                        <img src="./images/items/'.($cart_details[$i]['DuongDan']).'"
                        onerror="this.src=\'../images/not-found.png\'"
                        class="disp img-responsive" alt="" />
                        <span class="item-info">
                             <span class="item-name">'.($cart_details[$i]['Ten']).'</span>
                             <span class="item-quant">Số lượng: '.($cart_details[$i]['SoLuong']).'</span>
                             <span class="item-price">₫'.number_format($cart_details[$i]['SoLuong']*$cart_details[$i]['Gia'],0).'</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs btn-danger pull-right" onclick=\'delete_cart_detail('.json_encode($cart_details[$i]).')\'>X</button>
                    </span>
                </span>
              </li>';
          }
        }
        echo $create_content;
        ?>
        </ul>
      </div>
    </div>
    <!-- /Header Body -->
  </header>
  <!-- /Header-->

  <!-- Popup Login - Modal -->
  <div class="modal fade bs-modal-sm" id="popup-login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="popup-wap clearfix">
          <div class="n-vertical top clearfix">
            <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
          </div>
          <div class="n-vertical bottom clearfix">
            <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
          </div>


          <div class="modal-header">
            <div class="btn-close" data-dismiss="modal"></div>
            <div class="form-group text-center">
              <div class="avatar-login inline-block">
                <img src="/images/avatar.png" class="avatar img-responsive">
              </div>
              <div class="title-login inline-block">Đăng nhập</div>
            </div>
          </div>

          <div class="modal-body">
            <div id="signin-panel" class="tab-content">
              <div class="tab-pane fade active in" id="signin">
              <form id='login' action='' method='post' accept-charset='UTF-8'>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group">

                      <input type="text" name="login-username" id="login-user"
                      <?php if(isset($_SESSION['username'])) echo 'class="form-control focus" value="'.$_SESSION['username'].'" ';
                        else echo 'class="form-control focus empty"'; ?> placeholder="" required="">
                      <label class="floating-label">Tên đăng nhập</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <input type="password" name="login-password" id="login-pass" class="form-control focus empty" placeholder="" required="">
                      <label class="floating-label">Mật khẩu</label>
                    </div>
                  </div>
                </div>

                <div class="row no-gutter">
                  <div class="col-xs-4">
                    <div class="clearfix">
                      <div class="checkbox chkbox">
                        <input type="checkbox" value="1" id="chkbox-label" name="save-user" checked>Ghi nhớ
                        <label for="chkbox-label"></label>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-4">
                    <div class="form-group">
                      <button class="btn btn-lg btn-bcl red" type="submit" name="login-submit">Đăng nhập</button>
                    </div>
                  </div>

                  <div class = "col-xs-4">
                    <div class="clearfix">
                      <a href="/quen-mat-khau" class="text-danger">Quên mật khẩu ?</a>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-xs-6">
                    <div class="form-group form-group-lg">
                      <a href="javascript:void(0)" onclick="loginFB()" class="fb">
                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                          <div class="form-control">Đăng nhập với <br>Facebook</div>
                        </div>
                      </a>
                    </div>
                  </div>

                  <div class="col-xs-6">
                    <div class="form-group form-group-lg">
                      <a href="javascript:void(0)" onclick="loginGG()" class="gm">
                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-google-plus"></i></span>
                          <div class="form-control">Đăng nhập với <br>Google</div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="row no-gutter">
                  <div class="col-xs-2">
                    <div class="popup-open-line"></div>
                  </div>

                  <div class="col-xs-4 text-center">
                    <div class="clearfix">
                      <div class="lb-haveaccount">
                        <span>Bạn chưa có tài khoản?</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-5">
                    <div class="form-group">
                      <a href class="btn btn-lg btn-bcl orange" id="btn-regnow" data-target="#popup-reg" data-toggle="modal" data-dismiss="modal">Đăng ký ngay</a>
                    </div>
                  </div>

                  <div class="col-xs-1">
                    <div class="popup-close-line"></div>
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
          <!--  <div class="modal-footer">
          <center>
        </center>
      </div>
    -->
  </div>
      </div>
    </div>
  </div>
  <!-- /Popup Login - Modal -->

  <!-- Popup Register - Modal -->
  <div class="modal fade bs-modal-sm" id="popup-reg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="popup-wap clearfix">
          <div class="n-vertical top clearfix">
            <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
          </div>
          <div class="n-vertical bottom clearfix">
            <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
          </div>
          <div class="modal-header">
            <div class="btn-close" data-dismiss="modal"></div>
            <div class="form-group text-center">
              <div class="avatar-login inline-block">
                <img src="/images/avatar.png" class="avatar img-responsive">
              </div>
              <div class="title-login inline-block">Đăng ký</div>
            </div>
          </div>

          <div class="modal-body">
            <div id="signup-panel" class="tab-content">
            <form id='register' onsubmit="return false;">
              <div class="tab-pane fade active in" id="signup">
                <div class="regform">
                  <div class="row">
                    <div class="col-xs-12 col-lg-12">
                      <label class="error-label reg-error-label"></label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4">
                      <label class="nhan">Họ và tên <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-8">
                      <input id="name" name="name" class="form-control" type="text" required="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-4">
                      <label class="nhan">Tên đăng nhập <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-8">
                      <input id="regusername" name="username" class="form-control" type="text" required="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-4">
                      <label class="nhan">Mật khẩu <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-8">
                      <input id="regpassword" name="password" class="form-control" type="password" required="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-4">
                      <label class="nhan">Nhập lại mật khẩu <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-8">
                      <input id="reenterpassword" class="form-control" name="reenterpassword" type="password" required="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-4">
                      <label class="nhan">E-mail <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-8">
                      <input id="email" name="email" class="form-control" type="text" required="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-4">
                      <label class="nhan">Ngày sinh <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-1"></div>
                    <div class="col-xs-2">
                      <select class="date_day" name="date-day"></select>
                    </div>
                    <div class="col-xs-2 ">
                      <select class="date_month" name="date-month"></select>
                    </div>
                    <div class="col-xs-3">
                      <select class="date_year" name="date-year"></select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-4">
                      <label class="lblgioitinh">Giới tính <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-2"></div>
                    <div class="col-xs-3">
                      <div class="clearfix">
                        <div class="radio gioitinh">
                          <input id="gender-nam" type="radio" value="1" name="gender" checked="true">
                          <label for="gender-nam">Nam</label>
                        </div>
                      </div>
                    </div>

                    <div class="col-xs-3">
                      <div class="clearfix">
                        <div class="radio gioitinh">
                          <input id="gender-nu" type="radio" value="0" name="gender">
                          <label for="gender-nu">Nữ</label>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="row ">
                    <div class="col-xs-4">
                      <label class="nhan">Điện thoại <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-8">
                      <input id="phonenumber" class="form-control" name="phonenumber" type="tel" maxlength="11" required="">
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-xs-4">
                      <label class="nhan"><imp>(*)</imp> Thông tin bắt buộc </label>
                    </div>

                    <div class="col-xs-8">
                      <div class="form-group">
                        <button class="btn btn-danger btn-block btn-lg btn-dk" type="submit" name="reg-submit">Đăng ký</button>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-xs-6">
                      <div class="form-group form-group-lg">
                        <a href="javascript:void(0)" onclick="regFB()" class="fb">
                          <div class="input-group"> <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                            <div class="form-control">Đăng ký bằng <br>Facebook</div>
                          </div>
                        </a>
                      </div>
                    </div>

                    <div class="col-xs-6">
                      <div class="form-group form-group-lg">
                        <a href="javascript:void(0)" onclick="reg()" class="gm">
                          <div class="input-group"> <span class="input-group-addon"><i class="fa fa-google-plus"></i></span>
                            <div class="form-control">Đăng ký bằng <br>Google</div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12">
                      <div class="chkbox">
                        <div class="checkbox chkbox">
                          <input type="checkbox" value="1" id="chkbox-agreement" name="" checked="true"/>
                          <label for="chkbox-agreement"></label>
                          Tôi đồng ý với <a href="#popup-terms" data-toggle="modal">chính sách và quy định chung</a> của Gà Rán BCL
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12">
                      <div class="chkbox">
                        <div class="checkbox chkbox">
                          <input type="checkbox" value="2" id="chkbox-email" name="" checked="true"/>
                          Nhận thông tin khuyến mãi qua E-mail.
                          <label for="chkbox-email"></label>
                        </div>

                      </div>
                      <div class="clearfix"></div>
                      <div class="chkbox">
                        <span class="text-note">Chúng tôi cam đoan không chia sẻ thông tin mà không có sự đồng ý của bạn.</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            </div>
          </div>
          <!--  <div class="modal-footer">
          <center>
        </center>
      </div>
    -->
  </div>
  </div>
  </div>
  </div>
  <!-- /Popup Register - Modal -->

  <!-- Popup Terms&Conditions - Modal -->
  <div class="modal fade bs-modal-sm" id="popup-terms" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="popup-wap clearfix">
          <div class="modal-header">
            <div class="btn-close" data-dismiss="modal"></div>
            <div class="form-group text-center">
              <div class="avatar-login inline-block">
                <img src="" class="avatar img-responsive">
              </div>
              <div class="title-login inline-block">Chính sách và quy định chung</div>
            </div>
          </div>

          <div class="modal-body">
            <div id="signup-panel" class="tab-content">
              <div class="tab-pane fade active in" id="signup">
                <div class="content">
                  <p style="text-align: justify;"><em><b>1.1 Chấp nhận chính sách và quy định chung khi sử dụng website</b></em><br><br><span style="background-color: rgb(255, 255, 255);">Những chính sách và quy định chung này ảnh hưởng đến việc khách hàng sử dụng website của Gà Rán BCL và các tổ chức có liên quan đến website của Gà Rán BCL.</span><br><br><span style="background-color: rgb(255, 255, 255);">Khi truy cập hoặc đăng nhập vào website này có nghĩa là khách hàng đã chấp nhận và đồng ý với các chính sách và quy định chung này và những chính sách và quy định của chính sách bảo mật thông tin từ Gà Rán BCL.</span><br><br> <span style="background-color: rgb(255, 255, 255);">Nếu khách hàng không đồng ý với bất kỳ điều khoản nào dưới đây, vui lòng không truy cập vào website của Gà Rán BCL. Chính sách và quy định chung này được xem là hợp đồng giữa khách hàng và Gà Rán BCL và được áp dụng khi khách hàng sử dụng website của Gà Rán BCL. Những chính sách và quy định chung này ảnh hưởng đến quyền lợi của Khách hàng, vui lòng đọc kỹ trước khi sử dụng.</span><br> <br> <em><b>1.2 Những thay đổi đối với các chính sách và quy định chung này</b></em><br> <br> <span style="background-color: rgb(255, 255, 255);">Gà Rán BCL có quyền thay đổi các chính sách và quy định chung này bất cứ lúc nào mà không cần thông báo trước với khách hàng. khách hàng có thể xem phiên bản cập nhật mới nhất của chính sách và quy định chung này bằng cách nhấp chuột vào&nbsp;</span><span style="background-color: rgb(255, 255, 255);"><b>"Chính Sách và Quy Định Chung"</b>&nbsp;</span><span style="background-color: rgb(255, 255, 255);">tại trang chủ của Gà Rán BCL</b></span><span style="background-color: rgb(255, 255, 255);">. Phiên bản cập nhật này sẽ thay thế tất cả các phiên bản cũ. Nếu khách hàng sử dụng website của Gà Rán BCL sau khi xuất hiện những thay đổi này có nghĩa là khách hàng đã đồng ý với những thay đổi này.</span><br> <br> <em><b>1.3 Tài khoản sử dụng của Khách hàng</b></em><br> <br> <span style="background-color: rgb(255, 255, 255);">Nếu khách hàng sử dụng website của Gà Rán BCL, khách hàng có trách nhiệm duy trì tính bảo mật của tài khoản do khách hàng sử dụng, bảo quản mật mã và hạn chế cho người khác truy cập vào máy tính của khách hàng, và khách hàng đồng ý chịu trách nhiệm cho tất cả mọi hoạt động diễn ra trong tài khoản hoặc mật mã của khách hàng.</span><br> <br> <em><b>1.4 Website của Gà Rán BCL</b></em><br> <br> <span style="background-color: rgb(255, 255, 255);">Những chính sách và quy định chung này áp dụng cho tất cả khách hàng sử dụng website của Gà Rán BCL. Website này có thể chứa những liên kết đến website của bên thứ ba không thuộc sở hữu của Gà Rán BCL. Gà Rán BCL không có quyền kiểm soát nội dung, chính sách bảo mật thông tin hoặc những phần khác trong các website của bên thứ ba. Hơn nữa, Gà Rán BCL sẽ không thể kiểm duyệt hoặc biên tập lại nội dung trên các website của bên thứ ba. Chúng tôi khuyến khích khách hàng đọc kỹ các điều khoản, điều kiện và chính sách bảo mật thông tin của các website của bên thứ ba mà bạn truy cập.</span><br> <br> <em><b>1.5 Truy cập vào website</b></em><br> <br> <span style="background-color: rgb(255, 255, 255);">Gà Rán BCL chấp thuận cho bạn sử dụng website như đã công bố trong điều khoản sử dụng dịch vụ, bao gồm: (i) sử dụng website cho mục đích cá nhân, không nhằm mục đích thương mại; (ii) không sao chép hoặc cung cấp bất cứ thông tin nào của website này cho bên thứ ba; (iii) khách hàng không được thay đổi, chỉnh sửa bất cứ phần nào của website này; (iv) khách hàng phải tuân theo chính sách và quy định chung sử dụng dịch vụ.</span><br> <br> <span style="background-color: rgb(255, 255, 255);">Để truy cập vào một số tính năng của website, khách hàng phải tạo một tài khoản cho riêng mình. khách hàng không được phép sử dụng tài khoản của người khác nếu không được sự đồng ý của chủ tài khoản. Khi tạo tài khoản, khách hàng phải cung cấp thông tin đầy đủ và chính xác. khách hàng tự chịu trách nhiệm cho tất cả các hoạt động xảy ra trong tài khoản của mình, và khách hàng phải giữ mật mã tài khoản an toàn. khách hàng phải lập tức thông báo cho Gà Rán BCL nếu có bất cứ vi phạm nào về độ an toàn hoặc sử dụng tài khoản mà không có sự đồng ý của chủ tài khoản. Mặc dù Gà Rán BCL không chịu trách nhiệm pháp lý cho bất cứ những mất mát nào liên quan đến việc sử dụng tài khoản của khách hàng một cách bất hợp pháp, khách hàng phải chịu trách nhiệm cho những mất mát của Gà Rán BCL hoặc những mất mát do sử dụng bất hợp pháp.</span><br> <br> <span style="background-color: rgb(255, 255, 255);">Khách hàng đồng ý không sử dụng bất cứ hệ thống tự động nào, bao gồm nhưng không giới hạn, người máy, gián điệp...để truy cập vào website và gửi nhiều thông tin yêu cầu đến máy chủ của Gà Rán BCL nhiều hơn một người bình thường có thể làm được bằng việc sử dụng website thông thường trong một khoản thời gian nhất định. Mặc dù đã được đề cập ở trên, Gà Rán BCL chấp thuận cho người điều hành của các công cụ tìm kiếm công cộng được phép sử dụng gián điệp để sao chép thông tin từ website cho mục đích tạo ra những chỉ số tìm kiếm có giá trị công cộng của các thông tin này nhưng không được giữ hoặc lưu trữ những tài liệu này. Gà Rán BCL có quyền thu hồi những tài liệu này ngoại trừ những trường hợp đặc biệt. khách hàng đồng ý không thu thập bất cứ thông tin cá nhân nào từ website, bao gồm tên tài khoản, và cũng không sử dụng những hệ thống truyền thông do website cung cấp cho mục đích thương mại nào. khách hàng đồng ý không van nài, với mục đích thương mại, bất kỳ người sử dụng nào của website để yêu cầu đăng ký thông tin.</span><br> <br> <em><b>1.6 Đăng ký thông tin của người sử dụng</b></em><br> <br> <span style="background-color: rgb(255, 255, 255);">Website của Gà Rán BCL cho phép đăng ký thông tin cá nhân. khách hàng nên hiểu rằng những thông tin đăng ký này có được công bố hay không, Gà Rán BCL cũng không đảm bảo rằng sẽ bảo mật thông tin cho bất cứ phần đăng ký nào. khách hàng phải đồng ý với việc KFC có thể công bố tên của khách hàng và phần đăng ký thông tin trên website của Gà Rán BCL hoặc trong những phần thông cáo báo chí hoặc trong các phương tiện truyền thông khác.</span><br> <br> <span style="background-color: rgb(255, 255, 255);">Khách hàng sẽ đơn phương chịu trách nhiệm cho phần đăng ký thông tin cá nhân của mình và tầm quan trọng của việc công bố những thông tin này. Để kết nối với phần đăng nhập thông tin, khách hàng xác nhận và cam kết cho: (i) quyền sở hữu hoặc có những giấy phép cần thiết, chấp thuận và cho phép Gà Rán BCL sử dụng tất cả các bằng sáng chế, thương hiệu, bản quyền, nhãn hiệu đã đăng ký bản quyền và tất cả các quyền lợi độc quyền khác trong tất cả các phần đăng ký thông tin và (ii) khách hàng có văn bản chấp thuận, biên nhận, và sự đồng ý của mỗi cá nhân đăng ký thông tin trong phần đăng ký được sử dụng tên hoặc chân dung cá nhân và những phần đăng ký này mặc nhiên trở thành tài sản của Gà Rán BCL. Gà Rán BCL có thể tự do sử dụng những phần đăng ký thông tin này. Để rõ ràng hơn, khách hàng có thể giữ quyền sở hữu cá nhân trong các phần đăng ký thông tin khác. Tuy nhiên, khi đăng ký thông tin của mình trên website của Gà Rán BCL là khách hàng đã đồng ý cho Gà Rán BCL sử dụng những thông tin cá nhân này và Gà Rán BCL có quyền sử dụng những thông tin này cho mục đích quảng cáo trên website và các kênh truyền thông khác.</span><br> <br> <em><b>1.7 Miễn trừ trách nhiệm về kỹ thuật</b></em><br> <br> <span style="background-color: rgb(255, 255, 255);">Khách hàng đồng ý rằng khi sử dụng website của Gà Rán BCL, khách hàng sẽ tự chấp nhận các rủi ro có thể xảy ra. Các nhân viên văn phòng, ban giám đốc, nhân viên và các đại lý của Gà Rán BCL từ chối bảo hành có liên quan đến website và việc sử dụng website của khách hàng. Gà Rán BCL không bảo hành tính chính xác hoặc hoàn thiện của nội dung trên website hoặc nội dung của bất kỳ website nào được kết nối với website của Gà Rán BCL và chúng tôi không có quyền và nghĩa vụ cho bất cứ (i) những nội dung sai sót và sơ suất hoặc không chính xác, (ii) những tổn thương cá nhân hoặc hư hại tài sản đến từ tự nhiên trong quá trình truy cập và sử dụng website của chúng tôi, (iii) truy cập bất hợp pháp vào các máy chủ của chúng tôi để lấy thông tin cá nhân hoặc/và những thông tin tài chính mà chúng tôi bảo quản trong đó, (iv) cắt ngang hoặc chấm dứt truyền thông tin đến website của chúng tôi, (v) sai sót, vi-rút, hoặc những thứ tương tự như vậy có thể truyền đến thông qua website của chúng tôi bởi bên thứ ba, và (vi) lỗi hoặc sai sót trong phần nội dung hoặc những mất mát hư hỏng do sử dụng nội dung đăng tải, email, đường truyền hoặc những thứ tương tự từ website của Gà Rán BCL. Gà Rán BCL sẽ không bảo hành và chịu trách nhiệm bất cứ sản phẩm, dịch vụ nào hoặc các chương trình khuyến mãi của bên thứ ba thông qua website của Gà Rán BCL và Gà Rán BCL cũng không có trách nhiệm giám sát bất cứ giao dịch nào của khách hàng với bên thứ ba, những người cung cấp sản phẩm và dịch vụ. Việc mua sản phẩm và dịch vụ thông qua trung gian, tốt nhất là khách hàng nên sử dụng khả năng phán xét của mình để quyết định thế nào là hợp lý.</span><br> <br> <em><b>1.8 Hạn chế về nghĩa vụ pháp lý</b></em><br> <br> <span style="background-color: rgb(255, 255, 255);">Ban giám đốc, nhân viên hoặc các đại lý của Gà Rán BCL không chịu bất cứ trách nhiệm pháp lý nào cho khách hàng trong bất kỳ trường hợp nào bao gồm trực tiếp, gián tiếp, ngẫu nhiên, đặc biệt, hư hỏng do cố ý hay bất kỳ vấn đề gì là kết quả của các vấn đề sau bao gồm nhưng không giới hạn: (i) những nội dung sai sót hoặc không chính xác, (ii) những tổn thương cá nhân hoặc hư hại tài sản đến từ tự nhiên trong quá trình truy cập và sử dụng website của chúng tôi, (iii) truy cập bất hợp pháp vào các máy chủ của chúng tôi để lấy thông tin cá nhân hoặc/và những thông tin tài chính mà chúng tôi bảo quản trong đó, (iv) cắt ngang hoặc chấm dứt truyền thông tin đến website của chúng tôi, (v) sai sót, vi-rút, hoặc những thứ tương tự như vậy có thể truyền đến thông qua website của chúng tôi bởi bên thứ ba, và (vi) lỗi hoặc sai sót trong phần nội dung hoặc những mất mát hư hỏng do sử dụng nội dung đăng tải, email, đường truyền hoặc những thứ tương tự từ website của Gà Rán BCL, dựa trên bảo hành, hợp đồng, sai lầm dân sự, hoặc bất cứ các lý thuyết pháp lý khác, công ty sẽ không chịu trách nhiệm cho những thiệt hại có thể xảy ra này. Các hạn chế về nghĩa vụ pháp lý như đã nói ở trên sẽ được áp dụng trong phạm vi luật pháp cho phép.</span><br> <br> <span style="background-color: rgb(255, 255, 255);">Khách hàng nên nhận thức rõ việc Gà Rán BCL sẽ không chịu trách nhiệm cho việc đăng ký thông tin của người sử dụng, hoặc những chỉ dẫn bất hợp pháp của bất kỳ bên thứ ba nào hoặc bất cứ những rủi ro thiệt hại nào khác cho khách hàng.</span><br> <br> <em><b>1.9 Bồi thường</b></em><br> <br> <span style="background-color: rgb(255, 255, 255);">Khách hàng đồng ý bảo vệ, bồi thường và không gây hại cho Gà Rán BCL, công ty mẹ, ban giám đốc, nhân viên chi nhánh và các đại lý dựa trên toàn bộ/bất cứ các yêu sách, thiệt hại, mất mát, nghĩa vụ, chi phí hoặc nợ (bao gồm nhưng không giới hạn phí công chứng) phát sinh do: (i) khách hàng truy cập &amp; sử dụng website của Gà Rán BCL, (ii) khách hàng vi phạm bất cứ điều khoản nào trong phần điều khoản sử dụng dịch vụ này, (iii) khách hàng vi phạm quyền lợi của bất kỳ bên thứ ba nào, bao gồm nhưng không giới hạn tác quyền, tài sản, hoặc là quyền cá nhân, (iv) bất cứ các yêu sách nào từ phần đăng ký thông tin cá nhân gây thiệt hại cho bên thứ ba. Trách nhiệm về bồi thường sẽ được áp dụng xuyên suốt trong các điều khoản sử dụng cũng như việc truy cập vào website của Gà Rán BCL.</span><br> <br> <em><b>1.10 Tài sản trí tuệ của Gà Rán BCL</b></em><br> <br> <span style="background-color: rgb(255, 255, 255);">Website này chứa nhiều bản quyền thương hiệu có giá trị do Gà Rán BCL và các chi nhánh, thành viên trên toàn thế giới sở hữu và sử dụng. Những bản quyền thương hiệu này được sử dụng để phân biệt các chất lượng sản phẩm và dịch vụ của Gà Rán BCL. Những bản quyền thương hiệu này và các tài sản có liên quan được bảo vệ để tránh không được tái sản xuất và giả mạo theo luật quốc gia và luật quốc tế và không được sao chép dưới bất kỳ hình thức nào nếu không được sự đồng ý bằng văn bản của Gà Rán BCL. Văn bản, hình ảnh minh họa, mã html có trong website này sẽ không được sao chép, phân phối, trưng bày, tái sản xuất và truyền tải dưới bất kỳ hình thức nào hoặc phương tiện nào mà không được sự đồng ý bằng văn bản của Gà Rán BCL. Website của Gà Rán BCL có thể liên kết đến những trang khác không liên quan đến Gà Rán BCL. Các đường kết nối không được cung cấp dưới dạng dịch vụ dành cho khách hàng và không được tài trợ hoặc liên kết với website của Gà Rán BCL. Gà Rán BCL sẽ không xem xét các đường kết nối này đến từ website nào và không chịu trách nhiệm cho nội dung của bất cứ website nào khác. khách hàng tự chịu rủi ro khi truy cập các đường kết nối này. Gà Rán BCL sẽ không đại diện hoặc bảo hành cho bất cứ nội dung, tính trọn vẹn, hoặc tính chính xác nào của các đường kết nối này hoặc các website liên kết với website của chúng tôi.</span><br> <br> <span style="background-color: rgb(255, 255, 255);">Gà Rán BCL có quyền điều chỉnh các Điều khoản dịch vụ này bất cứ lúc nào mà không cần thông báo trước, và nhiệm vụ của khách hàng là phải xem lại các điều khoản này nếu có bất kỳ thay đổi nào. khách hàng sử dụng website của Gà Rán BCL với những điều khoản chỉnh sửa có nghĩa là khách hàng đã đồng ý và chấp nhận những điều khoản chỉnh sửa này.</span></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Popup Terms&Conditions - Modal -->

  <!-- Popup Notfications/Error - Modal -->
  <div class="modal fade" id="error-popup" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="popup-wap clearfix">
        <div class="n-vertical top clearfix">
          <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
        </div>
        <div class="n-vertical bottom clearfix">
          <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
        </div>
        <div class="modal-header">
          <div class="btn-close" data-dismiss="modal"></div>
          <div class="form-group text-center">
            <div class="title-login inline-block">Thông báo</div>
          </div>
        </div>

        <div class="modal-body">Lỗi xảy ra!</div>
    </div>
    </div>
  </div>
</div>
<!-- /Popup Notfications/Error - Modal -->
