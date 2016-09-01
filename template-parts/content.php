<?php
/**
 * @package my_portfolio_theme
 **/
	$layout = get_query_var( 'layout' );
	$class_col = get_query_var('class_col');
	
	if( $layout == 4 ):
		$add_class = " portfolio-container-size";
	else:
		$add_class = "";
	endif;

	$post_format = get_post_format();
	$quote_content = get_post_meta( get_the_ID(), 'portfolio_quote', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(" portfolio-article ".$class_col.$add_class); ?>>
	<div class="main-wrapper col-sm-12 col-xs-12 post-part">
			<div class="col-sm-12 portfolio-post-header text-center">
				<span class="col-sm-4 col-xs-12 pull-left"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> 
						<?php the_category( ', ' ); ?>
				</span>
				<span class="col-sm-4  col-xs-12 pull-left"><i class="fa fa-clock-o" aria-hidden="true"></i>
						<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
				</span>
				<span class="col-sm-4  col-xs-12 pull-left"><i class="fa fa-comments" aria-hidden="true"></i> 
					<?php comments_number(); ?>
				</span>
			</div>
			
			<!-- MEDIA - Take an appropriate custom post type (gallery, video, audio, standard or image) -->
			<div class="row text-center portfolio-title">
				<?php
					if ( is_single() ) {
						the_title( '<h1 class="entry-title">', '</h1>' );
					} else {
						the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
					}
				?>
			</div>

			<?php if( $post_format != 'quote' ): ?>
				<div class="media">
					<?php 
						$include_post_format = !empty( $post_format ) ? '-' : ''; 
						if( $post_format != 'quote' ): 
							include locate_template( 'post_formats/post'. $include_post_format.$post_format .'.php' );
						endif; 
					?>
				</div>	
			<?php endif; ?>


			<?php if( $post_format == 'quote' ): ?>
				<div class="post-excerpt">
					<?php include locate_template( 'post_formats/post-quote.php' ); ?>
					<span class="post-quote-author"><?php echo $quote_content; ?></span>
				</div>
			<?php endif; ?>
			
			<!-- CONTENT - Take Post Content - excerpt -->
			<div class="post-excerpt">
				<?php
					if( $post_format != 'quote' ):
						the_excerpt( sprintf(
							wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'my_portfolio_theme' ), array( 'span' => array( 'class' => array() ) ) ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						) );

					endif;
				?>
			</div>

		<div class="text-center">
			<a href="<?php esc_url( the_permalink() ); ?>" class="btn see-post-button">SEE POST</a>
		</div>

		<div class="footer-info">
			<?php if( has_tag() ): ?>
				<span><i class="fa fa-tags" aria-hidden="true"></i> <a href="#"><?php the_tags( '',', ','' ); ?></a></span>
			<?php else: ?>
				<span><i class="fa fa-tags" aria-hidden="true"></i> <a href="#"> No Tags</a></span>
			<?php endif; ?>
			<span><i class="fa fa-user" aria-hidden="true"></i> Author: <a href="#"><?php the_author_posts_link(); ?></a></span>
		</div><!-- .footer-info -->

	</div><!-- .main-wrapper -->
</article><!-- #post -->