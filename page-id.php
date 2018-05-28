<?php get_header(); ?>



		<!-- header area -->
		<div class="row content center-block">
			<div class="main col-md-10">

				<?php if (have_posts()) : while(have_posts()) : the_post(); ?>


					<div class="main-title col-md-12">
						<h2><?php the_title(); ?></h2>
						<?php the_content(); ?>

					</div>
				<?php endwhile; else: ?>
				<?php endif; ?>	
					
					<div class="clearfix"></div>

					<hr>

					<div class="clearfix"></div>			
			</div>

			<!-- area da sidebar -->
			<div class="bordas">
			<aside class="complementary col-md-2">

					<?php get_sidebar(); ?>
					

						<div class="clearfix"></div>
						
			</aside>
			</div>


			<div class="separator col-md-12">
			</div>	

			<div class="clearfix"></div>


		</div>

		<!-- footer area -->
<?php get_footer(); ?>