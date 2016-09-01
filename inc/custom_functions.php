<?php 

/*=====================================
	Generate random password
=======================================*/
function portfolio_random_string( $length = 10 ) {
	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$random = '';
	for ($i = 0; $i < $length; $i++) {
		$random .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $random;
}



/*=====================================
	Shortcode Style - replace characters
=======================================*/
function portfolio_shortcode_style( $style_css ){
 return 
 	'<script>
 		jQuery(document).ready( function($){ $("head").append( \''.str_replace( array( "\n", "\r" ), " ", $style_css).'\' ); });
 	</script>';
}



/*=====================================
	FILTER for Widget Cloud Parametars
=======================================*/
function portfolio_cloud_sizes($args) {
		$args['smallest']	= 12;
		$args['largest']	= 12;
		$args['unit']		= 'px';
		$args['number']		= 12;
		$args['separator']	= ' ';
		$args['orderby']	= 'name';
		$args['order']		= 'ASC';
	
	return $args; 
}
	add_filter('widget_tag_cloud_args','portfolio_cloud_sizes');




/*=====================================
	Function for Header Images URL
=======================================*/
function get_header_image_url(){
	global $my_portfolio;

// Images URL	
	$header_image_url_1 = $my_portfolio['header_image_1']['url'];
	$header_image_url_2 = $my_portfolio['header_image_2']['url'];
	$header_image_url_3 = $my_portfolio['header_image_3']['url'];
	$header_image_url_4 = $my_portfolio['header_image_4']['url'];
	$header_image_url_5 = $my_portfolio['header_image_5']['url'];
	$header_image_url_6 = $my_portfolio['header_image_6']['url'];
	$header_image_url_7 = $my_portfolio['header_image_7']['url']; 

// Make Arrays From Data
	$header_images = array(
		$header_image_url_1, 
		$header_image_url_2, 
		$header_image_url_3, 
		$header_image_url_4, 
		$header_image_url_5, 
		$header_image_url_6, 
		$header_image_url_7 
	);

	return $header_images;
}

/*=====================================
	Function for Header Images TITLES
=======================================*/
function get_header_image_titles(){
	global $my_portfolio;
	// Titles HEADLINES
	$header_image_title_1 = $my_portfolio['header_image_1_title'];
	$header_image_title_2 = $my_portfolio['header_image_2_title'];
	$header_image_title_3 = $my_portfolio['header_image_3_title'];
	$header_image_title_4 = $my_portfolio['header_image_4_title'];
	$header_image_title_5 = $my_portfolio['header_image_5_title'];
	$header_image_title_6 = $my_portfolio['header_image_6_title'];
	$header_image_title_7 = $my_portfolio['header_image_7_title']; 

	$header_titles = array(
		$header_image_title_1,
		$header_image_title_2,
		$header_image_title_3,
		$header_image_title_4,
		$header_image_title_5,
		$header_image_title_6,
		$header_image_title_7,
	);

	return $header_titles;
}

/*=========================================
	Function for Header Images DESCRIPTION
===========================================*/
function get_header_image_description(){
	global $my_portfolio;
	// Description
	$header_image_description_1 = $my_portfolio['header_image_1_description'];
	$header_image_description_2 = $my_portfolio['header_image_2_description'];
	$header_image_description_3 = $my_portfolio['header_image_3_description'];
	$header_image_description_4 = $my_portfolio['header_image_4_description'];
	$header_image_description_5 = $my_portfolio['header_image_5_description'];
	$header_image_description_6 = $my_portfolio['header_image_6_description'];
	$header_image_description_7 = $my_portfolio['header_image_7_description'];


	$header_descritpion_fields = array(
		$header_image_description_1,
		$header_image_description_2,
		$header_image_description_3,
		$header_image_description_4,
		$header_image_description_5,
		$header_image_description_6,
		$header_image_description_7,
	);

	return $header_descritpion_fields;
}


/*===================================================
	Set Default Values for this Theme
=====================================================*/
function portfolio_defaults($id){
	$defaults = array(
		'portfolio_logo'			=> '',
		'slider_headline_color' 	=> '#f2f2f2;',
		'slider_title_color'		=> '#c2c2c2;',
		'slider_text_color'			=> '#ffffff;',
		'subscribe_api'				=> '',
		'subscribe_list_id'		=> ''
	);
		if( isset($defaults[$id]) ){
			return $defaults[$id];
		}

			else{
				return '';
			}
}


/*===================================================
	Define Get Option Parametars
=====================================================*/
function portfolio_get_option($id){
	global $my_portfolio;

	if( isset($my_portfolio[$id]) ){
		$value = $my_portfolio[$id];

		if( isset($value) && !empty($value) ){
			return $value;
		}
			else {
				return portfolio_defaults($id);
			}
	}

	else{
		return portfolio_defaults($id);
	}
}



/*===================================================
	Create OPTIONS Menus for SELECT fields for REDUX
	Part - LOGO
=====================================================*/
function portfolio_logo_options(){
	return array(
		'left' 	=> 'Align by Left Side',
        'right' => 'Align by Right Side',
        'center'=> 'Align by Center'
	);
}



/*===================================================
	Blog Listings
=====================================================*/
function portfolio_blog_listings(){
	return array(
		__('Left Sidebar', 'portfolio'),
		__('Right Sidebar', 'portfolio'),
		__('Two Columns Left Sidebar','portfolio'),
		__('Two Columns Right Sidebar','portfolio'),
		__('Three Columns No Sidebar')
	);
}


/*===================================================
	Single Page Listings
=====================================================*/
function single_page_listings(){
	return array(
		__('Left Sidebar', 'portfolio'),
		__('Right Sidebar', 'portfolio'),
	);
}



/*===================================================
	Define Layouts for Theme. Set array of div 
	classes for layout posts.
=====================================================*/
function portfolio_layouts($layout){
	if( $layout == 0 || $layout == 1 ){
		$major_class	= 'container';
		$main_class		= 'col-sm-9 col-xs-12';
		$class_col		= 'col-sm-12 col-xs-12';
		$sidebar_class	= 'col-sm-3 col-xs-12';
	}

	if( $layout == 2 || $layout == 3 ){
		$major_class	= 'container';
		$main_class		= 'col-sm-9 col-xs-12';
		$class_col		= 'col-sm-6 col-xs-12 two-columns';
		$sidebar_class	= 'col-sm-3 col-xs-12';
	}
	else if( $layout == 4 ){
		$major_class	= 'container-fluid';
		$main_class 	= 'col-sm-12 col-xs-12';
		$class_col  	= 'col-sm-4 col-xs-11';
		//$sidebar_class 	= 'col-sm-6 col-xs-12';
	}


 	return array( $layout, $major_class, $main_class, $class_col, $sidebar_class);
}



/*===================================================
	Custom Post Type - VIDEO. Parse URL
=====================================================*/
function portfolio_parse_video_url( $url ){
	if( stristr( $url, 'youtube' ) ){
		$get_the_url = explode("?v=", $url);
		$video = 'http://www.youtube.com/embed/'.$get_the_url[1].'?rel=0';
	}
	else if( stristr( $url, 'vimeo' ) ){
		$get_the_url = explode( '/', $url );
		$video = 'http://player.vimeo.com/video/'.$get_the_url[5];
	}
	return $video;
}


/*===================================================
	Custom Post Type - VIDEO. Parse URL
=====================================================*/
function portfolio_parse_audio_url( $audio_clip_url ){
	$audio_url = esc_html($audio_clip_url, 'portfolio');
	$url = explode("/", $audio_url);
	$clean_url = explode("&",$url[8]);

	return $clean_url[0];
}


/*===================================================
	Form - Subscribe Users via Ajax
=====================================================*/
function portfolio_save_subscribe( $email = '' ){
	$post_name = esc_attr( $_POST['name'] );
	$post_mail = esc_attr( $_POST['email'] );
	$post_lastName = esc_attr( $_POST['lastName'] );

	$email = !empty( $email ) ? $email : $post_mail;
	$merge_vars = array(
	    "FNAME" => $post_name,
	    "LNAME"	=> $post_lastName
	);
	
	$response = array();	
	if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		require_once( locate_template( 'inc/mailChimp.php' ) );
		$chimp_api 		= portfolio_get_option("subscribe_api");
		$chimp_list_id 	= portfolio_get_option("subscribe_list_id");
		
		if( !empty( $chimp_api ) && !empty( $chimp_list_id ) ){
			$mc = new MailChimp( $chimp_api );
			$result = $mc->call('lists/subscribe', array(
				'id'                => $chimp_list_id,
				'email'             => array( 'email' => $email ),
 				'merge_vars'       	=> $merge_vars
			));
			
			if( $result === false) {
				$response['error'] = __( 'There was an error contacting the API, please try again.', 'portfolio' );
			}
			else if( isset($result['status']) && $result['status'] == 'error' ){
				$response['error'] = __( 'You are already subscribed.', 'portfolio' );
			}
			else{
				$response['success'] = __( 'You have successuffly subscribed to the newsletter.', 'portfolio' );
			}
			
		}
		else{
			$response['error'] = __( 'API data are not yet set.', 'portfolio' );
		}
	}
	else{
		$response['error'] = __( 'Email is empty or invalid.', 'portfolio' );
	}


	echo json_encode( $response );
	die();
	


}
	add_action('wp_ajax_portfolio_subscribe', 'portfolio_save_subscribe' );
	add_action('wp_ajax_nopriv_portfolio_subscribe', 'portfolio_save_subscribe' );


/*===================================================
	CONTACT FUNCTIONS
=====================================================*/
function portfolio_send_contact(){
	$errors 	= array();
	$name 		= esc_attr( $_POST['name'] );	
	$email 		= esc_attr( $_POST['email'] );
	$message 	= esc_attr( $_POST['message'] );

	if( empty( $name ) || empty( $email ) || empty( $message ) ){
		$response = array(
			'error' => __( 'All fields are required.', 'portfolio' ),
		);
	}
	else if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
		$response = array(
			'error' => __( 'E-mail address is not valid.', 'portfolio' ),
		);	
	}
	else{
		$email_to 	= portfolio_get_option( 'email_info_id' );
		$subject 	= portfolio_get_option( 'subject_info_id' );
		$message 	= "
			\n".__( 'Name: ', 'portfolio' )." {$name}		
			\n".__( 'Email: ', 'portfolio' )."{$email}
			\n".__( 'Message: ', 'portfolio' )."\n{$message}\n 
		";
		
		$info = @wp_mail( $email_to, $subject, $message);
		if( $info ){
			$response = array(
				'success' => __( 'Your message was successfully submitted.', 'portfolio' ),
			);
		}
		else{
			$response = array(
				'error' => __( 'Unexpected error while attempting to send e-mail.', 'portfolio' ),
			);
		}
		
	}
	
	echo json_encode( $response );
	die();	
}
add_action('wp_ajax_contact', 'portfolio_send_contact');
add_action('wp_ajax_nopriv_contact', 'portfolio_send_contact');


/*===================================================
	String Length
=====================================================*/
	function cut_string_words($words){
		$length = strlen($words);
		if( $length > 110 ){
			return substr( $words, 0, 110)."...";
		}
		else {
			return $words;
		}
	}



?>			