<?php 

/*========================================
	Button Shortcode - Basic Settings
==========================================*/
function portfolio_button_shortcode( $atts, $content ){
	$button_array = array(
		'text' 				=> 'Button',
		'link' 				=> '',
		'target' 			=> '',
		'bg_color'			=> '',
		'bg_color_hover'	=> '',
		'border_radius'	 	=> '',
		'icon' 				=> '',
		'font_color'		=> '',
		'font_color_hover' 	=> '',
		'size' 				=> 'normal',
		'align' 			=> '',
		'btn_width' 		=> 'normal',
		'inline' 			=> 'no',
	);
	extract( shortcode_atts( $button_array, $atts ) );

	$random = portfolio_random_string();

	$style_css = '
	<style>
		a.'.$random.', a.'.$random.':active, a.'.$random.':visited, a.'.$random.':focus{
			display: '.( $btn_width == 'normal' ? 'inline-block' : 'block' ).';
			'.( !empty( $bg_color ) ? 'background-color: '.$bg_color.';' : '' ).'
			'.( !empty( $font_color ) ? 'color: '.$font_color.';' : '' ).'
			'.( !empty( $border_radius ) ? 'border-radius: '.$border_radius.';' : '' ).'
		}
		a.'.$random.':hover{
			display: '.( $btn_width == 'normal' ? 'inline-block' : 'block' ).';
			'.( !empty( $bg_color_hover ) ? 'background-color: '.$bg_color_hover.';' : '' ).'
			'.( !empty( $font_color_hover ) ? 'color: '.$font_color_hover.';' : '' ).'
		}		
	</style>
	';

	return portfolio_shortcode_style( $style_css ).'
	<div class="btn-wrap" style="text-align: '.esc_attr( $align ).'; '.( $inline == 'yes' ? esc_attr( 'display: inline-block;' ) : '' ).' '.( $inline == 'yes' && $align == 'right' ? esc_attr( 'float: right;' ) : '' ).'">
		<a href="'.esc_url( $link ).'" class="btn btn-default '.esc_attr( $size ).' '.esc_attr( $random ).' '.( $link != '#' && $link[0] == '#' ? esc_attr( 'slideTo' ) : '' ).' '.( !empty( $text ) ? 'icon-margin' : '' ).'" target="'.esc_attr( $target ).'">
			'.( $icon != 'No Icon' && $icon != '' ? '<i class="fa fa-'.esc_attr( $icon ).' '.( empty( $text ) ? 'no-margin' : '' ).'"></i>' : '' ).'
			'.$text.'
		</a>
	</div>';
}

	add_shortcode( 'button', 'portfolio_button_shortcode' );



/*========================================
	Button Parametars for shortcodes.php
==========================================*/
function portfolio_button_params(){
	return array(
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Button Text", "portfolio"),
			"param_name"	=> "text",
			"value"			=> "",
			"description" 	=> __("Insert Button Text", "portfolio")
		),
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Button Font Size <span>(px or pt)</span>", "portfolio"),
			"param_name"	=> "size",
			"value" 		=> array(
				__( 'Normal', 'portfolio' ) => 'normal',
				__( 'Medium', 'portfolio' ) => 'medium',
				__( 'Large', 'portfolio' ) 	=> 'large'
			),
			"description" 	=> __("Insert Button Text Size", "portfolio")
		),
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Window Open", "portfolio"),
			"param_name"	=> "target",
			"value"			=> array(
				__( 'Same Window', 'portfolio' ) => '_self',
				__( 'New Window', 'portfolio' ) => '_blank',
			),
			"description" 	=> __("Open Window Options", "portfolio")
		),
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Insert Button Link", "portfolio"),
			"param_name"	=> "link",
			"value"			=> "",
			"description" 	=> __("Insert Button Link", "portfolio")
		),
		array(
			"type" 			=> "textfield",
			"holder" 		=> "div",
			"class" 		=> "",
			"heading" 		=> __("Button Border Radius","portfolio"),
			"param_name" 	=> "border_radius",
			"value" 		=> '',
			"description" 	=> __("Input button border radius. For example 5px or 5px 9px 0px 0px or 50% or 50% 50% 20% 10%.","portfolio")
		),
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Button Background Color", "portfolio"),
			"param_name"	=> "bg_color",
			"value"			=> "",
			"description" 	=> __("Insert Background Color", "portfolio")
		),
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Button Background Hover Color", "portfolio"),
			"param_name"	=> "bg_color_hover",
			"value"			=> "",
			"description" 	=> __("Insert Background Hover Color", "portfolio")
		),
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Button Font Color", "portfolio"),
			"param_name"	=> "font_color",
			"value"			=> "",
			"description" 	=> __("Insert Font Color", "portfolio")
		),
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Button Font Hover Color", "portfolio"),
			"param_name"	=> "font_color_hover",
			"value"			=> "",
			"description" 	=> __("Insert Font Hover Color", "portfolio")
		),
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
			"type" 			=> "dropdown",
			"holder" 		=> "div",
			"class" 		=> "",
			"heading" 		=> __("Button Align","portfolio"),
			"param_name" 	=> "align",
			"value" => array(
				__( 'Left', 'portfolio' ) 	=> 'left',
				__( 'Center', 'portfolio' ) => 'center',
				__( 'Right', 'portfolio' ) 	=> 'right',
			),
			"description" => __("Select button align.","portfolio")
		),
		array(
			"type" 			=> "dropdown",
			"holder" 		=> "div",
			"class" 		=> "",
			"heading" 		=> __("Select Button Width","portfolio"),
			"param_name" 	=> "btn_width",
			"value"			=> array(
				__( 'Normal', 'portfolio' )		=> 'normal',
				__( 'Full Width', 'portfolio' ) => 'full',
			),
			"description" 	=> __("Select button width.","portfolio")
		),
		array(
			"type" 			=> "dropdown",
			"holder" 		=> "div",
			"class" 		=> "",
			"heading" 		=> __("Display Inline","portfolio"),
			"param_name" 	=> "inline",
			"value" 		=> array(
				__( 'No', 'portfolio' ) 	=> 'no',
				__( 'Yes', 'portfolio' ) 	=> 'yes',
			),
			"description" 	=> __("Display button inline.","portfolio")
		),


	);
}


?>