<?php
/**
 * The template for displaying all single student posts
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

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

        <nav class='student-links'>
            <?php
            // Get the current student's speciality term (e.g., Developer, Designer)
            $terms = get_the_terms( get_the_ID(), 'speciality' );
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                $term_slugs = array();

                // Get the first term (assuming only one speciality per student)
                foreach ( $terms as $term ) {
                    $term_slugs[] = $term->slug;
                }

                // Query students who share the same Speciality term
                $args = array(
                    'post_type'      => 'student',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',  // Change to 'DESC' for descending order
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'speciality',
                            'field'    => 'slug',
                            'terms'    => $term_slugs,  // Match students with the same speciality
                        ),
                    ),
                );

                $students_query = new WP_Query( $args );

                if ( $students_query->have_posts() ) :
                    echo '<h2>' . esc_html__( 'Meet other Designer students:', 'school-theme' ) . '</h2>';
                    echo '<ul>';
                    while ( $students_query->have_posts() ) :
                        $students_query->the_post();
                        ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php
                    endwhile;
                    echo '</ul>';
                    wp_reset_postdata();
                else :
                    echo '<p>' . esc_html__( 'No other students found with this speciality.', 'school-theme' ) . '</p>';
                endif;
            } else {
                echo '<p>' . esc_html__( 'No speciality assigned to this student.', 'school-theme' ) . '</p>';
            }
            ?>
        </nav>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
