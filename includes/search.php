<?php
  require_once 'config.php';
  require_once 'functions.php';
  require_once 'userinfo.php';

  $keyword = trim($_GET['keyword']);
  $current_user = new bclUser($conn);
  if(!empty($_SESSION['current'])){
    $current_user->init_info($_SESSION['current']);
  }

  try
  {
    $create_tab_content = "";
    $list = search_menu_combo($conn, $keyword);
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

    $list = search_menu_item($conn, $keyword);
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

    echo $create_tab_content;
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }

?>
