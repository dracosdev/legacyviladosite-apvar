<?php get_header();

// Define o nome da sidebar usada nessa página
// Deixar vazio caso não queira sidebar nesta página
$sidebar_name = 'lat_right_categories_widgets'; ?>
		<div class="row content center-block">
			<div class="main col-md-12">

				<?php

				// Função que verifica se a categoria tem uma versão "2" e carrega o category2.php caso tenha.

				// Roda a função de checagem de categoria
					checa_categ();
					var_dump(checa_categ());	

				if ($categoria_slug != '') {
					get_template_part('layout/titulo-categ');

				// Função que abre a div de coluna variando de acordo com apresença da sidebar
				if (is_active_sidebar($sidebar_name)) {echo '<div class="col-md-9">';}
				else {echo '<div id="conteudo" class="col-md-12">';};

					get_template_part('layout/loop-geral-lastpost');


					echo '<div class="col-md-12 text-center"><h3><a href="'.$categoria_slug.'" title="nome da categoria">Ver todas as publicações desta categoria.</a></h3></div>';

					echo "</div>";
				
				}
				
				else{

					// Carrega o título
					get_template_part('layout/titulo-geral');

					// Função que abre a div de coluna variando de acordo com apresença da sidebar
					if (is_active_sidebar($sidebar_name)) {echo '<div class="col-md-9">';}
					else {echo '<div id="conteudo" class="col-md-12">';};

						get_template_part('layout/loop-geral-paginado');
						echo "<div class='col-md-12 center-block paginacao'> ";
						wordpress_pagination();
						echo "</div>";

					echo "</div>";

				}
					
					?>

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
			<?php bs_separator(); ?>
		</div>
<?php get_footer(); ?>