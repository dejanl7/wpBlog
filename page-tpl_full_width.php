<?php
/*
	Template Name: Full Width
*/
get_header();
the_post();

?>
<section>
	<div class="container full_width_page_content">	
		<div class="blog-item-content">
			<h2 class="post-title page"><?php the_title() ?></h2>
		</div>

		<div class="blog-item-content">
			<?php if( has_post_thumbnail() ): ?>
				<div class="full_page_thumbnail">
					<?php the_post_thumbnail() ?>
				</div>	
			<?php endif; ?>	

			<div class="post-content clearfix ">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>