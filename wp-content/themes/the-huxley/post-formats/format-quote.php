<section class="entry-content cf" itemprop="articleBody">
    <?php if(class_exists('acf')): ?>
        <blockquote>
            <p class="quote-content"><?php echo get_field('wpdevshed_post_format_quote_content'); ?></p>
            <p class="quote-source">-<?php echo get_field('wpdevshed_post_format_quote_source'); ?></p>
        </blockquote>
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