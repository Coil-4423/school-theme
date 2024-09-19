<?php
get_header(); ?>

<main id="primary" class="site-main">

    <header class="page-header">
        <h1 class="page-title"><?php single_term_title(); ?></h1> <!-- Title of the term -->
        <p><?php echo term_description(); ?></p> <!-- Term description, if available -->
    </header>

    <?php if (have_posts()) : ?>
        <div class="student-list">
            <?php while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <a href="<?php the_permalink(); ?>">
                        <h2><?php the_title(); ?></h2> <!-- Student name -->
                    </a>
                    <div class='student-info'>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="student-thumbnail">
                                <?php the_post_thumbnail('custom-size'); ?> <!-- Display featured image with custom size -->
                            </div>
                        <?php endif; ?>

                        <div class="student-content">
                            <?php the_content(); ?>
                        </div>
                    </div>

                </article>

            <?php endwhile; ?>
        </div>

        <?php the_posts_navigation(); ?>

    <?php else : ?>
        <p><?php esc_html_e('No students found for this speciality.', 'school-theme'); ?></p>
    <?php endif; ?>

</main>

<?php
get_footer();
