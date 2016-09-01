<?php

function portfolio_accordion_function( $atts, $content ){
	extract( shortcode_atts( array(
		'accordion_headlines' => '',
		'accordion_contents' => ''
	), $atts ) );

	$accordion_headlines = explode( "/n/", $accordion_headlines );
	$accordion_contents = explode( "/n/", $accordion_contents );

	$accordion_headlines_html = '';
	$accordion_contents_html = '';

	$random = portfolio_random_string();

	$html = '';

	if( !empty( $accordion_headlines ) ){
		for( $i=0; $i<sizeof( $accordion_headlines ); $i++ ){
			if( !empty( $accordion_headlines[$i] ) ){
				$html .= '
				  <div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="heading_'.esc_attr( $i ).'">
				      <div class="panel-title">
				        <a class="'.( $i !== 0 ? esc_attr( 'collapsed' ) : '' ).'" data-toggle="collapse" data-parent="#accordion_'.esc_attr( $random ).'" href="#coll_'.esc_attr( $i ).'_'.esc_attr( $random ).'" aria-expanded="true" aria-controls="coll_'.esc_attr( $i ).'_'.esc_attr( $random ).'">
				        	'.$accordion_headlines[$i].'
				        	<span class="title-active"></span>
				        </a>
				      </div>
				    </div>
				    <div id="coll_'.esc_attr( $i ).'_'.esc_attr( $random ).'" class="panel-collapse collapse '.( $i == 0 ? esc_attr( 'in' ) : '' ).'" role="tabpanel" aria-labelledby="heading_'.esc_attr( $i ).'">
				      <div class="panel-body">
				        '.( !empty( $accordion_contents[$i] ) ? apply_filters( 'the_content', $accordion_contents[$i] ) : '' ).'
				      </div>
				    </div>
				  </div>
				';
			}
		}
	}

	return '
		<div class="panel-group" id="accordion_'.esc_attr( $random ).'" role="tablist" aria-multiselectable="true">
		'.$html.'
		</div>';
}

	add_shortcode( 'accordion', 'portfolio_accordion_function' );


/*========================================
	Accordion Parametars for shortcodes.php
==========================================*/
function portfolio_accordion_params(){
	return array(
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Accordion Shortcode Title", "portfolio"),
			"param_name"	=> "accordion_headlines",
			"value" 		=> "",
			"description" 	=> __("Insert Headline for Accordion. Separate Tabs with \" /n/ \". ", "portfolio")
		),
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Accordion Shortcode Text", "portfolio"),
			"param_name"	=> "accordion_contents",
			"value" 		=> "",
			"description" 	=> __("Insert Accordion Description. Separate Tabs with \" \". ", "portfolio")
		),
	);
}

?>