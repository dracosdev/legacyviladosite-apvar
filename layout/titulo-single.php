<div class="main-title col-md-12">
	<div class="envolve-titulo">
		<img id='logo-title' class="plane-title" src='<?php echo get_bloginfo('template_directory') . '/img/title-apvar.png'; ?>' alt='Logotipo'>
		<?php 
			$category = get_the_category();
			$firstCategory = $category[0]->cat_name;
		?>
		<h2><?php  echo $firstCategory; ?></h2>
	</div>
</div>

<div class="separator col-md-12"></div>
<div class="clearfix"></div>