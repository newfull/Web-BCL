
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
    $(document).ready(function() {
        var stickyNavTop = $('#navbar').offset().top;
        var position = $(window).scrollTop();

        $(window).scroll(function() {
          if ($(window).scrollTop() > stickyNavTop) {
              $('#navbar').addClass('navbar-fixed-top');
        } else {
              $('#navbar').css('margin-top','0px');
              $('#navbar').removeClass('navbar-fixed-top');
            }

            var scroll = $(window).scrollTop();
            if(scroll < position) {
              $('#navbar').animate({ "margin": "0px"}, "fast");
            } else {
              $('#navbar').animate({ "margin": "-40px"}, "fast");      }
            position = scroll;

        });
      $('.fancybox').fancybox();
    });


  </script>
