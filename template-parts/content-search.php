<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cavatina
 */
$decimalCounter = "0";
?>


<?php
        // get post number (auto increment)
        $postNumber = cavatina_get_post_number();

        // Remove zero when reaching 10
        if($postNumber >= 10){
            $decimalCounter = "";
            $postNumber = $postNumber;
        }
        else{$postNumber = $decimalCounter.$postNumber;}
    ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'c-post c-post--archive' ); ?>>
    <header class="c-post__header entry-header">
        <?php
            if ( is_singular() ) :
                the_title( '<h2 class="c-post__entry-title c-post__entry-title--projects entry-title"><a class="c-post__entry-title__anchor" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            else :
                the_title( '<h2 class="c-post__entry-title c-post__entry-title--projects entry-title"><a class="c-post__entry-title__anchor" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;
        ?>
        <div class="c-post__meta entry-meta c-post__category--blog ">
            <?php

            echo esc_html('<span class="c-post__category">'. cavatina_get_category() .'</span>');
            echo '<span class="o-bullet"></span>';
            echo esc_html('<span class="c-post__date">'. cavatina_get_date() .'</span>');

            ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="c-post__thumbnail">
        <a href=<?php the_permalink() ?>>
            <?php the_post_thumbnail('large', array('class' => 'c-post__thumbnail__image')); ?>
        </a>
    </div>

    <div class="entry-content">
        <?php
        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cavatina' ),
                'after'  => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->