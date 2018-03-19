<div class="thumb-wrap">
	<?php
		$thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
		$thumb_url = $thumb_url_array[0]; 
		$image_full = huxley_catch_that_image(); 
		$gallery_full = huxley_catch_gallery_image_full();
	?>
	<a href="<?php the_permalink(); ?>">
	<?php if(has_post_thumbnail()): ?>
		<div class="image-bg" style="background-image:url(<?php echo esc_url( $thumb_url ); ?>);">
	<?php elseif(!empty($image_full)): ?>
		<div class="image-bg" style="background-image:url(<?php echo esc_url( $image_full ); ?>);">
	<?php elseif(!empty($gallery_full)) : ?>
		<div class="image-bg" style="background-image:url(<?php echo esc_url( $gallery_full ); ?>);">
	<?php else: ?>
		<div class="no-bg">
	<?php endif; ?>
		</div>
	</a>
</div>

<div class="the-post-content">
	<div class="table">
		<div class="table-cell">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="date">
				<?php printf( __( '<time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'the-huxley' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format'))); ?>
			</div>
			<?php the_excerpt(); ?>
		</div>
	</div>
</div>
<div class="clear"></div>