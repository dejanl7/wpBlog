<?php 
/*===========================================================
	1. Portfolio Recent Posts Widget
=============================================================*/
class Portfolio_Custom_Posts extends WP_Widget {
	// Sets up the widgets name etc
		public function __construct() {
			parent::__construct( 
				'portfolio_custom_post_widget',
				__('Portfolio Custom Posts', 'portfolio'),
				array('description' => __('Portfolio Post Widget', 'portfolio') )
			);
		}


	// Outputs the content of the widget	
		public function widget( $args, $instance ) {
			extract($args);

			$title = esc_attr( $instance['title'] );
			$title = ( !empty($title) ) ? $title : 'Portfolio Recent Posts';
			$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;

			if ( !$number ){
				$number = 5;
			}

		  // Before Widget
			echo $before_widget;
				if( $title ):
					$title_stylesheet = "<span class='portfolio-widget-title-separator'>||</span>";
					echo $before_title . $title . $title_stylesheet . $after_title;
				endif;

		  // SHOW POSTS
			$recent_posts_args = array(
				'posts_per_page'      => $number,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true
			);
			$recent_posts = new WP_Query( apply_filters( 'widget_posts_args', $recent_posts_args ) );
			if( $recent_posts->have_posts() ):
			?>
				<ul class="unstyled-list">
					<?php 
						while( $recent_posts->have_posts() ): 
						$recent_posts->the_post();
					?>
						<li>
							<?php if( has_post_thumbnail() ): ?>
								<a href="<?php the_permalink(); ?>" class="recent_post_wrapper">
									<?php the_post_thumbnail( 'portfolio-posts-thumbanil' ); ?>
									<span class="portfolio-widget-title"><?php the_title(); ?></span>
								</a>
							<?php else: ?>
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							<?php endif; ?> 
						</li>

		<?php
						endwhile;
			endif;

		  // After Widget
			echo $after_widget;

		}


	// Outputs the options form on admin
		public function form( $instance ) {
			$title 	= isset($instance['title']) ? esc_attr( $instance['title'] ) : 'Portfolio Recent Posts';
			$number = isset($instance['number']) ? absint( $instance['number'] ) : 5;
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title', 'portfolio'); ?></p>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" >

			<p><label for="<?php echo esc_attr( $this->get_field_id('number') ); ?>"><?php _e('Number of Recent Posts', 'portfolio'); ?></p>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number" value="<?php echo esc_attr($number); ?>" >
		<?php
		}

	// Processing widget options on save 
		public function update( $new_instance, $old_instance ) {
			$portfolio_instance['title']  = strip_tags( $new_instance['title'] );
			$portfolio_instance['number'] = strip_tags( $new_instance['number'] );

			return $portfolio_instance;
		}
}



/*===========================================================
	2. Portfolio Subscribe Widget
=============================================================*/
class Portfolio_Custom_Subscribe extends WP_Widget {
	// Sets up the widgets name etc
		public function __construct() {
			parent::__construct( 
				'portfolio_custom_subscribe_widget',
				__('Portfolio Subscribe', 'portfolio'),
				array('description' => __('Portfolio Subscribe Widget', 'portfolio') )
			);
		}

	
	// Outputs the content of the widget	
		public function widget( $args, $instance ) {
			extract($args);
			
			$title = esc_attr( $instance['subscribe_title'] ); 
			$title = ( !empty($title) ) ? $title : 'Portfolio Subscribe';
		  // Before Widget
			echo $before_widget;
				if( $title ):
					$title_stylesheet = "<span class='portfolio-widget-title-separator'>||</span>";
					echo $before_title . $title . $title_stylesheet . $after_title;
				endif;
			?>
				<form id="portfolio-subscribe-form">
					<div class="form-group">
						<input type="text" name="portfolio_name" id="portfolio_name" class="pull-left form-control" placeholder="First Name" >
						<input type="text" name="portfolio_lastName" id="portfolio_lastName" class="form-control" placeholder="Last Name" >
					</div>

					<div class="form-group">
						<input type="text" name="portfolio_email" id="portfolio_email" class="form-control" placeholder="E-mail" required >
					</div>
					
					<div class="form-group submit-btn text-center" >
						<a href="javascript:;" class="btn btn-default portfolio_subscriber_submit"><i class="fa fa-wifi fa-1x"> Subscribe</i></a>
					</div>

					<div id="subscribe-answer"></div>
				</form> <!-- .portfolio-subscribe-form --><br>
			<?php 
		  // After Widget
			echo $after_widget;
		}

	// Outputs the options form on admin
		public function form( $instance ) {
			$subscriber_title = isset($instance['subscribe_title']) ? esc_attr( $instance['subscribe_title'] ) : 'Portfolio Subscribe'; 
			$subscriber_name  = isset($instance['subscriber']) ? esc_attr( $instance['subscriber'] ) : '';
			$subscriber_mail  = isset($instance['subscriber_mail']) ? esc_attr( $instance['subscriber_mail'] ) : '';
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id('subscribe_title') ); ?>"><?php _e('Subscribe Widget Title', 'portfolio'); ?></p>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('subscribe_title') ); ?>" name="<?php echo esc_attr($this->get_field_name('subscribe_title')); ?>" type="text" value="<?php echo esc_attr($subscriber_title); ?>" >

			<p><label for="<?php echo esc_attr( $this->get_field_id('subscriber') ); ?>"><?php _e('Subscriber Name', 'portfolio'); ?></p>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('subscriber') ); ?>" name="<?php echo esc_attr($this->get_field_name('subscriber')); ?>" type="text" value="<?php echo esc_attr($subscriber_name); ?>" >

			<p><label for="<?php echo esc_attr( $this->get_field_id('subscriber_mail') ); ?>"><?php _e('Subscriber E-mail', 'portfolio'); ?></p>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('subscriber_mail') ); ?>" name="<?php echo esc_attr($this->get_field_name('subscriber_mail')); ?>" type="text" value="<?php echo esc_attr($subscriber_mail); ?>" >
		<?php
		}


	// Processing widget options on save
		public function update( $new_instance, $old_instance ) {
			$portfolio_instance['subscribe_title'] 	= strip_tags( $new_instance['subscribe_title'] );
			$portfolio_instance['subscriber'] 		= strip_tags( $new_instance['subscriber'] );
			$portfolio_instance['subscriber_mail'] 	= strip_tags( $new_instance['subscriber_mail'] );


			return $portfolio_instance;
		}

}



/*===========================================================
	3. Widget for Comments
=============================================================*/
class Portfolio_Custom_Comments extends WP_Widget {
	// Sets up the widgets name etc
		public function __construct() {
			parent::__construct( 
				'portfolio_custom_comments_widget',
				__('Portfolio Comments', 'portfolio'),
				array('description' => __('Portfolio Comments Widget', 'portfolio') )
			);
		}

	// Outputs the content of the widget	
		public function widget( $args, $instance ) {
			extract($args);
			
			$title = esc_attr( $instance['comments_title'] );
			$title = ( !empty($title) ) ? $title : 'Recent Comments';
			
			$number = esc_attr( $instance['comments_number'] );
			$number = (!empty($number) ) ? $number : 7; 

			echo $before_widget;
				if( $title ):
					$title_stylesheet = "<span class='portfolio-widget-title-separator'>||</span>";
					echo $before_title . $title . $title_stylesheet . $after_title;
				endif;

				$comments_args = array(
					'number'		=> $number,
					'status'		=> 'approve',
					'post_status'	=> 'publish'
				);
			?>

			<div class="portfolio-comments">
			  <?php
				$comments = get_comments( $comments_args );
				//print_r($comments);
				foreach( $comments as $comment ):
					$comment_text = get_comment_text( $comment->comment_ID );
					
					if( strlen($comment_text) > 80 ):
						$comment_text = substr( $comment_text, 0 , 80 );
						$comment_text = substr( $comment_text, 0, strripos( $comment_text, " "  ) );
						$comment_text .= "...";
					endif;
						
					$url  = get_avatar_url( $comment->comment_author_email );

					if ( $comment->user_id ) {
						$user = get_userdata( $comment->user_id );
						if( $user->display_name ){
						 	$name = $user->display_name;
						}
					}	

		?>
			
				<div class="portfolio-comments-avatar">
					<div class="avatar-image">
						<img src="<?php echo esc_url($url); ?>" alt="Avatar" >
						<span class="comment-text">
							<a href="<?php echo esc_url( get_comment_link($comment->comment_ID) ); ?>"> 
								<p><?php echo $comment_text; ?></p>
							</a>
						</span>
						<span class="comment-info">
							By: <?php echo $name." -> "; ?>
							<?php echo human_time_diff( get_comment_date('U', $comment->comment_ID), current_time('timestamp') ).__(' ago', 'portfolio') ?>
						</span>
					</div>
					
					<div class="clear"></div>
				</div><!-- .portfolio-comments-avatar -->


			<?php endforeach; ?>
		</div><!-- .portfolio-comments -->

		<?php echo $after_widget; }

	// Outputs the options form on admin
		public function form( $instance ) {
			$comments_title  = isset($instance['comments_title']) ? esc_attr( $instance['comments_title'] ) : 'Portfolio Comments';
			$comments_number = isset($instance['comments_number']) ? esc_attr( $instance['comments_number']) : '7';
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id('comments_title') ); ?>"><?php _e('Comments Widget Title', 'portfolio'); ?></p>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('comments_title') ); ?>" name="<?php echo esc_attr($this->get_field_name('comments_title')); ?>" type="text" value="<?php echo esc_attr($comments_title); ?>" >

			<p><label for="<?php echo esc_attr( $this->get_field_id('comments_number') ); ?>"><?php _e('Comments Widget Number', 'portfolio'); ?></p>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('comments_number') ); ?>" name="<?php echo esc_attr($this->get_field_name('comments_number')); ?>" type="text" value="<?php echo esc_attr($comments_number); ?>" >
		<?php
		}


	// Processing widget options on save
		public function update( $new_instance, $old_instance ) {
			$portfolio_instance['comments_title'] 	= strip_tags( $new_instance['comments_title'] );
			$portfolio_instance['comments_number']	= strip_tags( $new_instance['comments_number']);

				return $portfolio_instance;
		}

}




/*===========================================================
	4. Widget for Social Networks
=============================================================*/
class Portfolio_Social_Icons extends WP_Widget {
	// Sets up the widgets name etc
		public function __construct() {
			parent::__construct( 
				'portfolio_social_icons_widget',
				__('Portfolio Social Icons', 'portfolio'),
				array('description' => __('Portfolio Social Icons Widget', 'portfolio') )
			);
		}

	// Outputs the content of the widget	
		public function widget( $args, $instance ) {
			extract($args);

			$title = esc_attr( $instance['social_icons_title'] );
			$title = ( !empty($title) ) ? $title : 'Social Icons Title';
			
			$facebook = !empty( $instance['facebook'] ) ? '<a href="'.esc_url( $instance['facebook'] ).'" target="_blank" class="btn"><span class="fa fa-facebook-square fa-2x"></span></a>' : '';
			$twitter = !empty( $instance['twitter'] ) ? '<a href="'.esc_url( $instance['twitter'] ).'" target="_blank" class="btn"><span class="fa fa-twitter fa-2x"></span></a>' : '';
			$google = !empty( $instance['google'] ) ? '<a href="'.esc_url( $instance['google'] ).'" target="_blank" class="btn"><span class="fa fa-google-plus-square fa-2x"></span></a>' : '';
			$instagram = !empty( $instance['instagram'] ) ? '<a href="'.esc_url( $instance['instagram'] ).'" target="_blank" class="btn"><span class="fa fa-instagram fa-2x"></span></a>' : '';
			$linkedin = !empty( $instance['linkedin'] ) ? '<a href="'.esc_url( $instance['linkedin'] ).'" target="_blank" class="btn"><span class="fa fa-linkedin-square fa-2x"></span></a>' : '';
			$pinterest = !empty( $instance['pinterest'] ) ? '<a href="'.esc_url( $instance['pinterest'] ).'" target="_blank" class="btn"><span class="fa fa-pinterest-square fa-2x"></span></a>' : '';
			$youtube = !empty( $instance['youtube'] ) ? '<a href="'.esc_url( $instance['youtube'] ).'" target="_blank" class="btn"><span class="fa fa-youtube-square fa-2x"></span></a>' : '';
						$youtube = !empty( $instance['youtube'] ) ? '<a href="'.esc_url( $instance['youtube'] ).'" target="_blank" class="btn"><span class="fa fa-youtube-square fa-2x"></span></a>' : '';
			$flickr = !empty( $instance['flickr'] ) ? '<a href="'.esc_url( $instance['flickr'] ).'" target="_blank" class="btn"><span class="fa fa-flickr fa-2x"></span></a>' : '';


			echo $before_widget;
				if( $title ):
					$title_stylesheet = "<span class='portfolio-widget-title-separator'>||</span>";
					echo $before_title . $title . $title_stylesheet . $after_title;
				endif;
			?>
				<div class="portfolio-social-icons">
					<?php echo $facebook.$twitter.$google.$instagram.$linkedin.$pinterest.$youtube.$flickr; ?>
				</div>

		<?php	echo $after_widget;
		}	

	// Outputs the options form on admin
		public function form( $instance ) {
			$social_icons_title = isset( $instance['social_icons_title'] ) ? $instance['social_icons_title'] : 'Social Icons Title';
			$facebook 			= isset( $instance['facebook'] ) ? $instance['facebook'] : '';
			$twitter 			= isset( $instance['twitter'] ) ? $instance['twitter'] : '';
			$google 			= isset( $instance['google'] ) ? $instance['google'] : '';
			$instagram 			= isset( $instance['instagram'] ) ? $instance['google'] : '';
			$linkedin 			= isset( $instance['linkedin'] ) ? $instance['linkedin'] : '';
			$pinterest 			= isset( $instance['pinterest'] ) ? $instance['pinterest'] : '';
			$youtube 			= isset( $instance['youtube'] ) ? $instance['youtube'] : '';
			$flickr 			= isset( $instance['flickr'] ) ? $instance['flickr'] : '';
			$behance 			= isset( $instance['behance'] ) ? $instance['behance'] : '';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('social_icons_title') ); ?>"><?php _e('Social Icons Title:', 'portfolio') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_icons_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_icons_title') ); ?>" value="<?php echo esc_attr( $social_icons_title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>"><?php _e('Facebook:', 'portfolio') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>" name="<?php echo esc_attr( $this->get_field_name('facebook') ); ?>" value="<?php echo esc_url( $facebook ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>"><?php _e('Twitter:', 'portfolio') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter') ); ?>" value="<?php echo esc_url( $twitter ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('google') ); ?>"><?php _e('Google +:', 'portfolio') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('google') ); ?>" name="<?php echo esc_attr( $this->get_field_name('google') ); ?>" value="<?php echo esc_url( $google ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('instagram') ); ?>"><?php _e('Instagram:', 'portfolio') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('instagram') ); ?>" name="<?php echo esc_attr( $this->get_field_name('instagram') ); ?>" value="<?php echo esc_url( $instagram ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('linkedin') ); ?>"><?php _e('Linkedin:', 'portfolio') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('linkedin') ); ?>" name="<?php echo esc_attr( $this->get_field_name('linkedin') ); ?>" value="<?php echo esc_url( $linkedin ); ?>" />
		</p>			
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('youtube') ); ?>"><?php _e('YouTube:', 'portfolio') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('youtube') ); ?>" name="<?php echo esc_attr( $this->get_field_name('youtube') ); ?>" value="<?php echo esc_url( $youtube ); ?>" />
		</p>		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>"><?php _e('Pinterest:', 'portfolio') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pinterest')); ?>" value="<?php echo esc_url( $pinterest ); ?>" />
		</p>		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('flickr') ); ?>"><?php _e('Flickr:', 'portfolio') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('flickr') ); ?>" name="<?php echo esc_attr( $this->get_field_name('flickr') ); ?>" value="<?php echo esc_url( $flickr ); ?>" />
		</p>		
		
		<?php
		
		}

	// Processing widget options on save
		public function update( $new_instance, $old_instance ) {
			$portfolio_instance['social_icons_title'] 	= strip_tags( stripslashes( $new_instance['social_icons_title'] ) );
			$portfolio_instance['facebook']				= strip_tags( stripslashes( $new_instance['facebook'] ) );
			$portfolio_instance['twitter']  			= strip_tags( stripslashes( $new_instance['twitter'] ) );
			$portfolio_instance['google'] 				= strip_tags( stripslashes( $new_instance['google'] ) );
			$portfolio_instance['instagram'] 			= strip_tags( stripslashes( $new_instance['instagram'] ) );
			$portfolio_instance['linkedin'] 			= strip_tags( stripslashes( $new_instance['linkedin'] ) );
			$portfolio_instance['youtube'] 				= strip_tags( stripslashes( $new_instance['youtube'] ) );
			$portfolio_instance['pinterest'] 			= strip_tags( stripslashes( $new_instance['pinterest'] ) );
			$portfolio_instance['flickr'] 				= strip_tags( stripslashes( $new_instance['flickr'] ) );
	
				return $portfolio_instance;
		}

}



/*===========================================================
	5. Widget for Social Networks
=============================================================*/
class Portfolio_Shortcode_Widget extends WP_Widget {
	// Sets up the widgets name etc
	public function __construct() {
		parent::__construct( 
			'portfolio_shortcode_widget',
			__('Portfolio Shortcode Widget', 'portfolio'),
			array('description' => __('Portfolio Shortcode Widget', 'portfolio') )
		);
	}

	// Outputs the content of the widget	
	public function widget( $args, $instance ) {
		extract($args);

			$shortcode_title 	= esc_attr( $instance['shortcode_title'] );
			$title 				= ( !empty($shortcode_title) ) ? $shortcode_title : 'Shortcode Title';
			$shortcode_textarea = $instance['shortcode-textarea'];
			echo $before_widget;
				if( $title ):
					$title_stylesheet = "<span class='portfolio-widget-title-separator'>||</span>";
					echo $before_title . $title . $title_stylesheet . $after_title;
				endif;
		
			echo do_shortcode( $shortcode_textarea );
			echo $after_widget;
	}

	// Outputs the options form on admin
	public function form( $instance ) {
		$shortcode_title 	= isset( $instance['shortcode_title'] ) ? $instance['shortcode_title'] : 'Shortcodes';
		$shortcodetextarea 	= isset( $instance['shortcode-textarea'] ) ? $instance['shortcode-textarea'] : '';
	?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('shortcode_title') ); ?>">
				<?php _e('Shortcode Widget Title:', 'portfolio') ?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('shortcode_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('shortcode_title') ); ?>" value="<?php echo esc_attr( $shortcode_title ); ?>" />
		</p>
		<p>
			<label for="shortcode-widget-select"><?php _e('Choose Shortcode:', 'portfolio') ?></label>
			<select id="shortcode-widget-select" rows="100" cols="20" name="shortcode-widget-select" class="add-widget-shortcode">
				<option value=""><?php _e('-Select-', 'portfolio'); ?></option>
				<option value="accordion"><?php _e('Accordion', 'portfolio'); ?></option>
				<option value="alert"><?php _e('Alert Box', 'portfolio'); ?></option>
				<option value="button"><?php _e('Button', 'portfolio'); ?></option>
				<option value="progressbar"><?php _e('Progressbar', 'portfolio'); ?></option>				
				<option value="icon"><?php _e('Social Icon', 'portfolio'); ?></option>
				<option value="tabs"><?php _e('Tabs', 'portfolio'); ?></option>
				<option value="toggle"><?php _e('Toggle', 'portfolio'); ?></option>


			</select>
		</p>
		<p>
			<label for="<?php esc_attr( $this->get_field_id('shortcode-textarea') ); ?>"><?php _e('Description', 'portfolio'); ?></label>
			<textarea type="text" class="widefat shortcode-input" id="<?php echo esc_attr( $this->get_field_id('shortcode-textarea') ); ?>" name="<?php echo esc_attr( $this->get_field_name('shortcode-textarea') ); ?>"><?php echo esc_textarea( $shortcodetextarea); ?></textarea>
		</p>


	<?php
			
	}

	// Processing widget options on save
	public function update( $new_instance, $old_instance ) {
		$portfolio_instance['shortcode_title'] 		= strip_tags( stripslashes( $new_instance['shortcode_title'] ) );
		$portfolio_instance['shortcode-textarea']	= strip_tags( stripslashes( $new_instance['shortcode-textarea'] ) );
	
			return $portfolio_instance;
	}
}



/*=============================================
	Register All Widgets
===============================================*/
function register_custom_widgets(){
	if( !is_blog_installed() ):
		return;
	endif;
 	
 	// Register Custom Post Widget
		register_widget( 'Portfolio_Custom_Posts' );
	// Register Custom Subscribe Widget
		register_widget( 'Portfolio_Custom_Subscribe' );
	// Register Custom Comments Widget
		register_widget( 'Portfolio_Custom_Comments' );
	// Register Social Icons
		register_widget( 'Portfolio_Social_Icons' );
	// Register Shortcode Widget
		register_widget( 'Portfolio_Shortcode_Widget' );
}
	add_action( 'widgets_init', 'register_custom_widgets' );



?>