<?php 

// ----------------------------------------------------------
// Funções e recursos básicos do template
// ----------------------------------------------------------

//adiciona suporte para excerpt nas paginas
add_post_type_support( 'page', 'excerpt' );

// Adiciona a paginação
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


// Obtem o slug da categoria a partir do id dela
function get_cat_slug($cat_id) {
	$cat_id = (int)$cat_id;
	$category = &get_category($cat_id);
	return $category->slug;
}


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
    		<p> <?php if (has_excerpt()){
    				the_excerpt();
    			} else{
    				the_excerpt_max(200);
    				} ?> </p>
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
    		<p> <?php if (has_excerpt()){
    				the_excerpt();
    			} else{
    				the_excerpt_max(320);
    				} ?> </p>
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
    		<p> <?php if (has_excerpt()){
    				the_excerpt();
    			} else{
    				the_excerpt_max(120);
    				} ?> </p>
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
    		<p> <?php if (has_excerpt()){
    				the_excerpt();
    			} else{
    				the_excerpt_max(180);
    				} ?> </p>
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
    		<p> <?php if (has_excerpt()){
    				the_excerpt();
    			} else {
    				the_big_excerpt(100);
    				} ?> </p>
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
		<div class="envolvefilho">
			<div class="chamada col-md-1 col-xs-1">
		    	<h2><?php echo $child->post_title; ?></h2>
			</div>

			<div class="chamada-conteudo-dir col-md-11 col-xs-11">
	    	    <?php echo apply_filters( 'the_content', $child->post_content); ?>
			</div>
		</div>
		<br>
		<br>
	<?php }
}

// Função para inserir o separador do Bootstrap
function bs_separator() {
	echo ('
		<div class="separator col-md-12"></div>	
		<div class="clearfix"></div>
	');
}


// Redireciona subscribers não-admins para a página "Lounge" após logado
function apvar_login_redirect( $redirect_to, $request, $user  ) {
	$user_lounge = site_url() . "/lounge";
	return ( is_array( $user->roles ) && in_array( 'administrator', $user->roles ) ) ? admin_url() : $user_lounge;
}
add_filter( 'login_redirect', 'apvar_login_redirect', 10, 3 );



// Redireciona os usuários após o logout para a página inicial
add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
  wp_redirect( home_url() );
  exit();
}



// Função para checar se a categoria é "category2" ou não retornando true para categorias com 2 no final e false para categorias sem o 2.
function categ_checa() {
	global $categoria_slug;
	global $categoria_resultado;

	// Se for uma categoria, pega o slug da categoria atual
	if(is_category()) {
		$categoria = get_queried_object_id();
		$categoria_atual = get_category($categoria);
	}

	$categoria_slug = $categoria_atual->slug;

	// Verifica se a categoria é "category2" e define a variável caso seja.
	if (substr($categoria_slug, -1) == '2') {
		$categoria_resultado = true;
	} else {
		$categoria_resultado = false;
	}

	return $categoria_resultado;
}



//Função para ajustar a categoria, caso ela seja category 2, arrancando o 2 do final.
function categ_ajusta() {
	global $categoria_slug;
	global $post;

	// Pega o slug da categoria atual em categorias
	if (is_category()) {
		$categoria = get_queried_object_id();
		$categoria_atual = get_category($categoria);
		
		// Define a variável de slug
		$categoria_slug = $categoria_atual->slug;
	}

	// Pega o slug da categoria atual em single posts
	if (is_single()) {
		$categoria = get_the_category($post->ID);
		$categoria_atual = $categoria[0];
		
		// Define a variável de slug
		$categoria_slug = $categoria_atual->slug;
	}


	// Carrega as variáveis caso a página carregada seja a página "Lounge"
	if (is_page()) {

		// Obtem o slug da página
		$page_slug = $post->post_name;

		// Verifica se o slug da página contem "lounge"
		if (strpos($page_slug, 'lounge') === false) {} else {
			// Define a categoria para uso como sendo a de galeria de fotos
			$categoria_id = 27;
			// Define a variável para uso no link "ver todas"
			$categoria_slug = get_cat_slug($categoria_id);
		}
	};

	// Verifica se a categoria é "category2" e define a variável caso seja.
	if (substr($categoria_slug, -1) == '2') {
		$categoria_slug = substr($categoria_slug, 0, -1);
	}

	return $categoria_slug;

}




// Troca a logo da página de login e a formata para as medidas específicas

/*function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/apvar-logo-login.png);
		height:300px;
		width:300px;
		background-size: 300px 300px;
		background-repeat: no-repeat;
        	padding-bottom: 10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );*/



// Desabilita os endereços do plugin WP Customer Area
function cuar_disable_addresses( $addresses ) {
	return array();
}
add_filter( 'cuar/core/address/user-addresses', 'cuar_disable_addresses' );





// ----------------------------------------------------------
// Scripts
// ----------------------------------------------------------


// Carrega os scripts de javascript, bootstrap e etc
function carrega_scripts(){

	wp_enqueue_script('js_placeholder', get_template_directory_uri().'/js/placeholder.js', array(), null, true);

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
		'after_widget' => '</div><div class="separator col-md-12"></div> <div class="clearfix"></div>',
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

	register_sidebar( array(
		'name' => 'Lounge Sidebar',
		'id' => 'lat_right_lounge',
		'description' => esc_html('Sidebar da direita da página Lounge'),
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
	__('(APVAR) Ouvidoria Widget', ' ouvidoria_widget_domain'),
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
	__('(APVAR) Últimos Posts da Categoria', 'categ_last_widget_domain'),
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

		// Carrega as variáveis caso a página carregada seja a página "Lounge"
		if (is_page()) {

			// Obtem o slug da página
			$p_slug=$post->post_name;

			// Verifica se o slug da página contem "lounge"
			if (strpos($p_slug, 'lounge') === false) {} else {
				// Define a categoria para uso como sendo a de galeria de fotos
				$categ_id = 27;
			}
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
	            <p><a href="<?php the_permalink(); ?>"><?php the_title_max(120); ?><br><b class="data-posts-recente"><?php the_time('d/m/Y'); ?></b></a></p>
	        <?php
	        }
	    }

	    wp_reset_postdata();

	    $category_link = get_category_link( $categ_id );
	    echo "<a href='".get_site_url()."/category/".categ_ajusta()."' title='Posts Recentes'><p style='text-align:center;'>Ver todas</p></a>";



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


// Cria o widget de Falsa Recuperação
class falsa_recup_widget extends WP_Widget {
	
	function __construct() {
	parent::__construct(
	// widget ID
	'falsa_recup_widget',
	// widget name
	__('(APVAR) Falsa Recuperação', 'falsa_recup_widget_domain'),
	// widget description
	array( 'description' => __( 'Este widget mostra os últimos posts da categoria Falsa recuperação da Varig e um link para ver esta categoria completa.', 'falsa_recup_widget_domain' ), )
	);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		// Before Widget
		echo $args['before_widget'];

		// WIDGET
		// Variáveis para obter a categoria a partir do slug
		$slug = "falsarecuperacao2";
		$categ = get_category_by_slug( $slug );
		$categ_id = $categ->cat_ID;
		$category_link = get_category_link( $categ_id );

		// If title is present
		if ( ! empty( $title ) )
		echo $args['before_title'] . "<a href='$category_link' title='Falsa recuperação'>" . $title . "</a>" .$args['after_title'];

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
	            <a href="<?php the_permalink(); ?>"><p><?php the_title_max(50); ?><br><b class="data-posts-recente"><?php the_time('d/m/Y'); ?></b></p></a>
	        <?php
	        }
	    }
	    wp_reset_postdata();

	    
	    echo "<a href='$category_link' title='Falsa recuperação'><p style='text-align:center;'>Ver todas</p></a>";

		// After Widget
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		$title = $instance[ 'title' ];
		else
		$title = __( 'Falsa Recuperação', 'falsa_recup_widget_domain' );
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
class userdata_widget extends WP_Widget {
	
	function __construct() {
	parent::__construct(
	// widget ID
	'userdata_widget',
	// widget name
	__('(APVAR) Dados de Usuário', 'userdata_widget_domain'),
	// widget description
	array( 'description' => __( 'Um widget que mostra os dados de usuário quando logado.', 'userdata_widget_domain' ), )
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
		
		// Obtem os dados de usuário.
		$user_info = wp_get_current_user();
		$us_name = $user_info->user_nicename;
		$us_login = $user_info->user_login;
		$us_matricula = $user_info->matricula;
		$us_categ = implode(', ', $user_info->roles);
		$us_id = $user_info->ID;

		// Monta a exibição dos dados
		?>

		<p> Olá, <?php echo $us_name; ?></p>
		<p><strong> Você está logado como: </strong><br>
			<p><strong>Login</strong>
				<br><?php echo $us_login; ?>
			</p>
			
			<p><strong>Matrícula</strong>
				<br><?php echo $us_matricula; ?>
			</p>
			
			<p><strong>Categoria</strong>
				<br>
				<?php
				if (strpos($us_categ, 'administrator') !== false) {
					echo "Administrador";
				} else {
					if (strpos($us_categ, 'associado3') !== false){
						echo "Associado Efetivo";
					} else {
						echo "Associado";
					}
				}
				?>
				
			</p>

			<p><strong>Exclusivo para associados:</strong> <br>
				<a href='http://www.apvar.org.br/v1/fale-com-a-diretoria/' title=''>Fale com a diretoria</a>
		</p>
		</p>
		

		<?php
		// After Widget
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		$title = $instance[ 'title' ];
		else
		$title = __( 'Informações de Usuário', 'userdata_widget_domain' );
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






// Cria o widget de Galerias de Fotos
class galerias_widget extends WP_Widget {
	
	function __construct() {
	parent::__construct(
	// widget ID
	'galerias_widget',
	// widget name
	__('(APVAR) Galerias de Fotos', 'galerias_widget_domain'),
	// widget description
	array( 'description' => __( 'Este widget mostra os últimos posts da categoria de Galeria de Fotos e um link para ver esta categoria completa.', 'galerias_domain' ), )
	);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		// Before Widget
		echo $args['before_widget'];

		// WIDGET
		// Variáveis para obter a categoria a partir do slug
		$slug = "galeriasfotos";
		$categ = get_category_by_slug( $slug );
		$categ_id = $categ->cat_ID;
		$category_link = get_category_link( $categ_id );

		// If title is present
		if ( ! empty( $title ) )
		echo $args['before_title'] . "<a href='$category_link' title='Falsa recuperação'>" . $title . "</a>" .$args['after_title'];

		// Argumentos da query
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
	            <a href="<?php the_permalink(); ?>"><p><?php the_title_max(50); ?><br><b class="data-posts-recente"><?php the_time('d/m/Y'); ?></b></p></a>
	        <?php
	        }
	    }
	    wp_reset_postdata();

	    
	    echo "<a href='$category_link' title='Galerias de Fotos'><p style='text-align:center;'>Ver todas</p></a>";

		// After Widget
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		$title = $instance[ 'title' ];
		else
		$title = __( 'Galerias de Fotos', 'galerias_widget_domain' );
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





// Cria o widget de PDFs
class pdfs_widget extends WP_Widget {
	
	function __construct() {
	parent::__construct(
	// widget ID
	'pdfs_widget',
	// widget name
	__('(APVAR) PDFs', 'pdfs_widget_domain'),
	// widget description
	array( 'description' => __( 'Este widget mostra os últimos posts da categoria de PDFs e um link para ver esta categoria completa.', 'pdfs_widget__domain' ), )
	);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		// Before Widget
		echo $args['before_widget'];

		// WIDGET
		// Variáveis para obter a categoria a partir do slug
		$slug = "pdfs";
		$categ = get_category_by_slug( $slug );
		$categ_id = $categ->cat_ID;
		$category_link = get_category_link( $categ_id );

		// If title is present
		if ( ! empty( $title ) )
		echo $args['before_title'] . "<a href='$category_link' title='PDFs'>" . $title . "</a>" .$args['after_title'];

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
	            <a href="<?php the_permalink(); ?>"><p><?php the_title_max(50); ?><br><b class="data-posts-recente"><?php the_time('d/m/Y'); ?></b></p></a>
	        <?php
	        }
	    }
	    wp_reset_postdata();

	    
	    echo "<a href='$category_link' title='PDFs'><p style='text-align:center;'>Ver todas</p></a>";

		// After Widget
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
		$title = $instance[ 'title' ];
		else
		$title = __( 'PDFs', 'pdfs_widget_domain' );
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
	register_widget('userdata_widget');
	register_widget('galerias_widget');
	register_widget('pdfs_widget');

}

add_action( 'widgets_init', 'register_widgets' );



 ?>