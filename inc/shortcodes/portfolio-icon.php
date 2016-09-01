<?php
/*========================================
	Icons Shortcode - Basic Settings
==========================================*/
function portfolio_icon_func( $atts, $content ){
	extract( shortcode_atts( array(
		'icon' => '',
		'color' => '',
		'size' => '',
	), $atts ) );

	return '<span class="fa fa-'.esc_attr( $icon ).'" style="color: '.esc_attr( $color ).'; font-size: '.esc_attr( $size ).'; margin: 0px 2px;"></span>';
}

add_shortcode( 'icon', 'portfolio_icon_func' );



/*========================================
	Icons Parametars, for shortcode.php
==========================================*/
function portfolio_icon_params(){
	return array(
		array(
			"type" 			=> "dropdown",
			"holder" 		=> "div",
			"class" 		=> "",
			"heading" 		=> __("Select Icon","portfolio"),
			"param_name" 	=> "icon",
			"value" 		=> portfolio_awesome_icons_list(),
			"description" 	=> __("Select an icon you want to display.","portfolio")
		),
		array(
			"type" 			=> "colorpicker",
			"holder" 		=> "div",
			"class" 		=> "",
			"heading" 		=> __("Icon Color","portfolio"),
			"param_name" 	=> "color",
			"value" 		=> '',
			"description" 	=> __("Select color of the icon.","portfolio")
		),
		array(
			"type"			=> "textfield",
			"holder" 		=> "div",
			"class" 		=> "",
			"heading" 		=> __("Icon Size (in px or pt)","portfolio"),
			"param_name" 	=> "size",
			"value" 		=> '',
			"description" 	=> __("Input size of the icon.","portfolio")
		),

	);
}



?>