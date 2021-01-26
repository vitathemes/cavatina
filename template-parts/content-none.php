<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-cavatina
 */

?>

<main class="o-page__main o-page__main--no-results not-found">
    <header class="o-page__main__header o-page__main__header--align-left">
        <h1 class="o-page__main__title"><?php esc_html_e( 'Nothing Found', 'wp-cavatina' ); ?></h1>
    </header><!-- .page-header -->
    <div class="o-page__main__content">
        <?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p >' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wp-cavatina' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>
        <p class="o-page__main__desc">
            <?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wp-cavatina' ); ?>
        </p>
        <?php
			get_search_form();
		else :
			?>
        <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wp-cavatina' ); ?>
        </p>
        <?php
			get_search_form();
		endif;
		?>
    </div><!-- .page-content -->
</main><!-- .no-results -->