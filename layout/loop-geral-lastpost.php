<!-- Início do loop de posts -->
<?php

// Variáveis
$category = get_category( get_query_var( 'cat' ) );
$cat_id = $category->cat_ID;

// Argumentos
$args = array(
    'posts_per_page' => 1,
    'cat' => $cat_id    
);

// Loop
query_posts($args);

if (have_posts()) : while(have_posts()) : the_post();	?>
	
	<div class="chamada col-md-12">
	
		<div class="envolve-titulo envolve-titulo-interno">
			<h2><?php the_title(); ?></h2>
		</div>

		<div> <?php the_content(); ?> </div>

	</div>

<?php
endwhile;
else:
endif; ?>