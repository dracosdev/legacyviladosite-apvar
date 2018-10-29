<?php header('Content-type: text/html; charset=utf-8'); ?>
<div class="main-title col-md-12">
	<div class="envolve-titulo">
		<img id='logo-title' class="plane-title" src='<?php echo get_bloginfo('template_directory') . '/img/title-apvar.png'; ?>' alt='Logotipo'>
			<?php
			
			// Busca o nome da categoria e ajusta removendo o '2' no final.
			$titulo_categ = single_cat_title('', false );
			$titulo_ajustado = mb_substr( $titulo_categ, 0, -2); ?>
		
		<h2><?php echo $titulo_ajustado; ?></h2>
	</div>
</div>

<div class="separator col-md-12"></div>
<div class="clearfix"></div>