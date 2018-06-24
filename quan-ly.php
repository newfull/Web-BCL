<head>
<title>Quản lý tài khoản | Gà Rán BCL</title>
</head>
<?php include_once("header.php");?>

<?php
if(!empty($_SESSION['current'])){
?>
<div class="container container-sect user-sect col-xs-12 col-lg-12" id="user-sect">
  <div class="row sect-title">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-10">
      <h2><i class="glyphicon glyphicon-user"></i> QUẢN LÝ TÀI KHOẢN</h2>
    </div>
  </div>

  <div class="row sect-content">
    <div class="col-lg-2 user-sect-left-rev display-none">
    </div>
    <div class="col-xs-5 col-lg-2">
      <!-- Nav tabs -->
      <ul class="nav nav-pills nav-stacked nav-pills-user">
          <li class="active"><a data-toggle="pill" href="#user">Thông tin tài khoản</a></li>
          <li><a data-toggle="pill" href="#eadd">Thay đổi địa chỉ</a></li>
          <li><a data-toggle="pill" href="#his">Lịch sử mua hàng</a></li>
          <li><a data-toggle="pill" href="#liked">Món ăn yêu thích</a></li>
          <li><a data-toggle="pill" href="#epass">Đổi mật khẩu</a></li>
      </ul>
    </div>

    <div class="col-xs-7 col-lg-8">
      <!-- Tab panes -->
      <div class="tab-content">
        <div id="user" class="tab-pane fade in active">
          <form id='user_info' action='' method='post' accept-charset='UTF-8'>
              <div class="regform">
                <div class="row">
                  <div class="col-xs-4 col-lg-4">
                    <label class="nhan">Họ và tên <imp>(*)</imp>: </label>
                  </div>
                  <div class="col-xs-8 col-lg-4">
                    <input id="user-name" name="name" class="form-control" type="text" required=""
                    <? echo " value='".$current_user->getName()."'";?>
                    >
                  </div>
                  <div class="col-xs-0 col-lg-4">
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-4 col-lg-4">
                    <label class="nhan">Tên đăng nhập: </label>
                  </div>
                  <div class="col-xs-8 col-lg-4">
                    <input id="user-username" class="form-control" type="text" required="" readonly
                    <? echo " value='".$current_user->getUser()."'";?>
                    >
                  </div>
                  <div class="col-xs-0 col-lg-4">
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-4 col-lg-4">
                    <label class="nhan">E-mail <imp>(*)</imp>: </label>
                  </div>
                  <div class="col-xs-8 col-lg-4">
                    <input id="user-email" name="email" class="form-control" type="text" required=""
                    <? echo " value='".$current_user->getEmail()."'";?>
                    >
                  </div>
                  <div class="col-xs-0 col-lg-4">
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-4 col-lg-4">
                    <label class="nhan">Địa chỉ: </label>
                  </div>
                  <div class="col-xs-8 col-lg-4">
                    <input id="user-address" name="address" class="form-control" type="text" required="" readonly
                    <? echo " value='".$current_user->getAdd()."'";?>
                    >
                  </div>
                  <div class="col-xs-0 col-lg-4">
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-4 col-lg-3">
                    <label class="nhan">Ngày sinh <imp>(*)</imp>: </label>
                  </div>
                  <div class="col-xs-1 col-lg-0"></div>
                  <div class="col-xs-2 col-lg-1">
                    <select class="date_day" name="user-date-day" id="user-dob-day"></select>
                  </div>
                  <div class="col-xs-2 col-lg-1">
                    <select class="date_month" name="user-date-month" id="user-dob-month"></select>
                  </div>
                  <div class="col-xs-3 col-lg-2">
                    <select class="date_year" name="user-date-year" id="user-dob-year"></select>
                  </div>
                  <div class="col-xs-0 col-lg-5">
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-4 col-lg-3">
                    <label class="lblgioitinh">Giới tính <imp>(*)</imp>: </label>
                  </div>
                  <div class="col-xs-2 col-lg-0"></div>
                  <div class="col-xs-3 col-lg-2">
                    <div class="clearfix">
                      <div class="radio gioitinh">
                        <input id="user-gender-nam" type="radio" value="1" name="gender" <?php echo ($current_user->getSex()=='1')?'checked':'' ?>>
                        <label for="user-gender-nam">Nam</label>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-3 col-lg-2">
                    <div class="clearfix">
                      <div class="radio gioitinh">
                        <input id="user-gender-nu" type="radio" value="0" name="gender" <?php echo ($current_user->getSex()=='0')?'checked':'' ?>>
                        <label for="user-gender-nu">Nữ</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-0 col-lg-5">
                  </div>
                </div>


                <div class="row ">
                  <div class="col-xs-4 col-lg-4">
                    <label class="nhan">Điện thoại <imp>(*)</imp>: </label>
                  </div>
                  <div class="col-xs-8 col-lg-4">
                    <input id="user-phonenumber" class="form-control" name="phonenumber" type="text" maxlength="11" required=""
                    <? echo " value='".$current_user->getPhone()."'";?>
                    >
                  </div>
                  <div class="col-xs-0 col-lg-4">
                  </div>
                </div>


                <div class="row">
                  <div class="col-xs-4 col-lg-3">
                    <label class="nhan"><imp>(*)</imp> Thông tin bắt buộc </label>
                  </div>

                  <div class="col-xs-8 col-lg-5">
                    <div class="chkbox">
                      <div class="checkbox chkbox">
                        <input type="checkbox" value="2" id="user-chkbox-not" name="" <?php echo ($current_user->getNoti()=='1')?'checked':'' ?>/>
                          Nhận thông tin khuyến mãi qua E-mail.
                        <label for="user-chkbox-not"></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-0 col-lg-4">
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-xs-0 col-lg-2">
                  </div>
                  <div class="col-xs-6 col-lg-3">
                    <div class="form-group">
                      <button class="btn btn-default btn-block btn-lg" onclick="reload_info">Huỷ</button>
                    </div>
                  </div>
                  <div class="col-xs-6 col-lg-3">
                    <div class="form-group">
                      <button class="btn btn-danger btn-block btn-lg btn-dk" type="submit" name="update-submit">Cập nhật</button>
                    </div>
                  </div>
                  <div class="col-xs-0 col-lg-4">
                  </div>
                </div>
              </div>
          </form>
        </div>
        <div id="eadd" class="tab-pane fade">
          <div class="wrapper-add">Địa chỉ</div>
        </div>
        <div id="his" class="tab-pane fade">
          <div class="wrapper-his">??</div>
        </div>
        <div id="liked" class="tab-pane fade">
          <div class="liked-combos">
            <div class="liked-combos-content">
          <?php
           $create_tab_content = "";
           $list = liked_combos($conn, $current_user->getID());
           if(isEmpty($list)) $num = 0;
           else $num = count($list);
           for($j = 0; $j < $num; $j++){
             $create_tab_content .= "<div class='item-card inline-block'><div class='front-facing'>";
             $create_tab_content .= "<img src='./images/items/".($list[$j]['DuongDan'])."' onerror='this.src=\"../images/not-found.png\"' class='disp img-responsive'>";
             $create_tab_content .= "<p class='title'>".($list[$j]['Ten'])."</p><p class='price'>".number_format($list[$j]['Gia'], 0)." VNĐ"."</p>";
             $create_tab_content .= "<img onclick='likecombo(".$current_user->getID().",".($list[$j]['Ma']).")' src='./images/btn-liked.png' class='btn-like img-responsive'>";
             if($list[$j]['TinhTrang'] == 1){
               $create_tab_content .= "<img onclick='addCombotoCart(".$current_user->getCart().",".($list[$j]['Ma']).")' src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'>";
             }
             $create_tab_content .= "</div>";
             $create_tab_content .= "<div class='back-facing'>";
             $create_tab_content .= "<p class='title'>".($list[$j]['Ten'])."</p><p class='price'>".number_format($list[$j]['Gia'], 0)." VNĐ"."</p>";
             $create_tab_content .= "<img onclick='likecombo(".$current_user->getID().",".($list[$j]['Ma']).")' src='./images/btn-liked.png' class='btn-like img-responsive'>";
             if($list[$j]['TinhTrang'] == 1){
               $create_tab_content .= "<img onclick='addCombotoCart(".$current_user->getCart().",".($list[$j]['Ma']).")' src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'>";
             }

             $details = combo_details($conn, $list[$j]['Ma']);
             if(isEmpty($details)) $lines = 0;
             else $lines = count($details);

            $create_tab_content .= "<div class='details'>";
             for($k = 0; $k < $lines; $k++){
             $create_tab_content .= "<p data-toggle='tooltip' title='Giá gốc: ".number_format($details[$k]['Gia'], 0)." VNĐ'>► ".($details[$k]['SoLuong'])." ".($details[$k]['DonVi'])." ".($details[$k]['Ten'])."</p>";
              }

           $create_tab_content .= "</div>";
           $create_tab_content .= "</div></div>";
          }
           echo $create_tab_content;
           ?>
         </div>
       </div>
         <div class="liked-items">
           <div class="liked-items-content">
           <?
           $create_tab_content = "";
           $list = liked_items($conn, $current_user->getID());
           if(isEmpty($list)) $num = 0;
           else $num = count($list);

           for($j = 0; $j < $num; $j++){
             $create_tab_content .= "<div class='item-card inline-block'><div class='front-facing'>";
             $create_tab_content .= "<img src='./images/items/".($list[$j]['DuongDan'])."' onerror='this.src=\"../images/not-found.png\"' class='disp img-responsive'>";
             $create_tab_content .= "<p class='title'>".($list[$j]['Ten'])."</p><p class='price'>".number_format($list[$j]['Gia'], 0)." VNĐ"."</p>";
             $create_tab_content .= "<img onclick='likeitem(".$current_user->getID().",".($list[$j]['Ma']).")' src='./images/btn-liked.png' class='btn-like img-responsive'>";
             if($list[$j]['TinhTrang'] == 1){
               $create_tab_content .= "<img onclick='addItemtoCart(".$current_user->getCart().",".($list[$j]['Ma']).")' src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'>";
             }
             $create_tab_content .= "</div>";
             $create_tab_content .= "<div class='back-facing'>";
             $create_tab_content .= "<p class='title'>".($list[$j]['Ten'])."</p><p class='price'>".number_format($list[$j]['Gia'], 0)." VNĐ"."</p>";
             $create_tab_content .= "<img onclick='likeitem(".$current_user->getID().",".($list[$j]['Ma']).")' src='./images/btn-liked.png' class='btn-like img-responsive'>";
             if($list[$j]['TinhTrang'] == 1){
               $create_tab_content .= "<img onclick='addItemtoCart(".$current_user->getCart().",".($list[$j]['Ma']).")' src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'>";
             }
             $create_tab_content .= "<div class='details'><p>► ".($list[$j]['Ten'])."</p></div>";
             $create_tab_content .= "</div></div>";
           }

           echo $create_tab_content;
           ?>
         </div>
       </div>
        </div>
        <div id="epass" class="tab-pane fade">
          <h3>test 3</h3>
          <p>Some content in menu 2.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-0 user-sect-right-rev display-none">
    </div>
  </div>
</div>

<?
}
else{?>
  <script type="text/javascript">location.href = './dang-nhap';</script>
<?}?>
<?php include_once("footer.php");?>

<?php
if(isset($_GET['sec']))
{
  $selection = $_GET['sec'];
  if($conn != "NULL"){
    $section_id = "0";
    $choice =array("user","","his","liked");
    $section_id = array_search($selection, $choice);

    echo "<script>$('.nav-pills-user li:eq($section_id) a').tab('show');</script>";
  }
}
?>
