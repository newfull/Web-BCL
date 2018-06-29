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
      <h2><i class="glyphicon glyphicon-star"></i> ĐĂNG NHẬP</h2>
    </div>
  </div>

  <div class="row sect-content">
    <div class="hidden-xs col-lg-2">
    </div>
    <div class="col-xs-5 col-lg-2">
      <!-- Nav tabs -->
      <ul class="nav nav-pills nav-stacked nav-pills-login">
        <li class="active"><a data-toggle="pill" href="#login">Đăng nhập</a></li>
        <li><a data-toggle="pill" href="#signup">Đăng ký</a></li>
        <li><a data-toggle="pill" href="#fgpass">Quên mật khẩu</a></li>
      </ul>
    </div>

    <div class="col-xs-7 col-lg-8">
      <!-- Tab panes -->
      <div class="tab-content">
        <div id="login" class="tab-pane fade">
              <form id='login-page' action='' method='post' accept-charset='UTF-8'>
                <div class="row">
                  <div class="col-xs-12 col-lg-12">
                    <label class="error-label "></label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-lg-4">
                    <label class="nhan">Mật khẩu cũ: </label>
                  </div>
                  <div class="col-xs-12 col-lg-4">
                    <input id="old-password" name="old_password" class="form-control" type="password" required="">
                  </div>
                  <div class="hidden-xs col-lg-4">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-lg-4">
                    <label class="nhan">Mật khẩu mới: </label>
                  </div>
                  <div class="col-xs-12 col-lg-4">
                    <input id="new-password" name="new_password" class="form-control" type="password" required="">
                  </div>
                  <div class="hidden-xs col-lg-4">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-lg-4">
                    <label class="nhan">Xác nhận mật khẩu: </label>
                  </div>
                  <div class="col-xs-12 col-lg-4">
                    <input id="new-password-valid" name="new_password_valid" class="form-control" type="password" required="">
                  </div>
                  <div class="hidden-xs col-lg-4">
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-xs-2 col-md-5 col-lg-5">
                  </div>
                  <div class="col-xs-4 col-md-2 col-lg-1">
                    <div class="form-group">
                      <button type="reset" class="btn btn-default" onclick="reload_epass_sect()">Huỷ</button>
                    </div>
                  </div>
                  <div class="col-xs-5 col-md-2 col-lg-1">
                    <div class="form-group">
                      <button class="btn btn-danger update-pass">Cập nhật</button>
                    </div>
                  </div>
                  <div class="col-xs-1 col-md-3 col-lg-5">
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
