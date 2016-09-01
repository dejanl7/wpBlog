<?php 	


/*================================================
	Custom Functions for Meta Boxes
==================================================*/
function portfolio_smeta_images( $meta_key, $post_id, $default ){
	if(class_exists('SM_Frontend')){
		global $sm;
		return $result = $sm->sm_get_meta($meta_key, $post_id);
	}
	else{		
		return $default;
	}
}



/*==================================================
	Custom Meta Boxes - Plugin Options
====================================================*/
function portfolio_custom_meta(){
	/* Custom Meta Box - GALLERY */
	$post_meta_gallery = array(
		array(
			'id' 	=> 'portfolio_gallery_images',
			'name' 	=> __( 'Add images for the gallery', 'portfolio' ),
			'type' 	=> 'image',
			'repeatable' => 1
		)
	);
		$meta_boxes[] = array(
			'title' 	=> __( 'Galery Information for this Post', 'portfolio' ),
			'pages' 	=> 'post',
			'fields' 	=> $post_meta_gallery,
		);	


	/* Custom Meta Box - VIDEO */
	$post_meta_video = array(
		array(
			'id' 	=> 'portfolio_video',
			'name'	=> __( 'Isert video URL', 'portfolio' ),
			'type' 	=> 'text',
		),
		array(
			'id' 		=> 'portfolio_video_type',
			'name' 		=> __( 'Select video type', 'portfolio' ),
			'type' 		=> 'select',
			'options'	=> array(
				'self' 	=> __( 'Self Hosted', 'portfolio' ),
				'remote'=> __( 'Embed', 'portfolio' ),
			)
		),
	);
		$meta_boxes[] = array(
			'title' 	=> __( 'Video Post Information', 'portfolio' ),
			'pages'		=> 'post',
			'fields'	=> $post_meta_video,
		);

	/* Custom Meta Box - Audio */
	$post_meta_audio = array(
		array(
			'id' 	=> 'portfolio_audio',
			'name'	=> __( 'Insert audio URL', 'portfolio' ),
			'type' 	=> 'text',
		)
	);
		$meta_boxes[] = array(
			'title'		=> __( 'Audio Post Information', 'portfolio'),
			'pages'		=> 'post',
			'fields'	=> $post_meta_audio,
		);

	/* Custom Meta Box - Quote */
	$post_meta_quote = array(
		array(
			'id' 	=> 'portfolio_quote',
			'name'	=> __( 'Insert Quote Author', 'portfolio' ),
			'type' 	=> 'text',
		),
	);	
		$meta_boxes[] = array(
			'title'		=> __( 'Quote Author Name', 'portfolio'),
			'pages'		=> 'post',
			'fields'	=> $post_meta_quote,
		);



	return $meta_boxes;
}
	add_filter('sm_meta_boxes', 'portfolio_custom_meta');

?>