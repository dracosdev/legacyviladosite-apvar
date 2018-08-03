<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
	<div class="main-title col-md-12">
		<div class="envolve-titulo">
			<img id='logo-title' class="plane-title" src='<?php echo get_bloginfo('template_directory') . '/img/title-apvar.png'; ?>' alt='Logotipo'>
			
			<h2><?php the_title(); ?></h2>
		</div>
	</div>

	<div class="separator col-md-12"></div>
	<div class="clearfix"></div>

	<div class="envolve-base col-md-12">
		<?php if (tem_filhos()) {pega_filhos();} else {the_content();}?>
	</div>
<?php endwhile; else: ?>
<?php endif; ?>	