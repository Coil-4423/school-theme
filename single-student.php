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
    // Check if the student query has posts
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post(); ?>
            <article class="student-item">
                <a href="<?php the_permalink(); ?>">
                    <h2><?php the_title(); ?></h2>
                </a>
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'medium' ); // You can use a custom image size ?>
                    </a>
                <?php endif; ?>

                <?php the_content(); ?>

                <div class="specialty">
                    <strong><?php esc_html_e( 'Specialty:', 'school-theme' ); ?></strong>
                    <?php
                    // Display the Specialty taxonomy terms as a list with links
                    $specialities = get_the_terms( get_the_ID(), 'speciality' );
                    if ( ! is_wp_error( $specialities ) && ! empty( $specialities ) ) {
                        foreach ( $specialities as $speciality ) {
                            echo '<a href="' . esc_url( get_term_link( $speciality ) ) . '">' . esc_html( $speciality->name ) . '</a>, ';
                        }
                    } else {
                        echo 'None';
                    }
                    ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p><?php esc_html_e( 'No student found.', 'school-theme' ); ?></p>
    <?php endif; ?>
</main><!-- #main -->
<?php
// get_sidebar();
get_footer();