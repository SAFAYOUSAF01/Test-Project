(function( $ ) {
    wp.customize( 'pro_banner_title', function( value ) {
        value.bind( function( newval ) {
            $( '.banner-title' ).text( newval );
        } );
    } );
})( jQuery );
jQuery(document).ready(function($) {
    $('.prev-btn, .next-btn').on('click', function(e) {
        e.preventDefault();

        var btn = $(this),
            data = {
                'action': 'load_events',
                'direction': btn.hasClass('prev-btn') ? 'prev' : 'next'
            };

        $.post(ajaxurl, data, function(response) {
            $('.events-list').html(response);
        });
    });
});
function load_events() {
    $direction = $_POST['direction'];
    $paged = (isset($_POST['paged']) && !empty($_POST['paged'])) ? $_POST['paged'] : 1;

    if ($direction == 'next') {
        $paged++;
    } else if ($direction == 'prev' && $paged > 1) {
        $paged--;
    }

    $args = array(
        'post_type' => 'events',
        'posts_per_page' => 3,
        'paged' => $paged
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/content', 'event');
        endwhile;
    endif;

    wp_die();
}
add_action('wp_ajax_load_events', 'load_events');
add_action('wp_ajax_nopriv_load_events', 'load_events');
