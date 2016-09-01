<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package my_portfolio_theme
 */
	wp_reset_postdata();
	get_header(); 
	$post_format = get_post_format();

	global $my_portfolio;
	$single_layout = $my_portfolio['single_posts_layout'];
 	
	$classes_array 	= portfolio_layouts($single_layout);
	$major_class 	= $classes_array[1];
	$main_class 	= $classes_array[2];
	$sidebar_class	= $classes_array[4];
	
	$post_format = get_post_format();
	$quote_content = get_post_meta( get_the_ID(), 'portfolio_quote', true );
?>

<div class="<?php echo $major_class; ?>" id="portfolio-single-post">

	<!-- ASIDE - If left sidebar is active, display Left Sidebar -->
		 <?php if( $single_layout == 0 || $single_layout == 2 ): ?>
			<aside id="aside-content" class="<?php echo $sidebar_class; ?>">
				<?php dynamic_sidebar('sidebar-1'); ?>
			</aside>
		<?php 
			endif; 
		?>

		<div id="single-primary" class="<?php echo $main_class; ?>">
			<!-- Single Page Category (categories) Name -->
			<div class="row single-post-title text-center">
				<i class="fa fa-500px" aria-hidden="true"> </i> <span><?php the_category(', '); ?> </span> <i class="fa fa-500px" aria-hidden="true"> </i>
			</div><!-- .single-post-title -->

			<!-- Post Content -->
			<main id="single-main" class="row" >
			  <!-- Headline -->
				<?php 
					$hasImage = get_post_thumbnail_id($post_ID);
					if( !empty($hasImage) ):
				?>
					<div class="single-post-info-header text-center">
						<h4><?php the_title(); ?></h4><br>	
						<div class="col-sm-12">	
							<span class="col-sm-6 col-xs-12 "><i class="fa fa-user" aria-hidden="true"></i> <?php the_author_posts_link(); ?> </span>
							<span class="col-sm-6 col-xs-12"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php the_time('m/d/Y \a\t g:ia'); ?></span>
						</div>
					</div><!-- .single-post-header -->
				  	
				  	<?php else: ?><br><br>
				  		<div class="single-post-info-header text-center">
							<div class="col-sm-12">	
								<h4><?php the_title(); ?></h4><br>
								<span class="col-sm-3 col-xs-12 "><i class="fa fa-user" aria-hidden="true"></i> <?php the_author_posts_link(); ?> </span>
								<span class="col-sm-3 col-xs-12"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php the_time('m/d/Y \a\t g:ia'); ?></span>
								<span class="col-sm-3 col-xs-12"><i class="fa fa-comments" aria-hidden="true"></i> <?php comments_number(); ?></span>
								<?php if( get_the_tags($post_ID) ): ?>
									<span class="col-sm-3 col-xs-12"><i class="fa fa-tags" aria-hidden="true"></i> <?php the_tags('',', ','' ); ?></span>
								<?php else: ?>
									<span class="col-sm-3 col-xs-12"><i class="fa fa-tags" aria-hidden="true"></i> No Tags</span>
								<?php endif; ?>
						</div>
						</div><br><br>
				<?php endif; ?><br><br>
			  	<?php if( !empty($hasImage) ): ?>
				  <!-- Single Page Media - gallery -->
				  	<?php if( $post_format != 'quote' ): ?>
						<div class="row media single-post-media">
							<?php 
								$include_post_format = !empty( $post_format ) ? '-' : ''; 
								if( $post_format != 'quote' ): 
									include locate_template( 'post_formats/post'. $include_post_format.$post_format .'.php' );
								endif;
							?>
						</div><!-- .single-post-media -->
					<?php endif; ?>
				<?php endif; ?>

					
			  <!-- Single Post Quote -->
				<?php if( $post_format == 'quote' ): ?>
					<div class="single-post-quote">
						<?php include locate_template( 'post_formats/post-quote.php' ); ?>
						<span class="post-quote-author"><?php echo $quote_content; ?></span>
					</div>
				<?php endif; ?>

			
				<?php if( !empty($hasImage) ): ?>
					<!-- Single Post Footer Info -->
					<div class="col-sm-12 col-xs-12 single-post-info-footer">
						<span class="col-sm-6"><i class="fa fa-comments" aria-hidden="true"></i> <?php comments_number(); ?></span>
						<span class="col-sm-6"><i class="fa fa-tags" aria-hidden="true"></i> <?php the_tags( '',', ','' ); ?></span>
					</div><!-- .single-post-info-head --> 
				<?php endif; ?>

			  <!-- Single Post Content -->
			  	<div class="row single-post-content">
					<?php
						if( $post_format != 'quote' ):
							the_content();	
						endif;
					?>
				</div><!-- .single-post-content -->
						
			</main><!-- #main -->
			
			<!-- Single Post Navigation (previous and next post) -->
			<div class="row text-center">
				<div class="col-sm-12 portfolio-single-post-navigation">
				<?php
					$previous_post  = get_previous_post();
					$next_post 		= get_next_post();
				?>
				<span class="col-sm-4 col-xs-12 previous_post_id text-left">
					<a href="<?php echo get_permalink($previous_post->ID); ?>">
						<?php if( $previous_post->post_title != ''): ?>
							<i class="fa fa-arrow-left" aria-hidden="true"></i> <?php echo $previous_post->post_title; ?>
						<?php endif; ?>
					</a>
				</span>
				<span class="col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1 text-center">
					<a href="<?php echo esc_url( home_url() ); ?>">
						<i class="fa fa-home" aria-hidden="true"></i>
					</a>
				</span>
				<span class="col-sm-4 col-xs-4 col-xs-12 next_post_id  text-right">
					<a href="<?php echo get_permalink($next_post->ID); ?>"><?php echo $next_post->post_title; ?>
						<?php if( $next_post->post_title != ''): ?>
							<i class="fa fa-arrow-right" aria-hidden="true"></i>
						<?php endif; ?>
					</a>
				</span>
				</div><!-- .portfolio-single-post-navigation -->
			</div><!-- .row -->
		
		

		<!-- "Maybe Intereting" Section -->
		<?php  
			$tags 		= get_the_tags();
			$tags_array = array();
			if ( !empty( $tags) ):
				foreach( $tags as $tag):
					$tags_array[] = $tag->term_id;
				endforeach;
			endif;

			$related_posts 	= new WP_Query( array(
				'post_type'				=> 'post',
				'posts_per_page'		=> '4',
				'post_status'			=> 'publish',
				'ignore_sticky_posts'	=> 1,
				'post__not_in'			=> array( get_the_ID() ),
				'tag__in'				=> $tags_array
			) );  

				if( $related_posts-> have_posts() ):
		?>
					<div class="maybe-interesting text-center"><h4>Maybe Interesting</h4></div>
					<div id="owl-demo" class="owl-carousel owl-theme">

						<?php 
							while( $related_posts -> have_posts() ):
								$related_posts->the_post();	
								if(get_post_thumbnail_id( $post_ID ) != ''):
						?>
									<div class="item item-with-image">
									  	<a href="<?php the_permalink(); ?>">
									  		<h4 class="text-center"><?php the_title(); ?></h4>
									 			<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post_ID) ); ?>" alt="Related Posts">
									 	</a>
									</div>

								<?php	else: ?>
									<div class="item item-without-image">
									  	<a href="<?php the_permalink(); ?>">
									  		<h4 class="text-center"><?php the_title(); ?></h4>
									 	</a>
									</div>
								<?php
								endif;
							endwhile;
						?>
					</div><!-- .owl-theme -->

			<?php else: ?>
				<h4 class="text-center no-related-posts">No Related Posts</h4>
			<?php
				endif; 
				wp_reset_postdata(); 
			?>
	




			<!-- Comments -->
			<div class="row single-post-comments">
				<?php
				  // If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template( '',', ');
					endif;
				?>
			</div><!-- .single-post-comments -->	
		</div><!-- #single-primary -->

		
		<!-- RIGHT SIDEBAR - If is active -->
		 <?php if( $single_layout == 1 || $single_layout == 3 ): ?>
			<aside id="aside-content" class="<?php echo $sidebar_class; ?>">
				<?php dynamic_sidebar('sidebar-1'); ?>
			</aside>
		<?php endif; ?>
</div><!-- .container -->

<?php get_footer(); ?>