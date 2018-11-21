<!-- Início do loop de posts -->
<?php if (have_posts()) : while(have_posts()) : the_post();	?>
	
	<div class="chamada col-md-12">
	
		<a href="<?php echo esc_url( get_permalink($post->ID)); ?>">
			<div class="envolve-titulo envolve-titulo-interno">
				<h2><?php the_title(); ?></h2>
			</div>
			<div>
				<?php the_content(); ?>	
			</div>
		</a>

	</div>

<?php endwhile; else: ?>
<?php endif; ?>	