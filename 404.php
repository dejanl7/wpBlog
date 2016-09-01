<?php get_header(); ?>
<section class="single-blog no-featured no-page">
	<div class="container">
		<div class="blog-item-content margin-bottom">
			<h1><?php _e( '404', 'portfolio' ) ?></h1>
			<h4><?php _e( 'Page not found', 'portfolio' ) ?></h4>
		
			<div class="post-content">
				<p><?php _e( 'Page you are looking for is no longer available. Use search form bellow to find what you are looking for', 'portfolio' ) ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>