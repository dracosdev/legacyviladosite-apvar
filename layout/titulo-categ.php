<div class="main-title col-md-12">
	<div class="envolve-titulo">
		<img id='logo-title' class="plane-title" src='<?php echo get_bloginfo('template_directory') . '/img/title-apvar.png'; ?>' alt='Logotipo'>
			<?php
			$titulo_categ = single_cat_title('', true );
			$titulo_ajustado = substr( $titulo_categ, -4); ?>
		<h2><?php $titulo_ajustado; ?></h2>
	</div>
</div>

<div class="separator col-md-12"></div>
<div class="clearfix"></div>