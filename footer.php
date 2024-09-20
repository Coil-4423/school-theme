<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package school-theme
 */

?>

<footer id="colophon" class="site-footer">
    <div class="site-info">
        <?php 
        if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo(); 
        }
        ?>
		<div class='site-description'>

		</div>
        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'school-theme' ) ); ?>">
            <?php
            printf( esc_html__( 'Proudly powered by %s', 'school-theme' ), 'WordPress' );
            ?>
        </a>

        <span class="sep"> | </span>

        <?php
        printf( esc_html__( 'Theme: %1$s by %2$s', 'school-theme' ), 'school-theme', '<a href="https://sumitake.ca">Takehito</a>' );
        ?>
    </div><!-- .site-info -->

    <!-- Add footer links for Schedule and News -->
    <div class="footer-links">
        <a href="#">Schedule</a> | 
        <a href="#">News</a>
    </div>

    <!-- Add Photos Courtesy section -->
    <div class="footer-courtesy">
        Photos courtesy of <a href="https://burst.shopify.com/">Burst</a>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
