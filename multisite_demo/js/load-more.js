jQuery(function($) {
    var page = 3;
  
    $("body").on("click", ".loadmore", function() {
        var data = {
            action: "load_posts_by_ajax",
            page: page,
            security: blog.security
        };
  
        $.post(blog.ajaxurl, data, function(response) {
            if ($.trim(response) != "") {
                $("#posts-container").append(response);
                page++;
            } else {
                $(".loadmore").hide();
                $(".no-posts-message").show();
            }
        });
    });
  });
  
  
    