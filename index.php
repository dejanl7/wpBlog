<?php
get_header(); 

// Get Pagination
	$pagination = paginate_links($args);

// Get Values from Portfolio Layout
	global $my_portfolio; 
	$layout = $my_portfolio['posts_layout']; 


if( is_category() ){
	$headline_title = "Search By Category: " . single_cat_title(' ', false) ."\"";
	$layout 		= $my_portfolio['gallery_posts_layout'];
}

else if( is_tag() ){
	$headline_title = "Search By Tag: \"". get_query_var( 'tag' ) ."\"";
	$layout 		= $my_portfolio['tag_posts_layout'];
}

else if( is_author() ){
	$headline_title = "Author: ".get_the_author_meta( 'display_name' ) ."\"";
	$layout 		= $my_portfolio['author_posts_layout'];
}

else if( is_archive() ){
	$headline_title = "Search Archieve: " . single_month_title(' ', false) ."\"";
	$layout 		= $my_portfolio['archive_posts_layout'];
}

else if( is_search() ){ 
	$headline_title = "Search results for: \"" . get_search_query() ."\"";
	$layout 		= $my_portfolio['search_posts_layout'];
}

	$classes_array 	= portfolio_layouts($layout);
	$major_class 	= $classes_array[1];
	$main_class 	= $classes_array[2];
	$class_col		= $classes_array[3];
	$sidebar_class	= $classes_array[4];

	set_query_var( 'layout', $layout );
	set_query_var( 'class_col', $class_col);


?>
<div class="<?php echo $major_class; ?>">
  <div id="index_page">
  	<h2 class="text-center"><?php echo $headline_title; ?></h2>

 <!-- ASIDE - If left sidebar is active, display Left Sidebar -->
<?php if( $layout == 0 || $layout == 2 ): ?>
	<aside id="aside-content" class="<?php echo $sidebar_class; ?>col-xs-12 ">
		<?php dynamic_sidebar('sidebar-1'); ?>
	</aside>
<?php endif; ?>

	<main id="main-content" role="main" class="masonry <?php echo $main_class; ?> ">
		<?php
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php endif; ?>
				
			<div class="masonry-container">
				<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', 'content' );
					endwhile;
				?>
			</div>
			<?php if( !empty( $pagination ) ): ?>
				<div class="row text-center paginate">
					<div class="pagination">
						<?php my_portfolio_theme_pagination(); ?>
					</div>		
				</div>		
			<?php endif; ?>	
		
		<?php else: ?>
			<div class="myportfolio-item-content text-center">
				<h3><?php _e( 'No posts found', 'portfolio' ) ?></h3>
				<div class="post-content">
					<p><?php _e( 'We could not find any post which matches your search criteria. Use form bellow to try again.', 'model' ) ?></p>
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; ?>

	</main><!-- #main -->
	
 <!-- ASIDE - If right sidebar is active, display Right Sidebar -->
 <?php if( $layout == 1 || $layout == 3 ): ?>
	<aside id="aside-content" class="<?php echo $sidebar_class; ?>">
		<?php dynamic_sidebar('sidebar-1'); ?>
	</aside>
<?php endif; ?>

  </div><!-- .row -->


</div><!-- .container OR .container-fluid -->


<?php 
	wp_reset_postdata();
	get_footer(); 
?>