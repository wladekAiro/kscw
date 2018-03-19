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
								<p class="byline vcard blog">
									<?php printf( __( 'Posted on <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'the-huxley' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
									<?php
									/* translators: used between list items, there is a space after the comma */
									$category_list = get_the_category_list( __( ', ', 'the-huxley' ) );
									printf( __('under %s', 'the-huxley'),
									$category_list
									);
									?>
								</p>

								<?php
									get_template_part( 'post-formats/format', get_post_format() );
								?>

         					</article> <?php // end article ?>

						<?php endwhile; ?> <?php endif; ?>
								<div class="next-prev-post">
									<div class="prev">
										<?php previous_post_link('<span>PREVIOUS POST</span> &larr; %link'); ?>
									</div>
									<div class="next">
										<?php next_post_link('<span>NEXT POST</span> %link &rarr;'); ?>
									</div>
									<div class="clear"></div>
								</div> 

								<?php 
									if ( get_theme_mod('huxley_author_bio',true) ) :
										$author_class = '';
									else:
										$author_class = ' ' . 'author-hide';
									endif;
								?>

				                <footer class="article-footer <?php echo  esc_attr($author_class); ?>">
				                	<h3><?php _e('About the Author','the-huxley'); ?></h3>
				                  <div class="avatar">
				                  	<?php echo get_avatar( get_the_author_meta( 'ID' ) , 100 ); ?>
				                  </div>
				                  <div class="info">
					                  <p class="author"><?php the_author(); ?></p>
					                  <p class="author-desc"> <?php if (function_exists('huxley_author_excerpt')){echo huxley_author_excerpt();} ?> </p>
				                  </div>
				                  <div class="clear"></div>
				                </footer> <?php // end article footer ?>

				                <?php huxley_related_posts(); ?>
				                
				                <?php comments_template(); ?>
						</div>
						<?php get_sidebar(); ?>
						<div class="clear"></div>
					</div>
					
				</div>

			</div>

<?php get_footer(); ?>