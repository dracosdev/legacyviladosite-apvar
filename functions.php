<?php 

// ----------------------------------------------------------
// Funções e recursos básicos do template
// ----------------------------------------------------------

//adiciona a paginação
function wordpress_pagination() {
            global $wp_query;
 
            $big = 999999999;
 
            echo paginate_links( array(
                  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                  'format' => '?paged=%#%',
                  'current' => max( 1, get_query_var('paged') ),
                  'total' => $wp_query->max_num_pages
            ) );
      }

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


// Função para usar um excerpt maior do que o máximo permitido, usando o the content
function the_big_excerpt($chars) {
	$charnumber = $chars;
    echo wp_trim_words( get_the_content(), $charnumber );
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
		<a href=' <?php echo the_permalink(); ?> '>
			<?php the_post_thumbnail(); ?>
		</a>
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
    		<p> <?php the_excerpt_max(320); ?> </p>
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


// Função para carregar post na home com a imagem no topo
function post_comimagem_topo() { ?>
	
	<div class="foto-materia col-md-12">
		<a href=' <?php echo the_permalink(); ?> '>
			<?php the_post_thumbnail(); ?>
		</a>
	</div>

    <div class="main col-md-12">
    	<a href=' <?php echo the_permalink(); ?> '>
	    	<h4 class="m-title"> <?php echo the_title(); ?> </h4>
    		<p> <?php the_excerpt_max(120); ?> </p>
		</a>
	</div>
	<?php
}


// Função para carregar post na home sem imagem para o modelo com imagem no topo
function post_semimagem_topo() {
	?>
    <div class="main col-md-12">
    	<a href=' <?php echo the_permalink(); ?> '>
	    	<h4 class="m-title"> <?php echo the_title(); ?> </h4>
    		<p> <?php the_excerpt_max(180); ?> </p>
		</a>
	</div>
	<?php
}


// Função para carregar post na home sem imagem para o modelo com imagem no topo
function post_semimagem_topofirst() {
	?>
    <div class="main col-md-12">
    	<a href=' <?php echo the_permalink(); ?> '>
	    	<h4 class="m-title"> <?php echo the_title(); ?> </h4>
    		<p> <?php the_big_excerpt(100); ?> </p>
		</a>
	</div>
	<?php
}


// Função para verificar se o post tem ou não imagem e carregar a versão de imagem no topo para o Deu na Imprensa
function post_checaimg_topo() {
	if (has_post_thumbnail($post->ID)) {
		post_comimagem_topo();
	} else {
		post_semimagem_topofirst();
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
		<p>&nbsp;</p>
		<div class="chamada col-md-1 col-xs-1">
	    	<h2><?php echo $child->post_title; ?></h2>
		</div>

		<div class="chamada-conteudo-dir col-md-11 col-xs-11">
    	    <?php echo apply_filters( 'the_content', $child->post_content); ?>
		</div>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	<?php }
}

// Função para inserir o separador do Bootstrap
function bs_separator() {
	echo ('
		<div class="separator col-md-12"></div>	
		<div class="clearfix"></div>
	');
}


// ----------------------------------------------------------
// Scripts
// ----------------------------------------------------------


// Carrega os scripts de javascript, bootstrap e etc
function carrega_scripts(){

	wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), null, 'all');

	wp_enqueue_style('style', get_template_directory_uri().'/style.css', array(), null, 'all');

	wp_enqueue_script('js_template', get_template_directory_uri().'/js/template.js', array(), null, true);

	wp_enqueue_script('bs_template', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), null, true);

	wp_enqueue_script('fa_template', 'https://use.fontawesome.com/releases/v5.0.10/js/all.js', array('jquery'), null, true);
	
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
		'before_widget' => '<div id="%1$s" class="widget-space row %2$s">',
		'after_widget' => '</div> <div class="separator col-md-12"></div> <div class="clearfix"></div>',
		'before_title' => '<h4 class="main-title col-md-12">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'Páginas (Direita)',
		'id' => 'lat_right_pages_widgets',
		'description' => esc_html('Sidebar da direita à ser exibido por padrão nas páginas gerais'),
		'before_widget' => '<div id="%1$s" class="widget-space row %2$s">',
		'after_widget' => '</div> <div class="separator col-md-12"></div> <div class="clearfix"></div>',
		'before_title' => '<h4 class="main-title col-md-12">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'Categorias (Direita)',
		'id' => 'lat_right_categories_widgets',
		'description' => esc_html('Sidebar exibida à direita nas categorias'),
		'before_widget' => '<div id="%1$s" class="widget-space row %2$s">',
		'after_widget' => '</div> <div class="separator col-md-12"></div> <div class="clearfix"></div>',
		'before_title' => '<h4 class="main-title col-md-12">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'Página Inicial (Rodapé)',
		'id' => 'home_bottom',
		'description' => esc_html('Sidebar exibida na parte de baixo da home'),
		'before_widget' => '<div class="home-bottom">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );

	register_sidebar( array(
		'name' => 'Institucional (Direita)',
		'id' => 'lat_right_institucional_widgets',
		'description' => esc_html('Sidebar da direita da página Institucional'),
		'before_widget' => '<div id="%1$s" class="widget-space row %2$s">',
		'after_widget' => '</div> <div class="separator col-md-12"></div> <div class="clearfix"></div>',
		'before_title' => '<h4 class="main-title col-md-12">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'Links Úteis (Direita)',
		'id' => 'lat_right_links_widgets',
		'description' => esc_html('Sidebar da direita da página Links Úteis'),
		'before_widget' => '<div id="%1$s" class="widget-space row %2$s">',
		'after_widget' => '</div> <div class="separator col-md-12"></div> <div class="clearfix"></div>',
		'before_title' => '<h4 class="main-title col-md-12">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'Minha Apvar (Direita)',
		'id' => 'lat_right_minhaapvar_widgets',
		'description' => esc_html('Sidebar da direita da página Minha Apvar'),
		'before_widget' => '<div id="%1$s" class="widget-space row %2$s">',
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
			Envie-nos suas Sugestões, Dúvidas, Reclamações etc. <br>
			<a href="http://www.apvar.org.br/v1/ouvidoria/">Clique aqui >>>> </a>
			</p>' );

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		$title = $instance[ 'title' ];
		else
		$title = __( 'Ouvidoria', 'ouvidoria_widget_domain' );
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




// Cria o widget de Ouvidoria
class categ_last_widget extends WP_Widget {
	
	function __construct() {
	parent::__construct(
	// widget ID
	'categ_last_widget',
	// widget name
	__('Últimos Posts da Categoria', 'categ_last_widget_domain'),
	// widget description
	array( 'description' => __( 'Um widget que mostra os 10 posts mais recentes da categoria em exibição.', 'categ_lastpost_widget_domain' ), )
	);
	}

	public function widget( $args, $instance ) {
		global $post;
		$title = apply_filters( 'widget_title', $instance['title'] );

		// Before Widget
		echo $args['before_widget'];

		// If title is present
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		// WIDGET
		
		// Carrega as variáveis caso a página carregada seja uma categoria
		if (is_category()) {
			// Variáveis para saber categoria
			$categ = get_category( get_query_var( 'cat' ) );
			$categ_id = $categ->cat_ID;
		};
		
		// Carrega as variáveis caso a página carregada seja um post
		if (is_single()) {
			// Variáveis para saber categoria
			$categ = get_the_category($post->ID);
			$categ_id = $categ[0]->cat_ID;
		};

		//Argumentos da query
	    $lastposts = get_posts( array(
   			'posts_per_page' => 10,
	        'cat' => $categ_id,
	        'orderby' => 'date',
	        'order' => 'DESC',
	        'suppress_filters' => true
	    ) );

		// Loop de posts
	    if ( $lastposts ) {
	        foreach ( $lastposts as $post ) {
	            setup_postdata( $post ); ?>
	            <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
	        <?php
	        }
	    }
	    wp_reset_postdata();

		// After Widget
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		$title = $instance[ 'title' ];
		else
		$title = __( 'Últimos posts da Categoria', 'categ_last_widget_domain' );
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


// Cria o User data widget
class user_data_widget extends WP_Widget {
	
	function __construct() {
	parent::__construct(
	// widget ID
	'user_data_widget',
	// widget name
	__('Informações de Usuário', 'user_data_widget_domain'),
	// widget description
	array( 'description' => __( 'Um widget que mostra os dados de usuário quando logado.', 'user_data_widget_domain' ), )
	);
	}

	public function widget( $args, $instance ) {
		global $post;
		$title = apply_filters( 'widget_title', $instance['title'] );

		// Before Widget
		echo $args['before_widget'];

		// If title is present
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		// WIDGET
		
		//obtem os dados de usuário.
		$us_name = 'Vila do Site';
		$us_login ='viladosite';
		$us_matricula ='1234';
		$us_categ ='Administrador';

		//monta a exibição dos dados
		echo "<p>Olá ".$nome;.".</p>";
		echo "<p>Você está logado como: </p>";
		echo "<p> Login - ".$us_login."</p>";
		echo "<p> Matrícula - ".$us_matricula."</p>";
		echo "<p> Categoria - ".$us_categ."</p>";

		echo "<p> Links para associado:</p>";
		echo "<a href='#' title=''>Prestação de Contas</a>";
		echo "<a href='#' title=''>Fale com a diretoria</a>";

	    wp_reset_postdata();

		// After Widget
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		$title = $instance[ 'title' ];
		else
		$title = __( 'Informações de Usuário', 'user_data_widget_domain' );
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



// Cria o widget de Falsa Recuperação
class falsa_recup_widget extends WP_Widget {
	
	function __construct() {
	parent::__construct(
	// widget ID
	'falsa_recup_widget',
	// widget name
	__('Falsa Recuperação', 'falsa_recup_widget_domain'),
	// widget description
	array( 'description' => __( 'Este widget mostra os últimos posts da categoria Falsa recuperação da Varig e um link para ver esta categoria completa.', 'falsa_recup_widget_domain' ), )
	);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		// Before Widget
		echo $args['before_widget'];

		// If title is present
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		// WIDGET
		// Variáveis para obetr a categoria a partir do slug
		$slug = "falsarecuperacao";
		$categ = get_category_by_slug( $slug );
		$categ_id = $categ->cat_ID;

		//Argumentos da query
	    $lastposts = get_posts( array(
   			'posts_per_page' => 4,
	        'cat' => $categ_id,
	        'orderby' => 'date',
	        'order' => 'DESC',
	        'suppress_filters' => true
	    ) );

		// Loop de posts
		global $post;
	    if ( $lastposts ) {
	        foreach ( $lastposts as $post ) {
	            setup_postdata( $post ); ?>
	            <a href="<?php the_permalink(); ?>"><p><?php the_title(); ?></p></a>
	        <?php
	        }
	    }
	    wp_reset_postdata();

	    $category_link = get_category_link( $categ_id );
	    echo "<a href='$category_link' title='Falsa recuperação'><p style='text-align:center;'>Ver todas</p></a>";

		// After Widget
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		$title = $instance[ 'title' ];
		else
		$title = __( 'Últimos posts da Categoria', 'categ_last_widget_domain' );
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
	
	register_widget('falsa_recup_widget');
	register_widget('ouvidoria_widget');
	register_widget('categ_last_widget');

}

add_action( 'widgets_init', 'register_widgets' );



/*-----------------------------------------------------------------------------------*/
/* CAMPOS ADICIONAIS
/*-----------------------------------------------------------------------------------*/

// CAMPOS DE PERFIL PERSONALIZADOS
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
 
function my_show_extra_profile_fields( $user ) { ?>


    <table class="form-table">
 
        <tr>
            <th><label for="matricula">Matricula</label></th>
 
            <td>
                <input type="text" name="matricula" id="matricula" value="<?php echo esc_attr( get_the_author_meta( 'matricula', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Matrícula do usuário</span>
            </td>
        </tr>

    </table>  
<?php } ?>

<?php


// GUARDAR E MANTER INFO DOS CAMPOS
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
 
function my_save_extra_profile_fields( $user_id ) {
 
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    update_usermeta( $user_id, 'matricula', $_POST['matricula'] );
}




 ?>