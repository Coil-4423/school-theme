<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package school-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'school-theme' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			// the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$school_theme_description = get_bloginfo( 'description', 'display' );
			if ( $school_theme_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $school_theme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div>

		<div class="hamburger">
		  <span class="line"></span>
		  <span class="line"></span>
		  <span class="line"></span>
		</div>
		<!-- <nav id="site-navigation" class="main-navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
    		<img src="<?php echo esc_url( get_template_directory_uri() . '/images/iconmonstr-menu-lined.svg' ); ?>" alt="<?php esc_attr_e( 'Menu Icon', 'school-theme' ); ?>" />
		</button>
		</nav> -->
		<div class="nav__link hide">
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'header-menu', // Ensure this matches your registered menu
					'menu_id'        => 'primary-menu', // Give it an ID for styling purposes
					'container'      => 'ul', // You can remove the surrounding <div> and have just the <ul>
				)
			);
			?>
		</div>
	</header><!-- #masthead -->
	