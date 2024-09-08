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

        <?php
        // First custom query for 'web' category
        $web_args = array(
            'post_type'      => 'student',
            'posts_per_page' => -1,
            'tax_query'      => array(
                array (
                    'taxonomy' => 'speciality',
                    'field'    => 'slug',
                    'terms'    => 'Designer'
                ),
            ),
        );

        $web_query = new WP_Query( $web_args );

        if ( $web_query->have_posts() ) : ?>
            <section class="student-section">
                <h2><?php esc_html_e( 'Developer', 'fwd' ); ?></h2>
                <?php
                while( $web_query->have_posts() ) :
                    $web_query->the_post(); ?>
                    <article class="student-item">
                        <a href="<?php the_permalink(); ?>">
                            <h3><?php the_title(); ?></h3>
                            <?php the_post_thumbnail('custom-size') ?>
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
                ?>
            </section>
        <?php
        endif;
        ?>

        <?php
        // Second custom query for 'photo' category
        $photo_args = array(
            'post_type'      => 'student',
            'posts_per_page' => -1,
            'tax_query'      => array(
                array (
                    'taxonomy' => 'speciality',
                    'field'    => 'slug',
                    'terms'    => 'Developer'
                ),
            ),
        );

        $photo_query = new WP_Query( $photo_args );

        if ( $photo_query->have_posts() ) : ?>
            <section class="student-section">
                <h2><?php esc_html_e( 'Designer', 'fwd' ); ?></h2>
                <?php
                while( $photo_query->have_posts() ) :
                    $photo_query->the_post(); ?>
                    <article class="student-item">
                        <a href="<?php the_permalink(); ?>">
                            <h3><?php the_title(); ?></h3>
                            <?php the_post_thumbnail('custom-size') ?>
                        </a>
                        <?php the_excerpt(); ?>
                        <?php
// Display the Speciality taxonomy terms with links
$specialities = get_the_terms( get_the_ID(), 'speciality' );

if ( ! is_wp_error( $specialities ) && ! empty( $specialities ) ) {
    echo '<p><strong>Specialities:</strong> ';
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
                ?>
            </section>
        <?php
        endif;
        ?>

    <?php endif; ?>



</main><!-- #primary -->

<?php
get_footer();
