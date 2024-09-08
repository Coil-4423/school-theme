<?php
get_header(); ?>

<main id="primary" class="site-main">

    <header class="page-header">
    <h1><?php esc_html_e( 'Staff', 'fwd' ); ?></h1>

    </header>

    <?php
        // Display the content of the current page
        while ( have_posts() ) :
            the_post();
            the_content();  // Displays the page content
        endwhile;
        ?>

    <?php
    // Get all terms (categories) in the 'staff-category' taxonomy
    $staff_categories = get_terms( array(
        'taxonomy'   => 'staff-category',  // Ensure this taxonomy exists for staff
        'hide_empty' => true,              // Only show categories that have posts
    ) );

    if ( ! empty( $staff_categories ) && ! is_wp_error( $staff_categories ) ) :
        // Loop through each category
        foreach ( $staff_categories as $category ) : ?>

            <section class="staff-category-section">
                <h2 class="staff-category-title"><?php echo esc_html( $category->name ); ?></h2>

                <?php
                // Query posts from the current category (term)
                $staff_query = new WP_Query( array(
                    'post_type'      => 'staff',           // Ensure 'staff' is registered as a post type
                    'posts_per_page' => -1,                // Show all posts
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'staff-category', // Ensure 'staff-category' exists and matches this slug
                            'field'    => 'slug',
                            'terms'    => $category->slug,  // Query for the specific category
                        ),
                    ),
                ) );

                if ( $staff_query->have_posts() ) : ?>
                    <div class="staff-post-list">
                        <?php
                        while ( $staff_query->have_posts() ) :
                            $staff_query->the_post(); ?>

                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <a href="<?php the_permalink(); ?>">
                                    <h3><?php the_title(); ?></h3>
                                </a>

                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="staff-thumbnail">
                                        <?php the_post_thumbnail( 'thumbnail' ); // Display the thumbnail ?>
                                    </div>
                                <?php endif; ?>

                                <div class="entry-summary">
                                    <?php
                                    // Display Short Biography from ACF
                                    $biography = get_field( 'short_biography' );
                                    if ( $biography ) {
                                        echo '<p><strong>Biography:</strong> ' . esc_html( $biography ) . '</p>';
                                    }

                                    // Display Courses from ACF
                                    $courses = get_field( 'courses' );
                                    if ( $courses ) {
                                        echo '<p><strong>Courses:</strong> ' . esc_html( $courses ) . '</p>';
                                    }

                                    // Display Instructor Website from ACF
                                    $website = get_field( 'instructor_website' );
                                    if ( $website ) {
                                        echo '<p><strong>Website:</strong> <a href="' . esc_url( $website ) . '" target="_blank">' . esc_html( $website ) . '</a></p>';
                                    }
                                    ?>

                                    <?php the_excerpt(); // Display excerpt if available ?>
                                </div>
                            </article>

                        <?php endwhile; ?>
                    </div>
                <?php
                else :
                    echo '<p>No staff members found in this category.</p>';
                endif;

                // Reset Post Data
                wp_reset_postdata(); ?>
            </section>

        <?php endforeach; ?>
    <?php else : ?>
        <p><?php esc_html_e( 'No staff categories found.', 'school-theme' ); ?></p>
    <?php endif; ?>

</main>

<?php
get_footer();
