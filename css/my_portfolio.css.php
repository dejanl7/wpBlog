<?php 
/*===========================
	Header CSS Values
=============================*/
	global $my_portfolio;
  // Logo
	$logo =  $my_portfolio['portfolio_logo_select_option'];

  // Header Slider
	$header_title_color	= portfolio_get_option('slider_title_color');
	$header_text_color	= portfolio_get_option('slider_text_color');



?>
/*===========================
	Header CSS Values
=============================*/
  /* Logo */
  	#logo img { float: <?php echo $logo; ?> ;}

 /* Slider */
	h1.headline-title { color: <?php echo $header_title_color; ?>; }
	p.headline-description { color: <?php echo $header_text_color; ?>; }






