<?php 


// Cria o menu principal
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'menu_princ', 'Este é o menu principal do site' );
}

/**
 * Criando uma area de widgets
 *
 */
function widgets_novos_widgets_init() {

	register_sidebar( array(
		'name' => 'lateral_right',
		'id' => 'lat_right_widgets',
		'before_widget' => '<div class="widget-space row">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="main-title col-md-12">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'widgets_novos_widgets_init' );

class ouvidoria_widget extends WP_Widget {
	
	function __construct() {
	parent::__construct(
	// widget ID
	'ouvidoria_widget',
	// widget name
	__('Ouvidoria Sample Widget', ' ouvidoria_widget_domain'),
	// widget description
	array( 'description' => __( 'Ouvidoria Widget Use', 'ouvidoria_widget_domain' ), )
	);
	}
 
}


function carrega_scripts(){

	wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), null, 'all');

	wp_enqueue_style('style', get_template_directory_uri().'/css/style.css', array(), null, 'all');


	wp_enqueue_script('template', get_template_directory_uri().'/js/template.js', array(), null, true);

	wp_enqueue_script('template', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), null, true);

	wp_enqueue_script('template', 'https://use.fontawesome.com/releases/v5.0.10/js/all.js', array('jquery'), null, true);
	
}

add_action('wp_enqueue_scripts', 'carrega_scripts');

 ?>