<?php 

// ----------------------------------------------------------
// Funções e recursos básicos do template
// ----------------------------------------------------------


// Adiciona suporte à imagens de destaque em posts e páginas
add_theme_support('post-thumbnails');

// Cria o menu principal
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'menu_princ', 'Este é o menu principal do site' );
}

// Modifica o excerpt padrão para 20 caracteres
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


// Modifica o link de leia mais do excerpt padrão para deixa-lo vazio e montar direto no html
function wpdocs_excerpt_more( $more ) {
    return '';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );




// ----------------------------------------------------------
// Scripts
// ----------------------------------------------------------


// Carrega os scripts de javascript, bootstrap e etc
function carrega_scripts(){

	wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), null, 'all');

	wp_enqueue_style('style', get_template_directory_uri().'/css/style.css', array(), null, 'all');


	wp_enqueue_script('template', get_template_directory_uri().'/js/template.js', array(), null, true);

	wp_enqueue_script('template', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), null, true);

	wp_enqueue_script('template', 'https://use.fontawesome.com/releases/v5.0.10/js/all.js', array('jquery'), null, true);
	
}

// Registra o carregamento dos scripts
add_action('wp_enqueue_scripts', 'carrega_scripts');


// ----------------------------------------------------------
// Sidebars
// ----------------------------------------------------------


// Criando as sidebars básicas do template
function sidebars_init() {

	register_sidebar( array(
		'name' => 'lateral_right',
		'id' => 'lat_right_widgets',
		'description' => esc_html('Widget da direita da home'),
		'before_widget' => '<div class="widget-space row">',
		'after_widget' => '</div> <div class="separator col-md-12"></div> <div class="clearfix"></div>',
		'before_title' => '<h4 class="main-title col-md-12">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'lateral_right_institucional',
		'id' => 'lat_right_institucional_widgets',
		'description' => esc_html('Widget da direita da Institucional'),
		'before_widget' => '<div class="widget-space row">',
		'after_widget' => '</div> <div class="separator col-md-12"></div> <div class="clearfix"></div>',
		'before_title' => '<h4 class="main-title col-md-12">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'lateral_right_opiniao',
		'id' => 'lat_right_opiniao_widgets',
		'description' => esc_html('Widget da direita da Opiniao'),
		'before_widget' => '<div class="widget-space row">',
		'after_widget' => '</div> <div class="separator col-md-12"></div> <div class="clearfix"></div>',
		'before_title' => '<h4 class="main-title col-md-12">',
		'after_title' => '</h4>',
	) );

}

// Registra a inicialização das sidebars
add_action( 'widgets_init', 'sidebars_init' );




// ----------------------------------------------------------
// Widgets
// ----------------------------------------------------------


// Cria o widget de Ouvidoria
class ouvidoria_widget extends WP_Widget {
	
	function __construct() {
	parent::__construct(
	// widget ID
	'ouvidoria_widget',
	// widget name
	__('Ouvidoria Widget', ' ouvidoria_widget_domain'),
	// widget description
	array( 'description' => __( 'Widget used to show Ouvidoria', 'ouvidoria_widget_domain' ), )
	);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		//if title is present
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
		//output
		echo __( '<p class="ouvidoria-text">
			Envie-nos suas Sugestões, Dúvidas, Reclamações etc.
			<a href="http://www.apvar.org.br/v1/ouvidoria/">Clique aqui >>>> </a>
			</p>' );

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		$title = $instance[ 'title' ];
		else
		$title = __( 'Ouvidoria', 'hstngr_widget_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
 
}



// Registra e inicializa os widgets
function register_widgets() {
	
	register_widget( 'ouvidoria_widget' );

}

add_action( 'widgets_init', 'register_widgets' );


 ?>