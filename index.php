<?php get_header();

// Montagem das mensagens pré-definidas
$nenhumpost = '<p> Não foi encontrada nenhuma publicação nesta categoria. </p>';

?>

<!-- header area -->
<div class="row content center-block">
	<div class="main col-md-6">
		<div class="envolve-chamada row">
			<div class="main-title-home col-md-4">
				<img id='circle-titulo' class="circle-titulo" src='<?php echo get_bloginfo('template_directory') . '/img/logo-circulo-titulo.png'; ?>' alt='circulo do titulo'>
				<a href="http://www.apvar.org.br/v1/category/apvaracao/">
					<h4>Apvar em Ação</h4>
				</a>
			</div>

			<div class="chamada col-md-8">
				<h5>Confira a atuação da Apvar conforme registros em diversos meios de comunicação</h5>
			</div>
		</div>	
			
		<div class="clearfix"></div>
			<hr class="row col-md-12">

			<?php
			// Argumentos do loop
			$args_apvaracao = array(
				'cat' => 3,
				'post_type' => 'post',
				'posts_per_page' => 2
			);

			// Loop da área "Apvar em Ação"
			query_posts( $args_apvaracao );
			 
			// Loop
			while ( have_posts() ) : the_post(); ?>
			
			    <div class="envolve row"> <?php post_checaimg(); ?> </div>
				
			<?php wp_reset_postdata();
			endwhile; ?>

			<div class="clearfix"></div>

		<div class="envolve-chamada envolve-chamada-par row">
			<div class="main-title-home col-md-4">
				<img id='circle-titulo' class="circle-titulo" src='<?php echo get_bloginfo('template_directory') . '/img/logo-circulo-titulo.png'; ?>' alt='circulo do titulo'>

				<a href="http://www.apvar.org.br/v1/category/quadroavisos/">
					<h4>Quadro de Avisos</h4>
				</a>
			</div>

			<div class="chamada col-md-8">
				<h5>Informe-se sobre eventos e fatos relevantes para os pilotos e outros aeronautas da ativa ou aposentados</h5>
			</div>
		</div>

		<div class="clearfix"></div>

			<hr class="row col-md-12">

			<?php
			// Argumentos do loop
			$args_quadroavisos = array(
				'cat' => 4,
				'post_type' => 'post',
				'posts_per_page' => 3
			);

			// Loop da área "Quadro de Avisos"
			query_posts( $args_quadroavisos );

			while ( have_posts() ) : the_post(); ?>
			   
			    <div class="envolve row">
				    <?php post_checaimg(); ?>
				</div>
			<?php wp_reset_postdata();			
			endwhile; ?>

			<div class="clearfix"></div>			

	</div>

	<!-- coluna do meio -->
	<div class="second middle-section col-md-4">

		<div class="envolve-chamada chamada-dni">
			<div class="main-title-home m-t-left">
				<img id='circle-titulo' class="circle-titulo img-dni" src='<?php echo get_bloginfo('template_directory') . '/img/logo-circulo-titulo.png'; ?>' alt='circulo do titulo'>
				<a href="http://www.apvar.org.br/v1/category/deunaimprensa/">
					<h4>Deu na <br> Imprensa</h4>
				</a>
			</div>
			
			<div class="chamada chamada-dni">
				<h5>Notícias sobre a indústria e temas de interesse específico.</h5>
			</div>
			<div class="clearfix"></div>
		</div>	

			<div class="clearfix"></div>
			<hr>

			<?php
			// Argumentos do loop
			$args_deunaimprensa = array(
				'cat' => 5,
				'post_type' => 'post',
				'posts_per_page' => 4
			);

			// Loop da área "Deu na Imprensa"
			query_posts( $args_deunaimprensa );
		 
			while ( have_posts() ) : the_post(); ?>
			    
			    <div class="envolve row">
			   		<?php /*post_checaimg();*/ post_semimagem(); ?>
				</div>

			<?php wp_reset_postdata();			
			endwhile; ?>
	
	</div>

	<!-- area da sidebar -->
	
		<aside class="complementary col-md-2">
			<?php get_sidebar(); ?>
			<div class="clearfix"></div>
		</aside>
	

	<div class="separator col-md-12"></div>	
	<div class="clearfix"></div>

	<?php if(is_active_sidebar('home_bottom')){
        dynamic_sidebar('home_bottom');
	}; ?>

</div>

<!-- footer area -->
<?php get_footer(); ?>