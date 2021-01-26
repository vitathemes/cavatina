/* Load More */

jQuery(function ($) {
  $(document).ready(function () {
    const button = $(".js-pagination__load-more__btn");

    // use jQuery code inside this to avoid "$ is not defined" error
    $(".js-pagination__load-more").click(function () {
      var loadMore = $(this),
        data = {
          action: "loadmore",
          query: loadmore_params.posts, // that's how we get params from wp_localize_script() function
          page: loadmore_params.current_page,
        };
      $.ajax({
        // you can also use $.post here
        url: loadmore_params.ajaxurl, // AJAX handler
        data: data,
        type: "POST",
        beforeSend: function (xhr) {
          button.text("Loading . . . "); // change the loadMore text, you can also add a preloader image
        },
        success: function (data) {
          if (data) {
            loadMore.prev().after(data); // insert new posts
            button.text("Load More");

            loadmore_params.current_page++;

            if (loadmore_params.current_page == loadmore_params.max_page)
              loadMore.remove(); // if last page, remove the loadMore

            // you can also fire the "post-load" event here if you use a plugin that requires it
            // $( document.body ).trigger( 'post-load' );
          } else {
            loadMore.remove(); // if no data, remove the loadMore as well
          }
        },
      });
    });
  });
});
