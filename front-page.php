<?php
/**
 * Template Name: Page Template
 */

get_header(); 

function enqueue_bootstrap() {
    wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap');

function enqueue_custom_styles() {
    wp_enqueue_style('custom-styles', get_template_directory_uri() . '/styles.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');
?>

<div class="container">
    <div class="row">
        <div class="col-md-3 background-div logo-div">
            <div class="inner-content">
                <?php 
                $custom_logo = get_theme_mod('mytheme_logo');
                if ($custom_logo) {
                    echo '<img src="' . esc_url($custom_logo) . '" alt="Logo">';
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/assets/sports-slicing/logo.svg' . '" alt="Default Logo">';
                }
                ?>
            </div>
        </div>
        <?php if (has_nav_menu('secondary')) : ?>
            <?php
            // Get the secondary menu items
            $menu_locations = get_nav_menu_locations();
            $menu_id = $menu_locations['secondary'];
            $menu_items = wp_get_nav_menu_items($menu_id);
            ?>
            <?php if (!empty($menu_items)) : ?>
                <?php foreach ($menu_items as $index => $menu_item) : ?>
                    <div class="col-md-3 background-div <?php echo ($index === 0) ? 'membership-div' : 'account-div'; ?>">
                        <div class="inner-content">
                            <a href="<?php echo esc_url($menu_item->url); ?>">
                                <?php echo esc_html($menu_item->title); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php else : ?>
            <div class="col-md-3 background-div membership-div">
                <div class="inner-content">MEMBERSHIP</div>
            </div>
            <div class="col-md-3 background-div account-div">
                <div class="inner-content">ACCOUNT</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="new-container">
    <div class="row">
        <div class="col-md-3 background-div common-background">OUR TRACK</div>
        <div class="col-md-3 background-div common-background">FIND EVENTS</div>
        <div class="col-md-3 background-div common-background">
            <div class="dropdown">
                <button class="dropbtn">TRACK MAP</button>
                <div class="dropdown-content">
                    <a href="#" class="level-two">Level Two</a>
                    <a href="#" class="level-two">Level Two</a>
                    <a href="#" class="level-two last-level-two">Level Two</a>
                    <div class="dropdown-subcontent">
                        <a href="#" class="level-three">Level Three </a>
                        <a href="#" class="level-three">Level Three </a>
                        <a href="#" class="level-three">Level Three </a>
                        <div class="dropdown-subcontent-level3">
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 background-div common-background">ABOUT US</div>
        <div class="col-md-3 background-div common-background">CONTACT US</div>
        <div class="col-md-3 search-container">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" class="search-field" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" title="Search for:">
                <button type="submit" class="search-submit">
                    <img src="<?php echo get_template_directory_uri() . '/assets/sports-slicing/icon-search.png'; ?>" alt="Search" class="search-icon">
                </button>
            </form>
        </div>
    </div>
</div>

<div class="main-banner" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/sports-slicing/main-banner.jpg'; ?>');">
    <div class="slider">
        <!-- Previous Button -->
        <button class="prev-btn1">&#10094;</button>
        
        <!-- Next Button -->
        <button class="next-btn1">&#10095;</button>

        <?php
        $slides = json_decode(get_theme_mod('my_slider_repeater'), true);
        if (!empty($slides)) {
            foreach ($slides as $index => $slide) {
                $active_class = $index === 0 ? 'active' : '';
                $image = esc_url($slide['image']);
                $title = esc_html($slide['title']);
                $textarea = esc_html($slide['textarea']);
                $video = esc_url($slide['video']);
                ?>
                <div class="slide <?php echo $active_class; ?>" style="background-image: url('<?php echo $image; ?>');">
                    <div class="slide-content">
                        <?php if ($title) : ?>
                            <h2><?php echo $title; ?></h2>
                        <?php endif; ?>
                        <?php if ($textarea) : ?>
                            <p><?php echo $textarea; ?></p>
                        <?php endif; ?>
                        <?php if ($video) : ?>
                            <a href="<?php echo $video; ?>" class="video-icon"><i class="fa fa-play"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>


<div class="container">
    <!-- First Sub-Div with 4 Post Divs -->
    <div class="subdiv-1">
        <!-- Post 1 with Previous Button -->
        <div class="post-div">
            <div class="post-image" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/sports-slicing/post-1.jpg'; ?>'); position: relative;">
                <button class="prev-btn">&#10094;</button>
            </div>
            <div class="post-title">
                <a href="<?php the_permalink(); ?>"><h2>Soccer</h2></a>
            </div>
        </div>
        <!-- Post 2 -->
        <div class="post-div">
            <div class="post-image" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/sports-slicing/post-2.jpg'; ?>');"></div>
            <div class="post-title">
                <a href="<?php the_permalink(); ?>"><h2>Hockey</h2></a>
            </div>
        </div>
        <!-- Post 3 -->
        <div class="post-div">
            <div class="post-image" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/sports-slicing/post-3.jpg'; ?>');"></div>
            <div class="post-title">
                <a href="<?php the_permalink(); ?>"><h2>Volley Ball</h2></a>
            </div>
        </div>
        <!-- Post 4 with Next Button -->
        <div class="post-div">
            <div class="post-image" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/sports-slicing/post-4.jpg'; ?>'); position: relative;">
                <button class="next-btn">&#10095;</button>
            </div>
            <div class="post-title">
                <a href="<?php the_permalink(); ?>"><h2>Rugby</h2></a>
            </div>
        </div>
    </div>
    <!-- New Sub-Div for Events Section -->
    <div class="events-section">
        <div class="events-title">Events</div>
        <div class="events-list">
            <div class="event-item">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/sports-slicing/event-1.jpg" alt="Event 1">
                <div class="event-details">
                    <h3>ADIDAS SHOW</h3>
                    <p>7th Nov, 2022<br>11:00PM - 12:00AM</p>
                </div>
            </div>
            <div class="event-item">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/sports-slicing/event-2.jpg" alt="Event 2">
                <div class="event-details">
                    <h3>ADIDAS SHOW</h3>
                    <p>7th Nov, 2022<br>11:00PM - 12:00AM</p>
                </div>
            </div>
            <div class="event-item">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/sports-slicing/event-3.jpg" alt="Event 3">
                <div class="event-details">
                    <h3>ADIDAS SHOW</h3>
                    <p>7th Nov, 2022<br>11:00PM - 12:00AM</p>
                </div>
            </div>
        </div>
        <div class="events-footer">
            <button class="prev-btn">&#8249;</button>
            <button class="next-btn">&#8250;</button>
            <a href="#" class="more-events">More Events</a>
        </div>
    </div>
</div>

<!-- New Text and Image Container -->
<div class="new-text-image-container">
    <div class="text-div">
        <p><strong>2019 NATIONAL CHAMPION</strong>
        <strong>CROWNED AT REEBOK</strong></p>
        <p>Membership has its perks. Joining ADIDAS means you can race at your local tracks.</p>
    </div>
    <div class="image-div">
        <img src="<?php echo get_template_directory_uri() . '/assets/sports-slicing/sticky-post.jpg'; ?>" alt="Sticky Post">
    </div>
   <!-- New Sub-Div -->
<div class="additional-div">
    <h3>Categories</h3>
    <p>
        &gt; Sports Shoes<br>
        &gt; Sports Garments<br>
        &gt; Sports Goods<br>
        &gt; Leather Garments<br>
        &gt; Accessories
    </p>
</div>
</div>
<!-- New Recent Posts Section -->
<div class="recent-posts-container container">
    <div class="row">
        <!-- First Set of Recent Posts -->
        <div class="col-md-4 recent-posts-set">
            <?php
            $recent_posts = new WP_Query(array(
                'posts_per_page' => 3, // Number of recent posts to display
                'post_status' => 'publish'
            ));
            
            if ($recent_posts->have_posts()) :
                $is_first_post = true; // Flag to check the first post
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
            ?>
                <div class="recent-post">
                    <div class="recent-post-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri() . '/assets/sports-slicing/recent-post.jpg'; ?>" alt="<?php the_title(); ?>" class="img-fluid">
                        <?php endif; ?>
                    </div>
                    <div class="recent-post-content" style="margin-bottom: 0;">
                        <h3 class="recent-post-title" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/sports-slicing/pettern-1.png'; ?>'); margin-bottom: 0;">
                            <?php if ($is_first_post) : ?>
                                <strong>2019 NATIONAL CHAMPION</strong> <br>
                                <strong>CROWNED AT REEBOK</strong> <br>
                                Membership has its perks. Joining ADIDAS means you can race at your local tracks.
                            <?php else : ?>
                                <?php the_title(); ?>
                            <?php endif; ?>
                        </h3>
                        <?php if ($is_first_post) : ?>
                            <!-- Remove paragraph text since it's now in the title -->
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="read-more" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/sports-slicing/pettern-3.png'; ?>'); color: white; font-weight: bold; display: block; text-align: center; padding: 10px; margin-top: 0; text-decoration: none; border-radius: 5px; width: 100%;">Read More</a>
                    </div>
                </div>
                <?php 
                if ($is_first_post) {
                    $is_first_post = false; // Set flag to false after the first post
                }
                ?>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <p>No recent posts available.</p>
            <?php endif; ?>
        </div>
        
        <!-- Second Set of Recent Posts -->
        <div class="col-md-4 recent-posts-set">
            <?php
            $recent_posts = new WP_Query(array(
                'posts_per_page' => 3,
                'post_status' => 'publish'
            ));
            
            if ($recent_posts->have_posts()) :
                $is_second_post = true; // Flag to check the second post
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
            ?>
                <div class="recent-post">
                    <div class="recent-post-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri() . '/assets/sports-slicing/recent-post.jpg'; ?>" alt="<?php the_title(); ?>" class="img-fluid">
                        <?php endif; ?>
                    </div>
                    <div class="recent-post-content" style="margin-bottom: 0;">
                        <h3 class="recent-post-title" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/sports-slicing/pettern-1.png'; ?>'); margin-bottom: 0;">
                            <?php if ($is_second_post) : ?>
                                <strong>2019 NATIONAL CHAMPION</strong> <br>
                                Membership has its perks.
                            <?php else : ?>
                                <?php the_title(); ?>
                            <?php endif; ?>
                        </h3>
                        <a href="<?php the_permalink(); ?>" class="read-more" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/sports-slicing/pettern-3.png'; ?>'); color: white; font-weight: bold; display: block; text-align: center; padding: 10px; margin-top: 0; text-decoration: none; border-radius: 5px; width: 100%;">Read More</a>
                    </div>
                </div>
                <?php 
                if ($is_second_post) {
                    $is_second_post = false; // Set flag to false after the second post
                }
                ?>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <p>No recent posts available.</p>
            <?php endif; ?>
        </div>
        
        <!-- Third Set of Recent Posts -->
        <div class="col-md-4 recent-posts-set">
            <?php
            $recent_posts = new WP_Query(array(
                'posts_per_page' => 3,
                'post_status' => 'publish'
            ));
            
            if ($recent_posts->have_posts()) :
                $is_third_post = true;
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
            ?>
                <div class="recent-post">
                    <div class="recent-post-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri() . '/assets/sports-slicing/recent-post.jpg'; ?>" alt="<?php the_title(); ?>" class="img-fluid">
                        <?php endif; ?>
                    </div>
                    <div class="recent-post-content" style="margin-bottom: 0;">
                        <h3 class="recent-post-title" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/sports-slicing/pettern-1.png'; ?>'); margin-bottom: 0;">
                            <?php if ($is_third_post) : ?>
                                <strong>2019 NATIONAL CHAMPION</strong> <br>
                                <strong>CROWNED AT REEBOK</strong> <br>
                                Membership has its perks.
                            <?php else : ?>
                                <?php the_title(); ?>
                            <?php endif; ?>
                        </h3>
                        <a href="<?php the_permalink(); ?>" class="read-more" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/sports-slicing/pettern-3.png'; ?>'); color: white; font-weight: bold; display: block; text-align: center; padding: 10px; margin-top: 0; text-decoration: none; border-radius: 5px; width: 100%;">Read More</a>
                    </div>
                </div>
                <?php 
                if ($is_third_post) {
                    $is_third_post = false; // Set flag to false after the third post
                }
                ?>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <p>No recent posts available.</p>
            <?php endif; ?>
        </div>
        </div>
                 <!-- Second Sub-Div: Title and Text -->
        <div class="col-md-6 second-sub-div">
            <h2 class="section-title">Recent Updates</h2>
            <div class="weather-widget">
                <div class="weather-icon">
                    <img src="your-icon-url-here.png" alt="Weather Icon">
                </div>
                <div class="weather-info">
                    <h3 class="weather-time">19:30</h3>
                    <p class="weather-location">San Francisco</p>
                    <p class="weather-temperature">23°C</p>
                    <p class="weather-status">Clear</p>
                    <div class="weather-forecast">
                        <div class="forecast-item">
                            <p>Tue</p>
                            <p>22/16°C</p>
                        </div>
                        <div class="forecast-item">
                            <p>Wed</p>
                            <p>24/18°C</p>
                        </div>
                        <div class="forecast-item">
                            <p>Thu</p>
                            <p>24/17°C</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="additional-container">
    <div class="row">
        <div class="col-md-4 new-div">
            <h2>Latest Tweets</h2>
            <div class="twitter-image">
                <img src="<?php echo get_template_directory_uri() . '/assets/sports-slicing/twitter.png'; ?>" alt="Twitter Logo" class="img-fluid">
            </div>
        </div> <!-- Close col-md-4 -->

        <div class="col-md-4 new-div">
            <h2>Facebook Page</h2>
            <div class="facebook-page">
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
            </div>
        </div> <!-- Close col-md-4 -->

        <div class="col-md-4 new-div">
            <div class="date-time-container">
                <div class="date-time-title">Date & Time</div>
                <div class="date-time-widget">
                    <div class="date">Friday, 22 July, 2024</div>
                    <div class="time">12:50:15</div>
                </div>
            </div>
        </div> <!-- Close col-md-4 -->
    </div> <!-- Close row -->
</div> <!-- Close additional-container -->


        </div> <!-- Close col-md-4 -->
    </div> <!-- Close row -->
</div> <!-- Close additional-container -->

<!-- New Div Container -->
<div class="new-div-container">
    <div class="row">
        <div class="col-md-12 new-sub-div top-div" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/sports-slicing/pettern-3.png');">
            <div class="button-group">
                <button class="btn btn-primary" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/sports-slicing/pettern-3.png');">Match Info</button>
                <button class="btn btn-primary" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/sports-slicing/pettern-3.png');">Match Results</button>
                <button class="btn btn-primary" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/sports-slicing/pettern-3.png');">Match Schedule</button>
            </div>
            <div class="match-info" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/sports-slicing/pettern-1.png');">
                <p class="details-text">
                Here is a brief overview of the match. This section provides a quick summary of the upcoming event.
                    Detailed match information includes: 
                    <br>Date: August 10, 2024 
                    <br>Time: 7:00 PM 
                    <br>Location: Stadium XYZ 
                    <br>Teams: Team A vs. Team B 
                    <br>Referee: John Doe 
                    <br>Weather: Clear skies expected 
                    <br>Previous meetings: Team A won 3-1 in their last encounter 
                    <br>Ticket information: Available online 
                    <br>Special events: Halftime show featuring a local band
                </p>
            </div>
        </div>
    </div>
</div>
<script>
function showContent(contentId) {
    // Hide all content divs
    document.querySelectorAll('.content-div').forEach(div => {
        div.style.display = 'none';
    });

    // Show the selected content
    document.getElementById(contentId).style.display = 'block';
}
</script>
        <!-- Footer Section -->
<div class="footer" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/sports-slicing/pettern-3.png');">
    <div class="footer-content">
        <div class="footer-section">
            <h2>SITE MAP</h2>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Our Tracks</a></li>
                <li><a href="#">Fixed Events</a></li>
                <li><a href="#">Track Map</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h2>IMPORTANT LINKS</h2>
            <ul>
                <li><a href="https://www.loginpress.pro">www.loginpress.pro</a></li>
                <li><a href="https://www.wpbrigade.com">www.wpbrigade.com</a></li>
                <li><a href="https://www.simplesocialbuttons.com">www.simplesocialbuttons.com</a></li>
                <li><a href="https://www.wordpress.org">www.wordpress.org</a></li>
                <li><a href="https://www.analytify.io">www.analytify.io</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h2>ADIDAS</h2>
            <p><strong>ADIDAS</strong></p>
            <p>&copy; <?php echo date('Y'); ?> Designed by WPBrigade</p> <!-- Copyright and designer credit -->
        </div>
    </div>
</div>

<!-- Disclaimer Section -->
<div class="disclaimer">
    <div class="disclaimer-content">
        <p><strong>Disclaimer:</strong> The information provided on this website is for general informational purposes only. While we strive to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability, or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk.</p>
    </div>
</div>

<?php get_footer(); ?>
