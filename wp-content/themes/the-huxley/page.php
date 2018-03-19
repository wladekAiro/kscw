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
								<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
							</div>
							</header> <?php // end article header ?>
						
						<div id="inner-content" class="wrap cf post-content-single">
						<div class="m-all t-2of3 d-5of7 cf">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">
								<section itemprop="articleBody" class="entry-content cf">
									<?php the_content(); ?>
								</section>
         					</article> <?php // end article ?>
						<?php endwhile; ?> <?php endif; ?>
								
				            <?php comments_template(); ?>
						</div>
						<?php get_sidebar(); ?>
						<div class="clear"></div>
					</div>
					

					

				</div>

			</div>

<?php get_footer(); ?>