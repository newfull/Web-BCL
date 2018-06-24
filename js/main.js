function scroll_to_top(){
  $(function () {
    $.scrollUp({
          scrollName: 'scrollUp', // Element ID
          scrollDistance: 300, // Distance from top/bottom before showing element (px)
          scrollFrom: 'top', // 'top' or 'bottom'
          scrollSpeed: 300, // Speed back to top (ms)
          easingType: 'linear', // Scroll to top easing (see http://easings.net/)
          animation: 'fade', // Fade, slide, none
          animationSpeed: 200, // Animation in speed (ms)
          scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
          //scrollTarget: false, // Set a custom target element for scrolling to the top
          scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
          scrollTitle: false, // Set a custom <a> title if required.
          scrollImg: false, // Set true to use image
          activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
          zIndex: 2147483647 // Z-Index for the overlay
    });
  });
}

jQuery.fn.shake = function(intShakes, intDistance, intDuration) {
    this.each(function() {
        $(this).css("position","relative");
        for (var x=1; x<=intShakes; x++) {
        $(this).animate({left:(intDistance*-1)}, (((intDuration/intShakes)/4)))
    .animate({left:intDistance}, ((intDuration/intShakes)/2))
    .animate({left:0}, (((intDuration/intShakes)/4)));
    }
  });
return this;
};

var stickyNavTop = $('#navbar').offset().top;
var position = $(window).scrollTop();

function navbar_movealong(){
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();

    //navbar chạy theo scroll
    if (scroll > stickyNavTop) {
        $('#navbar').addClass('navbar-fixed-top');
        $('#navbar').addClass('isDown');
    } else {
        $('#navbar').css('margin-top','0px');
        $('#navbar').removeClass('navbar-fixed-top');
        $('#navbar').removeClass('isDown');
      }

    if(scroll < position && height > 1280) {
        $('#navbar').css('margin-top','0px');
        $('#navbar').addClass('isDown');
    } else {
        if($('#navbar').offset().top > 105)
          $('#navbar').css('margin-top','-25px');

        $('#navbar').removeClass('isDown');
      }
      position = scroll;
  });
}

function navbar_hover(){

  //hover cho navbar
  $('#navbar').mouseenter(function(){
    if((!$('#navbar').hasClass('isDown'))&&($(window).scrollTop() > stickyNavTop)){
      $('#navbar').animate({'margin-top':'0px'},"fast");
      $('#navbar').addClass('isDown');
    }
  });
  $('#navbar').mouseleave(function(){
    if(($('#navbar').hasClass('isDown'))&&($(window).scrollTop() > stickyNavTop)){
      $('#navbar').animate({'margin-top':'-25px'},"fast");
      $('#navbar').removeClass('isDown');
    }
  });
}

function check_input_value_email() {
    $('#login-user').blur(function() {
        if ($('#login-user').val() == '') {
            $('#login-user').addClass('empty');
        } else {
            $('#login-user').removeClass('empty');
        }
    })
    $('[name="email"],[name="password"],[type="text"]').blur(function() {
        if ($(this).val() == '') {
            $(this).addClass('empty');
        } else {
            $(this).removeClass('empty');
        }
    })
}

function check_input_value_password() {
    $('#login-pass').blur(function() {
        if ($('#login-pass').val() == '') {
            $('#login-pass').addClass('empty');
        } else {
            $('#login-pass').removeClass('empty');
        }
    })
}

function AllowNumbersOnly(e) {
    var code = (e.which) ? e.which : e.keyCode;
    if (code > 31 && (code < 48 || code > 57)) {
      e.preventDefault();
    }
}

$('input[type="tel"]').keydown(function(event){
  return AllowNumbersOnly(event);
});

function clear_modal(){
  $(".modal").on("hidden.bs.modal", function(){
        $(".modal-body input[type='text'], .modal-body input[type='password']").val("");
        $('#login-user').addClass('empty');
        $('#login-pass').addClass('empty');
  });
}

function load_days(){
  for(var i = 1; i <= 31; i++){
    $('.date_day').append('<option value="'+ i +'">'+ i +'</option>');
  }

  for(var i = 1; i <= 12; i++){
    $('.date_month').append('<option value="'+ i +'">'+ i +'</option>');
  }

  var min_age = 3;
  var cdt = new Date();
  var current_year = cdt.getFullYear();
  var min_year = current_year - 99;

  for(var i = current_year - min_age; i > min_year ; i--){
    $('.date_year').append('<option value="'+ i +'">'+ i +'</option>');
  }
};

function is_leap_year(year){
  if(year % 400 == 0) return true;
  if(year % 100 == 0) return false;
  if( year % 4 == 0)  return true;
  return false;
};


function date_change(){
  $('.date_month').change(function(){
    $('.date_day option[value="31"]').remove();
    $('.date_day option[value="30"]').remove();
    $('.date_day option[value="29"]').remove();
    $('.date_day').append('<option value="29">29</option>');
    $('.date_day').append('<option value="30">30</option>');
    $('.date_day').append('<option value="31">31</option>');

    var this_month = parseInt($(this).find(":selected").text());
      switch (this_month) {
        case 4: case 6: case 9: case 11:
          $('.date_day option[value="31"]').remove();
          break;

        case 2:
          $('.date_day option[value="31"]').remove();
          $('.date_day option[value="30"]').remove();
          if(is_leap_year($('.date_year').find(":selected").text()) == false)
            $('.date_day option[value="29"]').remove();
          break;
        }
    });

  $('.date_year').change(function(){
      $('.date_day option[value="31"]').remove();
      $('.date_day option[value="30"]').remove();
      $('.date_day option[value="29"]').remove();
      $('.date_day').append('<option value="29">29</option>');
      $('.date_day').append('<option value="30">30</option>');
      $('.date_day').append('<option value="31">31</option>');

      var this_month = parseInt($('.date_month').find(":selected").text());
      switch (this_month) {
        case 4: case 6: case 9: case 11:
          $('.date_day option[value="31"]').remove();
          break;

        case 2:
          $('.date_day option[value="31"]').remove();
          $('.date_day option[value="30"]').remove();
          if(is_leap_year($('.date_year').find(":selected").text()) == false)
            $('.date_day option[value="29"]').remove();
          break;
        }
    });
};

$('.carousel .vertical .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));

  for (var i=1;i<2;i++) {
    next=next.next();
    if (!next.length) {
    	next = $(this).siblings(':first');
  	}

    next.children(':first-child').clone().appendTo($(this));
  }
});

$('.item-card').on('click', function () {
  		if ($(this).hasClass('open')) {
  			$(this).removeClass('open');
  		} else {
  			$('.item-card').removeClass('open');
  			$(this).addClass('open');
  		}
  	});

$('.modal').on('shown.bs.modal', function(){
	$('body').css("overflow", "hidden");
});

$('.modal').on('hidden.bs.modal', function () {
  $('body').css("overflow", "scroll");
});

$('#popup-login').on('shown.bs.modal', function(){
    if ($(window).width() < 620)
    {
        location.href="/dang-nhap";
        return;
    }
});

$('#popup-reg').on('shown.bs.modal', function(){
    if ($(window).width() < 620)
    {
        location.href="/dang-ky";
        return;
    }
});

$('#popup-user').on('shown.bs.modal', function(){
  if ($(window).width() < 620)
  {
      location.href="/quan-ly";
      return;
  }
});

$(document).click(function(event){
    if(event.target.className != 'front-facing' && event.target.className != 'disp img-responsive'){
      $('.item-card').removeClass('open');
    }
});

$('#login').submit(function(e){
    e.preventDefault();
    var data= $("#login").serialize();
    $.ajax({
        url:'../includes/login.php',
        type:'post',
        data: data,
        success:function(response){
          $('#error-popup .modal-body').html(response);
          $('#error-popup').modal('show');
          if(response == "Đăng nhập thành công")
            setTimeout(function(){ window.location = "/"; },800);
          else {
            setTimeout(function(){  $('#error-popup').modal('hide');},5000);
          }
     }
    });
});

$('.fn-logout').on("click", function(){
  var r = confirm("Bạn thật sự muốn đăng xuất?");
  if (r == true) {
    $.ajax({
      url:'../includes/logout.php',
      type:'post',
      success:function(response){
        $('#error-popup .modal-body').html(response);
        $('#error-popup').modal('show');
        setTimeout(function(){ window.location = "/"; },800);
      }
    });
  }
});

function username_hover(){
  var timeoutId;
  $('.userbox .username').on("mouseenter", function(){ clearTimeout(timeoutId); $('#user-info').show(); });
  $('.userbox .username').on("mouseleave", function(){
    timeoutId = setTimeout(function() {
      $('#user-info').hide();
    }, 1000);
  });
  $('#user-info').on("mouseenter", function(){ clearTimeout(timeoutId); $(this).show(); });
  $('#user-info').on("mouseleave", function(){ $(this).fadeOut(1000); })
};

function cart_hover(){
  var timeoutId;
  $('.text-cart').on("mouseenter", function(){
    $('.cart-details').css("left", $(this).offset().left-100);
    if($(window).scrollTop() < 112){
      $('.cart-details').css("top", $('#navbar').offset().top-$(window).scrollTop()+40);
    }
    else
    $('.cart-details').css("top", $('#navbar').position().top+30);


    $('.cart-details').css("z-index", 99999);
    clearTimeout(timeoutId);
    $('.cart-details').show();
  });
  $('.text-cart').on("mouseleave", function(){
    timeoutId = setTimeout(function() {
      $('.cart-details').hide();
    }, 1000);
  });

  $('.cart-details').on("mouseenter", function(){ clearTimeout(timeoutId); $(this).show();});
  $('.cart-details').on("mouseleave", function(){ $(this).fadeOut(1000); });
};

$('.close-cart-box').on("click", function(){
  $('.cart-details').fadeOut(1000);
});

function change_quant(cart_detail, val){
  var id = "val"+cart_detail["Ma"];
  var curval = parseInt($('.spinner #' + id).val(), 10);
  if((curval > 1 && curval < 99) || (curval == 99 && val < 0) || (curval == 1 && val > 0)){
    $.ajax({
      cache: false,
      type: "POST",
      url:'./includes/functions.php',
      data: {
        funct: 'change_cart_details_quant',
        cart: cart_detail["Gio"],
        item: cart_detail["Ma"],
        val: val
      },
      success: function () {
        $(".cart-details").load("./header.php .cart-details");
        $(".wrapper-cart").load("./gio-hang.php .wrapper-cart");
      }
    });
  }else
    if(curval == 1 && val < 0)
    {
      var r = confirm("Bạn muốn xoá sản phẩm này khỏi giỏ hàng?");
      if (r == true) {
        $.ajax({
          cache: false,
          type: "POST",
          url:'./includes/functions.php',
          data: {
            funct: 'delete_cart_detail',
            cart: cart_detail["Gio"],
            item: cart_detail["Ma"]
          },
          success: function () {
            $("#cart_number").load("./header.php #cart_number");
            focus_cart_box();

            $(".cart-details .list-unstyled").load("./header.php .cart-details .list-unstyled");
            $(".wrapper-cart").load("./gio-hang.php .wrapper-cart");
          }
        });
      }
    }
}

function change_combo_quant(cart_details_combo, val){
  var id = "comboval"+cart_details_combo["Ma"];
  var curval = parseInt($('.spinner #' + id).val(), 10);
  console.log(curval);
  if((curval > 1 && curval < 99) || (curval == 99 && val < 0) || (curval == 1 && val > 0)){
    $.ajax({
      cache: false,
      type: "POST",
      url:'./includes/functions.php',
      data: {
        funct: 'change_cart_details_combo_quant',
        cart: cart_details_combo["Gio"],
        combo: cart_details_combo["Ma"],
        val: val
      },
      success: function () {
        $(".cart-details").load("./header.php .cart-details");
        $(".wrapper-cart").load("./gio-hang.php .wrapper-cart");
      }
    });
  }else
    if(curval == 1 && val < 0)
    {
      var r = confirm("Bạn muốn xoá sản phẩm này khỏi giỏ hàng?");
      if (r == true) {
        $.ajax({
          cache: false,
          type: "POST",
          url:'./includes/functions.php',
          data: {
            funct: 'delete_cart_detail_combo',
            cart: cart_details_combo["Gio"],
            combo: cart_details_combo["Ma"]
          },
          success: function () {
            $("#cart_number").load("./header.php #cart_number");
            focus_cart_box();

            $(".cart-details .list-unstyled").load("./header.php .cart-details .list-unstyled");
            $(".wrapper-cart").load("./gio-hang.php .wrapper-cart");
          }
        });
      }
    }
}

function delete_cart_detail(cart_detail){
  var id = "val"+cart_detail["Ma"];

  var r = confirm("Bạn muốn xoá sản phẩm " + cart_detail["Ten"] + " khỏi giỏ hàng?");
  if (r == true) {
    $.ajax({
      cache: false,
      type: "POST",
      url:'./includes/functions.php',
      data: {
        funct: 'delete_cart_detail',
        cart: cart_detail["Gio"],
        item: cart_detail["Ma"]
      },
      success: function () {
        $("#cart_number").load("./header.php #cart_number");
        focus_cart_box();


        $(".cart-details .list-unstyled").load("./header.php .cart-details .list-unstyled");
        $(".wrapper-cart").load("./gio-hang.php .wrapper-cart");
      }
    });
  }
}

function delete_cart_detail_combo(cart_detail_combo){
  var id = "comboval"+cart_detail_combo["Ma"];

  var r = confirm("Bạn muốn xoá sản phẩm " + cart_detail_combo["Ten"] + " khỏi giỏ hàng?");
  if (r == true) {
    $.ajax({
      cache: false,
      type: "POST",
      url:'./includes/functions.php',
      data: {
        funct: 'delete_cart_detail_combo',
        cart: cart_detail_combo["Gio"],
        combo: cart_detail_combo["Ma"]
      },
      success: function () {
        $("#cart_number").load("./header.php #cart_number");
        focus_cart_box();

        $(".cart-details .list-unstyled").load("./header.php .cart-details .list-unstyled");
        $(".wrapper-cart").load("./gio-hang.php .wrapper-cart");
      }
    });
  }
}

function likeitem(accid, itemid){
  $.ajax({
    cache: false,
    type: "POST",
    url:'./includes/functions.php',
    data: {
      funct: 'like_item',
      account: accid,
      item: itemid
    },
    success: function (response) {
      var btn = "";

      if(response == "0")
      btn = "./images/btn-liked.png";
      else
      btn = "./images/btn-like.png";

      $("#item"+itemid).attr("src", btn);
      $("#item"+itemid+"-2").attr("src", btn);

      $(".liked-items").load("./quan-ly.php .liked-items");
    }
  });
}

function likecombo(accid, comboid){
  $.ajax({
    cache: false,
    type: "POST",
    url:'./includes/functions.php',
    data: {
      funct: 'like_combo',
      account: accid,
      combo: comboid
    },
    success: function (response) {
      var btn = "";

      if(response == "0")
      btn = "./images/btn-liked.png";
      else
      btn = "./images/btn-like.png";

      $("#combo"+comboid).attr("src", btn);
      $("#combo"+comboid+"-2").attr("src", btn);

      $(".liked-combos").load("./quan-ly.php .liked-combos");
    }
  });
}

function addItemtoCart(cartid, itemid){
  $.ajax({
    cache: false,
    type: "POST",
    url:'./includes/functions.php',
    data: {
      funct: 'add_item_to_cart',
      cart: cartid,
      item: itemid
    },
    success: function () {
      $("#cart_number").load("./header.php #cart_number");
      focus_cart_box();

      $(".cart-details .list-unstyled").load("./header.php .cart-details .list-unstyled");
      $(".wrapper-cart").load("./gio-hang.php .wrapper-cart");
    }
  });
}

function addCombotoCart(cartid, comboid){
  $.ajax({
    cache: false,
    type: "POST",
    url:'./includes/functions.php',
    data: {
      funct: 'add_combo_to_cart',
      cart: cartid,
      combo: comboid
    },
    success: function () {
      $("#cart_number").load("./header.php #cart_number");
      focus_cart_box();

      $(".cart-details .list-unstyled").load("./header.php .cart-details .list-unstyled");
      $(".wrapper-cart").load("./gio-hang.php .wrapper-cart");
    }
  });
}

function focus_cart_box(){
  backupcolor = $("#cart_number").css("color");
  backupweight = $("#cart_number").css("font-weight");

  $("#cart_number, .text-cart, .fa-shopping-cart").css({"color": "red","font-weight": "bold"});

  setTimeout(function(){
    $("#cart_number, .text-cart, .fa-shopping-cart").css({"color": backupcolor,"font-weight": backupweight});
  },1000);
}

$(window).focus(function() {
  $("#cart_number").load("./header.php #cart_number");
  $(".cart-details .list-unstyled").load("./header.php .cart-details .list-unstyled");
  $(".wrapper-cart").load("./gio-hang.php .wrapper-cart");

  content = '.sect-content';
  id = $(content).parent().attr('id');
  switch(id){
    case 'user-sect':
      current_tab = $('.sect-content ul li.active a').attr('href');
      switch(current_tab){
        case '#liked':
          $(".liked-items").load("./quan-ly.php .liked-items-content");
          $(".liked-combos").load("./quan-ly.php .liked-combos-content");
          break;
        case '#his':
          $(".wrapper-his").load("./quan-ly.php .wrapper-his");
          break;
        case '#user':

          break;
        case '#eadd':

          break;
      }
      break;
    case 'info-sect':
       $(content).load("./gioi-thieu.php .sect-content");
       break;
     case 'blog-sect':
       $(content).load("./khuyen-mai.php .sect-content");
       break;
   }

});

$('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
  current_tab = $(this).attr('href');
  switch(current_tab){
    case '#liked':
      $(".liked-items").load("./quan-ly.php .liked-items-content");
      $(".liked-combos").load("./quan-ly.php .liked-combos-content");
      break;
    case '#his':
      $(".wrapper-his").load("./quan-ly.php .wrapper-his");
      break;
    case '#user':

      break;
    case '#eadd':

      break;
  }
});

$('a[data-toggle="pill"]').click(function() {
  current_tab = $(this).attr('href');
  switch(current_tab){
    case '#liked':
      $(".liked-items").load("./quan-ly.php .liked-items-content");
      $(".liked-combos").load("./quan-ly.php .liked-combos-content");
      break;
    case '#his':
      $(".wrapper-his").load("./quan-ly.php .wrapper-his");
      break;
    case '#user':

      break;
    case '#eadd':

      break;
    }
});

$(document).ready(function(e){
    SmoothScroll({ stepSize: 100 });
    scroll_to_top();
    navbar_movealong();
    navbar_hover();
    username_hover();
    cart_hover();
    clear_modal();
    load_days();
    date_change();
    check_input_value_email();
    check_input_value_password();

    $('.carousel-bcl').slick({
      prevArrow: '.glyphicon-chevron-left',
      nextArrow: '.glyphicon-chevron-right',
      accessibility: true,
      infinite: true,
      slidesToShow: 3,
      responsive: [{
        breakpoint: 935,
        settings: { slidesToShow: 2}
      }, {
        breakpoint: 769,
        settings: { slidesToShow: 1}
      }]
    });

    $('.carousel-tabs').slick({
      prevArrow: '.glyphicon-backward',
      nextArrow: '.glyphicon-forward',
      infinite: true,
      slidesToShow: 3,
      responsive: [{
        breakpoint: 935,
        settings: { slidesToShow: 2}
      }, {
        breakpoint: 769,
        settings: { slidesToShow: 1}
      }]
    });
});
