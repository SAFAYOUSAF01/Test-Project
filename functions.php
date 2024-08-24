<?php
/**
 * Theme Functions File
 */

// Enqueue theme styles and scripts
function mytheme_enqueue_styles() {
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('main-css', get_stylesheet_uri());
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');

// Theme setup function
function mytheme_setup() {
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add support for title tag
    add_theme_support('title-tag');

    // Add support for post thumbnails
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'mytheme'),
    ));
}
add_action('after_setup_theme', 'mytheme_setup');

// Customizer settings for logo
function mytheme_custom_logo_setup($wp_customize) {
    $wp_customize->add_setting('mytheme_logo');

    $wp_customize->add_control(new WP_Customize_Image_control($wp_customize, 'mytheme_logo', array(
        'label'    => __('Upload Logo', 'mytheme'),
        'section'  => 'title_tagline',
        'settings' => 'mytheme_logo',
    )));
}
add_action('customize_register', 'mytheme_custom_logo_setup');

// Register widget areas
function mytheme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'mytheme'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'mytheme'),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'mytheme_widgets_init');

// Custom logo display function (for use in template files)
function mytheme_display_custom_logo() {
    $custom_logo_id = get_theme_mod('mytheme_logo');
    if ($custom_logo_id) {
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
    } else {
        echo '<img src="' . get_template_directory_uri() . '/assets/default-logo.png" alt="Default Logo">';
    }
}
// Register the main navigation menu
function mytheme_register_menus() {
    register_nav_menu('main-menu', __('Main Menu', 'mytheme'));
}
add_action('after_setup_theme', 'mytheme_setup');
function custom_post_type_events() {
    $labels = array(
        'name'               => _x( 'Events', 'post type general name' ),
        'singular_name'      => _x( 'Event', 'post type singular name' ),
        'menu_name'          => _x( 'Events', 'admin menu' ),
        'name_admin_bar'     => _x( 'Event', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'event' ),
        'add_new_item'       => __( 'Add New Event' ),
        'new_item'           => __( 'New Event' ),
        'edit_item'          => __( 'Edit Event' ),
        'view_item'          => __( 'View Event' ),
        'all_items'          => __( 'All Events' ),
        'search_items'       => __( 'Search Events' ),
        'parent_item_colon'  => __( 'Parent Events:' ),
        'not_found'          => __( 'No events found.' ),
        'not_found_in_trash' => __( 'No events found in Trash.' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'events' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' )
    );

    register_post_type( 'events', $args );
}
add_action( 'init', 'custom_post_type_events' );
function enqueue_slider_ajax_script() {
    wp_enqueue_script('slider-ajax', get_template_directory_uri() . '/js/slider-ajax.js', array('jquery'), null, true);
    wp_localize_script('slider-ajax', 'localized_vars', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_slider_ajax_script');
function load_slider_posts_ajax_handler() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = array(
        'post_type' => 'your_custom_post_type', // Replace with your custom post type
        'posts_per_page' => 4,
        'paged' => $page
    );

    $loop = new WP_Query($args);

    ob_start();

    while ($loop->have_posts()) : $loop->the_post(); ?>
        <div class="post-div">
            <div class="post-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>'); position: relative;">
                <?php if ($loop->current_post == 0) : ?>
                    <button class="prev-btn">&#10094;</button>
                <?php elseif ($loop->current_post == 3) : ?>
                    <button class="next-btn">&#10095;</button>
                <?php endif; ?>
            </div>
            <div class="post-title">
                <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
            </div>
        </div>
    <?php
    endwhile;

    wp_reset_postdata();

    $response = array(
        'content' => ob_get_clean(),
    );

    echo json_encode($response);
    wp_die(); // Required to terminate immediately and return a proper response
}
add_action('wp_ajax_load_slider_posts', 'load_slider_posts_ajax_handler');
add_action('wp_ajax_nopriv_load_slider_posts', 'load_slider_posts_ajax_handler');
function mytheme_customize_register($wp_customize) {
    // Add a section for the match information
    $wp_customize->add_section('match_info_section', array(
        'title'      => __('Match Info', 'mytheme'),
        'priority'   => 30,
    ));

    // Match Info Content
    $wp_customize->add_setting('match_info_content', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post', // Sanitization callback function
    ));
    $wp_customize->add_control('match_info_content_control', array(
        'label'    => __('Match Info Content', 'mytheme'),
        'section'  => 'match_info_section',
        'settings' => 'match_info_content',
        'type'     => 'textarea',
    ));

    // Match Results Content
    $wp_customize->add_setting('match_results_content', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('match_results_content_control', array(
        'label'    => __('Match Results Content', 'mytheme'),
        'section'  => 'match_info_section',
        'settings' => 'match_results_content',
        'type'     => 'textarea',
    ));

    // Match Schedule Content
    $wp_customize->add_setting('match_schedule_content', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('match_schedule_content_control', array(
        'label'    => __('Match Schedule Content', 'mytheme'),
        'section'  => 'match_info_section',
        'settings' => 'match_schedule_content',
        'type'     => 'textarea',
    ));
}

add_action('customize_register', 'mytheme_customize_register');
function theme_footer_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Menu Widget', 'your-theme-text-domain' ),
        'id'            => 'footer-menu-widget',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'theme_footer_widgets_init' );
function theme_customize_register( $wp_customize ) {
    // Add setting for footer disclaimer
    $wp_customize->add_setting( 'footer_disclaimer', array(
        'default'           => '© 2024 Designed by WPBrigade',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    // Add control for footer disclaimer
    $wp_customize->add_control( 'footer_disclaimer_control', array(
        'label'    => __( 'Footer Disclaimer', 'your-theme-text-domain' ),
        'section'  => 'title_tagline', // Existing section in Customizer
        'settings' => 'footer_disclaimer',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'theme_customize_register' );
function wpb_link_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'url'   => '#',
        'title' => 'Link',
    ), $atts, 'wpb-link' );

    return '<a href="' . esc_url( $atts['url'] ) . '" target="_blank">' . esc_html( $atts['title'] ) . '</a>';
}
add_shortcode( 'wpb-link', 'wpb_link_shortcode' );
function wpb_dynamic_year_shortcode() {
    return date('Y');
}
add_shortcode( 'current_year', 'wpb_dynamic_year_shortcode' );

?>
<?php
$event_date = get_post_meta(get_the_ID(), 'event_date', true);
$event_time = get_post_meta(get_the_ID(), 'event_time', true);
?>

<p><?php echo 'Date: ' . $event_date; ?></p>
<p><?php echo 'Time: ' . $event_time; ?></p>
