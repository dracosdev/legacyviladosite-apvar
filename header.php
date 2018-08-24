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
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-principal" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="menu-principal">
			      	<?php 

						wp_nav_menu( array(
						'menu' => 'menu_princ',
						'theme_location' => 'menu_princ',
						'container' => 'nav',
						'items_wrap' => '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>'
					) );
					?>
			 
			    </div><!-- /.navbar-collapse -->
				</nav>	 



			</header>