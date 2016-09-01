<?php
	get_header();
	the_post();
?>
<section>
	<div class="container">
		<div class="col-sm-9 default-page">		
			<div class="blog-item-content margin-bottom">
				<h2 class="post-title page"><?php the_title() ?></h2>
			</div>

			<div class="blog-item-content margin-bottom">
				<?php if( has_post_thumbnail() ): ?>
				<div class="default_page_thumbnail " style="<?php echo esc_attr( $style ); ?>">
					<?php the_post_thumbnail() ?>
				</div>	
				<?php endif; ?>	

				<div class="post-content clearfix">
					<?php the_content(); ?>
				</div>
			</div>				
		</div>
		<div class="col-sm-3">
			<?php get_sidebar( 'right' ) ?>
		</div>				
	</div>
</section>
<?php get_footer(); ?>