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

function checkPhoneNumber() {
    var flag = false;
    var phone = $('#input').val().trim(); // ID của trường Số điện thoại
    phone = phone.replace('(+84)', '0');
    phone = phone.replace('+84', '0');
    phone = phone.replace('0084', '0');
    phone = phone.replace(/ /g, '');
    if (phone != '') {
        var firstNumber = phone.substring(0, 2);
        if ((firstNumber == '09' || firstNumber == '08') && phone.length == 10) {
            if (phone.match(/^\d{10}/)) {
                flag = true;
            }
        } else if (firstNumber == '01' && phone.length == 11) {
            if (phone.match(/^\d{11}/)) {
                flag = true;
            }
        }
    }
    return flag;
};

function checkEmail() {
    var email = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email.value)) {
             alert('Hay nhap dia chi email hop le.\nExample@gmail.com');
             email.focus;
             return false;
    }
    else{
             alert('OK roi day, Email nay hop le.');
    }
}

function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    } else {
        return true;
    }
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
        location.href="/quan-ly";
        return;
    }
});

$('#popup-reg').on('shown.bs.modal', function(){
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
  $.ajax({
      url:'../includes/logout.php',
      type:'post',
      success:function(response){
        $('#error-popup .modal-body').html(response);
        $('#error-popup').modal('show');
        setTimeout(function(){ window.location = "/"; },800);
   }
  });
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
      complete: function (response) {
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
            $(".cart-details").load("./header.php .cart-details");
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
        $(".cart-details").load("./header.php .cart-details");
        $(".wrapper-cart").load("./gio-hang.php .wrapper-cart");
      }
    });
  }
}

$(document).ready(function(e){
    SmoothScroll({ stepSize: 100 });
    scroll_to_top();
    navbar_movealong();
    navbar_hover();
    username_hover();
    cart_hover();
    check_input_value_email();
    check_input_value_password();
    clear_modal();
    load_days();
    date_change();
    $('[id="phonenumber"]').keypress(validateNumber);


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
