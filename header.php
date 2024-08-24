<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PRO
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php 
    // Enqueue any custom fonts or styles here if necessary
    wp_head(); 
    ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'pro' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="site-branding">
            <?php
            // Display custom logo if available
            if ( function_exists( 'the_custom_logo' ) ) {
                the_custom_logo();
            }

            // Display site title or logo only when not on the front page and home
            if ( ! ( is_front_page() && is_home() ) ) :
                ?>
                <p class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                </p>
                <?php
            endif;

            // Display site description if available
            $pro_description = get_bloginfo( 'description', 'display' );
            if ( $pro_description || is_customize_preview() ) :
                ?>
                <p class="site-description"><?php echo esc_html( $pro_description ); ?></p>
            <?php endif; ?>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <?php esc_html_e( 'Primary Menu', 'pro' ); ?>
            </button>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'menu',
                    'fallback_cb'    => false, // Prevent fallback if no menu is assigned
                    'before'         => '',    // Ensure these properties are defined
                    'after'          => '',
                    'link_before'    => '',
                    'link_after'     => '',
                )
            );
            ?>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
