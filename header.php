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

				<a href='<?php echo home_url(); ?>'>
				<img id='logotipo' src='<?php echo get_bloginfo('template_directory') . '/img/apvar-logo.png'; ?>' alt='Logotipo'>
				</a>

				<nav class="navbar navbar-default menu-barra">

					<?php 

					wp_nav_menu( array(
						'menu' => 'menu_princ',
						'theme_location' => 'menu_princ',
						'container' => 'nav',
						'items_wrap' => '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>'
					) );
					 ?>


				</nav>		 



			</header>