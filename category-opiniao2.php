<?php get_header();

// Define o nome da sidebar usada nessa página
// Deixar vazio caso não queira sidebar nesta página
$sidebar_name = 'lat_right_categories_widgets'; ?>
		<div class="row content center-block">
			<div class="main col-md-12">
				<?php get_template_part('layout/titulo-categ');

				// Função que abre a div de coluna variando de acordo com apresença da sidebar
				if (is_active_sidebar($sidebar_name)) {echo '<div class="col-md-9">';}
				else {echo '<div id="conteudo" class="col-md-12">';};

					get_template_part('layout/loop-geral-lastpost');

					//pega o slug da categoria atual
					if(is_category()) {
					$categoria = get_query_var('cat');
					$current_categoria = get_category($categoria); }

					//remove o caractere 2 do slug para ser usado no link
					$categoria_slug = substr($current_categoria->slug, 0, -1);

					echo '<a href="'.$categoria_slug.'" title="nome da categoria">Ver todas as postagens.</a>';

				echo "</div>";
				
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