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