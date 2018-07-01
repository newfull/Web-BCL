<head>
<title>Tin tức khuyến mãi | Gà Rán BCL</title>
</head>
<?php include_once("header.php");?>

<div class="container container-sect blog-sect col-xs-12 col-lg-12" id="blog-sect">
  <div class="row sect-title" id="blog-header">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-10">
      <h2><i class="glyphicon glyphicon-star"></i> TIN TỨC</h2>
    </div>
  </div>

  <div class="row sect-content">
    <div class="sect-content-wrapper">
      <div id="show_blog_content" class="show-blog-content display-none">
        <hr>
        <div class="row">
          <div class="col-xs-1">
          </div>
        <div class="col-xs-10 text-centered">
        <div id="blog_title">
          <h3></h3>
        </div>
      </div>
      <div class="col-xs-1">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-1">
      </div>
      <div class="col-xs-10 text-centered">
        <div id="blog_content">
        </div>
      </div>
        <div class="col-xs-1">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-xs-1 col-lg-3">
      </div>
      <div class="col-xs-10 col-lg-6 text-centered">
        <div id="blog_img">
          <img class="img-responsive" onerror="this.src='../images/not-found.png'">
        </div>
      </div>
      <div class="col-xs-1 col-lg-3">
      </div>
    </div>
    <hr>
    </div>

      <div class="row blog-row">
<?php $list = blog_list($conn);
$length = count($list);

  $create_content = "";
  for($i = 0; $i < $length; $i++){
    $create_content .= '
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 blog-item">
    <a href="#">
      <img src="../images/blog/thumbnail/'.$list[$i]['DuongDan'].'" onerror="this.src=\'../images/not-found.png\'" class="blog-img img-responsive" onclick="show_blog('.$list[$i]['Ma'].');">
      </a>
      <div class="blog-wrapper bg-white">
        <div class="row">
          <div class="col-xs-12 blog-content">
          <h3>'.$list[$i]['Ten'].'</h3>
          '.$list[$i]['NoiDung'].'<br>

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
     <a href="#"><i class="glyphicon glyphicon-circle-arrow-right show-content" title="Xem thêm nội dung" onclick="show_blog('.$list[$i]['Ma'].');"></i></a>
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
