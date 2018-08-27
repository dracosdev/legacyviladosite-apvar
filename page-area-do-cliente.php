<?php get_header();

// Define o nome da sidebar usada nessa página
// Deixar vazio caso não queira sidebar nesta página
$sidebar_name = 'lat_right_customer_widgets'; ?>

		<div class="row content center-block">
			<div class="main col-md-12">

			<?php
			if (have_posts()) : while(have_posts()) : the_post();

				get_template_part('layout/titulo-pages');

				// Função que abre a div de coluna variando de acordo com apresença da sidebar
				if (is_active_sidebar($sidebar_name)) {echo '<div class="col-md-9">';}
				else {echo '<div id="conteudo" class="col-md-12">';};
					get_template_part('layout/loop-pages');
				echo "</div>";

			endwhile; else:
			endif; ?>

				<!-- area da sidebar -->
				<div class="bordas">
					<aside class="complementary col-md-3">
						<?php if(is_active_sidebar($sidebar_name)){
				            dynamic_sidebar($sidebar_name);
		    			}; ?>
						<div class="clearfix"></div>
					</aside>
				</div>
				<div class="clearfix"></div>
				<hr>
				<div class="clearfix"></div>			
			</div>
			<div class="separator col-md-12"></div>	
			<div class="clearfix"></div>
		</div>
<?php get_footer(); ?>