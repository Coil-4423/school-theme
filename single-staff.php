<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package school-theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
            ?>
            
            <div class="entry-summary">
                                    <?php
                                    // Display Short Biography
                                    $biography = get_field( 'short_biography' );
                                    if ( $biography ) {
                                        echo '<p><strong>Biography:</strong> ' . esc_html( $biography ) . '</p>';
                                    }

                                    // Display Courses Taught
                                    $courses = get_field( 'courses' );
                                    if ( $courses ) {
                                        echo '<p><strong>Courses:</strong> ' . esc_html( $courses ) . '</p>';
                                    }

                                    // Display Instructor Website
                                    $website = get_field( 'instructor_website' );
                                    if ( $website ) {
                                        echo '<p><strong>Website:</strong> <a href="' . esc_url( $website ) . '" target="_blank">' . esc_html( $website ) . '</a></p>';
                                    }
                                    ?>

                                    <?php the_excerpt(); ?>
                                </div>
                                    <?php

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'school-theme' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'school-theme' ) . '</span> <span class="nav-title">%title</span>',
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
get_sidebar();
get_footer();
