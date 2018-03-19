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
								<?php if (is_category()) : ?>
										<h1 class="archive-title h2">
											<span><?php _e( 'Posts Categorized:', 'the-huxley' ); ?></span> <?php single_cat_title(); ?>
										</h1>

										<?php elseif (is_tag()): ?>
										<h1 class="archive-title h2">
											<span><?php _e( 'Posts Tagged:', 'the-huxley' ); ?></span> <?php single_tag_title(); ?>
										</h1>

										<?php elseif (is_author()) :
										global $post;
										$author_id = $post->post_author;
										?>
										<h1 class="archive-title h2">

											<span><?php _e( 'Posts By:', 'the-huxley' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

										</h1>

										<?php elseif (is_day()): ?>
										<h1 class="archive-title h2">
											<span><?php _e( 'Daily Archives:', 'the-huxley' ); ?></span> <?php the_time(get_option('date_format')); ?>
										</h1>

										<?php elseif (is_month()): ?>
											<h1 class="archive-title h2">
												<span><?php _e( 'Monthly Archives:', 'the-huxley' ); ?></span> <?php the_time(get_option('date_format')); ?>
											</h1>

										<?php elseif (is_year()): ?>
											<h1 class="archive-title h2">
												<span><?php _e( 'Yearly Archives:', 'the-huxley' ); ?></span> <?php the_time(get_option('date_format')); ?>
											</h1>
										<?php endif; ?>
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