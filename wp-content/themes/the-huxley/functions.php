<?php

// LOAD huxley CORE (if you remove this, the theme will break)
require_once( 'library/huxley.php' );


function huxley_ahoy() {

  // let's get language support going, if you need it
  load_theme_textdomain( 'the-huxley', get_template_directory() . '/library/translation' );

  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'huxley_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'huxley_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'use_default_gallery_style', '__return_false' ); 

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'huxley_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  huxley_theme_support();

  // adding sidebars to WordPress (these are created in functions.php)
  add_action( 'widgets_init', 'huxley_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'huxley_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'huxley_excerpt_more' );

  /************* OEMBED SIZE OPTIONS *************/

  global $content_width;
  if ( ! isset( $content_width ) ) {
  $content_width = 640;
  }

  set_post_thumbnail_size( 600, 600 );

  // Thumbnail sizes
  add_image_size( 'huxley-thumb-600', 600, 150, true );
  add_image_size( 'huxley-thumb-300', 300, 100, true );
  add_image_size( 'huxley-slider-image', 1280, 500, true );
  add_image_size( 'huxley-thumb-image-300by300', 300, 300, true );

} /* end huxley ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'huxley_ahoy' );


/************* THUMBNAIL SIZE OPTIONS *************/


add_filter( 'image_size_names_choose', 'huxley_custom_image_sizes' );
function huxley_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'huxley-thumb-600' => '600px by 150px',
        'huxley-thumb-300' => '300px by 100px',
        'huxley-slider-image' => '1280px by 500px'
    ) );
}


/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function huxley_register_sidebars() {
  register_sidebar(array(
    'id' => 'sidebar1',
    'name' => __( 'Posts Menu Widget Area', 'the-huxley' ),
    'description' => __( 'The Posts Menu Widget Area.', 'the-huxley' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'sidebar2',
    'name' => __( 'Page Menu Widget Area', 'the-huxley' ),
    'description' => __( 'The Page Menu Widget Area.', 'the-huxley' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer-1',
    'name' => __( 'Footer Widget Area 1', 'the-huxley' ),
    'description' => __( 'The Footer Widget Area.', 'the-huxley' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer-2',
    'name' => __( 'Footer Widget Area 2', 'the-huxley' ),
    'description' => __( 'The Footer Widget Area.', 'the-huxley' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer-3',
    'name' => __( 'Footer Widget Area 3', 'the-huxley' ),
    'description' => __( 'The Footer Widget Area.', 'the-huxley' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer-4',
    'name' => __( 'Footer Widget Area 4', 'the-huxley' ),
    'description' => __( 'The Footer Widget Area.', 'the-huxley' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));





} // don't remove this bracket!


function huxley_editor_styles() {
    add_editor_style( 'huxley-editor-style.css' );
}
add_action( 'admin_init', 'huxley_editor_styles' );

/************* COMMENT LAYOUT *********************/

// Comment Layout
function huxley_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="//www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=100" class="load-gravatar avatar avatar-48 photo" height="100" width="100" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'the-huxley' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'the-huxley' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'the-huxley' ),'  ','') ) ?>
        <br>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'the-huxley' )); ?> </a></time>
        <?php comment_text() ?>
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </section>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*******************************************************************
* These are settings for the Theme Customizer in the admin panel. 
*******************************************************************/
if ( ! function_exists( 'huxley_theme_customizer' ) ) :
  function huxley_theme_customizer( $wp_customize ) {
    
  
    /* color scheme option */
    $wp_customize->add_setting( 'huxley_color_settings', array (
      'default' => '#454545',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'huxley_color_settings', array(
      'label'    => __( 'Primary Color Scheme', 'the-huxley' ),
      'section'  => 'colors',
      'settings' => 'huxley_color_settings',
    ) ) );


    $wp_customize->add_setting( 'huxley_color_settings_2', array (
      'default' => '#62ABDB',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'huxley_color_settings_2', array(
      'label'    => __( 'Secondary Color Scheme', 'the-huxley' ),
      'section'  => 'colors',
      'settings' => 'huxley_color_settings_2',
    ) ) );

    
    /* logo option */
    $wp_customize->add_section( 'huxley_logo_section' , array(
      'title'       => __( 'Site Logo', 'the-huxley' ),
      'priority'    => 1,
      'description' => __( 'Upload a logo to replace the default site name in the header', 'the-huxley' ),
    ) );
    
    $wp_customize->add_setting( 'huxley_logo', array(
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'huxley_logo', array(
      'label'    => __( 'Choose your logo (ideal width is 100-350px and ideal height is 35-40)', 'the-huxley' ),
      'section'  => 'huxley_logo_section',
      'settings' => 'huxley_logo',
    ) ) );
  
    /* favicon option */
    $wp_customize->add_section( 'huxley_favicon_section' , array(
      'title'       => __( 'Site favicon', 'the-huxley' ),
      'priority'    => 2,
      'description' => __( 'Upload a favicon', 'the-huxley' ),
    ) );
    
    $wp_customize->add_setting( 'huxley_favicon', array(
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'huxley_favicon', array(
      'label'    => __( 'Choose your favicon (ideal width and height is 16x16 or 32x32)', 'the-huxley' ),
      'section'  => 'huxley_favicon_section',
      'settings' => 'huxley_favicon',
    ) ) );
    
    /* social media option */
    $wp_customize->add_section( 'huxley_social_section' , array(
      'title'       => __( 'Social Media Icons', 'the-huxley' ),
      'priority'    => 32,
      'description' => __( 'Optional media icons in the header', 'the-huxley' ),
    ) );
    
    $wp_customize->add_setting( 'huxley_facebook', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_facebook', array(
      'label'    => __( 'Enter your Facebook url', 'the-huxley' ),
      'section'  => 'huxley_social_section',
      'settings' => 'huxley_facebook',
      'priority'    => 101,
    ) ) );
  
    $wp_customize->add_setting( 'huxley_twitter', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_twitter', array(
      'label'    => __( 'Enter your Twitter url', 'the-huxley' ),
      'section'  => 'huxley_social_section',
      'settings' => 'huxley_twitter',
      'priority'    => 102,
    ) ) );
    
    $wp_customize->add_setting( 'huxley_google', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_google', array(
      'label'    => __( 'Enter your Google+ url', 'the-huxley' ),
      'section'  => 'huxley_social_section',
      'settings' => 'huxley_google',
      'priority'    => 103,
    ) ) );
    
    $wp_customize->add_setting( 'huxley_pinterest', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_pinterest', array(
      'label'    => __( 'Enter your Pinterest url', 'the-huxley' ),
      'section'  => 'huxley_social_section',
      'settings' => 'huxley_pinterest',
      'priority'    => 104,
    ) ) );
    
    $wp_customize->add_setting( 'huxley_linkedin', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_linkedin', array(
      'label'    => __( 'Enter your Linkedin url', 'the-huxley' ),
      'section'  => 'huxley_social_section',
      'settings' => 'huxley_linkedin',
      'priority'    => 105,
    ) ) );
    
    $wp_customize->add_setting( 'huxley_youtube', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_youtube', array(
      'label'    => __( 'Enter your Youtube url', 'the-huxley' ),
      'section'  => 'huxley_social_section',
      'settings' => 'huxley_youtube',
      'priority'    => 106,
    ) ) );
    
    $wp_customize->add_setting( 'huxley_tumblr', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_tumblr', array(
      'label'    => __( 'Enter your Tumblr url', 'the-huxley' ),
      'section'  => 'huxley_social_section',
      'settings' => 'huxley_tumblr',
      'priority'    => 107,
    ) ) );
    
    $wp_customize->add_setting( 'huxley_instagram', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_instagram', array(
      'label'    => __( 'Enter your Instagram url', 'the-huxley' ),
      'section'  => 'huxley_social_section',
      'settings' => 'huxley_instagram',
      'priority'    => 108,
    ) ) );
    
    $wp_customize->add_setting( 'huxley_flickr', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_flickr', array(
      'label'    => __( 'Enter your Flickr url', 'the-huxley' ),
      'section'  => 'huxley_social_section',
      'settings' => 'huxley_flickr',
      'priority'    => 109,
    ) ) );
    
    $wp_customize->add_setting( 'huxley_vimeo', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_vimeo', array(
      'label'    => __( 'Enter your Vimeo url', 'the-huxley' ),
      'section'  => 'huxley_social_section',
      'settings' => 'huxley_vimeo',
      'priority'    => 110,
    ) ) );
    
    $wp_customize->add_setting( 'huxley_yelp', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_yelp', array(
      'label'    => __( 'Enter your Yelp url', 'the-huxley' ),
      'section'  => 'huxley_social_section',
      'settings' => 'huxley_yelp',
      'priority'    => 111,
    ) ) );
    
    $wp_customize->add_setting( 'huxley_rss', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_rss', array(
      'label'    => __( 'Enter your RSS url', 'the-huxley' ),
      'section'  => 'huxley_social_section',
      'settings' => 'huxley_rss',
      'priority'    => 112,
    ) ) );
    
    $wp_customize->add_setting( 'huxley_email', array (
      'sanitize_callback' => 'sanitize_email',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_email', array(
      'label'    => __( 'Enter your email address', 'the-huxley' ),
      'section'  => 'huxley_social_section',
      'settings' => 'huxley_email',
      'priority'    => 113,
    ) ) );
    
    /* slider options */
    
    $wp_customize->add_section( 'huxley_slider_section' , array(
      'title'       => __( 'Slider Options', 'the-huxley' ),
      'priority'    => 33,
      'description' => __( 'Adjust the behavior of the image slider.', 'the-huxley' ),
    ) );

     $wp_customize->add_setting( 'huxley_display_slider', array (
      'default' => true,
      'sanitize_callback' => 'huxley_sanitize_checkbox',
    ) );
    
    $wp_customize->add_control('display_slider', array(
      'settings' => 'huxley_display_slider',
      'label' => __('Display Slider', 'the-huxley'),
      'section' => 'huxley_slider_section',
      'type' => 'checkbox',
    ));
    
    $wp_customize->add_setting( 'huxley_slider_effect', array(
      'default' => 'scrollHorz',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'huxley_sanitize_select_slider',
    ));
    
    $wp_customize->add_control( 'effect_select_box', array(
      'settings' => 'huxley_slider_effect',
      'label' => __( 'Select Effect:', 'the-huxley' ),
      'section' => 'huxley_slider_section',
      'type' => 'select',
      'choices' => array(
        'scrollHorz' => 'Horizontal (Default)',
        'scrollVert' => 'Vertical',
        'tileSlide' => 'Tile Slide',
        'tileBlind' => 'Blinds',
        'shuffle' => 'Shuffle',
      ),
    ));
    
    $wp_customize->add_setting( 'huxley_slider_timeout', array (
      'sanitize_callback' => 'huxley_sanitize_integer',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'huxley_slider_timeout', array(
      'label'    => __( 'Autoplay Speed in Seconds', 'the-huxley' ),
      'section'  => 'huxley_slider_section',
      'settings' => 'huxley_slider_timeout',
    ) ) );


     /* author bio in posts option */
    $wp_customize->add_section( 'huxley_author_bio_section' , array(
      'title'       => __( 'Display Author Bio', 'the-huxley' ),
      'priority'    => 35,
      'description' => __( 'Option to disable the author bio in the posts.', 'the-huxley' ),
    ) );
    
    $wp_customize->add_setting( 'huxley_author_bio', array (
      'default' => true,
      'sanitize_callback' => 'huxley_sanitize_checkbox',
    ) );
    
    $wp_customize->add_control('author_bio', array(
      'settings' => 'huxley_author_bio',
      'label' => __('Display Author Bio', 'the-huxley'),
      'section' => 'huxley_author_bio_section',
      'type' => 'checkbox',
    ));

    /* related posts option */
    $wp_customize->add_section( 'huxley_related_posts_section' , array(
      'title'       => __( 'Display Related Posts', 'the-huxley' ),
      'priority'    => 36,
      'description' => __( 'Option to disable the related posts in the posts.', 'the-huxley' ),
    ) );
    
    $wp_customize->add_setting( 'huxley_related_posts', array (
      'sanitize_callback' => 'huxley_sanitize_checkbox',
    ) );
    
    $wp_customize->add_control('related_posts', array(
      'settings' => 'huxley_related_posts',
      'label' => __('Display the Related Posts?', 'the-huxley'),
      'section' => 'huxley_related_posts_section',
      'type' => 'checkbox',
    ));

    /* center nav option */
    $wp_customize->add_section( 'huxley_center_nav_section' , array(
      'title'       => __( 'Centered logo and navigation', 'the-huxley' ),
      'priority'    => 37,
      'description' => __( 'Option to Display Logo and Navigation in the center.', 'the-huxley' ),
    ) );
    
    $wp_customize->add_setting( 'huxley_centered_nav', array (
      'sanitize_callback' => 'huxley_sanitize_checkbox',
    ) );
    
    $wp_customize->add_control('centered_nav', array(
      'settings' => 'huxley_centered_nav',
      'label' => __('Display Logo and Navigation in the center?', 'the-huxley'),
      'section' => 'huxley_center_nav_section',
      'type' => 'checkbox',
    ));
  
  }
endif;
add_action('customize_register', 'huxley_theme_customizer');


/**
 * Sanitize checkbox
 */
if ( ! function_exists( 'huxley_sanitize_checkbox' ) ) :
  function huxley_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
      return 1;
    } else {
      return '';
    }
  }
endif;

/**
 * Sanitize select slider
 */

if ( ! function_exists( 'huxley_sanitize_select_slider' ) ) :
  function huxley_sanitize_select_slider( $input ) {
   
    $valid = array(
    'scrollHorz' => 'Horizontal (Default)',
    'scrollVert' => 'Vertical',
    'tileSlide' => 'Tile Slide',
    'tileBlind' => 'Blinds',
    'shuffle' => 'Shuffle',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
  }
endif;

/**
 * Sanitize integer input
 */
if ( ! function_exists( 'huxley_sanitize_integer' ) ) :
  function huxley_sanitize_integer( $input ) {
    return absint($input);
  }
endif;

/**
 * Sanitize integer input
 */
if ( ! function_exists( 'huxley_sanitize_integer' ) ) :
  function huxley_sanitize_integer( $input ) {
    return absint($input);
  }
endif;
/**
* Apply Color Scheme
*/
if ( ! function_exists( 'huxley_apply_color' ) ) :
  function huxley_apply_color() {
    if ( get_theme_mod('huxley_color_settings') ) {
   ?>
  <style>
      #logo a,
      .nav li a,
      .social-icons a:hover,
      .social-icons a:focus,
      .blog-list .item a,
      .pagination li a,
      .widgettitle,
      cite.fn,
      .info p.author{
        color: <?php esc_html( get_theme_mod('huxley_color_settings') ); ?>; 
      }
      button:hover,
      html input[type="button"]:hover,
      input[type="reset"]:hover,
      input[type="submit"]:hover,
      button:focus,
      html input[type="button"]:focus,
      input[type="reset"]:focus,
      input[type="submit"]:focus,
      .blue-btn:hover, 
      #submit:hover, 
      .blue-btn:focus, 
      #submit:focus,
      .nav li ul.sub-menu li a,
      .nav li ul.children li a {
        background-color: <?php esc_html( get_theme_mod('huxley_color_settings') ); ?>; 
      }
  </style>
   <?php
    }

    if ( get_theme_mod('huxley_color_settings_2') ) {
   ?>
  <style>
      .slide-copy p a,
      .nav li.current-menu-item a,
      .blog-list .item h2 a:hover,
      .slide-copy-wrap h2 a:hover,
      a:hover,
      .slide-copy-wrap a:hover,
      .slide-copy-wrap a:focus,
      .blog-list .item .date,
      .blog-list .item a.excerpt-read-more,
      .pagination .current,
      .nav li a:hover,
      .nav li a:focus,
      .entry-content p a,
      a,
      .comment-reply-link,
      .article-footer h3, 
      .related h3, 
      #comments-title, 
      .comment-reply-title,
      #logo a:hover, 
      #logo a:focus{
        color: <?php esc_html( get_theme_mod('huxley_color_settings_2') ); ?>; 
      }
      .header[role="banner"]{
        border-bottom: 2px solid <?php esc_html( get_theme_mod('huxley_color_settings_2') ); ?>; 
      }
      .format-link a.link,
      .article-header,
      .blue-btn,
      #submit,
      button, 
      html input[type="button"], 
      input[type="reset"], 
      input[type="submit"],
      .wp-caption,
      .nav li ul.sub-menu li a:hover,
      .nav li ul.children li a:hover{
        background: <?php esc_html( get_theme_mod('huxley_color_settings_2') ); ?>; 
      }
  </style>
   <?php
    }
    
  }
endif;
add_action( 'wp_head', 'huxley_apply_color' );

/*-----------------------------------------------------------------------------------*/
/* custom functions below */
/*-----------------------------------------------------------------------------------*/

define('huxley_THEMEURL', get_template_directory_uri());
define('huxley_IMAGES', huxley_THEMEURL.'/images'); 
define('huxley_JS', huxley_THEMEURL.'/js');
define('huxley_CSS', huxley_THEMEURL.'/css');

if(is_user_logged_in()){
  add_action( 'wp_head', 'BIGPIX_user_login' );
  function BIGPIX_user_login(){ ?>
    <style>#main-navigation{top: 30px!important;}</style>
    <?php
  }
}

add_filter( 'post_thumbnail_html', 'huxley_remove_thumbnail_dimensions', 10, 3 );
function huxley_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_filter( 'the_content', 'huxley_remove_br_gallery', 11, 2);
function huxley_remove_br_gallery($output) {
    return preg_replace('/<br style=(.*)>/mi','',$output);
}

function huxley_author_excerpt() {
      $text_limit = 100; //Words to show in author bio excerpt
      $read_more  = ""; //Read more text
      $end_of_txt = "...";
      $url_of_author  = get_author_posts_url(get_the_author_meta('ID'));
      $short_desc_author = wp_trim_words(strip_tags(
                          get_the_author_meta('description')), $text_limit, 
                          $end_of_txt);

      return $short_desc_author;
   }

function huxley_catch_that_image() {
  global $post;
  $pattern = '|<img.*?class="([^"]+)".*?/>|';
  $transformed_content = apply_filters('the_content',$post->post_content);
  preg_match($pattern,$transformed_content,$matches);
  if (!empty($matches[1])) {
    $classes = explode(' ',$matches[1]);
    $id = preg_grep('|^wp-image-.*|',$classes);
    if (!empty($id)) {
      $id = str_replace('wp-image-','',$id);
      if (!empty($id)) {
        $id = reset($id);
        $transformed_content = wp_get_attachment_url($id);  
        return $transformed_content;
      }
    }
  }
  
}

function huxley_catch_that_image_thumb() {
  global $post;
  $pattern = '|<img.*?class="([^"]+)".*?/>|';
  $transformed_content = apply_filters('the_content',$post->post_content);
  preg_match($pattern,$transformed_content,$matches);
  if (!empty($matches[1])) {
    $classes = explode(' ',$matches[1]);
    $id = preg_grep('|^wp-image-.*|',$classes);
    if (!empty($id)) {
      $id = str_replace('wp-image-','',$id);
      if (!empty($id)) {
        $id = reset($id);
        $transformed_content = wp_get_attachment_image($id,'thumbnail');  
         return $transformed_content;
      }
    }
  }
 
}

function huxley_catch_gallery_image_full()  { 
    global $post;
    $gallery = get_post_gallery( $post, false );
    if ( !empty($gallery['ids']) ) {
      $ids = explode( ",", $gallery['ids'] );
      $total_images = 0;
      foreach( $ids as $id ) {
        $link = wp_get_attachment_url( $id );
        $total_images++;
        
        if ($total_images == 1) {
          $first_img = $link;
          return $first_img;
        }
      }
    } 
}

function huxley_catch_gallery_image_thumb()  { 
    global $post;
    $gallery = get_post_gallery( $post, false );
    if ( !empty($gallery['ids']) ) {
      $ids = explode( ",", $gallery['ids'] );
      $total_images = 0;
      foreach( $ids as $id ) {
        
        $image  = wp_get_attachment_image( $id, 'thumbnail');
        $total_images++;
        
        if ($total_images == 1) {
          $first_img = $image;
          return $first_img;
        }
      }
    } 
}
/* social icons*/
function huxley_social_icons()  { 
  $social_networks = array(
      "huxley_facebook" => "fa-facebook", "huxley_twitter" => "fa-twitter", "huxley_google" => "fa-google-plus",
      "huxley_pinterest" => "fa-pinterest", "huxley_linkedin" => "fa-linkedin", "huxley_youtube" => "fa-youtube",
      "huxley_tumblr" => "fa-tumblr", "huxley_instagram" => "fa-instagram", "huxley_flickr" => "fa-flickr",
      "huxley_vimeo" => "fa-vimeo-square", "huxley_rss" => "fa-rss"
  );

  foreach ($social_networks as $key => $icon) {
     
      if (get_theme_mod( $key )): ?>
       <a href="<?php echo esc_url( get_theme_mod($key) ); ?>" class="social-tw" title="<?php echo esc_attr( get_theme_mod( $key ) ); ?>" target="_blank"><i class="fa <?php echo $icon; ?>"></i></a>
      <?php endif;
  }

  if(get_theme_mod('huxley_email')): ?>
        <a href="mailto:<?php echo esc_attr(get_theme_mod('huxley_email')); ?>" class="social-tw" title="<?php echo esc_attr( get_theme_mod('huxley_email')); ?>" target="_blank"><i class="fa fa-envelope"></i> </i></a>
  <?php endif;
}

function huxley_index_query($query) {
  if ($query->is_home() && $query->is_main_query()) {
    $query->set('post__not_in', get_option( 'sticky_posts' ));
  }
}

add_action('pre_get_posts', 'huxley_index_query');

/**
 *
 * This script will prompt the users to install the plugin required to
 * enable the "Menu Item" custom post type for magazino theme.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.3.6
 * @author     Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/library/class/class-tgm.php';

add_action( 'tgmpa_register', 'huxley_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the huxley library
 * and one from the .org repo.
 *
 * The variable passed to huxley_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into huxley_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function huxley_register_required_plugins() {
 
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
 
 
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Advanced Custom Fields',
            'slug'      => 'advanced-custom-fields',
            'required'  => false,
        ),
 
    );
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'the-huxley-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'the-huxley' ),
            'menu_title'                      => __( 'Install Plugins', 'the-huxley' ),
            'installing'                      => __( 'Installing Plugin: %s', 'the-huxley' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'the-huxley' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' , 'the-huxley'), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' , 'the-huxley'), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' , 'the-huxley'), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' , 'the-huxley'), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' , 'the-huxley'), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' , 'the-huxley'), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' , 'the-huxley'), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' , 'the-huxley'), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' , 'the-huxley'),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' , 'the-huxley'),
            'return'                          => __( 'Return to Required Plugins Installer', 'the-huxley' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'the-huxley' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'the-huxley' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    tgmpa( $plugins, $config );
 
}
/* DON'T DELETE THIS CLOSING TAG */ ?>