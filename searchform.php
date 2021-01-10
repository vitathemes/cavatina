<form role="search" method="get" class="c-search__form" action="<?php echo home_url( '/' ); ?>">
    <label>
        <span class="screen-reader-text">Search for:</span>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x( 'Search by Keyword', 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </label>
    <input type="submit" class="search-submit button--small"
        value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
    <button type="submit" class="search-submit-mobile">

    </button>

</form>