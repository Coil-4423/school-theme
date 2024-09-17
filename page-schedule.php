<?php
get_header(); ?>

<main id="primary" class="site-main">

    <header class="page-header">
    <h1><?php esc_html_e( 'Course Schedule', 'fwd' ); ?></h1>
    </header>

    <?php
if (have_posts()) : 
    while (have_posts()) : 
        the_post();
        
        // Output the 'outline' field
        $outline = get_field('outline'); 
        if ($outline) {
            echo '<p>' . esc_html($outline) . '</p>';
        } else {
            echo '<p>Outline field is empty or not found.</p>';
        }

        // Output the 'weekly course schedule' field with HTML allowed
        $weekly_schedule = get_field('weekly_course_schedule');
        if ($weekly_schedule) {
            // Use wp_kses_post() to allow HTML content like the table to render
            echo wp_kses_post($weekly_schedule);
        } else {
            echo '<p>Weekly Course Schedule field is empty or not found.</p>';
        }

    endwhile; 
endif;
?>

</main>

<?php
get_footer();
