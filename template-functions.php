<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package PRO
 */

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function pro_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">';
    }
}
add_action( 'wp_head', 'pro_pingback_header' );

/**
 * Add custom classes to the array of body classes.
 */
function pro_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    return $classes;
}
add_filter( 'body_class', 'pro_body_classes' );

?>
