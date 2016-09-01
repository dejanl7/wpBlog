<?php

/*=========================================
	Manipulate with External MCE Plugin
	with custom created class "Shortcodes"
===========================================*/
class Shortcodes{
  // Construct function for Shortcodes...
	function __construct(){
		// Add Action - Register MCE
		add_action( 'init', array( $this, 'custom_buttons' ) );
		add_action('wp_ajax_shortcode_call', array( $this, 'shortcode_options' ) );
		add_action('wp_ajax_nopriv_shortcode_call', array( $this, 'shortcode_options' ) );
	}

  // Register Custom Buttons
	function custom_buttons(){
		add_filter( 'mce_external_plugins',  array( $this, 'portfolio_external_js') );
		add_filter( 'mce_buttons',  array( $this, 'portfolio_buttons') );
	}
  // Connect our class with external javascript file
		function portfolio_external_js($plugin_array){
			$plugin_array['portfolio'] = get_template_directory_uri() . '/js/shortcodes.js';
			return $plugin_array;
		}
  // Register all custom button options (in dropdown menu)
		function portfolio_buttons($buttons){
			array_push( $buttons, 'portfolio_button', 'portfolio_elements' );
			return $buttons;
		}


  // Use value type from Shortcode files and put it into "portfolio_options($inputs)" looop 
	function shortcode_options(){
		$options = 'portfolio_'.$_POST['shortcode'].'_params';
		//$options = 'portfolio_icon_params';
		$this->portfolio_options( $options() );
		die();
	}

 
  // Function for rendering shortcodes
	function portfolio_options( $inputs ){
		$html = '';
		foreach( $inputs as $input ){
			$html .= '<div class="shortcode-options"><label>'.$input['heading'].'</label>';
			switch ( $input['type'] ){
				case 'dropdown':
					$options = '';
						if( !empty( $input['value'] ) ){
							foreach( $input['value'] as $opt_name => $opt_value ){
								$options .= '<option value="'. esc_attr($opt_value) .'">'.$opt_name.'</option>';	
							}
						}
					$html .= '<select name="'. esc_attr($input['param_name']) .'" class="shortcode-field">'.$options.'</select>';
				break;
				case 'colorpicker':
					$html .= '<input type="text" name="'.esc_attr( $input['param_name'] ).'" class="shortcode-field shortcode-colorpicker" value="'.esc_attr( $field['value'] ).'" />';
				break;
				case 'textfield':
					$html .= '<input type="text" name="'.esc_attr( $input['param_name'] ).'" class="shortcode-field shortcode-text-field" value="'.esc_attr( $field['value'] ).'" />';
				break;
				case 'textarea' :					
					$html .= '<textarea name="'.esc_attr( $input['param_name'] ).'" class="shortcode-field">'.esc_attr($field['value']).'</textarea>';
				break;
			}
			$html .= '<small class="description">'.esc_attr($input['description']).'</small></div>';
		}
		echo $html .'<a href="javascript:;" class="shortcode-save-options button">'.__( 'Insert', 'portfolio' ).'</a>';
		
		die();
	}



} // End of class


$portfolio_shortcodes = new Shortcodes();


?>