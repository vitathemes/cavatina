<?php 
/**
 * Template Name: Home
 *
 * Displays the Home Page Template of the theme.
 *
 * @package cavatina
 * 
 */

get_header();
 ?>


<aside class="o-page__col c-aside c-aside--home js-aside">
    <div class="c-aside__content">
        <div class="c-aside__nav">
            <h4 class="c-aside__nav-title h4-lh--sm"><?php esc_html_e( 'Navigation', 'cavatina' ); ?></h4>
            <?php
                if ( has_nav_menu( 'primary-menu' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location'    => 'primary-menu',
                            'menu_id'           => 'primary-menu-registered',
                            "menu_class"        => "s-nav",
                            "container_class"   => "c-nav",
                            "container"         => "nav",
                        )
                    );
                }
            ?>
        </div>
        <?php
            /**
             * Show last 5 projects (post type) if exist, otherwise show last 5 posts in home page
             */
            if(post_type_exists( 'projects' )){
                $post_type_args = array( 'post_type' => 'projects' );
                $post_type_args = new WP_Query( $post_type_args );
                $numposts = $post_type_args->post_count;
                
                if ($numposts >= 1) {
                    $carousel_post_type = 'projects';
                }else{
                    $carousel_post_type = 'post';
                }
            }
            else{
                $carousel_post_type = 'post';
            }

            $loop = new WP_Query( array(
                    'post_type'      => $carousel_post_type,
                    'posts_per_page' => 5
            ));
        ?>
        <div class="c-aside__carousel">
            <div class="c-carousel c-carousel--aside">
                <h4 class="c-carousel__title"><?php esc_html_e( 'Recent Projects', 'cavatina' ); ?></h4>
                <div class="c-carousel__post-titles js-carousel__post-titles">
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <?php the_title( '<a href="'. esc_url( get_permalink() ) .'" class="c-carousel__post-title js-carousel__post-title"><span class="o-bullet-decimal-numeric"></span><p class="c-carousel__post-title__text js-carousel__post-title__text">', '</p></a>' ); ?>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
            <a href="<?php echo esc_url( site_url() ) ?>/projects" class="c-carousel__more">
                <?php esc_html_e( 'View All Projects', 'cavatina' ); ?>
            </a>
        </div>
    </div>
</aside><!-- .c-aside  -->
<main class="o-page__main js-page__main o-page__main--home">
    <div class="o-page__col c-content c-content--home">
        <div class="c-carousel">
            <p class="c-carousel__title c-carousel__title--home">
                <?php esc_html_e( 'Recent Projects', 'cavatina' ); ?>
            </p>
            <div class="c-carousel__slider">
                <div class="c-carousel__context js-carousel__context">
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <div class="c-carousel__cell">
                        <a href="<?php echo esc_html(get_permalink()); ?>">
                            <?php cavatina_get_thumbnail_with_preloader("c-carousel__image"); ?>
                        </a>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
            <div
                class="c-carousel__post-titles js-carousel__post-titles c-carousel__post-titles--mobile js-carousel__post-titles--mobile">
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <?php the_title( '<a href="' . esc_url( get_permalink() ) . '" class="c-carousel__post-title"><span class="o-bullet-decimal-numeric-small"></span><p class="c-carousel__post-title__text js-carousel__post-title__text-mobile">', '</p></a>' ); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <a href="<?php echo esc_url( site_url() ) ?>/projects" class="c-carousel__more c-carousel__more--home">
                <?php esc_html_e( 'View All Projects', 'cavatina' ); ?>
            </a>
        </div>
    </div>
</main><!-- .o-page__main  -->
<?php get_footer(); ?>
</div><!-- .o-page  -->