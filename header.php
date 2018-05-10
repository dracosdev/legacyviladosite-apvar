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

			<div class="siteArea col-sm-12 col-md-10 col-md-offset-1">			
		
			<header class="header row">

				<a href="index.html">
				<img id='logotipo' src='wp-content/themes/<?php echo get_template(); ?>/img/apvar-logo.png' alt='Logotipo'>
				</a>

				<nav class="navbar navbar-default menu-barra">

					<?php 

					wp_nav_menu( array(
						'menu' => 'menu_princ',
						'items_wrap' => '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>'
					) );

					/*Início da exibição do menu personalizado

					wp_nav_menu( array(
						'menu' => 'menu_princ',
						'theme_location' => 'menu_princ',
						'container' => 'nav',
						'container_class' => '',
						'container_id' => '',
						'menu_class' => 'navbar navbar-default center-block',
						'items_wrap' => '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>',
						'echo' => true,
						'menu_id' => 'menu-princ-id',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0,
						'walker' => '',
					) );


					 Fim da exibição do menu personalizado */ ?>

				</nav>		 



			</header>