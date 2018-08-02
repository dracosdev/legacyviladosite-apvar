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

// Modifica o link de leia mais do excerpt padrão para deixa-lo vazio e montar direto no html
function wpdocs_excerpt_more( $more ) {
    return '';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );


// Função para delimitar o excerpt
function the_excerpt_max($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;

    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo $subex;
        }
        echo '[...]';
    } else {
        echo $excerpt;
    }
}



// Função para delimitar o title
function the_title_max($thelength) {
    $thetitle = get_the_title(); /* or you can use get_the_title() */
    $getlength = strlen($thetitle);
    echo substr($thetitle, 0, $thelength);
    if ($getlength > $thelength) echo "...";
}


// Função para carregar post na home com imagem
function post_comimagem() {
	?>
	<div class="foto-materia col-md-4">
		<?php the_post_thumbnail(); ?>
	</div>

    <div class="main col-md-8">
    	<a href=' <?php echo the_permalink(); ?> '>
	    	<h4 class="m-title"> <?php echo the_title(); ?> </h4>
    		<p> <?php the_excerpt_max(200); ?> </p>
		</a>
	</div>
	<?php
}

// Função para carregar post na home sem imagem
function post_semimagem() {
	?>
    <div class="main col-md-12">
    	<a href=' <?php echo the_permalink(); ?> '>
	    	<h4 class="m-title"> <?php echo the_title(); ?> </h4>
    		<p> <?php the_excerpt_max(200); ?> </p>
		</a>
	</div>
	<?php
}

// Função para verificar se o post tem ou não imagem e carregar a versão correta
function post_checaimg() {
	if (has_post_thumbnail($post->ID)) {
		post_comimagem();
	} else {
		post_semimagem();
	}
}



// Função para verificar se uma página tem páginas filhas
function tem_filhos($post_ID = null) {
    if ($post_ID === null) {
        global $post;
        $post_ID = $post->ID;
    }
    $query = new WP_Query(array('post_parent' => $post_ID, 'post_type' => 'any'));

    return $query->have_posts();
}


// Função para carregar as páginas filhas de um item
function pega_filhos() {
	$childArgs = array(
	'sort_order' => 'ASC',
    'sort_column' => 'menu_order',
    'child_of' => get_the_ID()
	);
	
	$childList = get_pages($childArgs);

	foreach ($childList as $child) { ?>
		<br>
		<br>

		<div class="chamada col-md-1 col-xs-1">
	    	<h2><?php echo $child->post_title; ?></h2>
		</div>

		<div class="chamada-conteudo-dir col-md-11 col-xs-11">
    	    <?php echo apply_filters( 'the_content', $child->post_content); ?>
		</div>

	<?php }
}






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
		'name' => 'Página Inicial (Direita)',
		'id' => 'lat_right_widgets',
		'description' => esc_html('Widget da direita da home'),
		'before_widget' => '<div class="widget-space row">',
		'after_widget' => '</div> <div class="separator col-md-12"></div> <div class="clearfix"></div>',
		'before_title' => '<h4 class="main-title col-md-12">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'Institucional (Direita)',
		'id' => 'lat_right_institucional_widgets',
		'description' => esc_html('Widget da direita da página Institucional'),
		'before_widget' => '<div class="widget-space row">',
		'after_widget' => '</div> <div class="separator col-md-12"></div> <div class="clearfix"></div>',
		'before_title' => '<h4 class="main-title col-md-12">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'Opinião (Direita)',
		'id' => 'lat_right_opiniao_widgets',
		'description' => esc_html('Widget da direita da página Opiniao'),
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