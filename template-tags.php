<?php
/**
 * Custom template tags for this theme.
 *
 * @package PRO
 */

if ( ! function_exists( 'pro_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function pro_posted_on() {
    echo '<span class="posted-on">' . esc_html__( 'Posted on ', 'pro' ) . get_the_date() . '</span>';
}
endif;

if ( ! function_exists( 'pro_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function pro_posted_by() {
    echo '<span class="byline"> ' . esc_html__( 'by ', 'pro' ) . '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
}
endif;

?>
