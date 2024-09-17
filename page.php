<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package school-theme
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		<section class='blog-posts'>
		<h2><?php esc_html_e('Recent News',  'fwd'); ?></h2>
                <?php 
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page'=>3,
                );
				$blog_query = new WP_Query($args);
                if($blog_query -> have_posts()){
                    while($blog_query -> have_posts()){
                        $blog_query -> the_post();
                        ?>
                        <article>
                            <a href="<?php the_permalink(); ?>">
                                <h3><?php the_title(); ?></h3>
                                <?php
					the_post_thumbnail(
                        'recent-news',
						array(
                            'alt' => the_title_attribute(
                                array(
                                    'echo' => false,
                                    )
                                ),
                                )
                            );
                            // the_post_thumbnail('large'); 
                            ?>
                            <!-- <p class="post-date"><?php echo get_the_date(); ?></p> -->
                            </a>
                            <!-- Add the excerpt here -->
                        </article>
                        <?php
            
                    }
                    wp_reset_postdata();
                }
		?>
		</section>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
