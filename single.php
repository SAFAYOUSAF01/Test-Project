<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package PRO
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'pro' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'pro' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
function add_events_meta_boxes() {
    add_meta_box("event_details", "Event Details", "event_details_meta_box_markup", "events", "side", "high", null);
}

function event_details_meta_box_markup($post) {
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    $event_date = get_post_meta($post->ID, "event_date", true);
    $event_time = get_post_meta($post->ID, "event_time", true);

    echo '<label for="event_date">Event Date:</label>';
    echo '<input name="event_date" type="date" value="' . $event_date . '">';

    echo '<label for="event_time">Event Time:</label>';
    echo '<input name="event_time" type="time" value="' . $event_time . '">';
}

add_action("add_meta_boxes", "add_events_meta_boxes");

function save_event_details($post_id) {
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    $event_date = "";
    $event_time = "";

    if(isset($_POST["event_date"])) {
        $event_date = $_POST["event_date"];
    }
    update_post_meta($post_id, "event_date", $event_date);

    if(isset($_POST["event_time"])) {
        $event_time = $_POST["event_time"];
    }
    update_post_meta($post_id, "event_time", $event_time);
}

add_action("save_post", "save_event_details");
get_sidebar();
get_footer();
