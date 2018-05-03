<head>
  <title>Thực đơn | Gà Rán BCL</title>
</head>
<?php include_once("header.php");?>
<?php $tabs_name = item_category_list($conn); ?>

<div class="thucdon-tabs">
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="tab" role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
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
                  <div class="carousel slide carousel-tabs" id="thucdon-carousel" data-ride="carousel" data-interval="false">
                    <div class="carousel-inner" role="listbox">
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
                  </div>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                  <div role='tabpanel' class='tab-pane fade in' id='Section0'>
                    <?php
                     $create_tab_content = "";
                     $list = combo_list($conn);
                     if(isEmpty($list)) $num = 0;
                     else $num = count($list);
                     for($j = 0; $j < $num; $j++){
                       $create_tab_content .= "<div class='item-card inline-block'><div class='front-facing'>";
                       $create_tab_content .= "<img src='./images/items/".($list[$j]['COMBOIMGURL'])."' onerror='this.src=\"../images/not-found.png\"' class='disp img-responsive'>";
                       $create_tab_content .= "<p class='title'>".($list[$j]['COMBONAME'])."</p><p class='price'>".number_format($list[$j]['COMBOPRICE'], 0)." VNĐ"."</p>";
                       $create_tab_content .= "<img onclick='likeitem(".($list[$j]['COMBOID']).")' src='./images/btn-like.png' class='btn-like img-responsive'>";
                       $create_tab_content .= "<img onclick='addtoCart(".($list[$j]['COMBOID']).")' src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'>";
                       $create_tab_content .= "</div>";
                       $create_tab_content .= "<div class='back-facing'>";
                       $create_tab_content .= "<p class='title'>".($list[$j]['COMBONAME'])."</p><p class='price'>".number_format($list[$j]['COMBOPRICE'], 0)." VNĐ"."</p>";
                       $create_tab_content .= "<img onclick='likeitem(".($list[$j]['COMBOID']).")' src='./images/btn-like.png' class='btn-like img-responsive'>";
                       $create_tab_content .= "<img onclick='addtoCart(".($list[$j]['COMBOID']).")' src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'>";

                       $details = combo_details($conn, $list[$j][0]);
                       if(isEmpty($details)) $lines = 0;
                       else $lines = count($details);

                      $create_tab_content .= "<div class='details'>";
                       for($k = 0; $k < $lines; $k++){
                       $create_tab_content .= "<p>► ".($details[$k]['QUANTITY'])." ".($details[$k]['UNIT_NAME'])." ".($details[$k]['ITEMNAME'])."</p>";
                        }

                     $create_tab_content .= "</div>";
                     $create_tab_content .= "</div></div>";
}
                     echo $create_tab_content;
                     ?>
                </div>

                  <?php
                  $create_tab_content = "";
                  for($i = 0; $i < $tabs_num; $i++){
                    $create_tab_content .= "<div role='tabpanel' class='tab-pane fade in' id='Section".$tabs_name[$i][0]."'>";
                    $list = item_list($conn, $tabs_name[$i][0]);
                    if(isEmpty($list)) $num = 0;
                    else $num = count($list);

                    for($j = 0; $j < $num; $j++){
                      $create_tab_content .= "<div class='item-card inline-block'><div class='front-facing'>";
                      $create_tab_content .= "<img src='./images/items/".($list[$j]['ITEMIMGURL'])."' onerror='this.src=\"../images/not-found.png\"' class='disp img-responsive'>";
                      $create_tab_content .= "<p class='title'>".($list[$j]['ITEMNAME'])."</p><p class='price'>".number_format($list[$j]['ITEMPRICE'], 0)." VNĐ"."</p>";
                      $create_tab_content .= "<img onclick='likeitem(".($list[$j]['ITEMID']).")' src='./images/btn-like.png' class='btn-like img-responsive'>";
                      $create_tab_content .= "<img onclick='addtoCart(".($list[$j]['ITEMID']).")' src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'>";
                      $create_tab_content .= "</div>";
                      $create_tab_content .= "<div class='back-facing'>";
                      $create_tab_content .= "<p class='title'>".($list[$j]['ITEMNAME'])."</p><p class='price'>".number_format($list[$j]['ITEMPRICE'], 0)." VNĐ"."</p>";
                      $create_tab_content .= "<img onclick='likeitem(".($list[$j]['ITEMID']).")' src='./images/btn-like.png' class='btn-like img-responsive'>";
                      $create_tab_content .= "<img onclick='addtoCart(".($list[$j]['ITEMID']).")' src='./images/add-to-cart-48.png' class='btn-add-cart img-responsive'>";
                      $create_tab_content .= "<div class='details'><p>► ".($list[$j]['ITEMNAME'])."</p></div>";
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
        <a class="control left inline-block" href="#thucdon-carousel" data-slide="prev">≪</a>
        <a class="control right inline-block" href="#thucdon-carousel" data-slide="next">≫</a>
    </div>
</div>
</div>

<?php include_once("footer.php");?>

<?php
$selection = $_GET['select'];
$section_id = "0";
if($selection != "combo")
  $section_id = array_search($selection, array_column($tabs_name, 'ITEM_CATEGORYALIAS')) + 1;

echo "<script>$('.nav-tabs li:eq($section_id) a').tab('show');</script>";
?>
