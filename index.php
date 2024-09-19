<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    // Custom query for posts
    $args = array(
        'post_type' => 'post', // Adjust this if you're querying a custom post type
        'orderby' => 'date',
        'order' => 'DESC', // Use 'ASC' for ascending order
    );

    $custom_query = new WP_Query($args);

    if ($custom_query->have_posts()) :

        // Optional: Display the page title if it's a blog page
        if (is_home() && !is_front_page()) :
            ?>
            <header>
                <h1 class="page-title screen-reader-text" data-aos="zoom-in"><?php single_post_title(); ?></h1>
            </header>
            <?php
        endif;

        // Start the Loop
        while ($custom_query->have_posts()) :
            $custom_query->the_post();

            /*
             * Include the Post-Type-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Type name) and that will be used instead.
             */
            ?>
<div class="entry-content" data-aos="fade-up">
            <?php

get_template_part('template-parts/content', get_post_type());
            ?>
    </div>
			<hr>
			<?php

        endwhile;

        // Display navigation to next/previous pages when applicable
        the_posts_navigation();

        // Reset post data
        wp_reset_postdata();

    else :

        // If no content, include the "No posts found" template
        get_template_part('template-parts/content', 'none');

    endif;
    ?>

</main><!-- #primary -->

<?php
get_footer();
