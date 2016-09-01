<?php 

function portfolio_tabs_func( $atts, $content ){
	extract( shortcode_atts( array(
		'tab_titles' => '',
		'tab_contents' => ''
	), $atts ) );

	$tab_titles = explode( "/n/", $tab_titles );
	$tab_contents = explode( "/n/", $tab_contents );

	$tab_titles_html = '';
	$tab_contents_html = '';

	$random = portfolio_random_string();

	if( !empty( $tab_titles ) ){
		for( $i=0; $i<sizeof( $tab_titles ); $i++ ){
			$tab_titles_html .= '<li role="presentation" class="'.( $i == 0 ? esc_attr( 'active' ) : '' ).'"><a href="#tab_'.esc_attr( $i ).'_'.esc_attr( $random ).'" role="tab" data-toggle="tab">'.$tab_titles[$i].'</a></li>';
			$tab_contents_html .= '<div role="tabpanel" class="tab-pane fade '.( $i == 0 ? esc_attr( 'in active' ) : '' ).'" id="tab_'.esc_attr( $i ).'_'.esc_attr( $random ).'">'.( !empty( $tab_contents[$i] ) ? apply_filters( 'the_content', $tab_contents[$i] ) : '' ).'</div>';
		}
	}

	return '
		<!-- Nav tabs -->
		<div class="nav-tabs-wrap text-center">
			<ul class="nav nav-tabs" role="tablist">
		  		'.$tab_titles_html.'
			</ul>
		</div>

		<!-- Tab panels -->
		<div class="tab-content">
		  '.$tab_contents_html.'
		</div>';
}

	add_shortcode( 'tabs', 'portfolio_tabs_func' );



/*========================================
	Tab Parametars for shortcodes.php
==========================================*/
function portfolio_tabs_params(){
	return array(
		array(
			"type"			=> "textarea",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Tab Headline Text", "portfolio"),
			"param_name"	=> "tab_titles",
			"value" 		=> "",
			"description" 	=> __("Insert Tab Headline", "portfolio")
		),
		array(
			"type"			=> "textarea",
			"holder"		=> "div",
			"class"			=> "",
			"heading"		=> __("Tab Content Text", "portfolio"),
			"param_name"	=> "tab_contents",
			"value" 		=> "",
			"description" 	=> __("Insert Tabs Content", "portfolio")
		)
	);
}



?>