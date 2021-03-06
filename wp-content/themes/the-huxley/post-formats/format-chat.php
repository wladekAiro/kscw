<section class="entry-content cf" itemprop="articleBody">
  <?php if(class_exists('acf')): ?>
    <div class="chat-content">
      <?php echo get_field('wpdevshed_post_format_chat_content'); ?>
    </div>
  <?php endif; ?>
  <?php

  the_content();

  wp_link_pages( array(
  'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'the-huxley' ) . '</span>',
  'after'       => '</div>',
  'link_before' => '<span>',
  'link_after'  => '</span>',
  ) );
  echo get_the_tag_list('<div class="clear"></div><div class="tag-links">','','</div>');
  ?>
</section> <?php // end article section ?>