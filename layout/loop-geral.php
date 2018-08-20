<!-- Início do loop de posts -->
<?php if (have_posts()) : while(have_posts()) : the_post();	?>
	
	<div class="chamada col-md-12">
	
		<div class="envolve-titulo envolve-titulo-interno">
			<h2><?php the_title(); ?></h2>
		</div>

		<div> <?php the_excerpt(); ?> </div>

	</div>

<?php endwhile; else: ?>
<?php endif; ?>	