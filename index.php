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
			<div class="main col-md-6">

				<div class="envolve-chamada col-md-12">
					<div class="main-title-home col-md-4">
						<img id='circle-titulo' class="circle-titulo" src='<?php echo get_bloginfo('template_directory') . '/img/logo-circulo-titulo.png'; ?>' alt='circulo do titulo'>
						<a href="http://www.apvar.org.br/v1/category/apvaracao/"><h4>Apvar em Ação</h4></a>
					</div>

					<div class="chamada col-md-8">
						<h5>Confira a atuação da Apvar conforme registros em diversos meios de comunicação</h5>
					</div>

				</div>	
					
					<div class="clearfix"></div>

						<hr>

							<?php

							// Loop da área "Apvar em Ação"
							query_posts( $args_apvaracao );

							 
							// Loop
							while ( have_posts() ) : the_post(); ?>

							    <div class="envolve row col-md-12">

								    <?php post_checaimg(); ?>

								</div>

								
								<?php
								// Reseta o query de posts
								wp_reset_postdata();
							
							endwhile;

							?>


							<div class="clearfix"></div>

				<div class="envolve-chamada envolve-chamada-par col-md-12">
					<div class="main-title-home col-md-4">
						<img id='circle-titulo' class="circle-titulo" src='<?php echo get_bloginfo('template_directory') . '/img/logo-circulo-titulo.png'; ?>' alt='circulo do titulo'>
						<a href="http://www.apvar.org.br/v1/category/quadroavisos/"><h4>Quadro de Avisos</h4></a>
					</div>

					<div class="chamada col-md-8">
						<h5>Informe-se sobre eventos e fatos relevantes para os pilotos e outros aeronautas da ativa ou aposentados</h5>
					</div>
				</div>

					<div class="clearfix"></div>

					<hr>

						<?php

						// Loop da área "Quadro de Avisos"
						query_posts( $args_quadroavisos );

						 
						// Loop 
						while ( have_posts() ) : the_post(); ?>
						   
						    <div class="envolve row col-md-12">

						    <?php post_checaimg(); ?>

							</div>

						
						<?php
							// Reseta o query de posts
							 wp_reset_postdata();
						
						endwhile;

						?>

					<div class="clearfix"></div>			

			</div>


			<!-- coluna do meio -->
			<div class="second middle-section col-md-4">

				<div class="envolve-chamada col-md-12">
					<div class="main-title-home col-md-4">
						<img id='circle-titulo' class="circle-titulo" src='<?php echo get_bloginfo('template_directory') . '/img/logo-circulo-titulo.png'; ?>' alt='circulo do titulo'>
						<a href="http://www.apvar.org.br/v1/category/deunaimprensa/"><h4>Deu na Imprensa</h4></a>
					</div>
					
					<div class="chamada col-md-8">
						<h5>Notícias sobre a indústria e outros temas de interesse específico.</h5>
					</div>

				</div>	

					<div class="clearfix"></div>

					<hr>


					<?php
					// Loop da área "Deu na Imprensa"
					query_posts( $args_deunaimprensa );

					 
					// Loop 
					while ( have_posts() ) : the_post(); ?>
					    
					    <div class="envolve row  col-md-12">
					    
					   		<?php post_checaimg(); ?>

						</div>

					<?php 
						// Reseta o query de posts
						wp_reset_postdata();
					
					endwhile;

					?>
			
			</div>

			<!-- area da sidebar -->
			<div class="bordas">
			<aside class="complementary col-md-2">

					<?php get_sidebar(); ?>
					

						<div class="clearfix"></div>



			</aside>
			</div>


			<div class="separator col-md-12">
			</div>	
			<div class="clearfix"></div>

			<!-- aqui entra a parte antes do footer -->
			<div class="down-content col-md-12">

							<div class="main-title-home col-md-2">
								<img id='circle-titulo' class="circle-titulo" src='<?php echo get_bloginfo('template_directory') . '/img/logo-circulo-titulo.png'; ?>' alt='circulo do titulo'>
								<h4>Hora Mundial</h4>
							</div>

							<div class="main col-md-6">
								<p>Centenas de pilotos da Varig se encontram radicados pelo mundo e  a qualquer  hora podem estar navegando também nesta página</p>
							</div>
							<div class="main-title col-md-4">
								<h5>UTC:	14:03:30 - Thursday - 26 April</h5>
							</div>


								<div class="clearfix"></div>
								<hr>

							<div class="widget-area-down col-md-5">
								
								<table>

									<tbody><tr>

								      <td width="93" bgcolor="#BBC8D8"><strong><span class="style1">-- </span>Dubai</strong></td>

								      <td width="274" bgcolor="#BBC8D8">18:03:30 - Thursday - 26 April</td>

								    </tr>

								   <tr>

								      <td><strong><span class="style2">-- </span>Hong Kong</strong></td>

								      <td>22:03:30 - Thursday - 26 April </td>

								    </tr>

								    <tr>

								      <td bgcolor="#BBC8D8"><strong><span class="style1">-- </span>Macau</strong></td>

								      <td bgcolor="#BBC8D8">22:03:30 - Thursday - 26 April</td>

								    </tr>

								    <tr>

								      <td><strong><span class="style2">-- </span>Peking</strong></td>

								      <td>22:03:30 - Thursday - 26 April </td>

								    </tr>

								    <tr>

								      <td bgcolor="#BBC8D8"><strong><span class="style1">-- </span>Shanghai</strong></td>

								      <td bgcolor="#BBC8D8">22:03:30 - Thursday - 26 April</td>

								    </tr>

									<tr>

									  <td><strong><span class="style2">-- </span>Luanda</strong></td>

									  <td>15:03:30 - Thursday - 26 April</td>

									  </tr>

									<tr>

									  <td bgcolor="#BBC8D8"><strong><span class="style1">-- </span>New York </strong></td>

									  <td bgcolor="#BBC8D8">10:03:30 - Thursday - 26 April</td>

									  </tr>

									<tr>

								      <td><strong> <span class="style2">--</span> Tóquio  </strong></td>

								      <td>23:03:30 - Thursday - 26 April</td>

								    </tr>

								  </tbody>

								</table>


							</div>

							<div class="widget-area-down col-md-5">
								
								<table>

									<tbody><tr>

								      <td width="93" bgcolor="#BBC8D8"><strong><span class="style1">-- </span>Dubai</strong></td>

								      <td width="274" bgcolor="#BBC8D8">18:03:30 - Thursday - 26 April</td>

								    </tr>

								   <tr>

								      <td><strong><span class="style2">-- </span>Hong Kong</strong></td>

								      <td>22:03:30 - Thursday - 26 April </td>

								    </tr>

								    <tr>

								      <td bgcolor="#BBC8D8"><strong><span class="style1">-- </span>Macau</strong></td>

								      <td bgcolor="#BBC8D8">22:03:30 - Thursday - 26 April</td>

								    </tr>

								    <tr>

								      <td><strong><span class="style2">-- </span>Peking</strong></td>

								      <td>22:03:30 - Thursday - 26 April </td>

								    </tr>

								    <tr>

								      <td bgcolor="#BBC8D8"><strong><span class="style1">-- </span>Shanghai</strong></td>

								      <td bgcolor="#BBC8D8">22:03:30 - Thursday - 26 April</td>

								    </tr>

									<tr>

									  <td><strong><span class="style2">-- </span>Luanda</strong></td>

									  <td>15:03:30 - Thursday - 26 April</td>

									  </tr>

									<tr>

									  <td bgcolor="#BBC8D8"><strong><span class="style1">-- </span>New York </strong></td>

									  <td bgcolor="#BBC8D8">10:03:30 - Thursday - 26 April</td>

									  </tr>

									<tr>

								      <td><strong> <span class="style2">--</span> Tóquio  </strong></td>

								      <td>23:03:30 - Thursday - 26 April</td>

								    </tr>

								  </tbody>

								</table>


							</div>

							<div class="separator col-md-12">
							</div>
							

							<div class="clearfix"></div>
				
			</div>


		</div>

		<!-- footer area -->
<?php get_footer(); ?>