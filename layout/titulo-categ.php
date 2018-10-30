<?php header('Content-type: text/html; charset=utf-8'); ?>
<div class="main-title col-md-12">
	<div class="envolve-titulo">
		<img id='logo-title' class="plane-title" src='<?php echo get_bloginfo('template_directory') . '/img/title-apvar.png'; ?>' alt='Logotipo'>
			<?php
			
			// Cria as variáveis a utilizar.
			$titulo_categ = single_cat_title('', false );
			$titulo_ajustado = '';

			// Busca o nome da categoria, verifica se é terminado em 2 e, se for, ajusta removendo o '2' no final.
			if (substr($titulo_categ, -1) == '2') {
				$titulo_ajustado = substr($titulo_categ, 0, -2);
			} else {
				$titulo_ajustado = $titulo_categ;
			};

			?>
		
		<h2><?php echo $titulo_ajustado; ?></h2>
	</div>
</div>

<div class="separator col-md-12"></div>
<div class="clearfix"></div>