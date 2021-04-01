<form role="search" method="get" class="c-search__form" action="<?php echo esc_url(home_url( '/' ));  ?>">
    <label>
        <span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'cavatina' ); ?></span>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x( 'Search by Keyword', 'placeholder', 'cavatina' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label', 'cavatina' ) ?>" />
    </label>
    <input type="submit" class="search-submit button--small"
        value="<?php echo esc_attr_x( 'Search', 'submit button' , 'cavatina') ?>" />
    <button type="submit" class="search-submit-mobile">

    </button>

</form>