<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */
get_header();
?>
<main id="primary" class="site-main">
    <?php if ( have_posts() ) : ?>
        <header class="page-header">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
        </header><!-- .page-header -->

        <section class="student-section">
            <?php
            // Custom query to get students sorted by name
            $student_args = array(
                'post_type'      => 'student',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC', // Sort in ascending order
            );
            $student_query = new WP_Query( $student_args );

            if ( $student_query->have_posts() ) :
                while( $student_query->have_posts() ) :
                    $student_query->the_post(); ?>
                    <article class="student-item">
                        <a href="<?php the_permalink(); ?>">
                            <h3><?php the_title(); ?></h3>
                            <div class="student-thumbnail">
                                <?php the_post_thumbnail('custom-size'); ?> <!-- Display featured image with custom size -->
                            </div>
                        </a>
                        <?php the_excerpt(); ?>
                        <?php
                        // Display the Speciality taxonomy terms with links
$specialities = get_the_terms( get_the_ID(), 'speciality' );

if ( ! is_wp_error( $specialities ) && ! empty( $specialities ) ) {
    echo '<p><strong>Speciality:</strong> ';
    foreach ( $specialities as $speciality ) {
        echo '<a href="' . esc_url( get_term_link( $speciality ) ) . '">' . esc_html( $speciality->name ) . '</a>, ';
    }
    echo '</p>';
} else {
    echo '<p><strong>Speciality:</strong> None</p>';
}
                        ?>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>' . esc_html__( 'No students found.', 'fwd' ) . '</p>';
            endif;
            ?>
        </section>
    <?php endif; ?>
</main><!-- #primary -->
<?php
get_footer();