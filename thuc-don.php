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
                  <li role='presentation'><a href='#Section1' role='tab' data-toggle='tab'></i>Combo</a></li>;
                  <?php
                  $create_tab_content = "";
                  $tabs_num = count($tabs_name);
                  for($i = 2; $i < $tabs_num + 2; $i++){
                    $create_tab_content .= "<li role='presentation'";
                    $create_tab_content.= "><a href='#Section".$i."' role='tab' data-toggle='tab'></i>";
                    $create_tab_content .= $tabs_name[$i-2][1];
                    $create_tab_content .= "</a></li>";
                  }

                  echo $create_tab_content;
                  ?>
                  </ul>

                <!-- Tab panes -->
                <div class="tab-content tabs">
                  <div role='tabpanel' class='tab-pane fade in' id='Section1'>aeaeaeaae</div>
                  <?php
                  $create_tab_content = "";
                  for($i = 0; $i < $tabs_num; $i++){
                    $create_tab_content .= "<div role='tabpanel' class='tab-pane fade in' id='Section".($i+2)."'>";
                    $create_tab_content .= "<p>AEAEAEE</p>";
                    $create_tab_content .= "</div>";
                  }

                  echo $create_tab_content;
                  ?>
                </div>
            </div>
        </div>
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
