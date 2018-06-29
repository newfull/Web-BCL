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

function clear_log(){
  console.API;

  if (typeof console._commandLineAPI !== 'undefined') {
      console.API = console._commandLineAPI; //chrome
  } else if (typeof console._inspectorCommandLineAPI !== 'undefined') {
      console.API = console._inspectorCommandLineAPI; //Safari
  } else if (typeof console.clear !== 'undefined') {
      console.API = console;
  }

  console.API.clear();
}

//var timerID = setInterval(function() { clear_log(); }, 1 * 1000);

function toggleSidenav() {
  document.body.classList.toggle('sidenav-active');
  document.body.classList.toggle('noscroll');
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
    var height = $(document).height();
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
    $('.cart-details').css("left", $(this).offset().left-150);
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
  $('.cart-details').hide();
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
        reload_cart();
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
            reload_cart();
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
        reload_cart();
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
            reload_cart();
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
        reload_cart();
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
        reload_cart();
      }
    });
  }
}

function delete_all_cart_detail(cartid){
  var r = confirm("Bạn muốn xoá toàn bộ sản phẩm khỏi giỏ hàng?");
  if (r == true) {
    $.ajax({
      cache: false,
      type: "POST",
      url:'./includes/functions.php',
      data: {
        funct: 'delete_all_cart_detail',
        cart: cartid
      },
      success: function () {
        reload_cart();
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
      reload_cart();
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
      reload_cart();
    }
  });
}

function reload_cart(){
  $("#cart_number").load("./header.php #cart_number");
  $("#cart_number, .text-cart, .fa-shopping-cart").css({"font-weight": "bold"});

  setTimeout(function(){
    $("#cart_number, .text-cart, .fa-shopping-cart").css({"font-weight": 500});
  },1000);

  $(".cart-details .list-unstyled").load("./header.php .cart-details .list-unstyled");
  $(".wrapper-cart").load("./gio-hang.php .wrapper-cart-content");
}

$(window).focus(function() {
  $("#cart_number").load("./header.php #cart_number");
  $(".cart-details .list-unstyled").load("./header.php .cart-details .list-unstyled");
  $(".wrapper-cart").load("./gio-hang.php .wrapper-cart-content");

  content = '.sect-content';
  id = $(content).parent().attr('id');
  switch(id){
    case 'user-sect':
      reload_info();
      break;
    case 'info-sect':
       $(content).load("./gioi-thieu.php .sect-content");
       break;
     case 'blog-sect':
       $(content).load("./khuyen-mai.php .sect-content");
       break;
   }

});

function reload_info(){
  $(".info1").load("./quan-ly.php .info1-content");
  $(".info2").load("./quan-ly.php .info2-content");
  $(".liked-items").load("./quan-ly.php .liked-items-content");
  $(".liked-combos").load("./quan-ly.php .liked-combos-content");
  $(".current-address").load("./quan-ly.php .cur-add");
  $("#user-add-city").selectpicker("val", "");
  $("#row-user-ward").addClass('display-none');
  $("#row-user-dist").addClass('display-none');
  $("#row-user-street").addClass('display-none');
  $(".wrapper-his").load("./quan-ly.php .wrapper-his-content");

  load_dob(get_dob());
}

$("a[data-toggle='pill']").click(function(){
  reload_info();
});

$("a[data-toggle='pill']").on("shown.bs.tabs", function(){
  reload_info();
});

function get_dob(){
  var res = "";
  jQuery.ajaxSetup({async:false});
  $.ajax({
    cache: false,
    async: false,
    type: "GET",
    url:'./includes/functions.php',
    dateType: "text",
    data: {
      request: 'DOB'
    },
    success: function (response) {
       res = response;
    }
  });
  jQuery.ajaxSetup({async:true});

  return res;
}

function select_option(el, val){
  el = el.replace("#","");
  var sel = document.getElementById(el);
  if(sel != null){
    var opts = sel.options;
    var opt;
    for(j = 0; opt = opts[j]; j++) {
        if(opt.text == val) {
            sel.selectedIndex = j;
            break;
        }
    }
  }
}

function load_dob(dob){
    dob = new Date(dob); // for mySQL date
  //dob = new Date(dob*1000); //for php date
    select_option('#user-dob-day', dob.getDate());
    select_option('#user-dob-month', dob.getMonth()+1);
    select_option('#user-dob-year', dob.getFullYear());
}

function sortByKey(array, key) {
  return array.sort(function(a, b) {
    var x = a[key]; var y = b[key];
    return ((x < y) ? -1 : ((x > y) ? 1 : 0));
});
}

function load_address(){
  var x = "";
  $.getJSON("../js/geodata/tinh_tp.json", function(json) {
    var json = Object.keys(json).map(e => ({id: e, name_with_type: json[e].name_with_type}))
        .sort((a, b) => (a.name_with_type > b.name_with_type)? 1 : -1);
    for (i in json) {
      x = "";
      x = "<option value='" + json[i].id + "'>"+ json[i].name_with_type +"</option>";
      $("#user-add-city").append(x).selectpicker('refresh');
    }
  });
}

function show_dists(){
  $("#row-user-ward").addClass('display-none');

  $("#user-add-ward").find('option').remove();
  $("#user-add-ward").selectpicker('refresh');

  $("#row-user-dist").removeClass('display-none');

  $("#user-add-dist").find('option').remove();
  $("#user-add-dist").selectpicker('refresh');

  var x = "";
  var code = $("#user-add-city").val();
  var url = "../js/geodata/quan-huyen/" + code + ".json";
  $.getJSON(url, function(json) {
    var json = Object.keys(json).map(e => ({id: e, name_with_type: json[e].name_with_type}))
        .sort((a, b) => (a.name_with_type > b.name_with_type)? 1 : -1);
    for (i in json) {
      x = "";
      x = "<option value='" +  json[i].id + "'>"+ json[i].name_with_type +"</option>";
      $("#user-add-dist").append(x).selectpicker('refresh');
    }
  });
}

$("#user-add-city").change(function(){
  show_dists();
});

function show_wards(){
  $("#row-user-ward").removeClass('display-none');

  $("#user-add-ward").find('option').remove();
  $("#user-add-ward").selectpicker('refresh');

  var x = "";
  var code = $("#user-add-dist").val();
  var url = "../js/geodata/xa-phuong/" + code + ".json";
  $.getJSON(url, function(json) {
    var json = Object.keys(json).map(e => ({id: e, name_with_type: json[e].name_with_type, path_with_type: json[e].path_with_type}))
        .sort((a, b) => (a.name_with_type > b.name_with_type)? 1 : -1);
    for (i in json) {
        x = "";
        x = "<option value='" + json[i].path_with_type + "'>"+ json[i].name_with_type +"</option>";
        $("#user-add-ward").append(x).selectpicker('refresh');
    }
  });
}

$("#user-add-dist").change(function(){
  show_wards();
});

$("#user-add-ward").change(function(){
  $("#row-user-street").removeClass('display-none');
});

function get_add(){
  var res = "";
  jQuery.ajaxSetup({async:false});
  $.ajax({
    cache: false,
    async: false,
    type: "GET",
    url:'./includes/functions.php',
    dateType: "text",
    data: {
      request: 'add'
    },
    success: function (response) {
       res = response;
    }
  });
  jQuery.ajaxSetup({async:true});

  return JSON.parse(res);
}

$("a[href='#eadd']").click(function(){
  $("#user-add-city").selectpicker("val", "");
  $("#row-user-ward").addClass('display-none');
  $("#row-user-dist").addClass('display-none');
  $("#row-user-street").addClass('display-none');
});

function checkPhoneNumber(phone) {
    phone = phone.replace('(+84)', '0');
    phone = phone.replace('+84', '0');
    phone = phone.replace('0084', '0');
    phone = phone.replace(/ /g, '');
    if (phone != '') {
        var firstNumber = phone.substring(0, 2);
        if ((firstNumber == '09' || firstNumber == '08') && phone.length == 10) {
            if (phone.match(/^\d{10}/)) {
                return true;
            }
        } else if (firstNumber == '01' && phone.length == 11) {
            if (phone.match(/^\d{11}/)) {
                return true;
            }
        }
    }

    return false;
};

function checkEmail(email) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email.value)) {
      return false;
    }
    else{
      return true;
    }
}

$(".update-info").click(function(){
  var name = $('#user-name').val();
  var username = $('#user-username').val();
  var email = $('#user-email').val();
  var dob_d = $('#user-dob-day').val();
  var dob_m = $('#user-dob-month').val();
  var dob_y = $('#user-dob-year').val();

  var male = "";
  if($('#user-gender-nam').is(":checked"))
    male = 1;
  else male = 0;

  var phone = $('#user-phonenumber').val();

  var error = $('.user-error-label');
  if(name == "")
    error.html('Không được để trống họ tên');
  else
    if(checkEmail(email))
      error.html('Email không hợp lệ!');
    else
      if(checkPhoneNumber(phone))
        error.html('Số điện thoại không hợp lệ');
});

$(document).ready(function(e){
    $('.selectpicker').selectpicker();

    SmoothScroll({ stepSize: 100 });
    scroll_to_top();
    navbar_movealong();
    navbar_hover();
    username_hover();
    cart_hover();
    clear_modal();
    date_change();
    check_input_value_email();
    check_input_value_password();

    load_days();
    load_dob(get_dob());

    load_address();

    $('.carousel-bcl').slick({
           prevArrow: '.carousel-bcl-control-left',
           nextArrow: '.carousel-bcl-control-right',
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
       prevArrow: '.menu-tabs-control-left',
       nextArrow: '.menu-tabs-control-right',
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
