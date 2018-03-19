<?php get_header(); ?>

			<div id="content">
				<div id="inner-content" class=" cf">
					<?php 
							$thumb_id = get_post_thumbnail_id();
							$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
							$thumb_url = $thumb_url_array[0];
							$image_full = huxley_catch_that_image(); $gallery_full = huxley_catch_gallery_image_full(); 
						?>

						<?php if ( has_post_thumbnail()): ?>
							<header class="article-header" style="background-image:url('<?php echo esc_url( $thumb_url ); ?>');background-size:cover;background-position:center;position:relative;">
						
						<?php elseif(has_post_format('gallery') && !empty($gallery_full)): ?>
						     <header class="article-header" style="background-image:url('<?php echo esc_url( $gallery_full ); ?>');background-size:cover;background-position:center;position:relative;">
						
						<?php elseif(has_post_format('image') && !empty($image_full)):  ?>
							<header class="article-header" style="background-image:url('<?php echo esc_url( $image_full ); ?>');background-size:cover;background-position:center;position:relative;">
						
						<?php else: ?>	
							<header class="article-header no-bg">

						<?php endif; ?>

							<div class="bg-overlay"></div>
							<div class="wrap">
								<h1 class="archive-title"><span><?php _e( 'Search Results for:', 'the-huxley' ); ?></span> <?php echo esc_html(get_search_query()); ?></h1>
							</div>
							</header> <?php // end article header ?>
						<div class="wrap">
						<div class="blog-list" id="blog">
						<?php while (  have_posts() ) :  the_post(); ?>
		  						
		  						<article class="item">
			  						<?php get_template_part( 'home-post-format/home', get_post_format() ); ?>
								</article>

		  				<?php endwhile;  ?>
		 				<div class="clear"></div>

						</div>
						<?php  huxley_page_navi(); ?>
						<?php wp_reset_postdata(); ?>
					</div>

				</div>

			</div>

<?php get_footer(); ?>