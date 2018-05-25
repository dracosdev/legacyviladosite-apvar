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
		<div class="row content center-block content-category">
			<div class="main col-md-10">
				
				<div class="main-title col-md-12">
					<h3><i class="fa fa-plane"></i><?php single_cat_title('Categoria atual: ');
					?>
					</h3>
				</div>

				<?php

				// Loop da área "Apvar em Ação"
				query_posts( $args_apvaracao );

				 
				// Loop 
				while ( have_posts() ) : the_post();
				    echo '
				    <div class="chamada col-md-12">

					    <div class="foto-materia col-md-4">',
							the_post_thumbnail(), 
						'</div>

					    <div class="main col-md-8">
					    	<h4 class="m-title">',
					    		'<a href="', the_permalink(), '">', the_title(),
					    	'</h4>',
					    
					    	'<p>',
								the_excerpt(), '[ leia mais]</a>',
							'</p>',
						'</div>

						<div class="clearfix"></div>

						<hr>

					</div>';

				
					// Reseta o query de posts
					wp_reset_postdata();
				
				endwhile;

				?>

				<?php /*if (have_posts()) : while(have_posts()) : the_post(); ?>


					<div class="chamada col-md-12">
						<h2><?php the_title(); ?></h2>
						<?php the_content(); ?>

					</div>
					<div class="clearfix"></div>

					<hr>
				<?php endwhile; else: ?>
				<?php endif; */?>	
					
					

					<div class="clearfix"></div>			
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


		</div>


		<!-- footer area -->
<?php get_footer(); ?>