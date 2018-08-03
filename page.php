<?php get_header(); ?>
		<div class="row content center-block">
			<div class="main col-md-12">
			
			<?php get_template_part('layout/loop-pages'); ?>

				<!-- area da sidebar -->
				<div class="bordas">
					<aside class="complementary col-md-3">

						<?php if(is_active_sidebar('lat_right_pages_widgets')){
				            dynamic_sidebar('lat_right_pages_widgets');
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