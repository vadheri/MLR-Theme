$(document).ready(function () {
    // AJAX Category Filter
    $('#category-dropdown').change(function () {
        var category_id = $(this).val();
        
        // Fade out current posts
        $('#posts-container').fadeOut('slow', function () {
            
            // AJAX request to filter posts by category
            $.ajax({
                url: ajax_object.ajax_url,
                type: 'POST',
                data: {
                    action: 'filter_posts_by_category',
                    category_id: category_id
                },
                success: function (response) {
                    // Update the posts container with the new posts
                    $('#posts-container').html(response);
                    
                    // Fade in the new posts
                    $('#posts-container').fadeIn(300);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching posts: ' + textStatus, errorThrown);
                }
            });
        });
    });
});
