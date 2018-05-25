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
				
				

				<?php if (have_posts()) : while(have_posts()) : the_post(); ?>

					<div class="main-title col-md-12">
					<h3><i class="fa fa-plane"></i><?php global $post;
					$categoria = get_the_category($post->id);
					$nomeCategoria = $categoria[0]->cat_name;
					echo $nomeCategoria;
					?>
					</h3>
					</div>

					<div class="chamada col-md-12">
						<h2><?php the_title(); ?></h2>
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


		<!-- header area -->
		<div class="row content center-block">
			<div class="main col-md-6">
				
				<div class="main-title col-md-4">
					<h4>Apvar em Ação</h4>
				</div>

					<div class="chamada col-md-8">
						<h5>Confira a atuação da Apvar conforme registros em diversos meios de comunicação</h5>
					</div>
					
					<div class="clearfix"></div>

						<hr>

							<?php

							// Loop da área "Apvar em Ação"
							query_posts( $args_apvaracao );

							 
							// Loop 
							while ( have_posts() ) : the_post();
							    echo '
							    <div class="envolve row col-md-12">

								    <div class="foto-materia col-md-4">',
										the_post_thumbnail(), 
									'</div>

								    <div class="main col-md-8">
								    	<h4 class="m-title">',
								    		'<a href="', the_permalink(), '">', the_title(),
								    	'</h4>',
								    
								    	'<p>',
											the_excerpt(), '</a>',
										'</p>',
									'</div>

								</div>';

							
								// Reseta o query de posts
								wp_reset_postdata();
							
							endwhile;

							?>


							<div class="clearfix"></div>


				<div class="main-title col-md-4">
					<h4>Quadro de Avisos</h4>
				</div>

					<div class="chamada col-md-8">
						<h5>Informe-se sobre eventos e fatos relevantes para os pilotos e outros aeronautas da ativa ou aposentados</h5>
					</div>

					<div class="clearfix"></div>

					<hr>

						<?php

						// Loop da área "Quadro de Avisos"
						query_posts( $args_quadroavisos );

						 
						// Loop 
						while ( have_posts() ) : the_post();
						    echo '
						    <div class="envolve row col-md-12">

						    <div class="foto-materia col-md-4">',
									the_post_thumbnail(), 
								'</div>

						    <div class="main col-md-8">
						    	<h4 class="m-title">',
						    		'<a href="', the_permalink(), '">', the_title(),
						    	'</h4>',
						    
						    	'<p>',
									the_excerpt(), '</a>',
								'</p>',
							'</div>
							</div>';

						
							// Reseta o query de posts
							wp_reset_postdata();
						
						endwhile;

						?>

					<div class="clearfix"></div>			

			</div>


			<!-- coluna do meio -->
			<div class="second middle-section col-md-4">
				
				<div class="main-title col-md-4">
					<h4>Deu na Imprensa</h4>
				</div>
					
					<div class="chamada col-md-8">
						<h5>Notícias sobre a indústria e outros temas de interesse específico.</h5>
					</div>

					<div class="clearfix"></div>

					<hr>


					<?php
					// Loop da área "Deu na Imprensa"
					query_posts( $args_deunaimprensa );

					 
					// Loop 
					while ( have_posts() ) : the_post();
					    echo '
					    <div class="envolve row  col-md-12">
					    
					    <div class="foto-materia col-md-4">',
							the_post_thumbnail(), 
						'</div>

					    <div class="main col-md-8">
					    	<h4 class="m-title">',
					    		'<a href="', the_permalink(), '">', the_title(),
					    	'</h4>',
					    
					    	'<p>',
								the_excerpt(), '</a>',
							'</p>',
						'</div>
						</div>';

					
						// Reseta o query de posts
						wp_reset_postdata();
					
					endwhile;

					?>
			
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

			<!-- aqui entra a parte antes do footer -->
			<div class="down-content col-md-12">

							<div class="main-title col-md-2">
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