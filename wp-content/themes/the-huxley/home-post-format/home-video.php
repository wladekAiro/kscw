<div class="thumb-wrap">
	<div class="video-container">
		<?php if(class_exists('acf')): 
			echo get_field('wpdevshed_post_format_embed_video'); 
		else: the_excerpt(); endif; ?>
	</div>
</div>

<div class="the-post-content">
	<div class="table">
		<div class="table-cell">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="date">
				<?php printf( __( '<time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'the-huxley' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format'))); ?>
			</div>
			<?php if(class_exists('acf')) : ?> 
			<p class="status-content"><?php echo get_field('wpdevshed_post_format_status_content'); ?></p> 
			<?php else: the_excerpt(); endif; ?>
		</div>
	</div>
</div>
<div class="clear"></div>