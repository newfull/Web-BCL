<head>
  <title>Thực đơn | Gà Rán BCL</title>
</head>
<?php include_once("header.php");?>
<?php $tabs_name = item_category_list($conn); ?>

<div class="container container-sect menu-sect col-xs-12 col-lg-12" id="menu-sect">
<div class="row sect-title">
  <div class="col-lg-2">
  </div>
  <div class="col-lg-10">
    <h2><i class="glyphicon glyphicon-cutlery"></i> THỰC ĐƠN</h2>
  </div>
</div>
<div class="thucdon-tabs sect-content">
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="tab" role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-item-cat" role="tablist">
                  <li role='presentation'><a href='#Section0' role='tab' data-toggle='tab'></i>Combo</a></li>
                  <?php
                  $create_tab_content = "";
                  $tabs_num = count($tabs_name);

                  for($i = 0; $i < $tabs_num; $i++){
                    $create_tab_content .= "<li role='presentation'";
                    $create_tab_content.= "><a href='#Section".$tabs_name[$i][0]."' role='tab' data-toggle='tab'></i>";
                    $create_tab_content .= $tabs_name[$i][1];
                    $create_tab_content .= "</a></li>";
                  }

                  echo $create_tab_content;
                  ?>
                  </ul>

                  <!-- Carousel -->
                  <div class="carousel-tabs">
                      <div class="item active">
                        <a href='#Section0' role='tab' data-toggle='tab'>Combo</a>
                      </div>
                   <?php
                    $create_tab_content = "";
                    $tabs_num = count($tabs_name);
                    for($i = 0; $i < $tabs_num; $i++){
                      $create_tab_content .= "<div class='item'>";
                      $create_tab_content.= "<a href='#Section".$tabs_name[$i][0]."' role='tab' data-toggle='tab'>";
                      $create_tab_content .= $tabs_name[$i][1];
                      $create_tab_content .= "</a></div>";
                    }

                    echo $create_tab_content;
                    ?>
                  </div>
                <!-- Tab panes -->
                <div class="tab-content tabs menu-content">
                    <?php
                     $create_tab_content = "<div role='tabpanel' class='tab-pane fade in' id='Section0'>";
                     $list = combo_list($conn);
                     if(isEmpty($list)) $num = 0;
                     else $num = count($list);
                     for($j = 0; $j < $num; $j++){
                       $create_tab_content .= "<div class='item-card inline-block'><div class='front-facing'>";
                       $create_tab_content .= "<img src='./images/items/".($list[$j]['DuongDan'])."' onerror='this.src=\"../images/not-found.png\"' class='disp img-responsive'>";
                       $create_tab_content .= "<p class='title'>".($list[$j]['Ten'])."</p><p class='price'>".number_format($list[$j]['Gia'], 0)." VNĐ"."</p>";
                       if(!empty($_SESSION['current'])){
                         $create_tab_content .= "<img onclick='likecombo(".$current_user->getID().",".($list[$j]['Ma']).")' src='./images/";
                         if(check_exists($current_user->getComboLiked(), $list[$j]['Ma']))
                           $create_tab_content .= "btn-liked.png";
                         else
                           $create_tab_content .= "btn-like.png";
                         $create_tab_content .= "' class='btn-like img-responsive' id='combo".($list[$j]['Ma'])."'>";
                         $create_tab_content .= "<img onclick='addCombotoCart(".$current_user->getCart().",".($list[$j]['Ma']).")' src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'>";
                       }
                       else
                        $create_tab_content .= "<a href='#popup-login' data-toggle='modal'><img src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'></a>";

                       $create_tab_content .= "</div>";
                       $create_tab_content .= "<div class='back-facing'>";
                       $create_tab_content .= "<p class='title'>".($list[$j]['Ten'])."</p><p class='price'>".number_format($list[$j]['Gia'], 0)." VNĐ"."</p>";
                       if(!empty($_SESSION['current'])){
                         $create_tab_content .= "<img onclick='likecombo(".$current_user->getID().",".($list[$j]['Ma']).")' src='./images/";
                         if(check_exists($current_user->getComboLiked(), $list[$j]['Ma']))
                           $create_tab_content .= "btn-liked.png";
                         else
                           $create_tab_content .= "btn-like.png";
                         $create_tab_content .= "' class='btn-like img-responsive' id='combo".($list[$j]['Ma'])."-2'>";
                         $create_tab_content .= "<img onclick='addCombotoCart(".$current_user->getCart().",".($list[$j]['Ma']).")' src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'>";
                       }
                       else
                        $create_tab_content .= "<a href='#popup-login' data-toggle='modal'><img src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'></a>";

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
                      $create_tab_content .= "</div>";
                     echo $create_tab_content;
                     ?>

                  <?php
                  $create_tab_content = "";
                  for($i = 0; $i < $tabs_num; $i++){
                    $create_tab_content .= "<div role='tabpanel' class='tab-pane fade in' id='Section".$tabs_name[$i][0]."'>";
                    $list = item_list($conn, $tabs_name[$i][0]);
                    if(isEmpty($list)) $num = 0;
                    else $num = count($list);

                    for($j = 0; $j < $num; $j++){
                      $create_tab_content .= "<div class='item-card inline-block'><div class='front-facing'>";
                      $create_tab_content .= "<img src='./images/items/".($list[$j]['DuongDan'])."' onerror='this.src=\"../images/not-found.png\"' class='disp img-responsive'>";
                      $create_tab_content .= "<p class='title'>".($list[$j]['Ten'])."</p><p class='price'>".number_format($list[$j]['Gia'], 0)." VNĐ"."</p>";
                      if(!empty($_SESSION['current'])){
                        $create_tab_content .= "<img onclick='likeitem(".$current_user->getID().",".($list[$j]['Ma']).")' src='./images/";
                        if(check_exists($current_user->getLiked(), $list[$j]['Ma']))
                          $create_tab_content .= "btn-liked.png";
                        else
                          $create_tab_content .= "btn-like.png";
                        $create_tab_content .= "' class='btn-like img-responsive' id='item".($list[$j]['Ma'])."'>";
                        $create_tab_content .= "<img onclick='addItemtoCart(".$current_user->getCart().",".($list[$j]['Ma']).")' src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'>";
                      }
                      else
                       $create_tab_content .= "<a href='#popup-login' data-toggle='modal'><img src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'></a>";

                      $create_tab_content .= "</div>";
                      $create_tab_content .= "<div class='back-facing'>";
                      $create_tab_content .= "<p class='title'>".($list[$j]['Ten'])."</p><p class='price'>".number_format($list[$j]['Gia'], 0)." VNĐ"."</p>";
                      if(!empty($_SESSION['current'])){
                        $create_tab_content .= "<img onclick='likeitem(".$current_user->getID().",".($list[$j]['Ma']).")' src='./images/";
                        if(check_exists($current_user->getLiked(), $list[$j]['Ma']))
                          $create_tab_content .= "btn-liked.png";
                        else
                          $create_tab_content .= "btn-like.png";
                        $create_tab_content .= "' class='btn-like img-responsive' id='item".($list[$j]['Ma'])."-2'>";
                        $create_tab_content .= "<img onclick='addItemtoCart(".$current_user->getCart().",".($list[$j]['Ma']).")' src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'>";
                      }
                      else
                       $create_tab_content .= "<a href='#popup-login' data-toggle='modal'><img src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'></a>";

                      $create_tab_content .= "<div class='details'><p>► ".($list[$j]['Ten'])."</p></div>";
                      $create_tab_content .= "</div></div>";
                    }

                    $create_tab_content .= "</div>";
                  }

                  echo $create_tab_content;
                  ?>
                </div>
            </div>
        </div>

        <!-- Carousel control-->
        <a class="control left inline-block">
          <span class="glyphicon glyphicon-backward"></span>
        </a>
        <a class="control right inline-block">
          <span class="glyphicon glyphicon-forward"></span>
        </a>
    </div>
</div>
</div>
</div>
<?php include_once("footer.php");?>

<?php
$selection = $_GET['select'];
if($conn != "NULL"){
  $section_id = "0";
  if($selection != "combo")
    $section_id = array_search($selection, array_column($tabs_name, 'ITEM_CATEGORYALIAS')) + 1;

  echo "<script>$('.nav-tabs-item-cat li:eq($section_id) a').tab('show');</script>";
}
?>
