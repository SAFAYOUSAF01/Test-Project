<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PRO
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'pro' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'pro' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'pro' ), 'pro', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<div class="footer-section">
    <?php if ( is_active_sidebar( 'footer-menu-widget' ) ) : ?>
        <?php dynamic_sidebar( 'footer-menu-widget' ); ?>
    <?php endif; ?>
</div>
<p>&copy; <?php echo date('Y'); ?> <?php echo get_theme_mod( 'footer_disclaimer', '© 2024 Designed by WPBrigade' ); ?></p>


<?php wp_footer(); ?>

</body>
</html>
