<?php 
/*========================================
	Alert - Basic Settings
==========================================*/
function portfolio_alert_shortcode( $atts, $content ){
	$alert_array = array(
		'width' 					=> 'normal',
		'height'					=> 'normal',
		'background_color'			=> '',
		'font_color'				=> '',
		'alert_text'				=> '',
		'close'						=> 'yes',
	);

	extract( shortcode_atts($alert_array, $atts) );
	$random = portfolio_random_string();
	
	echo '
		<style>
			.'. $random .' {
				width: '. ( $width == "normal" ? "60%" : ( $width == "tiny" ? "30%" : "100%" ) ) .';
				height: '. ( $height == "normal" ? "40px" : ( $height == "tiny" ? "30px" : "50px" ) ) .';
				background-color: '. ( empty($background_color) ? "rgb(255, 26, 26)" : esc_attr($background_color) ).';
				color: '. ( empty($font_color) ? '#ffffff' : esc_attr($font_color) ) .';
			}
			.'. $random .' a.close {
				background-color: '. ( empty($close_background_color) ? "#ffffff" : esc_attr($close_background_color) ).';
				color: '. ( empty($close_font_color) ? '#000000' : esc_attr($close_font_color) ) .'; 
			}		
		</style>
	';

	return '
		<div class="alert fade in '. $random .' '.  ( $height == "normal" ? "alert-shortcode-normal" : ( $height == "tiny" ? "alert-shortcode-tiny" : "alert-shortcode-large" ) )  .'">
			'. ( $close == "yes" ? "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" : "" ).'
		    <strong>'. ( empty($alert_text) ? "Alert label" : esc_attr($alert_text) ) .'</strong>
		</div>
	';
}

	add_shortcode( 'alert', 'portfolio_alert_shortcode' );



/*========================================
	Alert Parametars for shortcodes.php
==========================================*/
	function portfolio_alert_params(){
		return array(
			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Alert Box Width", "portfolio"),
				"param_name"	=> "width",
				"value" 		=> array(
					__( 'Normal', 'portfolio' ) 		=> 'normal',
					__( 'Tiny', 'portfolio' ) 			=> 'tiny',
					__( 'Full width', 'portfolio' ) 	=> 'large'
				),
				"description" 	=> __("Insert Width for Alert Box", "portfolio")
			),
			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Alert Box Height", "portfolio"),
				"param_name"	=> "height",
				"value" 		=> array(
					__( 'Normal', 'portfolio' ) 		=> 'normal',
					__( 'Tiny', 'portfolio' ) 			=> 'tiny',
					__( 'Full width', 'portfolio' ) 	=> 'large'
				),
				"description" 	=> __("Insert Height for Alert Box", "portfolio")
			),
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Alert Background Color", "portfolio"),
				"param_name"	=> "background_color",
				"value"			=> "",
				"description" 	=> __("Insert Background Color for Alert Box", "portfolio")
			),
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Alert Font Color", "portfolio"),
				"param_name"	=> "font_color",
				"value"			=> "",
				"description" 	=> __("Insert Font Color for Alert Box", "portfolio")
			),
			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Alert Box Text", "portfolio"),
				"param_name"	=> "alert_text",
				"value" 		=> "",
				"description" 	=> __("Insert Text Into Alert Box - description", "portfolio")
			),
			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Show Close (x) Button", "portfolio"),
				"param_name"	=> "close",
				"value" 		=> array(
					__( 'Show', 'portfolio' ) 		=> 'yes',
					__( 'Hide', 'portfolio' ) 		=> 'no',
				),
				"description" 	=> __("Show or Hide Close (x) Button Into Alert Box", "portfolio")
			),
		);
	}
?>