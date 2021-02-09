<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cavatina
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'c-single__blog__post' ); ?>>
    <header class="c-single__blog__header entry-header">
        <div class="c-single__blog__meta entry-meta">
            <?php
                echo '<span class="c-post__category ">'.  esc_html( cavatina_get_category() ) .'</span>';
                echo '<span class="o-bullet o-bullet--sm"></span>';
				echo '<span class="c-post__date">'.esc_html( cavatina_get_date()) .'</span>';
			?>
        </div><!-- .entry-meta -->
        <?php
		if ( is_singular() ) :
			the_title( '<h2 class="c-single__blog__entry-title">', '</h2>' );
		else :
			the_title( '<h2 class="entry-title "><a class="c-post__entry-title__anchor" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
        <div class="c-single__author">
            <div class="c-single__author__avatar">
                <?php echo get_avatar( get_the_author_meta('user_email'), '80', '' ); ?>
            </div>
            <div class="c-single__author__info">
                <span>By <?php the_author_link(); ?></span>
            </div>
        </div>
    </header><!-- .entry-header -->

    <?php cavatina_get_thumbnail() ?>

    <div class="c-single__blog__entery-content">
        <?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'cavatina' ),
					array(
						'span' => array(
							'class' => array(),
						),
                    )
				),
				wp_kses_post( get_the_title() )
			)
		);
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cavatina' ),
				'after'  => '</div>',
			)
		);
        ?>
    </div><!-- .entry-content -->
    <ul class="c-single__blog__tags">
        <?php
        $post_tags = get_the_tags();
            if ($post_tags) {
            foreach($post_tags as $post_tag) {
                echo '<li><a href="'.  esc_url( get_tag_link( $post_tag->term_id ) ) .'" title="'.  esc_attr( $post_tag->name ) .'">#'. esc_html( $post_tag->name ). '</a></li>';
            }
        }
        ?>
    </ul>

    <div class="c-social-media c-social-media--blog">
        <span class="c-social-media__title">Share :</span>
        <a href="#" class="c-social-media__item">
            <svg width="16" height="15" viewBox="0 0 16 15" xmlns="http://www.w3.org/2000/svg">
                <path class="c-social-media__icon" fill-rule="evenodd" clip-rule="evenodd"
                    d="M0 1.76471C0 0.790086 0.790086 0 1.76471 0C2.23273 0 2.68159 0.185924 3.01254 0.51687C3.34349 0.847817 3.52941 1.29668 3.52941 1.76471C3.52941 2.73933 2.73933 3.52941 1.76471 3.52941C0.790086 3.52941 0 2.73933 0 1.76471ZM15.4412 9.18529C15.4716 7.27491 14.1683 5.60084 12.3088 5.16176C11.0627 4.89344 9.76383 5.24529 8.82353 6.10588V5.73529C8.82353 5.49163 8.62601 5.29411 8.38235 5.29411H6.17647C5.93282 5.29411 5.73529 5.49163 5.73529 5.73529V14.5588C5.73529 14.8025 5.93282 15 6.17647 15H8.38235C8.62601 15 8.82353 14.8025 8.82353 14.5588V9.58235C8.80174 8.69621 9.41934 7.92235 10.2882 7.74705C10.8056 7.65774 11.3359 7.80344 11.735 8.14456C12.1341 8.48568 12.3606 8.98679 12.3529 9.51176V14.5588C12.3529 14.8025 12.5505 15 12.7941 15H15C15.2437 15 15.4412 14.8025 15.4412 14.5588V9.18529ZM3.52941 5.73529V14.5588C3.52941 14.8025 3.33189 15 3.08824 15H0.882353C0.638698 15 0.441176 14.8025 0.441176 14.5588V5.73529C0.441176 5.49164 0.638698 5.29412 0.882353 5.29412H3.08824C3.33189 5.29412 3.52941 5.49164 3.52941 5.73529Z"
                    fill="#8A8A8A" />
            </svg>
        </a>
        <a href="#" class="c-social-media__item">
            <svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="c-social-media__icon"
                    d="M7.91667 2.5H5.41667C4.95643 2.5 4.58333 2.8731 4.58333 3.33333V5.83333H7.91667C8.01145 5.83123 8.10134 5.87533 8.15769 5.95156C8.21404 6.0278 8.22982 6.12667 8.2 6.21667L7.58333 8.05C7.52651 8.21827 7.36926 8.33201 7.19167 8.33333H4.58333V14.5833C4.58333 14.8135 4.39679 15 4.16667 15H2.08333C1.85321 15 1.66667 14.8135 1.66667 14.5833V8.33333H0.416667C0.186548 8.33333 0 8.14678 0 7.91667V6.25C0 6.01988 0.186548 5.83333 0.416667 5.83333H1.66667V3.33333C1.66667 1.49238 3.15905 0 5 0H7.91667C8.14678 0 8.33333 0.186548 8.33333 0.416667V2.08333C8.33333 2.31345 8.14678 2.5 7.91667 2.5Z"
                    fill="#8A8A8A" />
            </svg>
        </a>
        <a href="#" class="c-social-media__item">
            <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="c-social-media__icon"
                    d="M15.3769 7.69418C15.3743 11.0018 13.2565 13.9371 10.1184 14.9823C10.0009 15.0185 9.87332 14.9986 9.7724 14.9285C9.6715 14.8551 9.61156 14.738 9.61096 14.6132V12.5606C9.62759 12.0077 9.49479 11.4606 9.22657 10.9769C9.18599 10.9136 9.18599 10.8326 9.22657 10.7693C9.25775 10.711 9.31485 10.671 9.38032 10.6617C11.2562 10.4695 12.3017 9.72377 12.3017 7.69418C12.3469 6.74653 12.0184 5.819 11.3869 5.11105C11.479 4.812 11.5281 4.50139 11.5329 4.18851C11.5296 3.90799 11.4909 3.62902 11.4176 3.35822C11.3693 3.17765 11.1958 3.05984 11.0101 3.08146C10.3058 3.18144 9.65005 3.49854 9.13431 3.98863C8.17959 3.80416 7.19839 3.80416 6.24368 3.98863C5.72794 3.49854 5.07223 3.18144 4.36784 3.08146C4.18216 3.05984 4.00872 3.17765 3.96038 3.35822C3.88711 3.62902 3.84836 3.90799 3.84506 4.18851C3.84984 4.50139 3.89903 4.812 3.99113 5.11105C3.35956 5.819 3.03106 6.74653 3.07628 7.69418C3.07628 9.8314 4.23714 10.5464 6.36668 10.7232C6.10233 11.0696 5.92087 11.472 5.83622 11.8994C5.83622 11.8994 5.83622 11.9532 5.83622 11.9917C5.83252 12.0275 5.83252 12.0635 5.83622 12.0993C5.80423 12.341 5.58692 12.5142 5.3442 12.4914C5.22846 12.486 5.11545 12.4544 5.01362 12.3991C4.59479 12.1441 4.22506 11.816 3.92194 11.4305C3.72881 11.2115 3.52348 11.0036 3.30691 10.8078C3.16931 10.6886 3.01684 10.5879 2.85333 10.5079C2.73874 10.4436 2.59889 10.4436 2.48431 10.5079C2.37431 10.5785 2.30771 10.7001 2.30749 10.8308V10.8769C2.30771 11.0076 2.37431 11.1293 2.48431 11.1998C2.76028 11.4308 2.99886 11.7031 3.19159 12.0071C3.51708 12.5171 3.93104 12.9649 4.41396 13.3294C4.73215 13.5427 5.10721 13.6552 5.49026 13.6523H5.76703V14.6132C5.76643 14.738 5.70649 14.8551 5.60558 14.9285C5.50467 14.9986 5.37709 15.0185 5.25963 14.9823C1.53259 13.7409 -0.659069 9.88943 0.17747 6.05121C1.01401 2.21298 4.60962 -0.37717 8.5152 0.0450015C12.4208 0.467173 15.3798 3.76584 15.3769 7.69418Z"
                    fill="#8A8A8A" />
            </svg>
        </a>
        <a href="#" class="c-social-media__item">
            <svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="c-social-media__icon"
                    d="M17.6205 2.17393C17.1651 2.78129 16.6147 3.3111 15.9906 3.7429C15.9906 3.90156 15.9906 4.06022 15.9906 4.22769C15.9956 7.10894 14.8447 9.87169 12.7959 11.8966C10.7471 13.9215 7.97186 15.0391 5.09225 14.999C3.42748 15.0045 1.78404 14.6244 0.290649 13.8883C0.210126 13.8532 0.158189 13.7735 0.158495 13.6856V13.5886C0.158495 13.4621 0.261052 13.3595 0.387562 13.3595C2.02398 13.3055 3.60203 12.7382 4.89842 11.7376C3.41723 11.7078 2.08454 10.8303 1.47123 9.48111C1.44025 9.40741 1.44989 9.32289 1.49668 9.25808C1.54346 9.19327 1.62063 9.15753 1.70029 9.16379C2.15046 9.20904 2.60512 9.16714 3.03945 9.04039C1.40434 8.70096 0.175742 7.34352 -9.00902e-05 5.68208C-0.00633942 5.60238 0.029378 5.52518 0.0941588 5.47837C0.15894 5.43156 0.24342 5.42191 0.31708 5.4529C0.755872 5.64652 1.22955 5.7485 1.7091 5.75259C0.276359 4.81221 -0.342491 3.02358 0.202546 1.39825C0.258807 1.24032 0.393973 1.12365 0.558374 1.09111C0.722774 1.05858 0.892158 1.11498 1.00428 1.23959C2.93768 3.29731 5.5942 4.52349 8.41372 4.6596C8.3415 4.37142 8.30598 4.07525 8.308 3.77816C8.33437 2.22032 9.29826 0.832559 10.7484 0.264583C12.1986 -0.303393 13.848 0.0608181 14.9245 1.18671C15.6583 1.04692 16.3677 0.800439 17.0302 0.455108C17.0787 0.424812 17.1402 0.424812 17.1888 0.455108C17.219 0.503656 17.219 0.56522 17.1888 0.613768C16.8679 1.34854 16.3258 1.96482 15.6381 2.37666C16.2403 2.30683 16.8319 2.16477 17.4002 1.95357C17.448 1.921 17.5109 1.921 17.5588 1.95357C17.5989 1.9719 17.6288 2.00697 17.6407 2.04943C17.6526 2.09189 17.6452 2.13743 17.6205 2.17393Z"
                    fill="#8A8A8A" />
            </svg>
        </a>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->
<div class="u-border"></div>