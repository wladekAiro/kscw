<?php get_header(); ?>
	<div class="front-wrapper">
		
		<div id="content">
			<div class="wrap">
				<div class="blog-list" id="blog">
						<?php while ( have_posts() ) : the_post(); ?>
		  						
		  						<article class="item">
			  						<?php get_template_part( 'home-post-format/home', get_post_format() ); ?>
								</article>
		  				<?php endwhile;  ?>
		 				<div class="clear"></div>

				</div>
				<?php  huxley_page_navi(); ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div> <!-- content -->
	</div><!-- front-wrapper -->

<?php get_footer(); ?>