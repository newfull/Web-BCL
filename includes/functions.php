<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
  <!--For Image Zoom-->
<script src='js/jquery-1.8.3.min.js'></script>
<script src='js/jquery.elevatezoom.js'></script>

<script>
$(document).ready(function(){
  //scroll to top
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
      if(scroll < position) {
          $('#navbar').css('margin-top','0px');
          $('#navbar').addClass('isDown');
      } else {
          $('#navbar').css('margin-top','-40px');
          $('#navbar').removeClass('isDown');
        }
        position = scroll;
    });

  });

var stickyNavTop = $('#navbar').offset().top;
var position = $(window).scrollTop();

//hover cho navbar
$('#navbar').mouseenter(function(){
  if((!$('#navbar').hasClass('isDown'))&&($(window).scrollTop() > stickyNavTop)){
    $('#navbar').animate({'margin-top':'0px'},"fast");
    $('#navbar').addClass('isDown');
  }
});
$('#navbar').mouseleave(function(){
  if(($('#navbar').hasClass('isDown'))&&($(window).scrollTop() > stickyNavTop)){
    $('#navbar').animate({'margin-top':'-40px'},"fast");
    $('#navbar').removeClass('isDown');
  }
});
</script>
