<head>
<title>Đăng nhập | Gà Rán BCL</title>
</head>
<?php include_once("header.php");?>

<?php
if(empty($_SESSION['current'])){
  ?>
<div class="container container-sect blog-sect col-xs-12 col-lg-12" id="login-sect">
  <div class="row sect-title">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-10">
      <h2><i class="glyphicon glyphicon-user"></i> ĐĂNG NHẬP</h2>
    </div>
  </div>

  <div class="row sect-content">
    <div class="hidden-xs col-lg-2">
    </div>
    <div class="col-xs-5 col-lg-2">
      <!-- Nav tabs -->
      <ul class="nav nav-pills nav-stacked nav-pills-login">
        <li class="active"><a data-toggle="pill" href="#login-page">Đăng nhập</a></li>
        <li><a data-toggle="pill" href="#signup-page">Đăng ký</a></li>
      </ul>
    </div>

    <div class="col-xs-7 col-lg-8">
      <!-- Tab panes -->
      <div class="tab-content">
        <div id="login-page" class="tab-pane fade in active">
          <form id="login-page-form" action='' method='post' accept-charset='UTF-8'>
            <div class="row">
              <div class="col-xs-12 col-lg-12">
                <label class="error-label login-error-label"></label>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-lg-8">
                <div class="form-group">
                  <input type="text" name="login-username" id="login-page-user"
                  <?php if(isset($_SESSION['username'])) echo 'class="form-control focus" value="'.$_SESSION['username'].'" ';
                    else echo 'class="form-control focus empty"'; ?> placeholder="" required="" autofocus>
                  <label class="floating-label">Tên đăng nhập</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-lg-8">
                <div class="form-group">
                  <input type="password" name="login-password" id="login-page-pass" class="form-control focus empty" placeholder="" required="">
                  <label class="floating-label">Mật khẩu</label>
                </div>
              </div>
            </div>

            <div class="row no-gutter">
              <div class="col-xs-12 col-sm-8 col-lg-5">
                <div class="clearfix">
                  <div class="checkbox chkbox">
                    <input type="checkbox" value="1" id="login-page-save-user" name="login-page-save-user" checked>Ghi nhớ
                    <label for="chkbox-label"></label>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                <br>
              </div>
              <div class="col-xs-12 col-sm-4 col-lg-7">
                <div class="form-group">
                  <button class="btn btn-lg btn-bcl red" type="submit" name="login-submit">Đăng nhập</button>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-xs-12 col-lg-4">
                <div class="form-group form-group-lg">
                  <a href="javascript:void(0)" onclick="loginFB()" class="fb">
                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                      <div class="form-control">Đăng nhập với <br>Facebook</div>
                    </div>
                  </a>
                </div>
              </div>

              <div class="col-xs-12 col-lg-4">
                <div class="form-group form-group-lg">
                  <a href="javascript:void(0)" onclick="loginGG()" class="gm">
                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-google-plus"></i></span>
                      <div class="form-control">Đăng nhập với <br>Google</div>
                    </div>
                  </a>
                </div>
              </div>
            </div>

          </form>
        </div>

        <div id="signup-page" class="tab-pane fade">
          <form onsubmit="return false;">
                <div class="regform">
                  <div class="row">
                    <div class="col-xs-12 col-lg-4">
                      <label class="nhan">Họ và tên <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-12 col-lg-4">
                      <input name="name" class="form-control" type="text" required="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-lg-4">
                      <label class="nhan">Tên đăng nhập <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-12 col-lg-4">
                      <input name="username" class="form-control" type="text" required="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-lg-4">
                      <label class="nhan">Mật khẩu <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-12 col-lg-4">
                      <input name="password" class="form-control" type="password" required="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-lg-4">
                      <label class="nhan">Nhập lại mật khẩu <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-12 col-lg-4">
                      <input class="form-control" name="reenterpassword" type="password" required="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-lg-4">
                      <label class="nhan">E-mail <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-12 col-lg-4">
                      <input name="email" class="form-control" type="text" required="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-lg-3">
                      <label class="nhan">Ngày sinh <imp>(*)</imp>: </label>
                    </div>
                    <div class="hidden-xs col-lg-1">
                    </div>
                    <div class="col-xs-4 col-lg-1">
                      <select class="date_day" name="user-date-day"></select>
                    </div>
                    <div class="col-xs-4 col-lg-1">
                      <select class="date_month" name="user-date-month"></select>
                    </div>
                    <div class="col-xs-4 col-lg-2">
                      <select class="date_year" name="user-date-year"></select>
                    </div>
                    <div class="hidden-xs col-lg-5">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-lg-3">
                      <label class="lblgioitinh">Giới tính <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-2 col-lg-0"></div>
                    <div class="col-xs-5 col-lg-2">
                      <div class="clearfix">
                        <div class="radio gioitinh">
                          <input type="radio" value="1" name="gender" checked>
                          <label for="user-gender-nam">Nam</label>
                        </div>
                      </div>
                    </div>

                    <div class="col-xs-5 col-lg-2">
                      <div class="clearfix">
                        <div class="radio gioitinh">
                          <input id="user-gender-nu" type="radio" value="0" name="gender">
                          <label for="user-gender-nu">Nữ</label>
                        </div>
                      </div>
                    </div>
                    <div class="hidden-xs col-lg-5">
                    </div>
                  </div>


                  <div class="row ">
                    <div class="col-xs-12 col-lg-4">
                      <label class="nhan">Điện thoại <imp>(*)</imp>: </label>
                    </div>
                    <div class="col-xs-12 col-lg-4">
                      <input class="form-control" name="phonenumber" type="tel" maxlength="11" required="">
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-xs-12 col-lg-4">
                      <label class="nhan"><imp>(*)</imp> Thông tin bắt buộc </label>
                    </div>

                    <div class="col-xs-12 col-lg-4">
                      <div class="form-group">
                        <button class="btn btn-danger btn-block btn-lg btn-dk" type="submit" name="reg-submit">Đăng ký</button>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                      <div class="form-group form-group-lg">
                        <a href="javascript:void(0)" onclick="regFB()" class="fb">
                          <div class="input-group"> <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                            <div class="form-control">Đăng ký bằng <br>Facebook</div>
                          </div>
                        </a>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-lg-4">
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
                          <input type="checkbox" value="1" name="checkagreement" id="signup-chkagree" checked="true"/>
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
                          <input type="checkbox" value="2" name="checknoti" id="signup-chknoti" checked="true"/>
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
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
<?php } else { ?>
  <script type="text/javascript">location.href = './quan-ly';</script>
  <?php } ?>
<?php include_once("footer.php");?>

<?php
if(isset($_GET['sec']))
{
  $selection = $_GET['sec'];
  if($conn != "NULL"){
    $section_id = "0";
    $choice =array("login","reg");
    $section_id = array_search($selection, $choice);

    echo "<script>$('.nav-pills-login li:eq($section_id) a').tab('show');</script>";
  }
}
?>
