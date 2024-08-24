<?php
/**
 * Theme Customizer for PRO Theme.
 *
 * @package PRO
 */

function pro_customize_register( $wp_customize ) {

    // Add a section for the homepage banner
    $wp_customize->add_section( 'pro_homepage_banner', array(
        'title'    => __( 'Homepage Banner', 'pro' ),
        'priority' => 30,
    ));

    // Add a setting for the banner title
    $wp_customize->add_setting( 'pro_banner_title', array(
        'default'           => __( 'Welcome to Our Website', 'pro' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    // Add a control for the banner title
    $wp_customize->add_control( 'pro_banner_title_control', array(
        'label'    => __( 'Banner Title', 'pro' ),
        'section'  => 'pro_homepage_banner',
        'settings' => 'pro_banner_title',
        'type'     => 'text',
    ));
}

add_action( 'customize_register', 'pro_customize_register' );

function pro_customize_preview_js() {
    wp_enqueue_script( 'pro-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'pro_customize_preview_js' );
?>
