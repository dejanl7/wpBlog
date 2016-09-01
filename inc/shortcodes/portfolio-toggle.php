<?php 

function portfolio_toggle_function( $atts, $content ){
	extract( shortcode_atts(array(
		'toggle_headline' 	=> '',
		'toggle_content' 	=> '',
		'toggle_state'		=> '',
	), $atts) );

	$random = portfolio_random_string();

	return '
		<div class="panel-group">
		  <button type="button" class="btn btn-default btn-block" id="button_'. esc_attr($random) .'" data-toggle="collapse" data-target="#'. esc_attr($random) .'">'.
		  		esc_attr($toggle_headline)
		  .'
		  </button>
		  <div id="'. esc_attr($random) .'" class="collapse '. esc_attr($toggle_state) .'">'.
		  	apply_filters('the_content', $toggle_content)
		  .'
		  </div>
		</div>
	';
}

	add_shortcode('toggle', 'portfolio_toggle_function');



/*========================================
	Toggle Parametars for shortcodes.php
==========================================*/
function portfolio_toggle_params(){
	return array(
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Toggle Box Headline", "portfolio"),
			"param_name"	=> "toggle_headline",
			"value" 		=> "",
			"description" 	=> __("Insert Headline for Toggle", "portfolio")
		),
		array(
			"type"			=> "textarea",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Toggle Content Text", "portfolio"),
			"param_name"	=> "toggle_content",
			"value" 		=> "",
			"description" 	=> __("Insert Content for Toggle", "portfolio")
		),
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Toggle State", "portfolio"),
			"param_name"	=> "toggle_state",
			"value" 		=> array(
				__( 'Oppened', '' ) 	=> 'in',
				__( 'Collapsed', '' ) 	=> '',
			),
			"description" 	=> __("Open or Close State of the Toggle Content", "portfolio")
		)
	);
}


?>