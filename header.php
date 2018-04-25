
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website bán gà rán BCL">
    <meta name="author" content="BCL">

    <link rel="shortcut icon" href="../favicon.ico">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
            <a class="navbar-brand" href="trang-chu">
                <img src="./images/logo.png" class="logo-img img-responsive">
              </a>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
      <nav id="navbar" class="navbar navbar-default navbar-bcl">
  			<div class="container">
  					<div class="col-sm-4">
  						<div class="logo pull-left">
  							<a href="trang-chu"><img src="images/name.png" alt="" /></a>
  						</div>
            </div>
  					<div class="col-sm-8">
  						<div class="shop-menu pull-right">
  							<ul class="nav navbar-nav">

  								<li><a href="#popup-login" data-toggle="modal" id="btnLogIn"><i class="fa fa-lock"></i>Log</a></li>
                  <li><a href="#popup-reg" data-toggle="modal" id="btnReg"><i class="fa fa-lock"></i>Reg</a></li>
                  <li><a href="checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
  								<li><a href="cart"><i class="fa fa-shopping-cart"></i> Cart</a></li>
  						</ul>
  					</div>
  			 </div>
      	</div>
       </nav>
  	</div><!--/header-middle-->
	</header><!--/header-->


  <div class="modal fade bs-modal-sm" id="popup-login" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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

        <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <input type="text" value="" name="login-user" id="login-user" class="form-control focus empty" placeholder="">
                <label class="floating-label">Tên đăng nhập</label>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <input type="password" value="" name="login-pass" id="login-pass" class="form-control focus empty" placeholder="">
              <label class="floating-label">Mật khẩu</label>
            </div>
          </div>
        </div>

        <div class="row no-gutter">
          <div class="col-xs-4">
            <div class="clearfix">
              <div class="checkbox chkbox">
                  <input type="checkbox" value="1" id="chkbox-label" name=""/>Ghi nhớ
                  <label for="chkbox-label"></label>
              </div>
            </div>
          </div>

          <div class="col-xs-4">
            <div class="form-group form-group-lg">
              <div class="b-btn gm">
                  <div class="input-group">
                    <input class="form-control btn btn-danger" type="submit" onclick="loginTop()" name="submitTop" value="Đăng nhập">
                  </div>
              </div>
            </div>
          </div>

        <div class = "col-xs-4">
          <div class="clearfix">
            <a href="javascript:void(0)" data-toggle="tab" data-target="#forgotpass" class="text-danger">Quên mật khẩu ?</a>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-xs-6">
          <div class="form-group form-group-lg">
            <a href="javascript:void(0)" onclick="loginFB()" class="fb">
              <div class="input-group"> <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                <div class="form-control">Đăng nhập với Facebook</div>
              </div>
            </a>
          </div>
        </div>

        <div class="col-xs-6">
            <div class="form-group form-group-lg">
            <a href="javascript:void(0)" onclick="loginGG()" class="gm">
                <div class="input-group"> <span class="input-group-addon"><i class="fa fa-google-plus"></i></span>
                  <div class="form-control">Đăng nhập với Google</div>
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
              <div class="form-group form-group-lg">
                <div class="b-btn gm">
                  <div class="input-group">
                    <input class="form-control btn btn-danger" id="btn-regnow" data-target="#popup-reg" data-toggle="modal" value="Đăng ký ngay" readonly="readonly">
                  </div>
                </div>
              </div>
          </div>

        <div class="col-xs-1">
          <div class="popup-close-line"></div>
        </div>
    </div>
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


<div class="modal fade bs-modal-sm" id="popup-reg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
      <div class="tab-pane fade active in" id="signup">
        <div class="regform">
          <div class="row">
            <div class="col-xs-4">
              <label class="nhan">Họ và tên <imp>(*)</imp>: </label>
            </div>
            <div class="col-xs-8">
                <input id="userid" name="userid" class="form-control" type="text" required="">
            </div>
          </div>

          <div class="row">
            <div class="col-xs-4">
              <label class="nhan">Mật khẩu <imp>(*)</imp>: </label>
            </div>
            <div class="col-xs-8">
              <input id="password" name="password" class="form-control" type="password" required="">
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
                <label class="nhan">Ngày sinh <imp>(*)</imp>: </label>
              </div>
              <div class="col-xs-1"></div>
              <div class="col-xs-2">
                <select class="date_day"></select>
              </div>
              <div class="col-xs-2">
                <select class="date_month"></select>
              </div>
              <div class="col-xs-3">
                <select class="date_year"></select>
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


            <div class="row">
              <div class="col-xs-4">
                <label class="nhan">Điện thoại <imp>(*)</imp>: </label>
              </div>
              <div class="col-xs-8">
                <input id="phonenumber" class="form-control" name="phonenumber" type="text" maxlength="11" required="">
              </div>
            </div>


        <div class="row">
          <div class="col-xs-4">
            <label class="nhan"><imp>(*)</imp> Thông tin bắt buộc </label>
        </div>

        <div class="col-xs-8">
          <div class="form-group">
            <button onclick="registerUser()" class="btn btn-danger btn-block btn-lg btn-dk">Đăng ký</button>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-6">
          <div class="form-group form-group-lg"><a href="javascript:void(0)" onclick="loginFB()" class="fb btn-block">
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
              <div class="form-control">Đăng ký bằng Facebook</div>
            </div>
            </a> </div>
        </div>
        <div class="col-xs-6">
          <div class="form-group form-group-lg"><a href="javascript:void(0)" id="loginGoogle" class="gm btn-block">
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa fa-google-plus"></i></span>
              <div class="form-control">Đăng ký bằng Google</div>
            </div>
            </a> </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
            <div class="chkbox">
              <div class="checkbox chkbox">
                  <input type="checkbox" value="1" id="chkbox-agreement" name="" checked="true"/>
                  <label for="chkbox-agreement"></label>
                  Tôi đồng ý với <a hred="#">chính sách và quy định chung</a> của Gà Rán BCL
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


</div>
