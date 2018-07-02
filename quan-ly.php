<head>
  <title>Quản lý tài khoản | Gà Rán BCL</title>
</head>
<?php include_once("header.php");?>

<?php
if(!empty($_SESSION['current'])){
  ?>
  <div class="container container-sect col-xs-12 col-lg-12" id="user-sect">
    <div class="row sect-title">
      <div class="col-lg-2">
      </div>
      <div class="col-lg-10">
        <h2><i class="glyphicon glyphicon-user"></i> QUẢN LÝ TÀI KHOẢN</h2>
      </div>
    </div>

    <div class="row sect-content">
      <div class="hidden-xs col-lg-2">
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
                <form id='user_info' onsubmit="return false;">
                  <div class="info1">
                    <div class="info1-content">
                      <div class="row">
                        <div class="col-xs-12 col-lg-12">
                          <label class="error-label user-error-label"></label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-lg-4">
                          <label class="nhan">Họ và tên <imp>(*)</imp>: </label>
                        </div>
                        <div class="col-xs-12 col-lg-4">
                          <input id="user-name" name="name" class="form-control" type="text" required=""
                          <? echo " value='".$current_user->getName()."'";?>
                          >
                        </div>
                        <div class="hidden-xs col-lg-4">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-lg-4">
                          <label class="nhan">Tên đăng nhập: </label>
                        </div>
                        <div class="col-xs-12 col-lg-4">
                          <input id="user-username" class="form-control" type="text" required="" readonly
                          <? echo " value='".$current_user->getUser()."'";?>
                          >
                        </div>
                        <div class="hidden-xs col-lg-4">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-lg-4">
                          <label class="nhan">E-mail <imp>(*)</imp>: </label>
                        </div>
                        <div class="col-xs-12 col-lg-4">
                          <input id="user-email" name="email" class="form-control" type="text" required=""
                          <? echo " value='".$current_user->getEmail()."'";?>
                          >
                        </div>
                        <div class="hidden-xs col-lg-4">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-lg-3">
                      <label class="nhan">Ngày sinh <imp>(*)</imp>: </label>
                    </div>
                    <div class="hidden-xs col-lg-1">
                    </div>
                    <div class="col-xs-4 col-lg-1">
                      <select class="date_day" name="user-date-day" id="user-dob-day"></select>
                    </div>
                    <div class="col-xs-4 col-lg-1">
                      <select class="date_month" name="user-date-month" id="user-dob-month"></select>
                    </div>
                    <div class="col-xs-4 col-lg-2">
                      <select class="date_year" name="user-date-year" id="user-dob-year"></select>
                    </div>
                    <div class="hidden-xs col-lg-5">
                    </div>
                  </div>
                  <div class="info2">
                    <div class="info2-content">
                      <div class="row">
                        <div class="col-xs-12 col-lg-3">
                          <label class="lblgioitinh">Giới tính <imp>(*)</imp>: </label>
                        </div>
                        <div class="col-xs-2 col-lg-0"></div>
                        <div class="col-xs-5 col-lg-2">
                          <div class="clearfix">
                            <div class="radio gioitinh">
                              <input id="user-gender-nam" type="radio" value="1" name="gender" checked>
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
                          <input id="user-phonenumber" class="form-control" name="phonenumber" type="text" maxlength="11" required=""
                          <? echo " value='".$current_user->getPhone()."'";?>
                          >
                        </div>
                        <div class="hidden-xs col-lg-4">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-xs-12 col-lg-3">
                          <label class="nhan"><imp>(*)</imp> Thông tin bắt buộc </label>
                        </div>

                        <div class="col-xs-12 col-lg-5">
                          <div class="chkbox">
                            <div class="checkbox chkbox">
                              <input type="checkbox" value="2" id="user-chkbox-not" name="" <?php echo ($current_user->getNoti()=='1')?'checked':'' ?>/>
                              Nhận tin khuyến mãi qua E-mail.
                              <label for="user-chkbox-not"></label>
                            </div>
                          </div>
                        </div>
                        <div class="hidden-xs col-lg-4">
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>

                  <div class="row">
                    <div class="hidden-xs col-lg-2">
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-3">
                      <div class="form-group">
                        <button type="reset" class="btn btn-default btn-block btn-lg btn-huy" onclick="reload_user_sect()">Huỷ</button>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-3">
                      <div class="form-group">
                        <button class="btn btn-danger btn-block btn-lg btn-dk update-info" type="submit">Cập nhật</button>
                      </div>
                    </div>
                    <div class="hidden-xs col-lg-4">
                    </div>
                  </div>
                </form>
                </div>

          <div id="eadd" class="tab-pane fade">
            <div class="wrapper-add">
              <div class="wrapper-add-content">
                <form id='user_change_add'>
                  <div class="row">
                    <div class="col-xs-12 col-lg-12">
                      <label class="error-label user-add-error-label"></label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-lg-4">
                      <label class="nhan">Địa chỉ hiện tại: </label>
                    </div>
                    <div class="col-xs-12 col-lg-6 current-address">
                      <label class="cur-add"><? echo $current_user->getAdd(); ?></label>
                    </div>
                    <div class="hidden-xs col-lg-2">
                    </div>
                  </div>
                  <br>
                  <div class="row" id="row-user-city">
                    <div class="col-xs-12 col-lg-4">
                      <label class="nhan user-city">Tỉnh/ thành phố: </label>
                    </div>
                    <div class="col-xs-12 col-lg-4">
                      <select class="selectpicker" data-live-search="true" data-size="14" title="---Chọn một tỉnh/thành phố---" name="add_city" id="user-add-city" data-width="100%"></select>
                    </div>
                    <div class="hidden-xs col-lg-4">
                    </div>
                  </div>
                  <br>
                  <div class="row display-none" id="row-user-dist">
                    <div class="col-xs-12 col-lg-4">
                      <label class="nhan user-dist">Quận/ Huyện: </label>
                    </div>
                    <div class="col-xs-12 col-lg-4">
                      <select class="selectpicker" data-live-search="true" data-size="14" title="---Chọn một quận/ huyện---" name="add_dist" id="user-add-dist" data-width="100%"></select>
                    </div>
                    <div class="hidden-xs col-lg-4">
                    </div>
                  </div>
                  <br>
                  <div class="row display-none" id="row-user-ward">
                    <div class="col-xs-12 col-lg-4">
                      <label class="nhan user-ward">Xã/ Phường: </label>
                    </div>
                    <div class="col-xs-12 col-lg-4">
                      <select class="selectpicker" data-live-search="true" data-size="14" title="---Chọn một xã/ phường---" name="add_ward" id="user-add-ward" data-width="100%"></select>
                    </div>
                    <div class="hidden-xs col-lg-4">
                    </div>
                  </div>
                  <br>
                  <div class="row display-none" id="row-user-street">
                    <div class="col-xs-12 col-lg-4">
                      <label class="nhan">Đường: </label>
                    </div>
                    <div class="col-xs-12 col-lg-4">
                      <input class="add_street" id="user-add-street" name="add_street" type="text" required="">
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
                        <button type="reset" class="btn btn-default" onclick="reload_add_sect()">Huỷ</button>
                      </div>
                    </div>
                    <div class="col-xs-5 col-md-2 col-lg-1">
                      <div class="form-group">
                        <button class="btn btn-danger update-add" type="button">Cập nhật</button>
                      </div>
                    </div>
                    <div class="col-xs-1 col-md-3 col-lg-5">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div id="his" class="tab-pane fade">
            <div class="wrapper-his">
              <div class="wrapper-his-content">
                <div class="row">
                <div class="col-xs-10">
                  <table border="1px"; width=100%>

                  <tr style="border:1px solid black; background-color: #B6AFAE">
                      <th style="text-align:center">Đơn hàng</th>
                      <th style="text-align:center">Thời gian</th>
                      <th style="text-align:center">Địa chỉ</th>
                      <th style="text-align:center">Tổng</th>
                      </tr>

                  <?php
                  $data = receipts($conn, $current_user->getID());

                  foreach($data as $item) {?>

                  <tr>
                       <td align='center'><a href="#" onclick="show_receipt(<?php echo $item['Ma']; ?>)">#PO<?php echo $item['Ma']; ?></a></td>
                       <td align='center'><?php echo $item['ThoiGian'];?></td>
                       <td align='center'><?php echo $item['DiaChi'];?></td>
                       <td align='center'><?php echo number_format($item['GiaTri'],0).'₫';?></td>

                   </tr>

                  <?php  }
                ?>

                  </table>
                </div>
                </div>
              </div>
            </div>
            <div class="wrapper-receipt display-none">
            </div>

          </div>
          <div id="liked" class="tab-pane fade">
            <div class="liked-combos">
              <div class="liked-combos-content">
                <?
                if(isEmpty(liked_combos($conn, $current_user->getID())) && isEmpty(liked_items($conn, $current_user->getID()))){
                  $create_content = "";
                  $create_content .= '
                    <div class="row">
                  <div class="col-xs-4">
                  </div>
                  <div class="col-xs-4">
                  <img src="/images/thumb.png" class="img-responsive" alt="" />
                  </div>
                  <div class="col-xs-4">
                  </div>
                  </div>
                  <div class="row">
                <div class="hidden-xs col-lg-4">
                </div>
                <div class="col-xs-12 col-lg-4 text-center">
                <br><h4>Bạn chưa thích sản phẩm nào</h4><br>
                <a href="/thuc-don"><button type="button" class="btn btn-info center-block">Xem thực đơn</button></a><br>
                </div>
                <div class="hidden-xs col-lg-4">
                </div>
                </div>';

                  echo $create_content;
                }
                else
                {
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
                  $create_tab_content .= "</div></div>";
                }
                echo $create_tab_content;
              }
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
                  $create_tab_content .= "</div></div>";
                }

                echo $create_tab_content;
                ?>
              </div>
            </div>
          </div>
          <div id="epass" class="tab-pane fade">
            <div class="wrapper-change-pass">
              <div class="wrapper-change-pass-content">
                <form id='change-password' onsubmit="return false;">
                  <div class="row">
                    <div class="col-xs-12 col-lg-12">
                      <label class="error-label user-pass-error-label"></label>
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
                        <button class="btn btn-danger update-pass" type="submit">Cập nhật</button>
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
    </div>
  </div>
      <?
    }
    else{ ?>
      <script type="text/javascript">location.href = './dang-nhap';</script>
      <? } ?>
      <?php include_once("footer.php");?>

      <?php
      if(isset($_GET['sec']))
      {
        $selection = $_GET['sec'];
        if($conn != "NULL"){
          $section_id = "0";
          $choice =array("user","eadd","his","liked");
          $section_id = array_search($selection, $choice);

          echo "<script>$('.nav-pills-user li:eq($section_id) a').tab('show');</script>";
        }
      }
      ?>
