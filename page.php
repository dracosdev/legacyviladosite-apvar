<?php get_header(); ?>



		<!-- header area -->
		<div class="row content center-block">
			<div class="main col-md-12">

				<?php if (have_posts()) : while(have_posts()) : the_post(); ?>

					<div class="main-title col-md-12">
						<div class="envolve-titulo">
						<img id='logo-title' class="plane-title" src='<?php echo get_bloginfo('template_directory') . '/img/title-apvar.png'; ?>' alt='Logotipo'>
						
						<h2><?php the_title(); ?></h2>
						</div>
					</div>

					<div class="separator col-md-12">
					</div>

					<div class="clearfix"></div>

					<div class="chamada col-md-12">
						
						<?php the_content(); ?>

					</div>

				<?php endwhile; else: ?>
				<?php endif; ?>	
					
					<div class="clearfix"></div>

					<hr>

					<div class="clearfix"></div>			
			</div>

			<!-- area da sidebar -->
			


			<div class="separator col-md-12">
			</div>	

			<div class="clearfix"></div>


		</div>

		<!-- footer area -->
<?php get_footer(); ?>