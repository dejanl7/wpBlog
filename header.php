<?php
/*
 @package  - domain: my_portfolio_theme
*/

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="<?php echo esc_attr( portfolio_get_option('seo_keywords_id') ); ?>" >
<meta name="description" content="<?php echo esc_attr( portfolio_get_option('seo_description_id') ); ?>" >

<link href="<?php echo bloginfo('stylesheet_directory').'/images/img.jpg'; ?>" rel="shortcut icon" >
<style>
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url(<?php echo bloginfo('stylesheet_directory').'/images/Preloader_2.gif'; ?>) center no-repeat #fff;
	}
</style>
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div class="se-pre-con"></div><!-- Simple Preloader -->
<div id="page" >
		
	<!-- "HEADER" Section -->
	<header id="home">
	<?php 
		global $my_portfolio;	
		$logo 						= $my_portfolio['portfolio_logo']['url'];
		$header_image_urls 			= get_header_image_url();
		$get_header_image_titles	= get_header_image_titles();
		$header_image_descriptions 	= get_header_image_description();
	?>
		<div id="owl-header" class="owl-carousel owl-theme ">
		<?php foreach( $header_image_urls as $key => $img ): ?>
			<?php if( !empty($img) ): ?>
				<div class="item item-header">
				 	<img src="<?php echo $img; ?>" alt="header image">
					 	<div class="col-xs-12 slider-informations">
					 		<?php if( !empty($logo) ): ?>
						 		<div id="logo" class="text-center">
						 			<img src="<?php echo $logo; ?>"  />
						 		</div>
						 	<?php endif; ?>
						 	<div class="col-sm-8 col-sm-offset-2 text-information">
						 		<h1 class="text-center headline-title"><?php echo $get_header_image_titles[$key]; ?></h4>
						 		<p class="headline-description"><?php echo cut_string_words($header_image_descriptions[$key]) ?></p>
					 		</div>
					 	</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
		</div>

	</header><!-- #home -->


<!-- ================================= 
    SECTION "NAVBAR"
====================================== -->
<div class="container-fluid main-menu">
  <div class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <?php    
			$args = array(
				'theme_location' 	=> 'primary',
				'container'			=> 'nav',
				'container_class'	=> 'navbar-collapse collapse',
				'container_id'		=> 'navbar',
				'menu_class'		=> 'nav navbar-nav',
				'walker'			=>  new my_portfolio_theme_walker
			);
		
			wp_nav_menu( $args );
		?>
    </div><!--.container -->
  </div><!-- .navbar -->
</div> <!-- .fluid-container -->
	
<div id="content" class="site-content container-fluid">