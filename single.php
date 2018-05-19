<?php get_header(); ?>

<?php

// Montagem dos argumentos para cada loop
$args_apvaracao = array(
	'cat' => 3,
	'post_type' => 'post',
	'posts_per_page' => 2
);

$args_quadroavisos = array(
	'cat' => 4,
	'post_type' => 'post',
	'posts_per_page' => 2
);

$args_deunaimprensa = array(
	'cat' => 5,
	'post_type' => 'post',
	'posts_per_page' => 3
);


// Montagem das mensagens pré-definidas
$nenhumpost = '<p> Não foi encontrada nenhuma publicação nesta categoria. </p>';

?>


		<!-- header area -->
		<div class="row content center-block">
			<div class="main col-md-10">
				
				<div class="main-title col-md-12">
					<h4><i class="fa fa-plane"></i>Apvar em Ação</h4>
				</div>

				<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
					<div class="chamada col-md-12">
						<h5></h5>
						<?php the_content(); ?>

					</div>
				<?php endwhile; else: ?>
				<?php endif; ?>	
					
					<div class="clearfix"></div>

					<hr>

					<div class="clearfix"></div>			
			</div>

			<!-- area da sidebar -->
			<div class="bordas">
			<aside class="complementary col-md-2">

					<?php if ( dynamic_sidebar('lat_right_widgets') ) : else : endif; ?>
					
					<!--
						<div class="widget-space row">

							

							<div class="main-title col-md-12">
								<h4>A Falsa "recuperação" da Varig</h4>
							</div>
							<div class="chamada col-md-12">
								<h5>Registros que comprovam a fraude escandalosa contra os trabalhadores da Varig.</h5>
							</div>

								

								<div class="clearfix"></div>

								<hr>
							
							<div class="main col-md-12">
								<h5>Graziela Baggio usurpa o voto da categoria aero-nauta para trair o interesse dos trabalhadores....</h5>
							</div>

								<div class="clearfix"></div>

								<hr>
							
							<div class="main col-md-12">
								<h5>Marco histórico para o Grupo de Pilotos...</h5>
							</div>

								<div class="clearfix"></div>

								<hr>

							<div class="main col-md-12">
								<h5>Reintegração já para os perseguidos políticos da Varig...</h5>
							</div>							

								<div class="clearfix"></div>

								<hr>
							
						</div>
					-->

						<div class="clearfix"></div>



			</aside>
			</div>


			<div class="separator col-md-12">
			</div>	

			<div class="clearfix"></div>


		</div>

		<!-- footer area -->
<?php get_footer(); ?>