<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>APVAR - Associação de pilotos da Varig</title>
		
		<?php wp_head(); ?>
	</head>

	
	<body <?php body_class(); ?>>
			
		<div class="container main-container">
		
			<header class="header row">

				<a href="index.html">
				<img id='logotipo' src='wp-content/themes/<?php echo get_template(); ?>/img/logotitulo.gif' alt='Logotipo'>
				</a>

					<?php //Início da exibição do menu personalizado
/*
					wp_nav_menu( array(
						'menu' => 'menu_princ',
						'theme_location' => 'menu_princ',
						'container' => 'nav',
						'container_class' => 'container_class',
						'container_id' => 'menu-contai-id',
						'menu_class' => 'navbar navbar-default center-block',
						'echo' => true,
						'menu_id' => 'menu-princ-id',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0,
						'walker' => '',
					) );
*/

					// Fim da exibição do menu personalizado ?>


				<nav class="navbar navbar-default center-block">
					
    					 <ul class="nav navbar-nav">
							<li><a href="#">Principal</a></li>
							<li><a href="#">Institucional</a></li>
							<li><a href="#">Diretoria</a></li>
							<li><a href="#">Opinião</a></li>
							<li><a href="#">Editorial</a></li>
							<li><a href="#">Bases</a></li>
							<li><a href="#">Arquivo</a></li>
							<li><a href="#">Operacional</a></li>
							<li><a href="#">Fale Conosco</a></li>
							<li><a href="#">Cabine de Comando</a></li>
    					 </ul>	
  					
				</nav>



			</header>