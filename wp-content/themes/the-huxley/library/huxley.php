<?php

// remove injected CSS for recent comments widget
function huxley_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function huxley_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function huxley_scripts_and_styles() {

  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

		// modernizr (without media query polyfill)
		wp_enqueue_script( 'huxley-modernizr', get_template_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array('jquery'), '2.5.3', false );

		
		wp_enqueue_style( 'huxley-scroll-style', get_template_directory_uri() . '/library/css/jquery.mCustomScrollbar.css', array(), '', 'all' );
		wp_enqueue_style( 'huxley-font', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '', 'all' );
		// ie-only style sheet
		wp_enqueue_style( 'huxley-ie-only', get_template_directory_uri() . '/library/css/ie.css', array(), '' );

		// register main stylesheet
		wp_enqueue_style('huxley-fonts', get_template_directory_uri() . '/fonts/fonts.css');
		wp_enqueue_style( 'huxley-stylesheet', get_template_directory_uri() . '/library/css/style.min.css', array(), '', 'all' );
		wp_enqueue_style( 'huxley-main-stylesheet', get_stylesheet_uri(), array(), '', 'all' );

	    // comment reply script for threaded comments
	    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			  wp_enqueue_script( 'comment-reply' );
	    }

		//adding scripts file in the footer
		wp_enqueue_script( 'huxley-scroll-js', get_template_directory_uri() . '/library/js/jquery.mCustomScrollbar.concat.min.js', array('jquery'), '', true);
		wp_enqueue_script( 'huxley-js', get_template_directory_uri() . '/library/js/scripts.js', array('jquery'), '', true );

		if ( is_home() ){
			wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/library/js/imagesloaded.pkgd.js', array('jquery'), '', true);
			wp_enqueue_script( 'cycle2', get_template_directory_uri() . '/library/js/jquery.cycle2.js', array('jquery'), '', true );
			wp_enqueue_script( 'cycle2_tile', get_template_directory_uri() . '/library/js/jquery.cycle2.tile.js' , array('jquery'), '', true);
			wp_enqueue_script( 'cycle2_shuffle', get_template_directory_uri() . '/library/js/jquery.cycle2.shuffle.js', array('jquery'), '', true );
			wp_enqueue_script( 'cycle2_scrollvert', get_template_directory_uri() . '/library/js/jquery.cycle2.scrollVert.js', array('jquery'), '', true );
			wp_enqueue_script( 'huxley-scripts-home', get_template_directory_uri() . '/library/js/scripts-home.js', array('jquery'), '', true );
		}
		$wp_styles->add_data( 'huxley-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

}
/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function huxley_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );
	// default thumb size
	set_post_thumbnail_size(125, 125, true);
	
	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',    // background image default
	    'default-color' => 'ffffff',    // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	add_theme_support( 'title-tag' );

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'the-huxley' ),   // main nav in header
		)
	);

} /* end huxley theme support */


if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function huxley_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
    add_action( 'wp_head', 'huxley_render_title' );
    
    add_filter( 'wp_title', 'huxley_rw_title', 10, 3 );
	function huxley_rw_title( $title, $sep, $seplocation ) {
	  global $page, $paged;

	  // Don't affect in feeds.
	  if ( is_feed() ) return $title;

	  // Add the blog's name
	  if ( 'right' == $seplocation ):
	    $title .= get_bloginfo( 'name' );
	  else:
	    $title = get_bloginfo( 'name' ) . $title;
	  endif;

	  // Add the blog description for the home/front page.
	  $site_description = get_bloginfo( 'description', 'display' );

	  if ( $site_description && ( is_home() || is_front_page() ) ):
	    $title .= " {$sep} {$site_description}";
	  endif;

	  // Add a page number if necessary:
	  if ( $paged >= 2 || $page >= 2 ):
	    $title .= " {$sep} " . sprintf( __( 'Page %s', 'the-huxley' ), max( $paged, $page ) );
	  endif;

	  return $title;

	} // end better title

endif;

/*********************
SLIDER FUNCTION
*********************/

function huxley_slider_area(){
	if ( get_theme_mod('huxley_display_slider',true) ) :
		$slider_class = '';
	else:
		$slider_class = ' ' . 'slider-hide';
	endif;
	?>
	<?php if(is_home()): ?>
	<div id="slide-wrap" class="full-top-area<?php echo esc_attr( $slider_class ); ?>">

		<div id="load-cycle"></div>
		
		<?php 	
			$args = array('posts_per_page' => 10,'post_status' => 'publish','post__in' => get_option("sticky_posts"));
			$fPosts = new WP_Query( $args );
		?>

		<?php if ( $fPosts->have_posts() ) : ?>

			<div class="cycle-slideshow" 
			<?php if ( get_theme_mod('huxley_slider_effect') ) :
			echo 'data-cycle-fx="' . wp_kses_post( get_theme_mod('huxley_slider_effect') ) . '" data-cycle-tile-count="10"';
			else:
			echo 'data-cycle-fx="scrollHorz"';
			endif;?> 
			data-cycle-slides="> div.slides" 
			<?php if ( get_theme_mod('huxley_slider_timeout') ): 
			$slider_timeout = wp_kses_post( get_theme_mod('huxley_slider_timeout') );
			echo 'data-cycle-timeout="' . $slider_timeout . '000"';
			else:
			echo 'data-cycle-timeout="5000"';
			endif; ?> 
			data-cycle-prev="#sliderprev" data-cycle-next="#slidernext">


				<?php while ( $fPosts->have_posts() ) : $fPosts->the_post();  ?>

					<div class="slides">

						<div id="post-<?php the_ID(); ?>" <?php post_class('post-theme'); ?>>

							<?php 
								$image_full = huxley_catch_that_image(); 
								$gallery_full = huxley_catch_gallery_image_full(); 
							?>

							<?php if ( has_post_thumbnail()) : ?>

								<div class="slide-thumb">
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail( "full" ); ?>
									</a>
									<div class="bg-overlay"></div>
								</div>

								<?php elseif(has_post_format('image') && !empty($image_full)) : ?>
									<div class="slide-thumb">
										<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<img class="attachment-full" src="<?php echo esc_url($image_full); ?>">
										</a><div class="bg-overlay"></div>
									</div>

								<?php elseif(has_post_format('gallery') && !empty($gallery_full)) : ?>  
									<div class="slide-thumb">
										<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<img class="attachment-full" src="<?php echo esc_url($gallery_full); ?>">
										</a>
										<div class="bg-overlay"></div>
									</div>
									
								<?php else: ?>
									<div class="slide-noimg"></div>

							<?php endif; ?>

						</div>


						<div class="slide-copy-wrap">
							<div class="table">
								<div class="table-cell"> 
									<div class="slide-copy">
										<h2 class="slide-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Read %s', 'the-huxley' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
										<?php the_excerpt(); ?> 
										<a href="#main-header" class="arrow fa fa-angle-down"></a>
									</div>
								</div>
							</div>
						</div>

					</div>

				<?php endwhile; ?>

				<div class="slidernav">
					<a id="sliderprev" href="#" title="<?php _e('Previous', 'the-huxley'); ?>"><span class="fa fa-angle-left"></span></a>
					<a id="slidernext" href="#" title="<?php _e('Next', 'the-huxley'); ?>"><span class="fa fa-angle-right"></span></a>
				</div>

			</div>

		<?php endif; ?>

		<?php wp_reset_postdata(); ?>

		</div> <!-- slider-wrap -->
	<?php endif;
}

/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using huxley_related_posts(); )
function huxley_related_posts() {
	global $post;

	if ( get_theme_mod('huxley_related_posts') ) :
    	$related_class = '';
    else:
    	$related_class = ' ' . 'related-hide';
    endif;
				                
	$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3, 'post__not_in' => array($post->ID) ) ); ?>
    <?php if (!empty($related)) : ?>
        <div class="related posts <?php echo esc_attr( $related_class ); ?>">
            <h3><?php _e('Related Posts','the-huxley'); ?></h3>
            <div class="related-wrap"> 
                <?php if( $related ): foreach( $related as $post ) { ?>
                <?php setup_postdata($post); ?>

                    <div class="related-item">
                      <div class="related-image">
                          <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                            <?php 
                            	$image_thumb = huxley_catch_that_image_thumb(); 
                            	$gallery_thumb = huxley_catch_gallery_image_thumb(); 
                            ?>
                            
                            <?php if ( has_post_thumbnail()):
                            	the_post_thumbnail('huxley-thumb-image-300by300');
                            
                            elseif(has_post_format('gallery') && !empty($gallery_thumb)): 
                            	echo esc_url($gallery_thumb); 
                            
                            elseif(has_post_format('image') && !empty($image_thumb)): 
                            	echo esc_url($image_thumb); 
                            else: ?>
                            	<img src="<?php echo huxley_IMAGES; ?>/blank.jpg">
                            <?php endif; ?>
                          </a>
                      </div>

                      <div class="related-info">
                          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                      </div>
                       
                    </div>
                
                <?php } endif; wp_reset_postdata(); ?>
                <div class="clear"></div>
              </div>
         </div>
    <?php endif;
} /* end huxley related posts function */

/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function huxley_page_navi() {
  global $wp_query, $paged;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '<i class="fa fa-chevron-left"></i>',
    'next_text'    => '<i class="fa fa-chevron-right"></i>',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function huxley_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function huxley_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...<a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read ', 'the-huxley' ) . get_the_title($post->ID).'">'. __( 'read more', 'the-huxley' ) .'</a>';
}

add_action( 'wp_enqueue_media', 'huxley_mgzc_media_gallery_zero_columns' );
function huxley_mgzc_media_gallery_zero_columns(){
    add_action( 'admin_print_footer_scripts', 'huxley_mgzc_media_gallery_zero_columns_script', 999);
}
function huxley_mgzc_media_gallery_zero_columns_script(){
?>
<script type="text/javascript">
jQuery(function(){
    if(wp.media.view.Settings.Gallery){
        wp.media.view.Settings.Gallery = wp.media.view.Settings.extend({
            className: "gallery-settings",
            template: wp.media.template("gallery-settings"),
            render: function() {
                wp.media.View.prototype.render.apply( this, arguments );
                // Append an option for 0 (zero) columns if not already present...
                var $s = this.$('select.columns');
               
                   $s.find('option[value="5"]').remove();
                   $s.find('option[value="6"]').remove();
                   $s.find('option[value="7"]').remove();
                   $s.find('option[value="8"]').remove();
                   $s.find('option[value="9"]').remove();
                // Select the correct values.
                _( this.model.attributes ).chain().keys().each( this.update, this );
                return this;
            }
        });
    }
});
</script>
<?php
}

/*video*/

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_video',
		'title' => 'Video',
		'fields' => array (
			array (
				'key' => 'field_542906321cdab',
				'label' => 'Embed Video',
				'name' => 'wpdevshed_post_format_embed_video',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'html',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

/*link*/
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_link',
		'title' => 'Link',
		'fields' => array (
			array (
				'key' => 'field_54290c22892fe',
				'label' => 'Link',
				'name' => 'wpdevshed_post_format_link_url',
				'type' => 'text',
				'instructions' => 'place url here',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'link',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

/*quote*/
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_quote',
		'title' => 'Quote',
		'fields' => array (
			array (
				'key' => 'field_5428fc13708c4',
				'label' => 'Quote Content',
				'name' => 'wpdevshed_post_format_quote_content',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'none',
			),
			array (
				'key' => 'field_5428fc4e3e3fc',
				'label' => 'Quote Source',
				'name' => 'wpdevshed_post_format_quote_source',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'quote',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_audio',
		'title' => 'Audio',
		'fields' => array (
			array (
				'key' => 'field_542a4c44cc3c2',
				'label' => 'Upload Audio File Here',
				'name' => 'wpdevshed_post_format_audio_content',
				'type' => 'file',
				'save_format' => 'url',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'audio',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_status',
		'title' => 'Status',
		'fields' => array (
			array (
				'key' => 'field_542a5b07626a0',
				'label' => 'Insert Short Status Here',
				'name' => 'wpdevshed_post_format_status_content',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'none',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'status',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_chat',
		'title' => 'Chat',
		'fields' => array (
			array (
				'key' => 'field_542a5d28507df',
				'label' => 'Insert Chat Conversation here',
				'name' => 'wpdevshed_post_format_chat_content',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'chat',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}