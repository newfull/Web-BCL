<head>
<title>Tin tức khuyến mãi | Gà Rán BCL</title>
</head>
<?php include_once("header.php");?>

<div class="container container-sect blog-sect col-xs-12 col-lg-12" id="blog-sect">
  <div class="row sect-title">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-10">
      <h2><i class="glyphicon glyphicon-star"></i> TIN TỨC</h2>
    </div>
  </div>

  <div class="row sect-content">
    <div class="sect-content-wrapper">
      <div class="row blog-row">
<?php $list = blog_list($conn);
$length = count($list);

  $create_content = "";
  for($i = 0; $i < $length; $i++){
    $create_content .= '
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 blog-item">
    <a href="javascript::;">
      <img src="../images/blog/thumbnail/'.$list[$i]['DuongDan'].'" onerror="this.src=\'../images/not-found.png\'" class="blog-img img-responsive">
      </a>
      <div class="blog-wrapper bg-white">
        <div class="row">
          <div class="col-xs-12 blog-content">
          <h3>'.$list[$i]['Ten'].'</h3>
          '.substr($list[$i]['NoiDung'], 0, 200).'<br>

    </div>
    <div class="col-xs-12">
              <hr>
              </div>
        <div class="col-xs-7">
      <p><span>Chia sẻ:
      <a href="javascript::;"><i class="fa fa-facebook share-btn" aria-hidden="true"></i></a>
      <a href="javascript::;"><i class="fa fa-twitter share-btn" aria-hidden="true"></i></a>
      <a href="javascript::;"><i class="fa fa-google-plus share-btn" aria-hidden="true"></i></a>
       </span></p>
     </div>

     <div class="col-xs-4">
       <span><i class="glyphicon glyphicon-time"></i> '.date("d-m-Y", strtotime($list[$i]['Ngay'])).'</span>
     </div>

     <div class="col-xs-1">
     <a href=""><i class="glyphicon glyphicon-eye-open" title="Xem thêm nội dung"></i></a>
   </div>
   </div>
      </div>
      </div>';
  }

  echo $create_content;
    ?>
</div>
</div>
  </div>
</div>

<?php include_once("footer.php");?>
