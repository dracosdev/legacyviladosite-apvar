<?php 


// Cria o menu principal
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'menu_princ', 'Este é o menu principal do site' );
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