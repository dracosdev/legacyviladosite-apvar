<?php get_header();

// Define o nome da sidebar usada nessa página
// Deixar vazio caso não queira sidebar nesta página
$sidebar_name = 'lat_right_pages_widgets'; ?>

		<div class="row content center-block">
			<div class="main col-md-12">

			<?php
			if (have_posts()) : while(have_posts()) : the_post();

				get_template_part('layout/titulo-pages');
				
				echo '<div id="conteudo" class="col-md-12">';
					get_template_part('layout/loop-pages');
				echo "</div>";

			endwhile; else:
			endif; ?>

				
				<div class="clearfix"></div>
				<hr>
				<div class="clearfix"></div>			
			</div>
			<div class="separator col-md-12"></div>	
			<div class="clearfix"></div>
		</div>
<?php get_footer(); ?>