jQuery(document).ready(function($) {

    // Handle the Previous Button Click
    $('.prev-btn').on('click', function(e) {
        e.preventDefault();
        loadPosts('prev');
    });

    // Handle the Next Button Click
    $('.next-btn').on('click', function(e) {
        e.preventDefault();
        loadPosts('next');
    });

    function loadPosts(direction) {
        var ajaxurl = localized_vars.ajax_url; // Use the localized ajax URL
        var current_page = parseInt($('.subdiv-1').attr('data-page'));
        var total_pages = parseInt($('.subdiv-1').attr('data-total-pages'));

        // Calculate the new page number
        var new_page = (direction === 'next') ? current_page + 1 : current_page - 1;

        // Make sure new_page is within valid range
        if (new_page < 1 || new_page > total_pages) return;

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'load_slider_posts', // The action name in PHP
                page: new_page,
            },
            success: function(response) {
                $('.subdiv-1').html(response.content);
                $('.subdiv-1').attr('data-page', new_page); // Update the current page number
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error: ' + status + error);
            }
        });
    }
});
