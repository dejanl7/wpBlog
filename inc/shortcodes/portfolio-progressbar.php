<?php 
/*========================================
	Button Progressbar - Basic Settings
==========================================*/
function portfolio_progressbar_shortcode( $atts, $content ){
	$progressbar_array = array(
		'width' 					=> 'normal',
		'height'					=> 'normal',
		'background_color'			=> '',
		'active_background_color'	=> '',
		'font_color'				=> '',
		'progressbar_text'			=> '',
		'value'						=> '',
		'active'					=> '',
		'label_background_color'	=> '',
		'label_font_color'			=> '',
	);
		extract( shortcode_atts( $progressbar_array, $atts ) );
		
		$random = portfolio_random_string();
	
	echo '
		<style>
			.'. $random .' {
				width: '. ( $width == "normal" ? "60" : ( $width == "tiny" ? "30" : "100" ) ) .'%;
				height: '. ( $height == "normal" ? "40px" : ( $height == "tiny" ? "30px" : "50px" ) ) .';
				background-color: '. ( empty($background_color) ? "#cccccc" : esc_attr($background_color) ).';
			}
			.'. $random .' .myBar {
				width:'.( $value == 0 ? "1" : esc_attr($value) ) .'%;
				height: '. ( $height == "normal" ? "40px" : ( $height == "tiny" ? "30px" : "50px" ) ) .';
				background-color: '. ( empty($active_background_color) ? "blue" : esc_attr($active_background_color) ).';
			}
			.'. $random .' .myBar h5 {
				color:'. ( empty($font_color) ? "#000000" : esc_attr($font_color) ) .';
			}
			.'. $random .' span.value-label {
				background-color: '. ( empty($label_background_color) ? "#cccccc" : esc_attr($label_background_color) ) .';
				color: '. ( empty($label_font_color) ? "#000000" : esc_attr($label_font_color) ) .';
				'. ( $value <= 15 ? "left: 1%;" : "right:-3%;") .'
			}
		</style>
	';
	
	return '
		<div class="portfolio-progressbar '. $random .'">
			<div class="myBar progress-bar progress-bar progress-bar-striped '. ( empty($active) ? "" : "active" ) .'" role="progressbar" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100" width="47%">
				<span class="value-label">'.  ( $value == "" ? "0" : esc_attr($value) ) .'%</span>
				<h5 class="'.( $height == "normal" ? "progressbar-shortcode-normal" : ( $height == "tiny" ? "progressbar-shortcode-tiny" : "progressbar-shortcode-large" ) ).'" >
					'. esc_attr($progressbar_text) .'
				</h5>		
			</div>
		</div>';
}
	add_shortcode( 'progressbar', 'portfolio_progressbar_shortcode' );



/*========================================
	Progressbar Parametars for 
	shortcodes.php
==========================================*/
	function portfolio_progressbar_params(){
		return array(
			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Progressbar Width", "portfolio"),
				"param_name"	=> "width",
				"value" 		=> array(
					__( 'Normal', 'portfolio' ) 		=> 'normal',
					__( 'Tiny', 'portfolio' ) 			=> 'tiny',
					__( 'Full width', 'portfolio' ) 	=> 'large'
				),
				"description" 	=> __("Insert Progressbar Width", "portfolio")
			),
			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Progressbar Height", "portfolio"),
				"param_name"	=> "height",
				"value" 		=> array(
					__( 'Normal', 'portfolio' ) => 'normal',
					__( 'Tiny', 'portfolio' ) 	=> 'tiny',
					__( 'Large', 'portfolio' ) 	=> 'large'
				),
				"description" 	=> __("Insert Progressbar Height", "portfolio")
			),
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Progressbar Background Color", "portfolio"),
				"param_name"	=> "background_color",
				"value"			=> "",
				"description" 	=> __("Insert Background Color for Whole Progressbar", "portfolio")
			),
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Progressbar Activate Background Color", "portfolio"),
				"param_name"	=> "active_background_color",
				"value"			=> "",
				"description" 	=> __("Insert Background Color for Active Progressbar Part - visual effect", "portfolio")
			),
			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Progressbar Text", "portfolio"),
				"param_name"	=> "progressbar_text",
				"value" 		=> "",
				"description" 	=> __("Insert Text Into Progressbar", "portfolio")
			),
			array(
				"type"			=> "textfield",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Progressbar Value <span>(in %)</span>", "portfolio"),
				"param_name"	=> "value",
				"value" 		=> "",
				"description" 	=> __("Insert Value for Progressbar", "portfolio")
			),
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Progressbar Font Color", "portfolio"),
				"param_name"	=> "font_color",
				"value"			=> "",
				"description" 	=> __("Insert Font Color Text (description) Into Progressbar", "portfolio")
			),
			array(
				"type"			=> "dropdown",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Active or Static Progressbar Line", "portfolio"),
				"param_name"	=> "active",
				"value" 		=> array(
					__( 'Active', 'portfolio' ) => 'active',
					__( 'Static', 'portfolio' ) => '',
				),
				"description" 	=> __("Activate Progressbar or Leave it Static", "portfolio")
			),
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Progressbar Label Background Color", "portfolio"),
				"param_name"	=> "label_background_color",
				"value"			=> "",
				"description" 	=> __("Insert Background Color for Progressbar Label", "portfolio")
			),
			array(
				"type"			=> "colorpicker",
				"holder"		=> "div",
				"class"			=> "",
				"heading"		=> __("Progressbar Label Font Color", "portfolio"),
				"param_name"	=> "label_font_color",
				"value"			=> "",
				"description" 	=> __("Insert Font Color for Progressbar Label", "portfolio")
			),


		);
	}

?>