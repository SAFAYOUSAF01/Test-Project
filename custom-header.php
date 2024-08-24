<?php
/**
 * Implements Custom Header functionality for the theme.
 *
 * @package PRO
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses pro_header_style()
 */
function pro_custom_header_setup() {
    add_theme_support( 'custom-header', apply_filters( 'pro_custom_header_args', array(
        'default-image'      => '',
        'default-text-color' => '000000',
        'width'              => 1000,
        'height'             => 250,
        'flex-height'        => true,
        'wp-head-callback'   => 'pro_header_style',
    ) ) );
}
add_action( 'after_setup_theme', 'pro_custom_header_setup' );

if ( ! function_exists( 'pro_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see pro_custom_header_setup().
 */
function pro_header_style() {
    $header_text_color = get_header_textcolor();

    // If no custom options for text are set, let's bail.
    if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
        return;
    }

    // Custom styles for the header text.
    ?>
    <style type="text/css">
    <?php
        if ( ! display_header_text() ) :
    ?>
        .site-title,
        .site-description {
            display: none;
        }
    <?php
        else :
    ?>
        .site-title a,
        .site-description {
            color: #<?php echo esc_attr( $header_text_color ); ?>;
        }
    <?php endif; ?>
    </style>
    <?php
}
endif;

?>
