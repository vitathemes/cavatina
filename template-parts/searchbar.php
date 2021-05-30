<!-- Searchbar Mobile -->
<div class="c-search">
    <div class="c-search__content">
        <div class="c-search__wrapper">
            <div class="c-search__context">
                <span class="c-search__title"><?php esc_html_e( 'Search', 'cavatina' ); ?></span>
            </div>
            <button aria-label="<?php esc_attr( 'Search menu mobile Button', 'cavatina' ) ?>"
                class="c-search__icon js-search__icon"></button>
        </div>
        <div class="c-search__form js-search__form">
            <div class="c-search__holder">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</div>