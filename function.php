
  <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.scrollUp.min.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/main.js"></script>
    <!--For Image Zoom-->
  <script src='js/jquery-1.8.3.min.js'></script>
	<script src='js/jquery.elevatezoom.js'></script>
	<script>
	    $('#zoom_01').elevateZoom({
	    zoomType: "inner",
		cursor: "crosshair",
		zoomWindowFadeIn: 500,
		zoomWindowFadeOut: 750
		   });
	</script>

	<!--For Fancyapp-->
	<!--<script type="text/javascript" src="fancyapp/lib/jquery-1.10.1.min.js"></script> -->
  <script type="text/javascript" src="fancyapp/source/jquery.fancybox.js?v=2.1.5"></script>
  <link rel="stylesheet" type="text/css" href="fancyapp/source/jquery.fancybox.css?v=2.1.5" media="screen" />
  <script type="text/javascript">
  var stickyNavTop = $('#navbar').offset().top;
  var position = $(window).scrollTop();

    $(document).ready(function() {
        $(window).scroll(function() {
          var scroll = $(window).scrollTop();
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
      $('.fancybox').fancybox();
    });

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
