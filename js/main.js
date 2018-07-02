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
    if (scroll > stickyNavTop && height > 1280) {
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
        if ($(this).val() == '') {
            $(this).addClass('empty');
        } else {
            $(this).removeClass('empty');
        }
    })

    $('#login-page-pass').blur(function() {
        if ($(this).val() == '') {
            $(this).addClass('empty');
        } else {
            $(this).removeClass('empty');
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
        $(".reg-error-label").html("");
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

$('#login-page-form').submit(function(e){
    e.preventDefault();
    var data= $("#login-page-form").serialize();
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

$('#register').submit(function(e){
    e.preventDefault();
    var error = $('.reg-error-label');
    error.html("");

    if($("#name").val() == "")
      error.html("Không được để trống họ tên");
      else if($("#regusername").val() == "")
        error.html("Không được để trống tên đăng nhập");
        else
        if($("#regpassword").val().length < 8)
          error.html("Mật khẩu phải nhiều hơn 8 ký tự");
          else
          if($("#regpassword").val() != $("#reenterpassword").val())
            error.html("Nhập lại mật khẩu chưa chính xác!");
          else
            if(checkEmail($("#email").val()) == false)
              error.html("Email không hợp lệ");
            else if(checkPhoneNumber($("#phonenumber").val()) == false)
              error.html("Số điện thoại không hợp lệ");
              else
              if($("#chkbox-agreement").is(":checked") == false)
                error.html("Bạn phải đồng ý với điều khoản của BCL trước khi đăng ký");
              else
              {
                error.html("");
                var data= $("#register").serialize();

                var noti = "";
                if($('#chkbox-email').is(":checked"))
                  noti = 1;
                else noti = 0;

                data += "&noti=" + noti;

    $.ajax({
        url:'../includes/register.php',
        type:'post',
        data: data,
        success:function(response){
          $('#error-popup .modal-body').html(response);
          $('#error-popup').modal('show');
          if(response == "Đăng ký thành công")
            setTimeout(function(){ window.location = "/dang-nhap"; },1500);
          else {
            setTimeout(function(){  $('#error-popup').modal('hide');},1500);
          }
     }
    });
  }
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
   }

});

function reload_user_sect(){
  $(".info1").load("./quan-ly.php .info1-content");
  $(".info2").load("./quan-ly.php .info2-content");
  load_dob(get_dob());
}

function reload_likes_sect(){
  $(".liked-items").load("./quan-ly.php .liked-items-content");
  $(".liked-combos").load("./quan-ly.php .liked-combos-content");
}

function reload_add_sect(){
  $(".current-address").load("./quan-ly.php .cur-add");
  $(".user-add-error-label").html("");
  $("#user-add-city").selectpicker("val", "");
  $("#row-user-ward").addClass('display-none');
  $("#row-user-dist").addClass('display-none');
  $("#row-user-street").addClass('display-none');
}

function reload_his_sect(){
  $(".wrapper-his").load("./quan-ly.php .wrapper-his-content");
}

function reload_epass_sect(){
  $(".user-pass-error-label").html("");
  $("#change-password input[type='password']").val("");
}

function reload_info(){
  reload_user_sect();
  reload_likes_sect();
  reload_add_sect();
  reload_his_sect();
  reload_epass_sect();
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
  $('#user-add-street').val("");
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
    var flag = false;
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

function checkEmail(email) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email)) {
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

  var noti = "";
  if($('#user-chkbox-not').is(":checked"))
    noti = 1;
  else noti = 0;

  if(name == "")
    error.html('Không được để trống họ tên');
  else
    if(checkEmail(email) == false)
      error.html('Email không hợp lệ!');
    else
      if(checkPhoneNumber(phone) == false)
        error.html('Số điện thoại không hợp lệ');
      else
        {
          $.ajax({
            cache: false,
            type: "POST",
            url:'./includes/functions.php',
            data: {
              funct: 'change_user_info',
              name: name,
              email: email,
              phone: phone,
              sex: male,
              day: dob_d,
              month: dob_m,
              year: dob_y,
              noti: noti
            },
            success: function () {
              error.html('Thay đổi thông tin thành công');
            }
          });
        }
});

$(".update-add").click(function(){
  var error = $('.user-add-error-label');
  if($('#user-add-city').val() == "")
    error.html('Xin hãy chọn một tỉnh, thành phố');
  else
    if($('#user-add-dist').val() == "")
      error.html('Xin hãy chọn một quận, huyện');
    else
      if($('#user-add-ward').val() == "")
        error.html('Xin hãy chọn một xã, phường');
      else
        if($('#user-add-street').val() == "")
          error.html("Xin hãy điền đầy đủ địa chỉ");
        else
        {
          error.html("");
          var add = $('#user-add-street').val() + ", " + $('#user-add-ward').val();

          $.ajax({
            cache: false,
            type: "POST",
            url:'./includes/functions.php',
            data: {
              funct: 'change_add',
              address: add
            },
            success: function () {
              error.html('Thay đổi địa chỉ thành công');
              reload_add_sect();
            }
          });
        }
});

$(".update-pass").click(function(){
  var error = $('.user-pass-error-label');
  if($('#old-password').val() == "")
    error.html('Xin hãy nhập vào mật khẩu cũ');
  else
    if($('#new-password').val() == "")
      error.html('Xin hãy nhập mật khẩu mới');
    else
      if($('#new-password-valid').val() == "")
        error.html('Xin hãy xác nhận lại mật khẩu mới');
      else
        if($('#new-password').val() != $('#new-password-valid').val())
          error.html("Bạn đã nhập sai mật khẩu mới!");
        else
          if($('#new-password').val().length < 8)
            error.html("Mật khẩu không được ít hơn 8 kí tự!");
          else
            if($('#new-password').val() == $('#old-password').val())
              error.html("Mật khẩu mới không được giống mật khẩu cũ");
            else
            {
              var pass_ok = "0";
              jQuery.ajaxSetup({async:false});
              $.ajax({
                cache: false,
                async: false,
                type: "POST",
                url: './includes/functions.php',
                data: {
                  funct: 'check_pass',
                  pass: $('#old-password').val()
                },
                success: function(response){
                  pass_ok = response;
                }
              });

                if(pass_ok == "0")
                  error.html("Mật khẩu cũ không đúng!");
                else{
                  jQuery.ajaxSetup({async:false});
                  $.ajax({
                    cache: false,
                    async: false,
                    type: "POST",
                    url: './includes/functions.php',
                    data: {
                      funct: 'change_pass',
                      newpass: $('#new-password').val()
                    },
                    success: function(){
                      $.ajax({
                        url:'../includes/logout.php',
                        type:'post',
                        success:function(response){
                          $('#error-popup .modal-body').html("Đổi mật khẩu thành công.<br>Vui lòng đăng nhập lại");
                          $('#error-popup').modal('show');
                          setTimeout(function(){ window.location = "/dang-nhap"; },800);
                        }
                      });
                    }
                  });
                }
             }
});

$("#search_menu").on("change paste keyup blur", function(){
  if($("#search_menu").val() == ""){
    $("#show_menu").removeClass('display-none');
    $("#search_result").addClass('display-none');
    if ($(window).width() < 1200)
      $(".thucdon-tabs .control").css("display", "inline-block");

  }
  else
  {
    $("#show_menu").addClass('display-none');
    $(".thucdon-tabs .control").css("display", "none");
    $("#search_result").removeClass('display-none');
    $("#search_result #search_txt").html($("#search_menu").val());
    $.ajax({
      cache: false,
      async: false,
      type: "GET",
      url: './includes/search.php',
      data: {
        keyword: $("#search_menu").val()
      },
      success: function(response){
        $("#search_result .search_result_content").html(response);
      }
    });
  }
});

// window.fbAsyncInit = function() {
//     // FB JavaScript SDK configuration and setup
//     FB.init({
//       appId      : '615265362186705', // FB App ID
//       cookie     : true,  // enable cookies to allow the server to access the session
//       xfbml      : true,  // parse social plugins on this page
//       version    : 'v3.0' // use graph api version 2.8
//     });
//
//     // Check whether the user already logged in
//     FB.getLoginStatus(function(response) {
//         if (response.status === 'connected') {
//             //display user data
//             getFbUserData();
//         }
//     });
// };
//
// // Load the JavaScript SDK asynchronously
// (function(d, s, id) {
//     var js, fjs = d.getElementsByTagName(s)[0];
//     if (d.getElementById(id)) return;
//     js = d.createElement(s); js.id = id;
//     js.src = "//connect.facebook.net/en_US/sdk.js";
//     fjs.parentNode.insertBefore(js, fjs);
// }(document, 'script', 'facebook-jssdk'));
//
// // Facebook login with JavaScript SDK
// function loginFB() {
//     FB.login(function (response) {
//         if (response.authResponse) {
//             console.log(response);
//         } else {
//           $('#error-popup .modal-body').html("Người dùng huỷ đăng nhập hoặc chưa cấp quyền đủ.");
//           $('#error-popup').modal('show');
//         }
//     }, {scope: 'email'});
// }
//
// // Fetch the user profile data from facebook
// function getFbUserData(){
//     FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
//     function (response) {
//     //     document.getElementById('fbLink').setAttribute("onclick","fbLogout()");
//     //     document.getElementById('fbLink').innerHTML = 'Logout from Facebook';
//     //     document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.first_name + '!';
//     //     document.getElementById('userData').innerHTML = '<p><b>FB ID:</b> '+response.id+'</p><p><b>Name:</b> '+response.first_name+' '+response.last_name+'</p><p><b>Email:</b> '+response.email+'</p><p><b>Gender:</b> '+response.gender+'</p><p><b>Locale:</b> '+response.locale+'</p><p><b>Picture:</b> <img src="'+response.picture.data.url+'"/></p><p><b>FB Profile:</b> <a target="_blank" href="'+response.link+'">click to view profile</a></p>';
//      });
// }
//
// // Logout from facebook
// function fbLogout() {
//     FB.logout(function() {
//         // document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
//         // document.getElementById('fbLink').innerHTML = '<img src="fblogin.png"/>';
//         // document.getElementById('userData').innerHTML = '';
//         // document.getElementById('status').innerHTML = 'You have successfully logout from Facebook.';
//     });
// }

function show_blog(blogid){
  $("#show_blog_content").removeClass('display-none');
  $.ajax({
    cache: false,
    async: false,
    type: "POST",
    dataType: "json",
    url: './includes/functions.php',
    data: {
      funct: 'get_blog_by_id',
      blog: blogid
    },
    success: function(response){
      console.log(response['Ten']);
      document.getElementById("blog-header").scrollIntoView();
      $("#blog_title > h3").html(response['Ten']);
      $("#blog_content").html(response['NoiDung']);
      var url = "../images/blog/content/" + response['DuongDan'];
      $("#blog_img img").attr("src", url);
    }
  });
}

function registerEmail(){
  var data= $("#news_email").val();
  if(checkEmail(data) == false){
    $('#error-popup .modal-body').html("Email không hợp lệ!");
    $('#error-popup').modal('show');
  }
  else{
  $.ajax({
      url:'../includes/functions.php',
      type:'post',
      data: {
        funct: 'reg_email',
        email: data
      },
      success:function(response){
        $('#error-popup .modal-body').html(response);
        $('#error-popup').modal('show');
        setTimeout(function(){  $('#error-popup').modal('hide');},2000);
        $("#news_email").val("");
   }
  });
  }
}

function requireAdd(){
  $('#error-popup .modal-body').html("Xin vui lòng cài đặt địa chỉ trước~");
  $('#error-popup').modal('show');
  setTimeout(function(){ window.location = "/quan-ly?sec=eadd"; },1500);
}

$(".submit-receipt").click(function(){
  $.ajax({
      url:'../includes/functions.php',
      type:'post',
      data: {
        funct: 'checkout'
      },
      success:function(){
        $('#error-popup .modal-body').html("Xác nhận đơn hàng thành công");
        $('#error-popup').modal('show');
        setTimeout(function(){  window.location = "/quan-ly?sec=his"; },2000);

   }
  });
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
       slidesToShow: 2,
       responsive: [{
         breakpoint: 769,
         settings: { slidesToShow: 1}
       }]
     });
});
